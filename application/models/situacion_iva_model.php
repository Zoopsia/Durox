<?php 
class Situacion_iva_model extends My_Model {
		
	protected $_tablename	= 'iva';
	protected $_id_table	= 'id_iva';
	protected $_order		= 'id_iva';
	protected $_subject		= 'iva';
	
	
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
	
	function deleteClientes($id){
		
		$sql = "SELECT
					*
				FROM
					clientes
				WHERE
					$this->_id_table = $id";

		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0)
		{
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
} 
?>
