<?php 
class Telefonos_model extends My_Model {
		
	protected $_tablename	= 'telefonos';
	protected $_id_table	= 'id_telefono';
	protected $_order		= 'telefono';
	protected $_subject		= 'telefono';
	
	
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
	
	function insertarTelefono($telefono,$id_usuario,$tipo){
		
		
		$sql = "INSERT INTO 
					telefonos (`id_tipo`, `telefono`, `cod_area`, `fax`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) 
				VALUES 
					(".$telefono['id_tipo'].", ".$telefono['telefono'].", ".$telefono['cod_area'].", ".$telefono['fax'].", '2015-06-22 00:00:00', '2015-06-22 00:00:00', '0', '1', '1')";
		 
		//----INSERTO CAMPOS EN TABLA TELEFONO----//
		$this->db->insert('telefonos', $telefono);
		 
		$id_telefono	= $this->db->insert_id();
		
		//----TRAIGO ID DEL TELEFONO NUEVO Y LO CARGO EN LA TABLA DE CRUCE---//
		if($tipo == 1){
			$sin_clientes_telefonos	= array(
			
				'id_telefono' 		=> $id_telefono, 
				'id_cliente' 		=> $id_usuario		
			);
		$this->db->insert('sin_clientes_telefonos', $sin_clientes_telefonos);
					
		}
		else if($tipo == 2){
			$sin_vendedores_telefonos	= array(
			
				'id_telefono' 		=> $id_telefono, 
				'id_vendedor' 		=> $id_usuario		
			);
		$this->db->insert('sin_vendedores_telefonos', $sin_vendedores_telefonos);
		}
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
} 
?>
