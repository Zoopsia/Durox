<?php 
class Epocas_model extends My_Model {
		
	protected $_tablename	= 'epocas_visitas';
	protected $_id_table	= 'id_epoca_visita';
	protected $_order		= 'epoca';
	protected $_subject		= 'epoca';
			
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
