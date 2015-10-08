<?php 
class Monedas_model extends My_Model {
		
	protected $_tablename	= 'monedas';
	protected $_id_table	= 'id_moneda';
	protected $_order		= 'id_moneda';
	protected $_subject		= 'moneda';
	
	
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
