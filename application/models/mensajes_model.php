<?php 
class Mensajes_model extends My_Model {
		
	protected $_tablename	= 'mensajes';
	protected $_id_table	= 'id_mensaje';
	protected $_order		= 'mensaje';
	protected $_subject		= 'mensaje';
			
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
	
	function insertCruceMensaje($id_mensaje, $id, $padre=null){
		$session_data = $this->session->userdata('logged_in');
		
		if($padre){
			$arreglo = array(
				'id_mensaje'		=> $id_mensaje,
				'id_receptor'		=> $id,
				'id_emisor'			=> $session_data['id_usuario'],
				'visto'				=> 1,
				'id_mensaje_padre'	=> $padre
			);
		}
		else{
			$arreglo = array(
				'id_mensaje'	=> $id_mensaje,
				'id_receptor'	=> $id,
				'id_emisor'		=> $session_data['id_usuario'],
				'visto'			=> 1
			);
		}
		
		if($this->db->field_exists('date_add', 'sin_mensajes_vendedores'))
		{
			$arreglo['date_add'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('date_upd', 'sin_mensajes_vendedores'))
		{
			$arreglo['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_add', 'sin_mensajes_vendedores'))
		{
			$arreglo['user_add'] = $session_data['id_usuario']; 
		}
		
		if($this->db->field_exists('user_upd', 'sin_mensajes_vendedores'))
		{
			$arreglo['user_upd'] = $session_data['id_usuario']; 
		}
			
		$this->db->insert('sin_mensajes_vendedores', $arreglo);
	}
	
	function mensajesNuevosHome(){
		
		$session_data = $this->session->userdata('logged_in');
			
		$sql = "SELECT
					mensajes.*,
					sin_mensajes_vendedores.*,
					vendedores.nombre,
					vendedores.apellido,
					vendedores.imagen
				FROM 
					$this->_tablename
				INNER JOIN
					sin_mensajes_vendedores
				USING
					($this->_id_table)
				INNER JOIN
					vendedores
				ON
					sin_mensajes_vendedores.id_emisor = vendedores.id_vendedor
				WHERE 
					mensajes.id_origen = 1
				AND
					id_receptor = ".$session_data['id_usuario']."
				AND
					sin_mensajes_vendedores.eliminado = 0
				ORDER BY
					sin_mensajes_vendedores.date_add DESC
				LIMIT
					4";

		if (!$this->db->query($sql)){	
			$error = $this->db->error(); 
			log_message('error', $sql);
		}
		else{
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
	
	function mensajesNuevos($id = null){
		
		$session_data = $this->session->userdata('logged_in');
		
		if($id){
			$sql = "SELECT
						mensajes.*,
						sin_mensajes_vendedores.*,
						vendedores.nombre,
						vendedores.apellido,
						vendedores.imagen,
						usuarios.imagen AS Uimagen
					FROM 
						$this->_tablename
					INNER JOIN
						sin_mensajes_vendedores
					USING
						($this->_id_table)
					INNER JOIN
						vendedores
					ON
						sin_mensajes_vendedores.id_emisor = vendedores.id_vendedor
					INNER JOIN
						usuarios
					ON
						sin_mensajes_vendedores.id_receptor = usuarios.id_usuario
					WHERE 
						id_sin_mensaje_vendedor = $id";
		}
		else {
			$sql = "SELECT
						mensajes.*,
						sin_mensajes_vendedores.*,
						vendedores.nombre,
						vendedores.apellido
					FROM 
						$this->_tablename
					INNER JOIN
						sin_mensajes_vendedores
					USING
						($this->_id_table)
					INNER JOIN
						vendedores
					ON
						sin_mensajes_vendedores.id_emisor = vendedores.id_vendedor
					WHERE 
						mensajes.id_origen = 1
					AND
						id_receptor = ".$session_data['id_usuario']."
					AND
						sin_mensajes_vendedores.eliminado = 0
					ORDER BY
						sin_mensajes_vendedores.date_add DESC";
		}
		
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
	
	function mensajesEnviados($id = null){
		
		$session_data = $this->session->userdata('logged_in');
		if($id){
			$sql = "SELECT
						mensajes.*,
						sin_mensajes_vendedores.*,
						vendedores.nombre,
						vendedores.apellido,
						vendedores.imagen,
						usuarios.imagen AS Uimagen
					FROM 
						$this->_tablename
					INNER JOIN
						sin_mensajes_vendedores
					USING
						($this->_id_table)
					INNER JOIN
						vendedores
					ON
						sin_mensajes_vendedores.id_receptor = vendedores.id_vendedor
					INNER JOIN
						usuarios
					ON
						sin_mensajes_vendedores.id_emisor = usuarios.id_usuario
					WHERE 
						mensajes.id_origen = 2
					AND
						id_emisor = ".$session_data['id_usuario']."
					AND
						sin_mensajes_vendedores.id_mensaje = $id";
					
		}else{
			$sql = "SELECT
						mensajes.*,
						sin_mensajes_vendedores.*,
						vendedores.nombre,
						vendedores.apellido
					FROM 
						$this->_tablename
					INNER JOIN
						sin_mensajes_vendedores
					USING
						($this->_id_table)
					INNER JOIN
						vendedores
					ON
						sin_mensajes_vendedores.id_receptor = vendedores.id_vendedor
					WHERE 
						mensajes.id_origen = 2
					AND
						id_emisor = ".$session_data['id_usuario']."
					AND
						sin_mensajes_vendedores.eliminado = 0
					GROUP BY
						sin_mensajes_vendedores.id_mensaje
					ORDER BY
						sin_mensajes_vendedores.date_add DESC";
			
		}
		
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
	
	function mensajesBorrados($id = null){
		
		if($id){	
			$sql = "SELECT
						mensajes.*,
						sin_mensajes_vendedores.*
					FROM 
						$this->_tablename
					INNER JOIN
						sin_mensajes_vendedores
					USING
						($this->_id_table)
					WHERE
						id_sin_mensaje_vendedor = $id
					AND
						sin_mensajes_vendedores.eliminado = 1";
		}
		else{
			$sql = "SELECT
						mensajes.*,
						sin_mensajes_vendedores.*
					FROM 
						$this->_tablename
					INNER JOIN
						sin_mensajes_vendedores
					USING
						($this->_id_table)
					WHERE 
						sin_mensajes_vendedores.eliminado = 1
					ORDER BY
						sin_mensajes_vendedores.date_add DESC";
		}
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
	
	function updateMensaje($id)
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
		
		$arreglo_campos['visto'] = 1;
		
		$this->db->where('id_sin_mensaje_vendedor', $id);
		$this->db->update('sin_mensajes_vendedores', $arreglo_campos);
		
		return $this->db->insert_id();
	}
	
	function getMensaje($id){
		$sql 	= "SELECT
						*
					FROM 
						$this->_tablename
					INNER JOIN
						sin_mensajes_vendedores
					USING
						($this->_id_table)
					WHERE 
						id_sin_mensaje_vendedor = $id
					AND
						sin_mensajes_vendedores.eliminado = 0
					AND
						mensajes.eliminado = 0";
		
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
	
	function actualizarMensaje($mensaje,$campo,$valor){
			
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_upd', $this->_tablename))
		{
			$arreglo_campos['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_upd', $this->_tablename))
		{
			$arreglo_campos['user_upd'] = $session_data['id_usuario']; 
		}
		
		$arreglo_campos[$campo] = $valor;
		
		$this->db->where('id_sin_mensaje_vendedor', $mensaje);
		$this->db->update('sin_mensajes_vendedores', $arreglo_campos);
		
		return $this->db->insert_id();
	}
} 
?>
