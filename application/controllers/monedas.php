<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monedas extends My_Controller {
	
	protected $_subject		= 'monedas';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function Monedas(){
		
		$db['monedas']		=$this->monedas_model->getTodo();
		
		$this->cargar_vista($db, 'tabla');
	}
	
}