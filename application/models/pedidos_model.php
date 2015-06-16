<?php 
class Pedidos_model extends My_Model {
		
	protected $_tablename	= 'pedidos';
	protected $_id_table	= 'id_pedido';
	protected $_order		= 'id_pedido';
	protected $_subject		= 'pedido';
	protected 
	$_array_cruze	= array(
		
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
