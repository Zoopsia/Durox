<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('usuarios_model');
		$this->load->model('empresas_model');
		
	}

	function index()
	{
		$db['empresas'] = $this->empresas_model->getRegistro(1);
		
		$this->load->helper(array('form'));
		$this->load->view('plantilla/head', $db);
		$this->load->view('login/inicio');
	}
 
	function logout()
	{
		$db['empresas'] = $this->empresas_model->getRegistro(1);
		
		$this->session->unset_userdata('logged_in');
	  	session_destroy();
	  	$this->load->view('plantilla/head', $db);
	   	$this->load->view('login/inicio');
	}
	
	function control()
	{
		$db['empresas'] = $this->empresas_model->getRegistro(1);
	   	$password = $this->input->post('password');
	   	$username = $this->input->post('username');
	   
	  	$usuario = $this->check_database($password, $username);
	   
	   	if($usuario == FALSE){
		    $db['error'] = 'error';
		    $this->load->view('plantilla/head.php', $db);
			$this->load->view('login/inicio');
			$this->load->view('plantilla/footer.php');
	   	}
		else
	   	{
	     	//Go to private area
			redirect('/home/','refresh');
	  	}
	
	}


	function check_database($password, $username)
	{
		$result = $this->usuarios_model->login($username, $password);
	
		if($result)
		{
			$sess_array = array();
			$ci = & get_instance();
			foreach($result as $row)
			{
				$sess_array = array(
					'id_usuario' 	=> $row->id_usuario,
					'usuario' 		=> $row->usuario,
					'imagen'		=> $row->imagen,
					'correo'		=> $row->correo
		    	);
			}
			 
			$this->session->unset_userdata('logged_in');
			$this->session->set_userdata('logged_in', $sess_array);
		    
			return TRUE;
		}
		else
		{
			return false;
		}
	}
}


?>