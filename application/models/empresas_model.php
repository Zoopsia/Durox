<?php 
class Empresas_model extends CI_Model {
	
	function getEmpresas(){
		$sql = "SELECT 
					* 
				FROM 
					empresas 
				WHERE 
					empresas.id_empresa = 1";
		
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
