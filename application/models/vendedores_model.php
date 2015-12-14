<?php 
class Vendedores_model extends My_Model {
		
	protected $_tablename	= 'vendedores';
	protected $_id_table	= 'id_vendedor';
	protected $_order		= 'nombre';
	protected $_subject		= 'vendedor';
	protected 
	$_array_cruze	= array(
	
		'clientes'	=> array(
			'table' 		=> 'clientes', 
			'id_table' 		=> 'id_cliente', 
			'sin_table' 	=> 'sin_vendedores_clientes'
		),
		
		'telefonos'	=> array(
			'table' 		=> 'telefonos', 
			'id_table' 		=> 'id_telefono', 
			'sin_table' 	=> 'sin_vendedores_telefonos'
		),
		
		'direcciones'	=> array(
			'table' 		=> 'direcciones', 
			'id_table' 		=> 'id_direccion', 
			'sin_table' 	=> 'sin_vendedores_direcciones'
		),
		
		'mails'	=> array(
			'table' 		=> 'mails', 
			'id_table' 		=> 'id_mail', 
			'sin_table' 	=> 'sin_vendedores_mails'
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
	
	function sinCruce($id){
		$sql = "SELECT 
					sin_vendedores_clientes.id_sin_vendedor_cliente,
					sin_vendedores_clientes.id_cliente,
					sin_vendedores_clientes.id_vendedor,
					sin_vendedores_clientes.eliminado,
					sin_vendedores_clientes.date_upd,
					sin_vendedores_clientes.nota,
					clientes.razon_social 
				FROM 
					sin_vendedores_clientes 
				LEFT JOIN 
					clientes ON(sin_vendedores_clientes.id_cliente = clientes.id_cliente)
				WHERE 
					$this->_id_table = '$id'";
	
		return $this->getQuery($sql);
	}
	
	function updateSin($arreglo_campos, $id){
		
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_upd', $this->_tablename))
		{
			$arreglo_campos['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_upd', $this->_tablename))
		{
			$arreglo_campos['user_upd'] = $session_data['id_usuario']; 
		}	
		
		$this->db->where('id_sin_vendedor_cliente', $id);
		$this->db->update('sin_vendedores_clientes', $arreglo_campos);
		
		return $this->db->insert_id();
	}
	
	
	function getPresupuestos($id){
			
		$sql = "SELECT 
					* 
				FROM 
					presupuestos
				INNER JOIN 
					clientes USING (id_cliente)
				INNER JOIN 
					estados_presupuestos USING (id_estado_presupuesto)
				WHERE 
					$this->_id_table = '$id'
				AND
					presupuestos.eliminado = 0";
					
		return $this->getQuery($sql);
	}
	
	
	function getPedidos($id){
			
		$sql = "SELECT 
					* 
				FROM 
					pedidos
				INNER JOIN 
					clientes USING (id_cliente)
				INNER JOIN 
					estados_pedidos USING (id_estado_pedido)
				WHERE 
					$this->_id_table = '$id'
				AND
					pedidos.eliminado = 0";
					
		return $this->getQuery($sql);
	}
	
	
	function getVisitas($id){
			
		$sql = "SELECT 
					* 
				FROM 
					visitas
				INNER JOIN	
					origen USING (id_origen)
				INNER JOIN 
					clientes USING (id_cliente)
				WHERE 
					$this->_id_table = '$id'
				AND
					visitas.eliminado = 0";
					
		return $this->getQuery($sql);
	}
	
	
	function traerDatosDBExterna($id){
		
		$tabla			= 'bj_web_vendedor';
		$prikey_tabla	= 'ven_Cod';
		$campos			= array();
		
		$sql = "SELECT 
					id_db 
				FROM 
					$this->_tablename  
				WHERE 
					$this->_id_table = '$id'
				AND 
					id_origen = 3";
						
		$vendedor = $this->db->query($sql);
		
		if($vendedor->num_rows() > 0){
			foreach ($vendedor->result_array() as $vendedor){
			
				$sql = "SHOW COLUMNS FROM durox.$tabla";
				
				$query = $this->db->query($sql);
				
				if($query->num_rows() > 0){
					foreach ($query->result() as $fila){
						$sql1= "SELECT
									$fila->Field
								FROM
									$tabla
								WHERE
									$prikey_tabla = ".$vendedor['id_db']."";
									
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
	
	
	function login($username, $password){
		$sql = 
		"SELECT 
			id_vendedor, 
			usuario, 
			pass 
		FROM 
			vendedores
		WHERE
			usuario = '$username' AND 
			pass	= '$password'";
		
		$query = $this->db->query($sql);		
		
		if($query->num_rows() == 1){
			return $query->result();
		} else {
			return false;
		}
	}
} 
?>
