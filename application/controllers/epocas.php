<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Epocas extends My_Controller {
	
	protected $_subject		= 'epocas';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}

	public function epocas_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('epocas_visitas.eliminado', 0);
			
			$crud->set_table('epocas_visitas');
			
			$crud->columns('epoca');
			
			$crud->display_as('epoca','Epoca');
			
			$crud->required_fields('epoca');
			
			$crud->set_subject('Época');
			
			$crud->fields('epoca');

			$crud->callback_after_insert(array($this, 'insertDatos'));
			$crud->callback_after_update(array($this, 'updateDatos'));
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}
	
	function insertDatos($post_array, $primary_key)
	{
		$session_data = $this->session->userdata('logged_in');
		
		$arreglo	= array(
			'date_add'		=> date('Y-m-d H:i:s'),
			'user_add'		=> $session_data['id_usuario'],
			'user_upd'		=> $session_data['id_usuario']
		);
		
		$id			= $this->epocas_model->update($arreglo,$primary_key);
		
		return true;
	}
	
	function updateDatos($post_array, $primary_key)
	{
		$session_data = $this->session->userdata('logged_in');
		
		$arreglo	= array(
			'user_upd'		=> $session_data['id_usuario']
		);
		
		$id			= $this->epocas_model->update($arreglo,$primary_key);
		
		return true;
	}

}