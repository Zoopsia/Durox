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
	
	function deleteCondicionPresupuesto($id){
		
		$sql = "SELECT
					*
				FROM
					presupuestos
				INNER JOIN
					$this->_tablename USING ($this->_id_table)
				WHERE
					$this->_tablename.$this->_id_table = $id
				AND
					presupuestos.eliminado = 0";
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0)
		{
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	function deleteCondicionPedido($id){
			
		$sql = "SELECT
					*
				FROM
					pedidos
				INNER JOIN
					$this->_tablename USING ($this->_id_table)
				WHERE
					$this->_tablename.$this->_id_table = $id
				AND
					pedidos.eliminado = 0";
		
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
