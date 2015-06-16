<?php 
class Vendedores_model extends My_Model {
		
	protected $_tablename	= 'vendedores';
	protected $_id_table	= 'id_vendedor';
	protected $_order		= 'nombre';
	protected $_subject		= 'vendedor';
	protected 
	$_array_cruze	= array(
	
		'clientes'	=> array(
			'table' 		=> 'clientes', 
			'id_table' 		=> 'id_cliente', 
			'sin_table' 	=> 'sin_vendedores_clientes'
		),
		
		'telefonos'	=> array(
			'table' 		=> 'telefonos', 
			'id_table' 		=> 'id_telefono', 
			'sin_table' 	=> 'sin_vendedores_telefonos'
		),
		
		'direcciones'	=> array(
			'table' 		=> 'direcciones', 
			'id_table' 		=> 'id_direccion', 
			'sin_table' 	=> 'sin_vendedores_direcciones'
		),
		
		'mails'	=> array(
			'table' 		=> 'mails', 
			'id_table' 		=> 'id_mail', 
			'sin_table' 	=> 'sin_vendedores_mails'
		),
		
	);
	
	function __construct()
	{
		parent::__construct(
				$tablename		= $this->_tablename, 
				$id_table		= $this->_id_table, 
				$order			= $this->_order,
				$subject		= $this->_subject,
				$_array_cruze	= $this->_array_cruze
		);
	}
		
	
} 
?>
