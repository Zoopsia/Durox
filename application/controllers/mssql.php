<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mssql extends My_Controller {
	
	protected $_subject		= 'mssql';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);
		
		$this->load->dbforge();
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function armarTablas(){
			
		$coneccion			= $this->mssql_model->pingDB();
		
		set_time_limit(600);
		
		if($coneccion){
			$nombreDB 			= 'Prueba';//-- IMPORTANTE! --//
			$basededatos		= 'mssql';
			$tablas 			= $this->mssql_model->crearTablas($basededatos,$nombreDB);
			
			if($tablas){
				foreach ($tablas as $row) {
					$this->mssql_model->crearColumnas($basededatos,$nombreDB,$row->TABLE_NAME);
					$this->mssql_model->copiarRegistros($basededatos,$nombreDB,$row->TABLE_NAME);
					$this->mssql_model->mergeTablas($row->TABLE_NAME);
					$this->mssql_model->updateTablas($row->TABLE_NAME);
				}
				echo "INFO - Sincronización Realizada con Éxito!";
			}
			else{
				echo "ERROR - No se realizó Sincronización!";
			}
		}
		
		set_time_limit(30);
	}



	public function sincronizacion(){
		
		$db['sincronizacion']	= $this->mssql_model->getSincronizacion();
		
		$this->cargar_vista($db, 'tabla'); 
	}
	
	
	
	public function guardarActualizacion(){
		
		$datos		= $this->mssql_model->getSincronizacion();
		$actualizar = $this->input->post('actualizar');
		
		if($datos){	
			if($actualizar){
				foreach($datos as $datos){
					$i = 0;
					foreach($actualizar as $row){
						if($datos->id_sincronizacion == $row)
							$i = 1;
					}
					if($i == 1){
						$datos_ext	= array(
							'actualiza'			=> 1
						);
					}
					else{
						$datos_ext	= array(
							'actualiza'			=> 0
						);
					}
					$this->mssql_model->updateSincronizacion($datos->id_sincronizacion,$datos_ext);
				}
			}
			else{
				foreach($datos as $datos){
					$datos_ext	= array(
						'actualiza'			=> 0
					);
					$this->mssql_model->updateSincronizacion($datos->id_sincronizacion,$datos_ext);
				}
			}
		}
		$this->sincronizacion();
	}
	
}