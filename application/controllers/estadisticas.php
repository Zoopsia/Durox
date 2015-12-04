<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends My_Controller {
	
	protected $_subject		= 'estadisticas';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);		
		
		$this->load->model('empresas_model');
		$this->load->model('visitas_model');
		$this->load->model('vendedores_model');
	}
	
	public function generar(){
		$db['registros']		= $this->visitas_model->getTodo();
		if($this->input->post('campos')){
			$db['registros']	= $this->visitas_model->getCampos($this->input->post('campos'));
		}
		$this->cargar_vista($db, 'generar');
	}
	
	public function sistemas(){
		$this->load->library('Graficos');
		$db['vendedores']		= $this->vendedores_model->getTodo();
		
		if($this->input->post('id_vendedor')){
			$listado = array(
				'inicio'		=> $this->input->post('inicio'),
				'final'			=> $this->input->post('final'),
				'id_vendedor'	=> $this->input->post('id_vendedor'),
			);
			
			$db['registros']	= $this->visitas_model->listado($listado);
		}else{
			$db['registros']	= FALSE;
		}
		
		$this->cargar_vista($db, 'sistemas');
	}
	
	
}