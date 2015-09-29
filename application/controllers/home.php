<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends My_Controller {
	
	protected $_subject		= 'home';
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('clientes_model');
		$this->load->model('productos_model');
		$this->load->model('pedidos_model');
		$this->load->model('visitas_model');
		$this->load->model('mssql_model');
		
		$this->load->dbforge();
	}

	public function index()
	{
		$db['clientes_cantidad'] 	= $this->clientes_model->getCantidad();
		$db['productos_cantidad'] 	= $this->productos_model->getCantidad();
		$db['pedidos_cantidad'] 	= $this->pedidos_model->getCantidad();
		$db['visitas_cantidad'] 	= $this->visitas_model->getCantidad();
		$db['vendedores'] 			= $this->vendedores_model->getTodo();
		$db['recibidos']			= $this->mensajes_model->mensajesNuevosHome();
		
		$coneccion			= $this->mssql_model->pingDB();
		
		if($coneccion){
			$nombreDB 			= 'Prueba';
			$basededatos		= 'mssql';
			$tablas 			= $this->mssql_model->crearTablas($basededatos,$nombreDB);
			
			if($tablas){
				foreach ($tablas as $row) {
					$this->mssql_model->crearColumnas($basededatos,$nombreDB,$row->TABLE_NAME);
					$this->mssql_model->copiarRegistros($basededatos,$nombreDB,$row->TABLE_NAME);
					$this->mssql_model->mergeTablas($row->TABLE_NAME);
				}
			}
		}
		
		$this->cargar_vista($db, 'inicio');
	}

		
}