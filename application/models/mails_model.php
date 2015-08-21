<?php 
class Mails_model extends My_Model {
		
	protected $_tablename	= 'mails';
	protected $_id_table	= 'id_mail';
	protected $_order		= 'mail';
	protected $_subject		= 'mail';
	
	
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
	
	function getConfigMails(){
		
		$sql	=  "SELECT 
						*
					FROM 
						config_mails 
					WHERE 
						1"; 
					
		$query 	= $this->db->query($sql);
		
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
	
	function updateMail($arreglo,$id){
		
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_upd', 'config_mails'))
		{
			$arreglo['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_upd', 'config_mails'))
		{
			$arreglo['user_upd'] = $session_data['id_usuario']; 
		}
		
		$this->db->where('id_config', $id);
		$this->db->update('config_mails', $arreglo);

	}
} 
?>
