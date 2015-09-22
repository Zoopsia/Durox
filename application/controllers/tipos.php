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
			
			$crud->required_fields('tipo');
			
			$crud->set_subject('Tipos');
			
			$crud->fields('tipo');

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
			'user_upd'		=> $session_data['id_usuario'],
			'eliminado'		=> 0
		);
		
		$id			= $this->tipos_model->update($arreglo,$primary_key);
		
		$log		= array(
			'accion'	=> 'INSERT',
			'tabla'		=> 'tipos',
			'id_cambio'	=> $primary_key
		);
		
		$this->tipos_model->logRegistros($log);
		
		return true;
	}
	
	function updateDatos($post_array, $primary_key)
	{
		$session_data = $this->session->userdata('logged_in');
		
		$arreglo	= array(
			'user_upd'		=> $session_data['id_usuario'],
			'eliminado'		=> 0
		);
		
		$id			= $this->tipos_model->update($arreglo,$primary_key);
		
		return true;
	}

}