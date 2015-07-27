<?php 
class Direcciones_model extends My_Model {
		
	protected $_tablename	= 'direcciones';
	protected $_id_table	= 'id_direccion';
	protected $_order		= 'direccion';
	protected $_subject		= 'direccion';
	
	
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
	
	function getPaises(){
		
		$sql = "SELECT 
					* 
				FROM 
					paises 
				WHERE eliminado = 0";
				
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
	
	function getProvincias($id_pais){
		
		$sql = "SELECT 
					* 
				FROM 
					paises 
				INNER JOIN 
					provincias USING (id_pais)
				WHERE 
					id_pais = $id_pais
				AND
					provincias.eliminado = 0";
				
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
	
	function getDepartamentos($id_provincia){
		
		$sql = "SELECT 
					* 
				FROM 
					provincias
				INNER JOIN 
					departamentos USING(id_provincia)
				WHERE 
					id_provincia = $id_provincia
				AND
					departamentos.eliminado = 0";
				
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
	

} 
?>
