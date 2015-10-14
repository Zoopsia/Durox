<?php 
class Condiciones_pago_model extends My_Model {
		
	protected $_tablename	= 'condiciones_pago';
	protected $_id_table	= 'id_condicion_pago';
	protected $_order		= 'id_condicion_pago';
	protected $_subject		= 'condicion_pago';
	
	
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
