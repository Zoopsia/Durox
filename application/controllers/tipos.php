<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipos extends My_Controller {
	
	protected $_subject		= 'tipos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}

	public function tipos_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('tipos.eliminado', 0);
			
			$crud->set_table('tipos');
			
			$crud->columns(	'tipo');
			
			$crud->display_as('tipos','Tipos');
			
			$crud->set_subject('Tipos');
			
			$crud->fields('tipo');

			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}

}