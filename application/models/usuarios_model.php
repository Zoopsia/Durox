<?php 
class Usuarios_model extends My_Model {
		
	protected $_tablename	= 'usuarios';
	protected $_id_table	= 'id_usuario';
	protected $_order		= 'nombre';
	protected $_subject		= 'usuario';
	protected 
	$_array_cruze	= array(
		
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
	
	function login($username, $password)
	{
		$password = MD5($password);
		
		$sql = 
		"SELECT 
			id_usuario, 
			usuario, 
			pass 
		FROM 
			usuarios
		WHERE
			usuario = '$username' AND 
			pass = '$password'";
		
		$query = $this->db->query($sql);		
		
		if($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	 }

} 
?>
