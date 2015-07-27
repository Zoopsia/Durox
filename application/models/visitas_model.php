<?php 
class Visitas_model extends My_Model {
		
	protected $_tablename	= 'visitas';
	protected $_id_table	= 'id_visita';
	protected $_order		= 'id_visita';
	protected $_subject		= 'visita';
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
	
	function busqueda($array){
		
		$this->db->select( 'visitas.*, 
							visitas.date_upd AS fecha_visita,
							clientes.nombre AS Cnombre,
							clientes.apellido AS Capellido,
							clientes.eliminado AS  Celiminado,
							vendedores.nombre AS Vnombre,
							vendedores.apellido AS Vapellido,
							vendedores.eliminado AS Veliminado
		');
		$this->db->from('visitas');
		$this->db->join('clientes', 'visitas.id_cliente = clientes.id_cliente', 'inner');
		$this->db->join('vendedores', 'visitas.id_vendedor = vendedores.id_vendedor', 'inner');

		
		if($array['id_visita']!='')
			$this->db->or_like('visitas.id_visita', $array['id_visita']);
		else
			$this->db->or_not_like('visitas.id_visita', '');
		
			
		if($array['cliente_nombre']!='')
			$this->db->or_like('clientes.nombre', $array['cliente_nombre']);
		else
			$this->db->or_not_like('clientes.nombre', '');
		
		
		if($array['cliente_apellido']!='')
			$this->db->or_like('clientes.apellido', $array['cliente_apellido']);
		else
			$this->db->or_not_like('clientes.apellido', '');
		
		
		if($array['vendedor_nombre']!='')
			$this->db->or_like('vendedores.nombre', $array['vendedor_nombre']);
		else
			$this->db->or_not_like('vendedores.nombre', '');
		
		
		if($array['vendedor_apellido']!='')
			$this->db->or_like('vendedores.apellido', $array['vendedor_apellido']);
		else
			$this->db->or_not_like('vendedores.apellido', '');					

		
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

	function getEpocas(){
		
		$sql = "SELECT 
					* 
				FROM 
					epocas_visitas 
				WHERE 
					eliminado = 0";
				
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
