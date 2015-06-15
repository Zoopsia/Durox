<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('clientes_model');
	}

	public function clientes_tabla($output){
		
		$db['empresas']=$this->empresas_model->getEmpresas();

			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php", $output);
			$this->load->view("nav_left.php");	
			$this->load->view("clientes/clientes_tabla.php");
					
	}
	
	public function clientes_pestanas($id){
		
		$db['empresas']=$this->empresas_model->getEmpresas();
		$db['clientes']=$this->clientes_model->getClientes($id);
		$db['vendedores']=$this->clientes_model->getClientesVendedores($id);
		$db['telefonos']=$this->clientes_model->getClientesTelefonos($id);
		
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view("clientes/clientes_pestanas.php");
					
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
				 ->display_as('apellido','Apellido');
			
			$crud->set_subject('Cliente');
			
			$crud->fields(	'nombre',
							'apellido');
							
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			
			
			$output = $crud->render();
			
			$this->clientes_tabla($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url('Clientes/clientes_pestanas').'/'.$row->id_cliente;
	}
	
		
}