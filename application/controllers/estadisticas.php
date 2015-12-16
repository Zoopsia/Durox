<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends My_Controller {
	
	protected $_subject		= 'estadisticas';
	
	
	
	function __construct(){
		parent::__construct(
				$subjet		= $this->_subject 
		);		
		
		$this->load->model('empresas_model');
		$this->load->model('visitas_model');
		$this->load->model('vendedores_model');
	}
	
	public function generar(){
		$db['registros']		= $this->visitas_model->getTodo();
		$filtros = array();
		
		if($this->input->post('filtros')){
			foreach ($this->input->post('filtros') as $registro) {
				$filtros['filtros'][] = $registro;	
			}
			foreach ($this->input->post('opciones') as $registro) {
				$filtros['opciones'][] = $registro;	
			}
			foreach ($this->input->post('valores') as $registro) {
				$filtros['valores'][] = $registro;	
			}
			foreach ($this->input->post('condiciones') as $registro) {
				$filtros['condiciones'][] = $registro;	
			}
		}
		
		if($this->input->post('valor')){
			$filtros['filtros'][]	= $this->input->post('filtro');
			$filtros['opciones'][]	= $this->input->post('opcion');
			$filtros['valores'][]	= $this->input->post('valor');
			$filtros['condiciones'][]	= $this->input->post('condicion');
		}
		

		if($this->input->post('campos')){
			$db['registros']	= $this->visitas_model->getCampos($this->input->post('campos'), $filtros);
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