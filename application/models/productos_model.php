<?php 
class Productos_model extends My_Model {
		
	protected $_tablename	= 'productos';
	protected $_id_table	= 'id_producto';
	protected $_order		= 'id_producto';
	protected $_subject		= 'producto';
	protected 
	$_array_cruze	= array(
		
	);
		
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
	
	function getImagenes($id){
		$this->db->select('*');
		$this->db->from('productos_imagenes');
		$this->db->where('id_producto',$id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return FALSE;
		}
	}
	
	function getPrecios(){
		$this->db->select('*');
		$this->db->from('reglas');
		$this->db->join('grupos_clientes','reglas.id_grupo_cliente = grupos_clientes.id_grupo_cliente','inner');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return FALSE;
		}
	}
			
} 
?>
