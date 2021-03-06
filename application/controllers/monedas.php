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
	
	public function Monedas($aux=null){
		
		$db['monedas']		=$this->monedas_model->getTodo();
		
		if($aux == "Save")
			$db['mostrar_registro']	= 1;
		else if($aux == "Delete")
			$db['mostrar_registro']	= 2;
		else
			$db['mostrar_registro']	= 0;
		
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
		
		echo "El registro fue modificado con éxito";
	}
	
	public function guardarMoneda(){
		
		$moneda	= array(
				'moneda' 		=> $this->input->post('nuevo_moneda'),			
				'abreviatura'	=> $this->input->post('nuevo_abreviatura'),
				'simbolo'		=> $this->input->post('nuevo_simbolo'),
				'valor'			=> $this->input->post('nuevo_valor')
		);
		
		$id_insert = $this->monedas_model->insert($moneda);	
		
		if($id_insert)
			redirect($this->_subject.'/Monedas/Save','refresh');
		else
			redirect($this->_subject.'/Monedas/','refresh');
	}
	
	public function eliminarMoneda(){
		if($this->input->post('eliminar')){	
			foreach($this->input->post('eliminar') as $row){
				if($this->monedas_model->deleteMonedaPresupuesto($row)){
					if($this->monedas_model->deleteMonedaPedido($row)){
						$arreglo = array(
							'eliminado'		=> 1
						);
									
						$this->monedas_model->update($arreglo,$row);
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