<?php 
class Alarmas_model extends My_Model {
		
	protected $_tablename	= 'alarmas';
	protected $_id_table	= 'id_alarma';
	protected $_order		= 'alarma';
	protected $_subject		= 'alarma';
			
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
	
	function insertCruce($cruce, $id_alarma, $id_usuario){
		
		$tabla = 'sin_alarmas_'.$cruce;
		$arreglo['id_alarma']	= $id_alarma;
		
		if($cruce == 'clientes'){
			$arreglo['id_cliente']		= $id_usuario;
		}
		else if($cruce == 'pedidos'){
			$arreglo['id_pedido']		= $id_usuario;
		}
		else if($cruce == 'presupuestos'){
			$arreglo['id_presupuesto']	= $id_usuario;
		}
		else if($cruce == 'productos'){
			$arreglo['id_producto']		= $id_usuario;
		}
		else if($cruce == 'visitas'){
			$arreglo['id_visita']		= $id_usuario;
		}
		else if($cruce == 'vendedores'){
			$arreglo['id_vendedor']		= $id_usuario;
		}
		
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_add', $tabla))
		{
			$arreglo['date_add'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('date_upd', $tabla))
		{
			$arreglo['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_add', $tabla))
		{
			$arreglo['user_add'] = $session_data['id_usuario']; 
		}
		
		if($this->db->field_exists('user_upd', $tabla))
		{
			$arreglo['user_upd'] = $session_data['id_usuario']; 
		}
			
		$this->db->insert($tabla, $arreglo);
	}
		
	function insertTipo($alarma){
				
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_add', 'tipos_alarmas'))
		{
			$alarma['date_add'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('date_upd', 'tipos_alarmas'))
		{
			$alarma['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_add', 'tipos_alarmas'))
		{
			$alarma['user_add'] = $session_data['id_usuario']; 
		}
		
		if($this->db->field_exists('user_upd', 'tipos_alarmas'))
		{
			$alarma['user_upd'] = $session_data['id_usuario']; 
		}
			
		$this->db->insert('tipos_alarmas', $alarma);
		
		return $this->db->insert_id();
	}
	
	function getTipoAlarma($id){
			
		$sql = "SELECT 
					* 
				FROM 
					tipos_alarmas 
				WHERE 
					id_tipo_alarma = '$id'";
					

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
	
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para traer nuevas Alarmas
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	
 
 	function alarmasNuevas(){
 			
 		$sql = "SELECT
					alarmas.*,
					vendedores.nombre,
					vendedores.apellido,
					vendedores.imagen AS Vimagen,
					usuarios.usuario,
					usuarios.imagen AS Uimagen
				FROM 
					$this->_tablename
				LEFT JOIN
					vendedores
				ON
					alarmas.id_creador = vendedores.id_vendedor
				LEFT JOIN
					usuarios
				ON
					alarmas.id_creador = usuarios.id_usuario
				WHERE 
					visto_back = 0
				AND
					alarmas.eliminado = 0";

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
	
	function buscarAlarma($alarma, $cruce){
		
		$tabla = 'sin_alarmas_'.$cruce;
		
		$sql = "SELECT
					*
				FROM
					$tabla
				WHERE
					id_alarma = $alarma";
		
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

	function updateAlarma($arreglo_campos, $id)
	{
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_upd', $this->_tablename))
		{
			$arreglo_campos['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_upd', $this->_tablename))
		{
			$arreglo_campos['user_upd'] = $session_data['id_usuario']; 
		}
		
		$this->db->where('id_tipo_alarma', $id);
		$this->db->update('tipos_alarmas', $arreglo_campos);

		return $id;
	}
} 
?>
