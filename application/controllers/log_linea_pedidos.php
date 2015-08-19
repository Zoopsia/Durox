<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_Linea_Pedidos extends My_Controller {
	
	protected $_subject		= 'log';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}

}