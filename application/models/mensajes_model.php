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
	
	function insertCruceMensaje($id_mensaje, $id){
		$session_data = $this->session->userdata('logged_in');
		
		$arreglo = array(
			'id_mensaje'	=> $id_mensaje,
			'id_receptor'	=> $id,
			'id_emisor'		=> $session_data['id_usuario']
		);
		
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
	
	function mensajesNuevos(){
		/*
		$session_data = $this->session->userdata('logged_in');
		
		$sql = "SELECT 
					* 
				FROM 
					$this->_tablename 
				WHERE 
					1";
					

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
		*/
	}
} 
?>
