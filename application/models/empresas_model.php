<?php 
class Empresas_model extends My_Model {
		
	protected $_tablename	= 'empresas';
	protected $_id_table	= 'id_empresa';
	protected $_order		= 'nombre';
	
	
	function __construct()
	{
		parent::__construct(
				$tablename		= $this->_tablename, 
				$id_table		= $this->_id_table, 
				$order			= $this->_order
		);
	}
	
	
} 
?>
