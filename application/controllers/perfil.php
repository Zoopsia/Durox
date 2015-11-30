<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil extends My_Controller {
	
	protected $_subject		= 'perfil';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		$this->load->model('usuarios_model');
	}
	
	public function Perfil(){

		$db['config_mail']	= $this->perfil_model->getConfiguracion();
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function cambiarPerfil(){
		$arreglo = array(
			'from'					=> $this->input->post('from'),
			'seguridad_smtp'		=> $this->input->post('seguridad_smtp'),
			'autorizacion_smtp'		=> $this->input->post('autorizacion_smtp'),
			'host'					=> $this->input->post('host'),
			'puerto'				=> $this->input->post('puerto'),
			'lenguaje'				=> $this->input->post('lenguaje'),
			'html_enable'			=> $this->input->post('html_enable'),
		);
		
		$this->perfil_model->updateConfiguracion($arreglo);
		
		$log = array(
			'accion'	=> 'UPDATE',
			'tabla'		=> 'config_correo',
			'id_cambio'	=> '1'
		);
		 
		$this->usuarios_model->logRegistros($log);
		
		$this->Perfil();
	}
}