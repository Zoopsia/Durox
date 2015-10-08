<?php 
class Estados_presupuestos_model extends My_Model {
		
	protected $_tablename	= 'estados_presupuestos';
	protected $_id_table	= 'id_estado_presupuesto';
	protected $_order		= 'id_estado_presupuesto';
	protected $_subject		= 'estado';
			
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
