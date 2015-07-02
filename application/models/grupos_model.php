<?php 
class Grupos_model extends My_Model {
		
	protected $_tablename	= 'grupos_clientes';
	protected $_id_table	= 'id_grupo_cliente';
	protected $_order		= 'grupo_cliente';
	protected $_subject		= 'grupo';
	
	
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
	
	
	function getGrupos(){
			
		$sql = "SELECT 
					*
				FROM 
					grupos_clientes
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
	}
	
	function getReglasGrupos($id){
		
		$sql = "SELECT 
					*
				FROM 
					reglas
				WHERE 
					id_grupo_cliente = '$id'";
					
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
	
	function getClientesGrupos($id){
		
		$sql = "SELECT 
					*
				FROM 
					clientes
				INNER JOIN
					grupos_clientes USING(id_grupo_cliente)
				WHERE 
					id_grupo_cliente = '$id'";
					
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
