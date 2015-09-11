<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mssql extends My_Controller {
	
	protected $_subject		= 'mssql';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);
		
		$this->load->dbforge();
		
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function armarTablas(){
			
		$nombreDB 	= 'Prueba';
		$db		= 'mssql';
		$tablas = $this->mssql_model->crearTablas($db,$nombreDB);
		
		if($tablas){
			foreach ($tablas as $row) {
				$this->mssql_model->crearColumnas($db,$nombreDB,$row->TABLE_NAME);
				$this->mssql_model->copiarRegistros($db,$nombreDB,$row->TABLE_NAME);
			}
		}
	}
}