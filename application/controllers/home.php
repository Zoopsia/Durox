<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('clientes_model');
	}

	public function home(){
		
		$db['empresas']=$this->empresas_model->getEmpresas();

			$this->load->view("head.php", $db);
			$this->load->view("menu2.php");
			$this->load->view("cuerpo.php");	
					
	}

		
}