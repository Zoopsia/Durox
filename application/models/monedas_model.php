<?php 
class Monedas_model extends My_Model {
		
	protected $_tablename	= 'monedas';
	protected $_id_table	= 'id_moneda';
	protected $_order		= 'id_moneda';
	protected $_subject		= 'moneda';
	
	
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
	
	function deleteMonedaPresupuesto($id){
		
		$sql = "SELECT
					*
				FROM
					linea_productos_presupuestos
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
	
	function deleteMonedaPedido($id){
		
		$sql = "SELECT
					*
				FROM
					linea_productos_pedidos
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
