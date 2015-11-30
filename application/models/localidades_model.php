<?php 
class Localidades_model extends My_Model {
		
	protected $_tablename	= '';
	protected $_id_table	= '';
	protected $_order		= '';
	protected $_subject		= '';
	
	
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
	
	function updatePais($arreglo_campos, $id)
	{
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_upd', 'paises'))
		{
			$arreglo_campos['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_upd', 'paises'))
		{
			$arreglo_campos['user_upd'] = $session_data['id_usuario']; 
		}
		
		$this->db->where('id_pais', $id);
		$this->db->update('paises', $arreglo_campos);
	}
	
	function updateProvincia($arreglo_campos, $id){
		
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_upd', 'provincias'))
		{
			$arreglo_campos['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_upd', 'provincias'))
		{
			$arreglo_campos['user_upd'] = $session_data['id_usuario']; 
		}
		
		$this->db->where('id_provincia', $id);
		$this->db->update('provincias', $arreglo_campos);
	}
	
	function updateDepartamento($arreglo_campos, $id){
			
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_upd', 'departamentos'))
		{
			$arreglo_campos['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_upd', 'departamentos'))
		{
			$arreglo_campos['user_upd'] = $session_data['id_usuario']; 
		}
		
		$this->db->where('id_departamento', $id);
		$this->db->update('departamentos', $arreglo_campos);
	}
	
	function logRegistros($arreglo){
 			
 		$session_data = $this->session->userdata('logged_in');
		$arreglo['date_add'] = date('Y-m-d H:i:s'); 
		$arreglo['date_upd'] = date('Y-m-d H:i:s'); 
		$arreglo['user_add'] = $session_data['id_usuario']; 
		$arreglo['user_upd'] = $session_data['id_usuario']; 
		
		
		$this->db->insert('logs', $arreglo);
		 
		return $this->db->insert_id();
 	}
	
	function getPais($id){
			
		$sql = "SELECT 
					* 
				FROM 
					provincias 
				INNER JOIN 
					paises USING (id_pais)
				WHERE 
					id_provincia = $id";
		
				
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
	
	function getProvincia($id){
			
		$sql = "SELECT 
					* 
				FROM 
					departamentos
				INNER JOIN 
					provincias USING (id_provincia)
				WHERE 
					id_departamento = $id";
		
				
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
	
	function insertNuevo($arreglo,$tabla)
	{
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
		
		$id_insert	= $this->db->insert_id();
		
		return $id_insert;
		
	}
} 
?>
