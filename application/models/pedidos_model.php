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
					productos.id_producto AS producto, 
					productos.precio AS preciobase,
					linea_productos_$this->_tablename.cantidad AS cantidad, 
					linea_productos_$this->_tablename.precio AS precio,
					linea_productos_$this->_tablename.subtotal AS subtotal,
					linea_productos_$this->_tablename.id_linea_producto_pedido AS id_linea_producto_pedido,
					linea_productos_$this->_tablename.id_estado_producto_pedido AS estado_linea,
					estados_productos_$this->_tablename.estado AS estado,
					$this->_tablename.iteracion AS iteracion
				FROM 
					$this->_tablename 
				INNER JOIN 
					visitas USING(id_visita)
				INNER JOIN 
					linea_productos_$this->_tablename USING($this->_id_table)
				INNER JOIN 
					productos USING (id_producto)
				INNER JOIN 
					estados_productos_$this->_tablename USING(id_estado_producto_$this->_subject)
				WHERE 
					$this->_id_table = '$id'
				AND
					linea_productos_$this->_tablename.eliminado = 0";
					
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
	
	function getPedido($id){
		$sql = "SELECT 
					* 
				FROM 
					$this->_tablename 
				WHERE 
					id_visita = '$id'";
					
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
		
	function insertLinea($arreglo){
		
		//----INSERTO CAMPOS EN TABLA ----//
		
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_add', $this->_tablename))
		{
			$arreglo['date_add'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('date_upd', $this->_tablename))
		{
			$arreglo['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_add', $this->_tablename))
		{
			$arreglo['user_add'] = $session_data['id_usuario']; 
		}
		
		if($this->db->field_exists('user_upd', $this->_tablename))
		{
			$arreglo['user_upd'] = $session_data['id_usuario']; 
		}
		
		$this->db->insert('linea_productos_pedidos', $arreglo);
		 
		return $this->db->insert_id();
		
	}
	
	public function updateLinea($arreglo_campos, $id){
		
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_upd', $this->_tablename))
		{
			$arreglo_campos['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_upd', $this->_tablename))
		{
			$arreglo_campos['user_upd'] = $session_data['id_usuario']; 
		}
		
		$this->db->where('id_linea_producto_pedido', $id);
		$this->db->update('linea_productos_pedidos', $arreglo_campos);
		
		return $this->db->insert_id();
	}
	
	function pedidosNuevos(){
		
		$sql = 'SELECT 
					pedidos.*,
					origen.origen,
					clientes.razon_social as razon_social,
					clientes.nombre as Cnombre,
					clientes.apellido as Capellido,
					clientes.id_cliente as id_cliente,
					vendedores.nombre as Vnombre,
					vendedores.apellido	as Vapellido,
					vendedores.id_vendedor as id_vendedor
				FROM 
					pedidos 
				INNER JOIN 
					origen 
				USING 
					(id_origen)
				INNER JOIN
					clientes
				USING
					(id_cliente)
				INNER JOIN
					vendedores
				USING
					(id_vendedor)
				WHERE
					pedidos.visto = 0
				AND
					pedidos.eliminado = 0';
		
		$query = $this->db->query($sql);
						
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}
			return $data;
		}else{
			return FALSE;
		}							
	}
		
} 
?>
