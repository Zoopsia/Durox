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
					* 
				FROM 
					sin_vendedores_clientes 
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
					clientes USING (id_cliente)
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
} 
?>
