<?php 
class Tiempos_entrega_model extends My_Model {
		
	protected $_tablename	= 'tiempos_entrega';
	protected $_id_table	= 'id_tiempo_entrega';
	protected $_order		= 'id_tiempo_entrega';
	protected $_subject		= 'tiempo_entrega';
	
	
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
	
	function deleteTiempoPresupuesto($id){
		
		$sql = "SELECT
					*
				FROM
					presupuestos
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
	
	function deleteTiempoPedido($id){
		
		$sql = "SELECT
					*
				FROM
					pedidos
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
