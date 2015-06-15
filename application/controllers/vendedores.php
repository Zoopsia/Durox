<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendedores extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('vendedores_model');
	}

	public function vendedores_tabla($output){
		
		$db['empresas']=$this->empresas_model->getEmpresas();

			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php", $output);
			$this->load->view("nav_left.php");	
			$this->load->view("vendedores/vendedores_tabla.php");
					
	}
	
	public function vendedores_pestanas($id){
		
		$db['empresas']=$this->empresas_model->getEmpresas();
		$db['vendedores']=$this->vendedores_model->getVendedores($id);
		$db['clientes']=$this->vendedores_model->getVendedoresClientes($id);

			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view("vendedores/vendedores_pestanas.php");
					
	}
	

	public function vendedores_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			//$crud->where('vendedores', 0);
			
			$crud->set_table('vendedores');
			
			$crud->columns(	'nombre',
							'apellido');
			
			$crud->display_as('nombre','Nombre')
				 ->display_as('apellido','Apellido');
			
			$crud->set_subject('vendedor');
			
			$crud->fields(	'nombre',
							'apellido');
							
			$crud->add_action('Photo', '', '','glyphicon-user',array($this,'just_a_test'));
			
			$output = $crud->render();
			
			$this->vendedores_tabla($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url('vendedores/vendedores_pestanas').'/'.$row->id_vendedor;
	}
	
		
}