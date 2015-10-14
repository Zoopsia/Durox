<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monedas extends My_Controller {
	
	protected $_subject		= 'monedas';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function Monedas(){
		
		$db['monedas']		=$this->monedas_model->getTodo();
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function editarMoneda(){
		$nombre 	= $this->input->post('name');
		$valor		= $this->input->post('valor');
		$id_moneda	= $this->input->post('id');
		
		$moneda	= array(
						$nombre			=> $valor,
						'eliminado'		=> 0
		);
		
		$this->monedas_model->update($moneda, $id_moneda);	
		
		echo "El registro fué modificado con exito";
	}
	
}