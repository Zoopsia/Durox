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
				
		return $this->getQuery($sql);
	}
	
	function visitasNuevas(){
		
		$sql = 'SELECT 
					visitas.*,
					origen.origen,
					clientes.razon_social as razon_social,
					clientes.nombre as Cnombre,
					clientes.apellido as Capellido,
					clientes.id_cliente as id_cliente,
					vendedores.nombre as Vnombre,
					vendedores.apellido	as Vapellido,
					vendedores.id_vendedor as id_vendedor
				FROM 
					visitas 
				INNER JOIN 
					origen 
				USING 
					(id_origen)
				INNER JOIN
					clientes
				USING
					(id_cliente)
				INNER JOIN
					vendedores
				USING
					(id_vendedor)
				WHERE
					visitas.visto = 0';
		
		return $this->getQuery($sql);				
	}
	
	
	function getCampos($campos, $filtros = NULL){
		$join = "";
		$where = "";
		$sql = "SELECT";
		
		foreach ($campos as $key => $value) {
			if($value == 'id_vendedor'){
				$sql .= " vendedores.nombre as id_vendedor,";
				$join .= " LEFT JOIN
							vendedores
						USING
							(id_vendedor) ";
			}else if($value == 'id_cliente'){
				$sql .= " clientes.razon_social as id_cliente,";
				$join .= " LEFT JOIN
							clientes
						USING
							(id_cliente) ";
			}else if($value == 'id_epoca_visita'){
				$sql .= " epocas_visitas.epoca as id_epoca_visita,";
				$join .= " LEFT JOIN
							epocas_visitas
						USING
							(id_epoca_visita) ";
			}else if($value == 'id_origen_visita'){
				$sql .= " origenes_visita.origen_visita as id_origen_visita,";
				$join .= " LEFT JOIN
							origenes_visita
						USING
							(id_origen_visita) ";	
			}else{
				$sql .= " visitas.".$value.",";
			}
		}
		$sql = trim($sql, ",");
		
		
		
		if($filtros !== NULL && isset($filtros['filtros'])){
			$cantidad = count($filtros['filtros']) ;
		
			$opciones = array(
				"igual" 		=> '=' ,
				"mayor"			=> '>',
				"mayor_igual"	=> '>=',
				"menor"			=> '<',
				"menor_igual"	=> '<=',
				"distinto"		=> '!=',
				"contiene"		=> '=',
			);
			
			$condiciones = array(
				"y" 		=> ' AND' ,
				"o"			=> ' OR',
			);
			
			for ($i = 0; $i < $cantidad; $i++) {
				if($i == 0){
					$condicion = '';
				}else{
					$condicion = ' AND';
					$condicion = $condiciones[$filtros['condiciones'][$i]];
				}	
				
				$where .= $condicion;
				
				if($filtros['filtros'][$i] == 'id_vendedor'){
					$where .= " vendedores.nombre ";
				}else if($filtros['filtros'][$i] == 'id_cliente'){
					$where .= " clientes.razon_social ";
				}else if($filtros['filtros'][$i] == 'id_epoca_visita'){
					$where .= " epocas_visitas.epoca ";
				}else if($filtros['filtros'][$i] ==  'id_origen_visita'){
					$where .= " origenes_visita.origen_visita ";
				}else{
					$where .= " visitas.".$filtros['filtros'][$i]." ";
				}	
				
				$where .= $opciones[$filtros['opciones'][$i]]." '".$filtros['valores'][$i]."' ";	
			}
			
		}else{
			$where = 1;
		}
		
		$sql .=" FROM 
					visitas";
		$sql .= $join; 
		$sql .=	"WHERE ";
		$sql .= $where;
		
		return $this->getQuery($sql, 'array');
	}
	
	
	function listado($opciones){
		$inicio = explode('/', $opciones['inicio']);
		$opciones['inicio'] = $inicio[2].'-'.$inicio[1].'-'.$inicio[0];
		$final = explode('/', $opciones['final']);
		$opciones['final'] = $final[2].'-'.$final[1].'-'.$final[0];
		
		$sql = "SELECT 
					visitas.*,
					origen.origen,
					clientes.razon_social as razon_social,
					vendedores.nombre as Vnombre,
					vendedores.apellido	as Vapellido,
					vendedores.id_vendedor as id_vendedor
				FROM 
					visitas 
				INNER JOIN 
					origen 
				USING 
					(id_origen)
				INNER JOIN
					clientes
				USING
					(id_cliente)
				INNER JOIN
					vendedores
				USING
					(id_vendedor)
				WHERE 
					visitas.id_vendedor = '$opciones[id_vendedor]' AND
					visitas.fecha >= '$opciones[inicio]' AND
					visitas.fecha <= '$opciones[final]' ";
		
		return $this->getQuery($sql);
	}
		
} 
?>
