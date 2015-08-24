<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alarmas extends My_Controller {
	
	protected $_subject		= 'alarmas';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function insertAlarma(){
		$alarma	= array(
			'id_tipo_alarma'	=> $this->input->post('tipo'),
			'mensaje'			=> $this->input->post('mensaje'),
			'visto_back'		=> 0,
			'visto_front'		=> 0,
			'eliminado'			=> 0
		);
		
		$id_alarma = $this->alarmas_model->insert($alarma);
		
		$this->alarmas_model->insertCruce($this->input->post('cruce'),$id_alarma,$this->input->post('id'));
		
		if($this->input->post('tipo') == 1)
			$tipo	= '<i class="fa fa-thumbs-up"></i>';
		else if($this->input->post('tipo') == 2)
			$tipo	= '<i class="fa fa-info"></i>';
		else if($this->input->post('tipo') == 3)
			$tipo	= '<i class="fa fa-warning"></i>';
		
		$arreglo	= array(
			'id_tipo'	=> $this->input->post('tipo'),
			'tipo'		=> $tipo,
			'mensaje'	=> $this->input->post('mensaje')
		);
		echo armarAlarma($arreglo);
	}
}