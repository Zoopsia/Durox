<?php 
class Log_Linea_Pedidos_model extends My_Model {
		
	protected $_tablename	= 'log_linea_pedidos';
	protected $_id_table	= 'id_log';
	protected $_order		= 'id_linea';
	protected $_subject		= 'id_linea';
			
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
