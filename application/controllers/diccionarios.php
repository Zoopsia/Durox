<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diccionarios extends My_Controller {
	
	protected $_subject		= 'diccionarios';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function Diccionarios(){
		
		$db['empresas'] 	= $this->empresas_model->getRegistro(1);
		
		$this->cargar_vista($db, 'tabla');
	}
	
}