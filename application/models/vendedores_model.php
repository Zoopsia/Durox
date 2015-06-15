<?php 
class Vendedores_model  extends My_Model {
		
	protected $_tablename	= 'vendedores';
	protected $_id_table	= 'id_vendedor';
	protected $_order		= 'nombre';
	protected $_subject		= 'vendedor';
	
	function __construct()
	{
		parent::__construct(
				$tablename		= $this->_tablename, 
				$id_table		= $this->_id_table, 
				$order			= $this->_order,
				$subject		= $this->_subject
		);
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
