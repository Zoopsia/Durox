<?php 
class Reglas_model extends My_Model {
		
	protected $_tablename	= 'reglas';
	protected $_id_table	= 'id_regla';
	protected $_order		= 'nombre';
	protected $_subject		= 'id_grupo_cliente';
	
	
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
