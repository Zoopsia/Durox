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
	
	function getClientesVendedores($id){
		$sql = "SELECT 
					vendedores.*
				FROM 
					clientes 
				INNER JOIN 
					sin_vendedores_clientes USING(id_cliente) 
				INNER JOIN 
					vendedores USING(id_vendedor)
				WHERE 
					clientes.id_cliente =  '$id'";
	
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
	
	function getClientesTelefonos($id){
		$sql = "SELECT 
					*
				FROM 
					clientes 
				INNER JOIN 
					sin_clientes_telefonos USING(id_cliente) 
				INNER JOIN 
					telefonos_clientes USING(id_telefono_cliente)
				INNER JOIN 
					tipos_telefonos USING(id_tipo_telefono)
				WHERE 
					clientes.id_cliente =  '$id'";
	
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
