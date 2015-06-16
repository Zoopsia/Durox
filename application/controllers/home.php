<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
	}

	public function home(){
		
		/*---- PONGO "1" POR LA EMPRESA, SI ES OTRA EMPRESA CAMBIARLO----*/
		
		$db['empresas']=$this->empresas_model->getRegistro(1);

			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view("home/inicio.php");		
	}

		
}