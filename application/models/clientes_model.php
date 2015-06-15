<?php 
class Clientes_model extends My_Model {
		
	protected $_tablename	= 'clientes';
	protected $_id_table	= 'id_cliente';
	protected $_order		= 'nombre';
	protected $_subject		= 'cliente';
	
	
	function __construct()
	{
		parent::__construct(
				$tablename		= $this->_tablename, 
				$id_table		= $this->_id_table, 
				$order			= $this->_order,
				$subject		= $this->_subject
		);
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
	
	
	
	
} 
?>
