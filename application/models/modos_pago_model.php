<?php 
class Modos_pago_model extends My_Model {
		
	protected $_tablename	= 'modos_pago';
	protected $_id_table	= 'id_modo_pago';
	protected $_order		= 'id_modo_pago';
	protected $_subject		= 'modo_pago';
	
	
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
	
	function deleteModoPresupuesto($id){
		
		$sql = "SELECT
					*
				FROM
					sin_presupuestos_modos
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
	
	function deleteModoPedido($id){
		
		$sql = "SELECT
					*
				FROM
					sin_pedidos_modos
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
