<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends My_Controller {
	
	protected $_subject		= 'pedidos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id)
	{
		
		$db['pedidos']=$this->pedidos_model->getDetallePedido($id);

		$this->pestanas_vista($db);	
	}
	

	public function pedidos_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('pedidos.eliminado', 0);
			
			$crud->set_table('pedidos');
			
			$crud->columns('id_pedido',
							'id_cliente',
							'id_vendedor',
							'id_estado_pedido',
							'date_add');
			
			$crud->display_as('id_pedido','N° Pedido')
				 ->display_as('id_cliente','Cliente')
				 ->display_as('id_vendedor','Vendedor')
				 ->display_as('id_estado_pedido','Estado')
				 ->display_as('date_add','Fecha Ingreso');
				 
			$crud->required_fields();
			
			$crud->set_subject('Pedidos');
			
			$crud->fields(	'id_pedido',
							'id_cliente',
							'id_vendedor',
							'id_estado_pedido');
			
			
							
			$crud->order_by('date_add','asc');
							
			$crud->set_relation('id_cliente','clientes','{apellido} {nombre}');
			$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			$crud->set_relation('id_estado_pedido','estados_pedidos','estado');
			
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			$crud->callback_delete(array($this,'delete_user'));
			
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_edit();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}

	public function delete_user($primary_key)
	{
		$arreglo = array(
			'eliminado'		=> 1
		);
		return $this->pedidos_model->update($arreglo,$primary_key);
	}

	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_pedido;
	}
	
		
}