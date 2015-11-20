<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exemplo_graficos extends My_Controller {
	
	protected $_subject		= 'graficos';
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);
	
	
	}

	public function index(){
		$this->load->library('Graficos');
			
		$this->load->view("plantilla/head.php");
		$this->load->view($this->_subject."/ejemplo.php");
		$this->load->view("plantilla/footer.php");	
	}

		
}