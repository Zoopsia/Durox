<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Condiciones_pago extends My_Controller {
	
	protected $_subject		= 'condiciones_pago';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function Condiciones_pago(){
		
		$db['condiciones']		=$this->condiciones_pago_model->getTodo();
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function editar(){
		
		$nombre 	= $this->input->post('condicion');
		$dias		= $this->input->post('dias');
		$id_condicion	= $this->input->post('id');
		
		$condicion	= array(
						$nombre			=> $dias,
						'eliminado'		=> 0
		);
		
		$this->condiciones_pago_model->update($condicion, $id_condicion);	
		
		echo "El registro fué modificado con exito";
	}
	
	public function guardarCondicion(){
			
		$nombre 		= $this->input->post('nuevo_pago');
		$dias			= $this->input->post('nuevo_pago_dias');
		
		$condicion	= array(
						'condicion_pago' 	=> $nombre,			
						'dias'				=> $dias,
						'eliminado'			=> 0
		);
		
		$this->condiciones_pago_model->insert($condicion);	
		
		redirect($this->_subject.'/Condiciones_pago/','refresh');
		
	}
	
}