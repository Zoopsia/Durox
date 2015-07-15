<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends My_Controller {
	
	protected $_subject		= 'clientes';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		$this->load->model('grupos_model');
		
	}
	

	public function pestanas($id){
		
		$db['empresas']		=$this->empresas_model->getRegistro(1);
		$db['clientes']		=$this->clientes_model->getCliente($id);
		$db['vendedores']	=$this->clientes_model->getCruce($id,'vendedores');	
		$db['telefonos']	=$this->clientes_model->getCruce($id,'telefonos');
		$db['direcciones']	=$this->clientes_model->getCruce($id,'direcciones');
		$db['mails']		=$this->clientes_model->getCruce($id,'mails');
		$db['pedidos']		=$this->clientes_model->getPedidos($id);
		$db['grupos']		=$this->grupos_model->getTodo();
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/pestanas.php");
					
	}
	

	public function clientes_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			//$crud->where('clientes', 0);
			
			$crud->set_table('clientes');
			
			$crud->columns(	'nombre',
							'apellido');
			
			$crud->display_as('nombre','Nombre')
				 ->display_as('apellido','Apellido')
				 ->display_as('id_grupo_cliente','Grupo')
				 ->display_as('id_razon_social','Razón Social');
			
			$crud->set_subject('Cliente');
			
			$crud->fields(	'nombre',
							'apellido',
							'cuit',
							'id_grupo_cliente',
							'id_razon_social');
							
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));

			$crud->set_relation('id_razon_social','razon_social','razon_social');
			
			$crud->set_relation('id_grupo_cliente','grupos_clientes','grupo_nombre');
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			
			
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_cliente;
	}
	
	function editarCliente($id_cliente)
	{
		$registro	= $this->clientes_model->getRegistro($id_cliente);
		
		$destino 	= 'img/clientes/';
		
		if(isset($_FILES['imagen']['tmp_name']))
		{
			
			$origen 	= $_FILES['imagen']['tmp_name'];
			$url		= $destino.$_FILES['imagen']['name'];
			$imagen		= base_url().$url;
			if(!empty($_FILES['imagen']['tmp_name'])){
				copy($origen, $url);	
			}
			else {
				foreach ($registro as $key) {
					$imagen = $key->imagen;
				}
			}
			
			$cliente	= array(		
					'nombre_fantasia'	=> $this->input->post('alias'),
					'id_grupo_cliente'	=> $this->input->post('id_grupo_cliente'),
					'imagen'			=> $imagen
			);
			
		}
			
		$id = $this->clientes_model->update($cliente, $id_cliente);	
		
		$this->pestanas($id_cliente);
		
	}

}