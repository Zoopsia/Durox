<?php 
class Clientes_model extends My_Model {
		
	protected $_tablename	= 'clientes';
	protected $_id_table	= 'id_cliente';
	protected $_order		= 'nombre';
	protected $_subject		= 'cliente';
	protected 
	$_array_cruze	= array(
	
		'vendedores'	=> array(
			'table' 		=> 'vendedores', 
			'id_table' 		=> 'id_vendedor', 
			'sin_table' 	=>  'sin_vendedores_clientes'
		),
		
		'telefonos'	=> array(
			'table' 		=> 'telefonos_clientes', 
			'id_table' 		=> 'id_telefono_cliente', 
			'sin_table' 	=>  'sin_clientes_telefonos',
		),
		
		'direcciones'	=> array(
			'table' 		=> 'direcciones_clientes', 
			'id_table' 		=> 'id_direccion_cliente', 
			'sin_table' 	=>  'sin_clientes_direcciones'
		),
		
		'mails'	=> array(
			'table' 		=> 'mails_clientes', 
			'id_table' 		=> 'id_mail_cliente', 
			'sin_table' 	=>  'sin_clientes_mails'
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
