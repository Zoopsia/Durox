<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendedores extends My_Controller {
	
	protected $_subject		= 'vendedores';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);
		

		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('view');

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
	}

		
	public function pestanas($id){
		
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['vendedores']	= $this->vendedores_model->getRegistro($id);
		$db['clientes']		= $this->vendedores_model->getCruce($id,'clientes');
		$db['telefonos']	= $this->vendedores_model->getCruce($id,'telefonos');
		$db['direcciones']	= $this->vendedores_model->getCruce($id,'direcciones');
		$db['mails']		= $this->vendedores_model->getCruce($id,'mails');
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/pestanas.php");					
	}
	

	public function vendedores_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			//$crud->where('vendedores', 0);
			
			$crud->set_table('vendedores');
			
			$crud->columns(	'nombre',
							'apellido');
			
			$crud->display_as('nombre','Nombre')
				 ->display_as('apellido','Apellido');
			
			$crud->set_subject('vendedor');
			
			$crud->fields(	'nombre',
							'apellido');
							
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_vendedor;
	}
	
		
}