<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('clientes_model');
		$this->load->model('productos_model');
		$this->load->model('pedidos_model');
		$this->load->model('visitas_model');
	}

	public function index()
	{
		$db['empresas'] = $this->empresas_model->getRegistro(1);
		$db['title']	= 'Inicio';
		$db['subtitle'] = $this->lang->line('inicio');
		
		$db['clientes_cantidad'] = $this->clientes_model->getCantidad();
		$db['productos_cantidad'] = $this->productos_model->getCantidad();
		$db['pedidos_cantidad'] = $this->pedidos_model->getCantidad();
		$db['visitas_cantidad'] = $this->visitas_model->getCantidad();
		
		$this->load->view("plantilla/head.php", $db);
		$this->load->view("plantilla/nav_top.php");
		$this->load->view("plantilla/nav_left.php");	
		$this->load->view("home/inicio.php");
		$this->load->view("plantilla/footer.php");		
	}

		
}