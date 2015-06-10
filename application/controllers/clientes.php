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

	public function prueba($output){
		
		$db['empresas']=$this->empresas_model->getEmpresas();

			$this->load->view("head.php", $db);
			$this->load->view("menu.php", $output);
			$this->load->view("cuerpo.php");	
			$this->load->view("clientes.php");
					
	}
	
	public function prueba2(){
		
		$db['empresas']=$this->empresas_model->getEmpresas();
		$db2['clientes']=$this->clientes_model->getClientes($_REQUEST['id']);

			$this->load->view("head.php", $db);
			$this->load->view("menu2.php");
			$this->load->view("cuerpo.php");	
			$this->load->view("clientes2.php", $db2);
					
	}
	
	public function index()
	{
		$this->prueba((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	
	}
	
	
	public function clientes_abm(){
			$crud = new grocery_CRUD();

			//$crud->set_theme('datatables');
			//$crud->where('clientes', 0);
			$crud->set_table('clientes');
			
			$crud->columns(	'nombre_cliente',
							'apellido_cliente');
			
			$crud->display_as('nombre_cliente','Nombre')
				 ->display_as('apellido_cliente','Apellido');
			
			$crud->set_subject('Cliente');
			
			$crud->fields(	'nombre_cliente',
							'apellido_cliente');
							
			$crud->add_action('Photos', '', '','glyphicon-home',array($this,'just_a_test'));
			
			$output = $crud->render();
			
			$this->prueba($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url('Clientes/prueba2').'?id='.$row->id_cliente;
	}
	
		
}