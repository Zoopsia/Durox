<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiempos_entrega extends My_Controller {
	
	protected $_subject		= 'tiempos_entrega';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function Tiempos_entrega($aux=null){
		
		$db['tiempos_entrega']		= $this->tiempos_entrega_model->getTodo();
		
		if($aux == "Save")
			$db['mostrar_registro']	= 1;
		else if($aux == "Delete")
			$db['mostrar_registro']	= 2;
		else
			$db['mostrar_registro']	= 0;
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function editarTiempo(){
		$nombre 	= $this->input->post('name');
		$valor		= $this->input->post('valor');
		$id_tiempo	= $this->input->post('id');
		
		$tiempo		= array(
					$nombre			=> $valor,
					'eliminado'		=> 0
		);
		
		$this->tiempos_entrega_model->update($tiempo, $id_tiempo);	
		
		echo "El registro fue modificado con éxito";
	}
	
	public function guardarTiempo(){
		
		$tiempo	= array(
				'tiempo_entrega'	=> $this->input->post('nuevo_tiempo')
		);
		
		$id_insert = $this->tiempos_entrega_model->insert($tiempo);	
		
		if($id_insert)
			redirect($this->_subject.'/Tiempos_entrega/Save','refresh');
		else
			redirect($this->_subject.'/Tiempos_entrega/','refresh');
	}
	
	public function eliminarTiempo(){
		if($this->input->post('eliminar')){	
			foreach($this->input->post('eliminar') as $row){
				if($this->tiempos_entrega_model->deleteTiempoPresupuesto($row)){
					if($this->tiempos_entrega_model->deleteTiempoPedido($row)){
						$arreglo = array(
							'eliminado'		=> 1
						);
									
						$this->tiempos_entrega_model->update($arreglo,$row);
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