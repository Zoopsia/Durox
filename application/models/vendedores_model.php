<?php 
class Vendedores_model extends CI_Model {
	
	function getVendedores($id){
		$sql = "SELECT 
					* 
				FROM 
					vendedores 
				WHERE 
					id_vendedor = '$id'";
					
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
	
	function getVendedoresClientes($id){
		$sql = "SELECT 
					clientes.*
				FROM 
					vendedores 
				INNER JOIN 
					sin_vendedores_clientes USING(id_vendedor) 
				INNER JOIN 
					clientes USING(id_cliente)
				WHERE 
					vendedores.id_vendedor =  '$id'";
	
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
