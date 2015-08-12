<?php 
class Productos_model extends My_Model {
		
	protected $_tablename	= 'productos';
	protected $_id_table	= 'id_producto';
	protected $_order		= 'id_producto';
	protected $_subject		= 'producto';
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
	
	function getImagenes($id){
		$this->db->select('*');
		$this->db->from('productos_imagenes');
		$this->db->where('id_producto',$id);
		
		$query = $this->db->get();
		
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
	
	function getPrecios(){
		$this->db->select('*');
		$this->db->from('reglas');
		$this->db->join('grupos_clientes','reglas.id_grupo_cliente = grupos_clientes.id_grupo_cliente','inner');
		
		$query = $this->db->get();
		
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

/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para ver si se puede eliminar el registro
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	
 
	function permitirEliminarEstadoPresupuesto($id){

		$this->db->select('*');
		$this->db->from('linea_productos_presupuestos');
		$this->db->join('estados_productos_presupuestos', 'estados_productos_presupuestos.id_estado_producto_presupuesto = linea_productos_presupuestos.id_estado_producto_presupuesto');
		$this->db->where($this->_id_table, $id);
		$this->db->where('eliminar_'.$this->_subject, 0);
		
		
		if($this->db->count_all_results()>0){
			return FALSE;
		}
		else
			return TRUE;
	}
	
	function permitirEliminarEstadoPedido($id){

		$this->db->select('*');
		$this->db->from('linea_productos_pedidos');
		$this->db->join('estados_productos_pedidos', 'estados_productos_pedidos.id_estado_producto_pedido = linea_productos_pedidos.id_estado_producto_pedido');
		$this->db->where($this->_id_table, $id);
		$this->db->where('eliminar_'.$this->_subject, 0);
		
		
		if($this->db->count_all_results()>0){
			return FALSE;
		}
		else
			return TRUE;
	}
			
} 
?>
