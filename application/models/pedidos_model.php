<?php 
class Pedidos_model extends My_Model {
		
	protected $_tablename	= 'pedidos';
	protected $_id_table	= 'id_pedido';
	protected $_order		= 'id_pedido';
	protected $_subject		= 'pedido';
	protected 
	$_array_cruze	= array(
		
	);
		
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
	
	function getDetallePedido($id)
	{
		$sql = "SELECT 
					productos.nombre AS nombre, 
					linea_productos_pedidos.cantidad AS cantidad, 
					linea_productos_pedidos.precio AS precio,
					estados_productos_pedidos.estado AS estado
				FROM 
					$this->_tablename 
				INNER JOIN 
					visitas USING(id_visita)
				INNER JOIN 
					linea_productos_pedidos USING($this->_id_table)
				INNER JOIN 
					productos USING (id_producto)
				INNER JOIN 
					estados_productos_pedidos USING(id_estado_producto_pedido)
				WHERE 
					$this->_id_table = '$id'";
					
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return FALSE;
		}
		
	}
		
} 
?>
