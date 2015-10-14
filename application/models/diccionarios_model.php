<?php 
class Diccionarios_model extends My_Model {
		
	protected $_tablename	= 'diccionarios';
	protected $_id_table	= 'id_diccionario';
	protected $_order		= 'id_diccionario';
	protected $_subject		= 'diccionario';
	
	
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
