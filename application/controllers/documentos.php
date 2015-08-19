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
		$db['tipos']			= $this->documentos_model->getTodo('tipos_documentos');
		
		$this->cargar_vista($db, 'pestanas');
		    
	}
	
	function guardarDocumento(){
		$id_documento = 0;
		$documentos		= $this->documentos_model->getTodo();
		$destino 	= 'documentos/';
		$bandera = 0;
		if(isset($_FILES['documento']['tmp_name']))
		{
			if($_FILES['documento']['type'] == "application/pdf" || $_FILES['documento']['type'] == "application/octet-stream"){
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
							'documento'		=> $imagen,
							'nombre'		=> $this->input->post('nombre')
						);
						
						$id_documento	= $this->documentos_model->insert($arreglo);
					}
				}
				else { //----SINO LO INSERTO YA QUE ES EL PRIMER DOCUMENTO---//
					$arreglo = array(
						'documento'		=> $imagen,
						'nombre'		=> $this->input->post('nombre')
					);
					$id_documento		= $this->documentos_model->insert($arreglo);
				}
			}
			
			if($id_documento != 0){
				if(!empty($_POST['tipo_documento'])){
					foreach($_POST['tipo_documento'] as $row){
						$sin = array(
							'id_tipo_documento'		=> $row,
							'id_documento'			=> $id_documento
						);
						
						$id_sin		= $this->documentos_model->insertTipo($sin);
					}
				}
			}
		}	
		
		redirect($this->_subject.'/documentos_abm/','refresh');
	}
	
	function mostrarDocumento(){
		
		$destino 	= 'temp/';

		if(isset($_FILES['documento']['tmp_name']))
		{
			if($_FILES['documento']['type'] == "application/pdf" || $_FILES['documento']['type'] == "application/octet-stream"){
				$origen 	= $_FILES['documento']['tmp_name'];
				$url		= $destino.$_FILES['documento']['name'];
				$imagen		= base_url().$url;
				if(!empty($_FILES['documento']['tmp_name'])){
					copy($origen, $url);	
				}
				
				$arreglo = array(
					'documento'		=> $imagen
				);
				if($_FILES['documento']['type'] == "application/pdf")
					$mensaje = '<iframe src="'.base_url().$url.'" name="vistaprevia" frameborder="0" class="vistaprevia" align="right">';
				else {
					$mensaje = '<div class="row">
								<div class="col-sm-6 col-md-6">
									<div class="alert-message alert-message-success">
										<h4>NO SE PUEDE GENERAR VISTA PREVIA</h4>
										<p>'.$_FILES['documento']['name'].'
																					                    
										</p>
									</div>
								</div>
							</div>';
				}
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
		$documento			= $this->documentos_model->getRegistro($id_documento);
		$direccion			= base_url();
		
		if($id_documento){
			foreach($documento as $row){
				$enlace = substr($row->documento,strlen($direccion));
				unlink($enlace);
			}
			$this->documentos_model->deleteDocumento($id_documento);
		}
		
		$this->armarDocumento();
	}

	function ordenarDocumento(){
		$id_tipo_documento		= $this->input->post('id_tipo_documento');
		if($id_tipo_documento!=0)
			$this->armarDocumento($id_tipo_documento);
		else
			$this->armarDocumento();
	}
	
	function armarDocumento($id_tipo=null){
		
		if($id_tipo){
			$documentos		= $this->documentos_model->getDocumentosTipo($id_tipo);
		}
		else
			$documentos		= $this->documentos_model->getTodo();
		
		$i = 0;
		$mensaje = '';
		if($documentos){
			foreach ($documentos as $row) {
				$mensaje .= '<div class="col-md-2">
							 	<div class="box-tools pull-right">
						        	<button class="btn btn-danger btn-xs" onclick="deleteDocumento('.$row->id_documento.')"><i class="fa fa-times"></i></button>
						        </div>
						        <a href="'.$row->documento.'" style="padding: 25% 0 25% 25%" target="_blank">';
				$cadena   = substr($row->documento,strrpos($row->documento,'.'));
				if($cadena == '.pdf')
					$mensaje .=    	'<i class="fa fa-file-pdf-o fa-5x"></i>';
				else if($cadena == '.docx' || $cadena == '.doc')
					$mensaje .=    	'<i class="fa fa-file-word-o fa-5x"></i>';
				else if($cadena == '.xlsx' || $cadena == '.xls')
					$mensaje .=    	'<i class="fa fa-file-excel-o fa-5x"></i>';
				$mensaje .=    '</a>
						        <br>
						       	<p class="text-center">'.cortarCadena($row->documento).'</p>
						    </div>';
				$i ++;
				if($i%6 == 0){
					$mensaje .= "<br><br><br><br><br><br><br>";
				}
			}
		}

		echo $mensaje;
	}
}