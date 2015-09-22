<?php 
class Mssql_model extends My_Model {
			
	protected $subjet 	= 'dbo';
	protected $prefijo 	= 'bj_';
	
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
	
	function getTablasSin($tabla){
			
		$sql = "SELECT 
					bj_tablas.nombre_tabla AS origen,
					tablas.nombre_tabla	AS destino
				FROM
					bj_sin_columnas 
				INNER JOIN
					bj_tablas
				USING
					(id_bj_tabla)
				INNER JOIN
					tablas
				USING
					(id_tabla)
				WHERE
					bj_tablas.nombre_tabla = '$tabla'
				GROUP BY
					tablas.nombre_tabla";
		
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
	
	function getColumnasSin($origen,$destino){
			
		$sql = "SELECT 
					bj_tablas.nombre_tabla AS origen,
					tablas.nombre_tabla	AS destino,
					bj_sin_columnas.bj_columna,
					bj_sin_columnas.columna
				FROM
					bj_sin_columnas 
				INNER JOIN
					bj_tablas
				USING
					(id_bj_tabla)
				INNER JOIN
					tablas
				USING
					(id_tabla)
				WHERE
					tablas.nombre_tabla = '$destino'
				AND
					bj_tablas.nombre_tabla = '$origen'";
		
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
	
	function getIdSinInsert($source, $target, $id_source, $id_target){
			
		$sql = "SELECT 
					$id_source AS id_faltante
				FROM 
					$source 
				WHERE 
					$source.$id_source 
				NOT IN( 
					SELECT 
						$id_target 
					FROM 
						$target)";
		
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
			$source 	= $this->prefijo.strtolower($tabla);
			$target 	= "productos";
			$id_target	= "id_db";
			$id_source	= "art_CodGen";//---En caso de cambiar las tablas cambiar el ID---//
			
			$tablasin	= $this->getTablasSin($source);
			$id_insert	= $this->getIdSinInsert($source, $target, $id_source, $id_target);
			
			if($tablasin){
				foreach($tablasin as $row){
					$columnassin 	= $this->getColumnasSin($row->origen ,$row->destino);
					if($columnassin){
						if($id_insert){
							foreach($id_insert as $id){
								$sql = "INSERT INTO $row->destino (";
								
								foreach($columnassin as $fila){
									if ($fila === end($columnassin)) 
								        $sql .= $fila->columna;
									else
										$sql .= $fila->columna.",";
								}
								
								$sql .=	") SELECT ";
									
								foreach($columnassin as $fila){
									if ($fila === end($columnassin)) 
								        $sql .= $fila->bj_columna;
									else
										$sql .= $fila->bj_columna.",";
								}
								
								$sql .=	" 	FROM 
												$source
											WHERE 
												$source.$id_source = '$id->id_faltante'";	
								
								$this->db->query($sql);
								
								//echo $this->db->insert_id();
								//echo "<br>";	
							}
						}			
					}
				}
			}	
		}
		else if(preg_match("/vendedor/i",$tabla)){	
			$source 	= $this->prefijo.strtolower($tabla);
			$target 	= "vendedores";
			$id_target	= "id_db";
			$id_source	= "ven_Cod";//---En caso de cambiar las tablas cambiar el ID---//
			
			$tablasin	= $this->getTablasSin($source);
			$id_insert	= $this->getIdSinInsert($source, $target, $id_source, $id_target);
			
			if($tablasin){
				foreach($tablasin as $row){
					$columnassin 	= $this->getColumnasSin($row->origen ,$row->destino);
					if($columnassin){
						if($id_insert){
							foreach($id_insert as $id){
								$sql = "INSERT INTO $row->destino (";
								
								foreach($columnassin as $fila){
									if ($fila === end($columnassin)) 
								        $sql .= $fila->columna;
									else
										$sql .= $fila->columna.",";
								}
								
								$sql .=	") SELECT ";
									
								foreach($columnassin as $fila){
									if ($fila === end($columnassin)) 
								        $sql .= $fila->bj_columna;
									else
										$sql .= $fila->bj_columna.",";
								}
								
								$sql .=	" 	FROM 
												$source
											WHERE 
												$source.$id_source = '$id->id_faltante'";	
								
								$this->db->query($sql);
								
								//echo $this->db->insert_id();
								//echo "<br>";		
							}
						}			
					}
				}
			}
		}
		else if(preg_match("/clientes/i",$tabla)){
			$source 	= $this->prefijo.strtolower($tabla);
			$target 	= "clientes";
			$id_target	= "id_db";
			$id_source	= "cli_Cod";//---En caso de cambiar las tablas cambiar el ID---//
			
			$tablasin	= $this->getTablasSin($source);
			$id_insert	= $this->getIdSinInsert($source, $target, $id_source, $id_target);
			
			if($id_insert){
				foreach($id_insert as $id){
					$clientes	= array();
					$cruce		= array();
					if($tablasin){
						foreach($tablasin as $row){
							$columnassin 	= $this->getColumnasSin($row->origen ,$row->destino);
							if($columnassin){
								
								$sql = "INSERT INTO $row->destino (";
								
								foreach($columnassin as $fila){
									if ($fila === end($columnassin)) 
								        $sql .= $fila->columna;
									else
										$sql .= $fila->columna.",";
								}
								
								$sql .=	") SELECT ";
									
								foreach($columnassin as $fila){
									if ($fila === end($columnassin)) 
								        $sql .= $fila->bj_columna;
									else
										$sql .= $fila->bj_columna.",";
								}
								
								$sql .=	" 	FROM 
												$source
											WHERE 
												$source.$id_source = '$id->id_faltante'";	
												
								foreach($columnassin as $fila){
									$sql .= " AND ".$fila->bj_columna." IS NOT NULL";
								}
								
								$this->db->query($sql);
								
								if($row->destino == 'clientes')
									array_push($clientes, $this->db->insert_id());	
								else
									array_push($cruce, $this->db->insert_id());
								
								/*echo $sql;
								echo "<br>";
								echo $this->db->insert_id();
								echo "<br>";*/
							}
						}			
					}
					
					if(count($clientes) > 0){
						for ($i=0; $i < count($clientes); $i++) {
							echo "<br>";
							echo $clientes[$i];
							echo "<br>";
							for ($j=0; $j < count($cruce); $j++) { 
								echo $cruce[$j];	
								echo "<br>";
							}
						}
					}
					
				}
			}

			
		}
	}
	
} 
?>
