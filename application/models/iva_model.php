<?php 
class Iva_model extends My_Model {
		
	protected $_tablename	= 'iva';
	protected $_id_table	= 'id_iva';
	protected $_order		= 'iva';
	protected $_subject		= 'iva';
			
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
