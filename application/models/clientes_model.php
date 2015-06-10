<?php 
class Clientes_model extends CI_Model {
	
	function getClientes($id){
		$sql = "SELECT 
					* 
				FROM 
					clientes 
				WHERE 
					id_cliente = '$id'";
		
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
