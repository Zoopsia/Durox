<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modos_pago extends My_Controller {
	
	protected $_subject		= 'modos_pago';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function Modos_pago($aux=null){
		
		$db['modos_pago']			= $this->modos_pago_model->getTodo();
		
		if($aux == "Save")
			$db['mostrar_registro']	= 1;
		else if($aux == "Delete")
			$db['mostrar_registro']	= 2;
		else
			$db['mostrar_registro']	= 0;
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function editarModo(){
		$nombre 	= $this->input->post('name');
		$valor		= $this->input->post('valor');
		$id_modo	= $this->input->post('id');
		
		$modo	= array(
						$nombre			=> $valor,
						'eliminado'		=> 0
		);
		
		$this->modos_pago_model->update($modo, $id_modo);	
		
		echo "El registro fue modificado con éxito";
	}
	
	public function guardarModo(){
		
		$modo	= array(
				'modo_pago'			=> $this->input->post('nuevo_modo')
		);
		
		$id_insert = $this->modos_pago_model->insert($modo);	
		
		if($id_insert)
			redirect($this->_subject.'/Modos_pago/Save','refresh');
		else
			redirect($this->_subject.'/Modos_pago/','refresh');
	}
	
	public function eliminarModo(){
		if($this->input->post('eliminar')){	
			foreach($this->input->post('eliminar') as $row){
				if($this->modos_pago_model->deleteModoPresupuesto($row)){
					if($this->modos_pago_model->deleteModoPedido($row)){
						$arreglo = array(
							'eliminado'		=> 1
						);
									
						$this->modos_pago_model->update($arreglo,$row);
					}
					else {
						echo "resp";
					}
				}
				else {
					echo "resp";
				}
			}
		}
	}
}