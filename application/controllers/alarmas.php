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
	
	public function nuevaAlarma($id_alarma=null){
		
		$db['alarmas']	= $this->alarmas_model->getTodo();
		
		if($id_alarma){
			$db['id_alarma']		= $id_alarma;
		}
		else
			$db['id_alarma']		= 0;
		$this->cargar_vista($db, 'tabla');
	}
	
	public function insertAlarma(){
		$alarma	= array(
			'id_tipo_alarma'	=> $this->input->post('tipo'),
			'mensaje'			=> $this->input->post('mensaje'),
			'visto_back'		=> 0,
			'visto_front'		=> 0,
			'eliminado'			=> 0
		);
		
		$id_alarma 			= $this->alarmas_model->insert($alarma);
		
		$this->alarmas_model->insertCruce($this->input->post('cruce'),$id_alarma,$this->input->post('id'));
		
		$tipo_alarma 		= $this->alarmas_model->getTipoAlarma($this->input->post('tipo'));
		
		if($tipo_alarma){
			foreach($tipo_alarma as $row){
				$arreglo	= array(
					'id_tipo'	=> $row->id_tipo_alarma,
					'tipo'		=> $row->tipo_alarma,
					'mensaje'	=> $this->input->post('mensaje'),
					'nombre'	=> $row->nombre,
					'color'		=> $row->color
				);
			}
		}
		echo armarAlarma($arreglo);
	}
	
	public function guardarTipoAlarma(){
		
		$alarma = array(
		'nombre'		=> $this->input->post('nombre'),
		'tipo_alarma'	=> $this->input->post('icono'),
		'color'			=> $this->input->post('color')
		);
		
		$id_alarma = $this->alarmas_model->insertTipo($alarma);
		
		if($id_alarma){
			redirect('Alarmas/nuevaAlarma/'.$id_alarma,'refresh');
		}
	}
	
	public function tipoAlarma(){
		$tipo_alarma 		= $this->alarmas_model->getTipoAlarma($this->input->post('tipo'));
		if($tipo_alarma){
			foreach($tipo_alarma as $row){
				echo $row->color;
			}
		}
	}
}