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
	
	function insertarDireccion($direccion,$id_usuario,$tipo){
		
		//----INSERTO CAMPOS EN TABLA DIRECCIONES----//
		$this->db->insert('direcciones', $direccion);
		 
		$id_direccion	= $this->db->insert_id();
		
		//----TRAIGO ID DE LA NUEVA DIRECCION Y LA CARGO EN LA TABLA DE CRUCE---//
		if($tipo == 1){
			$sin_clientes_direcciones	= array(
			
				'id_direccion' 		=> $id_direccion, 
				'id_cliente' 		=> $id_usuario		
			);
		$this->db->insert('sin_clientes_direcciones', $sin_clientes_direcciones);
					
		}
		else if($tipo == 2){
			$sin_vendedores_direcciones	= array(
			
				'id_direccion' 		=> $id_direccion, 
				'id_vendedor' 		=> $id_usuario		
			);
		$this->db->insert('sin_vendedores_direcciones', $sin_vendedores_direcciones);
		}

		return $id_direccion;
		
	}
	
	function getTipos(){
		
		$sql = "SELECT 
					* 
				FROM 
					tipos 
				WHERE 1";
				
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
	
	function getPaises(){
		
		$sql = "SELECT 
					* 
				FROM 
					paises 
				WHERE 1";
				
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
					id_pais = $id_pais";
				
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
					id_provincia = $id_provincia";
				
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
	
	function editarDirecciones($direccion, $id){
			
		$this->db->where('id_direccion', $id);
		$this->db->update('direcciones', $direccion);
	}
} 
?>
