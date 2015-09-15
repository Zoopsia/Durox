<?php 
class Mssql_model extends My_Model {
			
	protected $subjet 	= 'dbo';
	protected $prefijo 	= 'bj_';
	
	protected $productos_columnas	= array(
			'id_db'			=>	'art_CodGen',	
			'nombre'		=>	'art_DescGen',
			'descripcion'	=>	'da1_Desc'
	);
	
	
	function __construct(){
		parent::__construct();
	}
	
	function crearTablas($db, $nombreDB){
			
		//Llamo base de datos del ODBC//
		$db_mssql = $this->load->database($db, TRUE);
        
        //y de esta forma accedemos, no con $this->db->get,
        //sino con $db_mssql->get que contiene la conexión
        //a la base de datos mssql
        
        if($db_mssql){
        	
	        $sql = "SELECT	
	        			TABLE_NAME
					FROM 
						$nombreDB.INFORMATION_SCHEMA.TABLES";
	
			$query = $db_mssql->query($sql);
			
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
	
	function crearColumnas($db, $nombreDB ,$tabla){
			
		/*
		//Elimino la tabla existente//
		$tabladestino = strtolower($tabla);	
		$delete = "DROP TABLE IF EXISTS $this->prefijo$tabladestino";
		$this->db->query($delete);
		*/
		$db_mssql = $this->load->database($db, TRUE);
		
		//-- Hago un SELECT de los nombres de las Columnas de su db 
		//-- y la info para cargar en mi base--//
		if($db_mssql){
			$sql = "SELECT	
		        		TABLE_NAME,
						COLUMN_NAME,
						DATA_TYPE,
						CHARACTER_MAXIMUM_LENGTH,
						IS_NULLABLE
					FROM 
						$nombreDB.INFORMATION_SCHEMA.COLUMNS
					WHERE 
						TABLE_NAME = '$tabla'
					ORDER BY 
						ORDINAL_POSITION ASC";
	
			$query		 = $db_mssql->query($sql);
			$i = 0;
			$fields = array();
			
			//-- Creo arreglos con las Columnas --//
			if($query->num_rows() > 0){
				foreach ($query->result() as $fila){
					
					if($fila->IS_NULLABLE == "NO"){
						$campo = array(
		                       	'type' 			=> $fila->DATA_TYPE,
		                        'constraint' 	=> $fila->CHARACTER_MAXIMUM_LENGTH
						);
					}
					else{
						$campo = array(
		                       	'type' 			=> $fila->DATA_TYPE,
		                        'constraint' 	=> $fila->CHARACTER_MAXIMUM_LENGTH,
		                        'null' 			=> TRUE,
						);
					}	
		               	
		            $fields[$fila->COLUMN_NAME] = $campo;
					
					if($i == 0)
						$this->dbforge->add_key($fila->COLUMN_NAME, TRUE);
					
					
					$i++;
				}
			}
			//-- Cargo cada Columna y su estructura a la nueva Tabla--//
			$this->dbforge->add_field($fields);
			$this->dbforge->create_table($this->prefijo.$tabla, TRUE);
			
			//-- Si la Tabla ya existia corroboro si existen todas las columnas sino las creo --//
			if($query->num_rows() > 0){
				foreach ($query->result() as $fila){
					if(!$this->db->field_exists($fila->COLUMN_NAME,$this->prefijo.$tabla)){
							
						$fields = array(
		                        $fila->COLUMN_NAME => array(
				                       	'type' 			=> $fila->DATA_TYPE,
				                        'constraint' 	=> $fila->CHARACTER_MAXIMUM_LENGTH,
				                        'null' 			=> TRUE,
										)
						);	
						
						$this->dbforge->add_column($this->prefijo.$tabla, $fields);
					}
				}
			}
		}
	}
	
	function copiarRegistros($db, $nombreDB ,$tabla){
			
		$db_mssql = $this->load->database($db, TRUE);
		
		$tabladestino = strtolower($tabla);
		
		if($db_mssql){
			$sql = "SELECT	
						COLUMN_NAME
					FROM 
						$nombreDB.INFORMATION_SCHEMA.COLUMNS
					WHERE 
						TABLE_NAME = '$tabla'
					ORDER BY 
						ORDINAL_POSITION ASC";
	
			$query		 	= $db_mssql->query($sql);
			$numerocol		= $db_mssql->affected_rows();
			$i = 0;
			$select = "";
			$columna = array();
			
			if($query->num_rows() > 0){
				foreach ($query->result() as $fila){
					$i++;
					if($numerocol == $i)
						$select .= $fila->COLUMN_NAME;
					else if ($i == 1){
						$select .= $fila->COLUMN_NAME.',';
						$columna_pri = $fila->COLUMN_NAME;
					}
					else 
						$select .= $fila->COLUMN_NAME.',';
					
					array_push($columna,$fila->COLUMN_NAME);
				}
			}
			
			$sql = "SELECT	
						$select
					FROM 
						$nombreDB.$this->subjet.$tabla";
	
			$query		 	= $db_mssql->query($sql);
			
			if($query->num_rows() > 0){
				foreach ($query->result_array() as $row){
					
					if(!$this->buscarRegistro($columna_pri,$this->prefijo.$tabladestino,$row[$columna[0]]))
					{
						$sql1 = "INSERT INTO
							$this->prefijo$tabladestino
							($select)
						VALUES (";
						
						for ($i=0; $i < count($columna) ; $i++) {
							if($i != count($columna) - 1) 
								$sql1 .= "'".addslashes($row[$columna[$i]])."',";
							else
								$sql1 .= "'".addslashes($row[$columna[$i]])."'";
						}
						
						$sql1 .= ")";
						
						$this->db->query($sql1);
						$sql1 = "";
					}
					else{
						log_message('error','El registro ya existe en '.$this->prefijo.$tabladestino.' con ID '.$row[$columna[0]]);
					}
				}
			}		 
		}
	}

	function buscarRegistro($primary_key ,$tabla, $id){
			
		$sql = "SELECT
					*
				FROM
					$tabla
				WHERE
					$primary_key = '$id'";
		
		$query = $this->db->query($sql);
			
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
	
	function mergeTablas($tabla){
			
		if(preg_match("/articulos/i",$tabla)){
				
			$target 	= "productos";
			$source 	= $this->prefijo.strtolower($tabla);
			$id_target	= "id_db";
			$id_source	= "art_CodGen";
			
			$sql = "INSERT INTO $target (";
			$last = end($this->productos_columnas);
						
			foreach ($this->productos_columnas as $key => $value){
				if($last == $value)
					$sql .= $key;
				else	
					$sql .= $key.",";
			}
					
			$sql .=	") SELECT ";
			
			foreach ($this->productos_columnas as $key => $value){
				if($last == $value)
					$sql .= $source.".".$value;
				else	
					$sql .= $source.".".$value.",";
			}
			$sql .=	" FROM $source 
					WHERE $source.$id_source NOT IN(
					SELECT 
						$id_target
					FROM
						$target)";
			
			$this->db->query($sql);	
			
		}
		else if(preg_match("/vendedor/i",$tabla)){
			//echo $tabla;
			//echo "<br>";
		}
		else if(preg_match("/clientes/i",$tabla)){
			//echo $tabla;
			//echo "<br>";
		}
	}
	
} 
?>
