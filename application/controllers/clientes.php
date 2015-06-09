<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->model('empresas_model');

		$this->load->library('grocery_CRUD');
	}

	public function prueba(){
		
		$db['empresas']=$this->empresas_model->getEmpresas();
		
		$this->load->view("head.php", $db);
		$this->load->view("menu.php");
	}
	
}