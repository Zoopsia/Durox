<?php 
class Log_Linea_Pedidos_model extends My_Model {
		
	protected $_tablename	= 'log_linea_pedidos';
	protected $_id_table	= 'id_log';
	protected $_order		= 'id_linea';
	protected $_subject		= 'id_linea';
			
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
		
	function insertLog(){
			
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
		
		$this->db->insert($this->_tablename, $arreglo);

		return $this->db->insert_id();
	}
} 
?>
