<?php 
class Empresas_model extends My_Model {
		
	protected $_tablename	= 'empresas';
	protected $_id			= 'id_empresa';
	protected $_order		= 'nombre';
	
	
	function __construct()
	{
		parent::__construct(
				$tablename		= $this->_tablename, 
				$id				= $this->_id, 
				$order			= $this->_order
		);
	}
	
	
} 
?>
