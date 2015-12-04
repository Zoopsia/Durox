<?php 
class Alarmas_sistema_model extends My_Model {
		
	protected $_tablename	= 'alarmas_sistema';
	protected $_id_table	= 'id_alarma';
	protected $_order		= 'id_alarma';
	protected $_subject		= 'id_alarma';
			
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
