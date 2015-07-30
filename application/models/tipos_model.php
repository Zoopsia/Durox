<?php 
class Tipos_model extends My_Model {
		
	protected $_tablename	= 'tipos';
	protected $_id_table	= 'id_tipo';
	protected $_order		= 'tipo';
	protected $_subject		= 'tipo';
			
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
