<?php 
class Clientes_model extends My_Model {
		
	protected $_tablename	= 'clientes';
	protected $_id_table	= 'id_cliente';
	protected $_order		= 'nombre';
	protected $_subject		= 'cliente';
	protected 
	$_array_cruze	= array(
	
		'vendedores'	=> array(
			'table' 		=> 'vendedores', 
			'id_table' 		=> 'id_vendedor', 
			'sin_table' 	=> 'sin_vendedores_clientes'
		),
		
		'telefonos'	=> array(
			'table' 		=> 'telefonos', 
			'id_table' 		=> 'id_telefono', 
			'sin_table' 	=> 'sin_clientes_telefonos',
		),
		
		'direcciones'	=> array(
			'table' 		=> 'direcciones', 
			'id_table' 		=> 'id_direccion', 
			'sin_table' 	=> 'sin_clientes_direcciones'
		),
		
		'mails'	=> array(
			'table' 		=> 'mails', 
			'id_table' 		=> 'id_mail', 
			'sin_table' 	=> 'sin_clientes_mails'
		),
				
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
	
	function getCliente($id){
			
		$sql = "SELECT 
					clientes.*,
					iva.iva,
					grupos_clientes.grupo_nombre,
					reglas.valor,
					reglas.aumento_descuento
				FROM 
					$this->_tablename 
				INNER JOIN
					iva USING (id_iva)
				INNER JOIN
					grupos_clientes USING (id_grupo_cliente)
				INNER JOIN
					reglas USING (id_grupo_cliente)
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

	function getPedidos($id){
			
		$sql = "SELECT 
					* 
				FROM 
					pedidos
				INNER JOIN 
					vendedores USING (id_vendedor)
				INNER JOIN 
					estados_pedidos USING (id_estado_pedido)
				WHERE 
					$this->_id_table = '$id'
				AND
					pedidos.eliminado = 0";
					
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
	
	function getPresupuestos($id){
			
		$sql = "SELECT 
					* 
				FROM 
					presupuestos
				INNER JOIN 
					vendedores USING (id_vendedor)
				INNER JOIN 
					estados_presupuestos USING (id_estado_presupuesto)
				WHERE 
					$this->_id_table = '$id'
				AND
					presupuestos.eliminado = 0";
					
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
	
	function getVisitas($id){
			
		$sql = "SELECT 
					* 
				FROM 
					visitas
				INNER JOIN	
					origen USING (id_origen)
				INNER JOIN 
					vendedores USING (id_vendedor)
				WHERE 
					$this->_id_table = '$id'
				AND
					visitas.eliminado = 0";
					
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
	
	function traerUltimaVisita($id){
	
		$sql = "SELECT 
					MAX(fecha) AS fecha
				FROM 
					visitas
				WHERE 
					$this->_id_table = '$id'
				AND
					eliminado = 0";
	
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
	
	function traerDatosDBExterna($id){
		
		$tabla			= 'bj_web_clientes';
		$prikey_tabla	= 'cli_Cod';
		$campos			= array();
		
		$sql = "SELECT 
					id_db 
				FROM 
					$this->_tablename  
				WHERE 
					$this->_id_table = '$id'";
						
		$cliente = $this->db->query($sql);
		
		if($cliente->num_rows() > 0){
			foreach ($cliente->result_array() as $cliente){
			
				$sql = "SHOW COLUMNS FROM durox.$tabla";
				
				$query = $this->db->query($sql);
				
				if($query->num_rows() > 0){
					foreach ($query->result() as $fila){
						$sql1= "SELECT
									$fila->Field
								FROM
									$tabla
								WHERE
									$prikey_tabla = ".$cliente['id_db']."";
									
						$query1 = $this->db->query($sql1);
						
						
						if($query1->num_rows() > 0)
						{
							foreach ($query1->result_array() as $row)
							{
								$campos[$fila->Field]	= $row[$fila->Field];
							}
						}
					}
				}
				
				return $campos;
			}
		}
		else {
			return FALSE;
		}
	}
} 
?>
