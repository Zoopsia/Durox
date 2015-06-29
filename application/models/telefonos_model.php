<?php 
class Telefonos_model extends My_Model {
		
	protected $_tablename	= 'telefonos';
	protected $_id_table	= 'id_telefono';
	protected $_order		= 'telefono';
	protected $_subject		= 'telefono';
	
	
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
