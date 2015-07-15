<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presupuestos extends My_Controller {
	
	protected $_subject		= 'presupuestos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('clientes_model');
		$this->load->model('vendedores_model');
		$this->load->model('productos_model');
		$this->load->model('visitas_model');
			
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id){
		
		$db['empresas']=$this->empresas_model->getRegistro(1);
		$db['presupuestos']=$this->presupuestos_model->getDetallePresupuesto($id);

		
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/pestanas.php");
					
	}
	

	public function presupuestos_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			//$crud->where('pedidos', 0);
			
			$crud->set_table('presupuestos');
			
			$crud->columns('id_presupuesto',
							'id_cliente',
							'id_vendedor',
							'id_estado_presupuesto',
							'date_add');
			
			$crud->display_as('id_presupuesto','N° Pedido')
				 ->display_as('id_cliente','Cliente')
				 ->display_as('id_vendedor','Vendedor')
				 ->display_as('id_estado_presupuesto','Estado')
				 ->display_as('date_add','Fecha Ingreso');
			
			$crud->set_subject('Presupuestos');
			
			$crud->fields(	'id_presupuesto',
							'id_cliente',
							'id_vendedor',
							'id_estado_presupuesto');
			
			
							
			$crud->order_by('date_add','asc');
							
			$crud->set_relation('id_cliente','clientes','{apellido} {nombre}');
			$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			$crud->set_relation('id_estado_presupuesto','estados_presupuestos','estado');
			
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_operations();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_presupuesto;
	}
	
	public function carga($id_visita=null){
		
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		$db['productos']	= $this->productos_model->getTodo();
		$db['visitas']		= $this->visitas_model->getTodo();
		$db['estados']		= $this->presupuestos_model->getTodo('estados_presupuestos');
		
		if($id_visita){
			$db['visita']	= $this->visitas_model->getRegistro($id_visita);;
		}
		else
			$db['visita']	= '';
			
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/carga.php");
				
	}
	
	public function nuevoPresupuesto(){
		
		$presupuesto	= array(
			'id_visita'				=> $this->input->post('id_visita'),
			'id_cliente' 			=> $this->input->post('id_cliente'), 
			'id_vendedor' 			=> $this->input->post('id_vendedor'),
			'date_add'				=> $this->input->post('date_add'),
			'date_upd'				=> $this->input->post('date_add'),
			'id_estado_presupuesto'	=> $this->input->post('id_estado_presupuesto')	
		);

		$id_presupuesto = $this->presupuestos_model->insert($presupuesto);
		
		echo $id_presupuesto;
		//redirect('Visitas/carga/'.$id_visita,'refresh');
		
	}
		
}