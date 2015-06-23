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
	
	function editarDirecciones($direccion, $id){
		

	}
} 
?>
