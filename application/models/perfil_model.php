<?php 
class Perfil_model extends My_Model {
		
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
	
	function getConfiguracion(){
		
		$session_data = $this->session->userdata('logged_in');
		$data = array();
		
		$sql = "SELECT 
					*
				FROM
					config_correo
				WHERE
					id_config_correo = 1";	
					
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0)
		{
			$row = $query->row_array(1);
			$data['autorizacion_smtp']	= $row['autorizacion_smtp'];
			$data['seguridad_smtp']		= $row['seguridad_smtp'];
			$data['host']				= $row['host'];
			$data['puerto']				= $row['puerto'];
			$data['html_enable']		= $row['html_enable'];
			$data['from']				= $row['from'];
			$data['lenguaje']			= $row['lenguaje'];
			$data['correo']				= $session_data['correo'];
			
			return $data;
		}
		else
		{
			return FALSE;
		}
	}
	
	function updateConfiguracion($arreglo){
		$this->db->where('id_config_correo', '1');
		$this->db->update('config_correo', $arreglo);
		
	}
	
	function updateCorreo($arreglo, $id){
		$this->db->where('id_usuario', $id);
		$this->db->update('usuarios', $arreglo);
	}
} 
?>
