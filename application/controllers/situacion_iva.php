<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Situacion_iva extends My_Controller {
	
	protected $_subject		= 'situacion_iva';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function Iva($aux=null){
		
		$db['iva']			= $this->situacion_iva_model->getTodo();
		
		if($aux == "Save")
			$db['mostrar_registro']	= 1;
		else if($aux == "Delete")
			$db['mostrar_registro']	= 2;
		else
			$db['mostrar_registro']	= 0;
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function editarIva(){
		$nombre 	= $this->input->post('name');
		$valor		= $this->input->post('valor');
		$id_modo	= $this->input->post('id');
		
		$modo	= array(
						$nombre			=> $valor,
						'eliminado'		=> 0
		);
		
		$this->situacion_iva_model->update($modo, $id_modo);	
		
		echo "El registro fue modificado con éxito";
	}
	
	public function guardarIva(){
		
		$iva	= array(
				'iva'			=> $this->input->post('nuevo_iva')
		);
		
		$id_insert = $this->situacion_iva_model->insert($iva);	
		
		if($id_insert)
			redirect($this->_subject.'/Iva/Save','refresh');
		else
			redirect($this->_subject.'/Iva/','refresh');
	}
	
	public function eliminarIva(){
		if($this->input->post('eliminar')){	
			foreach($this->input->post('eliminar') as $row){
				if($this->situacion_iva_model->deleteClientes($row)){
					
					$arreglo = array(
						'eliminado'		=> 1
					);
									
					$this->situacion_iva_model->update($arreglo,$row);
					
				}
				else {
					echo "resp";
				}
			}
		}
	}
}