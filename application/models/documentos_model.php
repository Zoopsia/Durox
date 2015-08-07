<?php 
class Documentos_model extends My_Model {
		
	protected $_tablename	= 'documentos';
	protected $_id_table	= 'id_documento';
	protected $_order		= 'documento';
	protected $_subject		= 'documento';
			
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