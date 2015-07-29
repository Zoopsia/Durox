<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends My_Controller {
	
	protected $_subject		= 'clientes';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		$this->load->model('grupos_model');
		
	}
	
	

	public function index()
	{
		$db['empresas'] = $this->empresas_model->getRegistro(1);
		$db['title']	= $this->_subject;
		$db['subtitle'] = $this->lang->line('visitas');;
		
		$this->load->view("plantilla/head.php", $db);
		$this->load->view("plantilla/nav_top.php");
		$this->load->view("plantilla/nav_left.php");
		$this->load->view("plantilla/footer.php");
		$this->load->view("test.php");
	}
}