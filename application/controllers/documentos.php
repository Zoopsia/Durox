<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentos extends My_Controller {
	
	protected $_subject		= 'documentos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}

	public function documentos_abm(){
		
		$db['documentos']		= $this->documentos_model->getTodo();		
		
		$this->cargar_vista($db, 'pestanas');
		    
	}
	
	function guardarDocumento(){
		
		$documentos		= $this->documentos_model->getTodo();
		$destino 	= 'documentos/';
		$bandera = 0;
		if(isset($_FILES['documento']['tmp_name']))
		{
			if($_FILES['documento']['type'] == "application/pdf"){
				$origen 	= $_FILES['documento']['tmp_name'];
				$url		= $destino.$_FILES['documento']['name'];
				$imagen		= base_url().$url;
				if(!empty($_FILES['documento']['tmp_name'])){
					copy($origen, $url);	
				}
				//----COMPRUEBO QUE EL ARCHIVO NO EXISTA---//
				if($documentos){
					foreach($documentos as $row){
						if($row->documento == $imagen)
							$bandera = 1;
					}
					if($bandera != 1){
						$arreglo = array(
							'documento'		=> $imagen
						);
						
						$this->documentos_model->insert($arreglo);
					}
				}
				else { //----SINO LO INSERTO YA QUE ES EL PRIMER DOCUMENTO---//
					$arreglo = array(
						'documento'		=> $imagen
					);
					$this->documentos_model->insert($arreglo);
				}
			}
		}	
		
		redirect($this->_subject.'/documentos_abm/','refresh');
	}
	
	function mostrarDocumento(){
		
		$destino 	= 'temp/';

		if(isset($_FILES['documento']['tmp_name']))
		{
			if($_FILES['documento']['type'] == "application/pdf"){
				$origen 	= $_FILES['documento']['tmp_name'];
				$url		= $destino.$_FILES['documento']['name'];
				$imagen		= base_url().$url;
				if(!empty($_FILES['documento']['tmp_name'])){
					copy($origen, $url);	
				}
				
				$arreglo = array(
					'documento'		=> $imagen
				);
				
				$mensaje = '<iframe src="'.base_url().$url.'" name="vistaprevia" frameborder="0" class="vistaprevia" align="right">';

			}
			else{
				$mensaje = '<div class="row">
								<div class="col-sm-6 col-md-6">
									<div class="alert-message alert-message-danger">
										<h4>FORMATO NO VALIDO!</h4>
										<p>'.$_FILES['documento']['type'].'
																					                    
										</p>
									</div>
								</div>
							</div>';
			}
			echo $mensaje;	
		}
	}
	
	function deleteDocumento(){
		
		$id_documento		= $this->input->post('id_documento');
		
		if($id_documento){
			$arreglo = array(
				'eliminado'		=> 1
			);
			$id 				= $this->documentos_model->update($arreglo,$id_documento);
		}
		
		$documentos		= $this->documentos_model->getTodo();
		$i = 0;
		$mensaje = '';
		if($documentos){
			foreach ($documentos as $row) {
				$mensaje .= '<div class="col-md-2">
							 	<div class="box-tools pull-right">
						        	<button class="btn btn-danger btn-xs" onclick="deleteDocumento('.$row->id_documento.')"><i class="fa fa-times"></i></button>
						        </div>
						        <a href="'.$row->documento.'" style="padding: 25% 0 25% 25%" target="_blank">
						        	<i class="fa fa-file-pdf-o fa-5x"></i>
						        </a>
						        <br>
						       	<p class="text-center">'.cortarCadena($row->documento).'</p>
						    </div>';
				$i ++;
				if($i%6 == 0){
					$mensaje .= "<br><br><br><br><br>";
				}
			}
		}

		echo $mensaje;
	}

}