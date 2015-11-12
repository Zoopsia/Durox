<?php 
class Mssql_model extends My_Model {
			
	protected $subjet 	= 'dbo';//esquema
	protected $prefijo 	= 'bj_';
	protected $host		= '192.168.1.232';
	protected $port 	= 1433; 
	
	function __construct(){
		parent::__construct();
	}
	
	function pingDB(){
		$waitTimeoutInSeconds = 1; 
		if($fp = @fsockopen($this->host,$this->port,$errCode,$errStr,$waitTimeoutInSeconds)){
			$log_error = array(
				'tipo'		=>	'INFO',
				'mensaje'	=>	'Conectado a '.$this->host.' y el puerto'.$this->port,
				'fecha'		=>	date('Y-m-d H:i:s'),
				'origen'	=>	'mssql_model'
			);
			$this->db->insert('log_error', $log_error);				   
			return TRUE;
		} 
		else {
			$log_error = array(
				'tipo'		=>	'ERROR',
				'mensaje'	=>	'Imposible conectar con '.$this->host.' y al puerto'.$this->port,
				'fecha'		=>	date('Y-m-d H:i:s'), 
				'origen'	=>	'mssql_model'
			);
			$this->db->insert('log_error', $log_error);
			return FALSE;
		} 
		fclose($fp);
	}
	
	function crearTablas($db, $nombreDB){
			
		//Llamo base de datos del ODBC//
		$db_mssql = $this->load->database($db, TRUE);
        
        //y de esta forma accedemos, no con $this->db->get,
        //sino con $db_mssql->get que contiene la conexión
        //a la base de datos mssql
        
        if($db_mssql){
        	//CONSULTA CON TABLAS
        	/*
	        $sql = "SELECT	
	        			TABLE_NAME
					FROM 
						$nombreDB.INFORMATION_SCHEMA.TABLES";
			*/
			//CONSULTA CON VISTAS
			$sql = "SELECT	
	        			TABLE_NAME
					FROM 
						$nombreDB.INFORMATION_SCHEMA.VIEWS";
						
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
			
		
		//Elimino la tabla existente//
		$tabladestino = strtolower($tabla);	
		$delete = "DROP TABLE IF EXISTS $this->prefijo$tabladestino";
		$this->db->query($delete);
		
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
		
		$cantidad_registros = 0;
		
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
						
						$insert_id = $this->db->query($sql1);
						$sql1 = "";
						
						if($insert_id)
							$cantidad_registros++;
					}
				}
			}		
			
			if($cantidad_registros>0){
				$log_error = array(
					'tipo'		=>	'INFO',
					'mensaje'	=>	'Se insertaron '.$cantidad_registros.' registros en '.$this->prefijo.$tabladestino,
					'fecha'		=>	date('Y-m-d H:i:s'),
					'origen'	=>	'mssql_model'
				);
				$this->db->insert('log_error', $log_error);
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
			
		$session_data = $this->session->userdata('logged_in');
		
		if(preg_match("/articulos/i",$tabla)){
			$source 	= $this->prefijo.strtolower($tabla);
			$target 	= "productos";
			$id_target	= "id_db";
			$id_source	= "art_CodGen";//---En caso de cambiar las tablas cambiar el ID---//
			$id_clave	= "id_producto";
			
			$tablasin	= $this->getTablasSin($source);
			$id_insert	= $this->getIdSinInsert($source, $target, $id_source, $id_target);
			
			$cantidad_articulos = 0;
			
			if($id_insert){
				foreach($id_insert as $id){
					$productos	= array();
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
								
								$this->db->query($sql);
								
								if($row->destino == 'productos'){
									array_push($productos, $this->db->insert_id());	
									$cantidad_articulos++;
								}
								
							}
						}			
					}
					if(count($productos) > 0){
						for ($i=0; $i < count($productos); $i++) {
							//--- Datos que no puedo traer de su tabla ---//	
							$datos_ext	= array(
								'id_origen'			=> 3,
								'date_add'			=> date('Y-m-d H:i:s'),
								'date_upd'			=> date('Y-m-d H:i:s'),
								'eliminado'			=> 0,
								'user_add'			=> $session_data['id_usuario'],
								'user_upd'			=> $session_data['id_usuario']
							);
							
							$this->db->where($id_clave, $productos[$i]);
							$this->db->update($target, $datos_ext);
						}
					}		
				}
			}
			
			if($cantidad_articulos > 0){
				$log_error = array(
					'tipo'		=>	'INFO',
					'mensaje'	=>	'Se insertaron '.$cantidad_articulos.' registros en '.$row->destino,
					'fecha'		=>	date('Y-m-d H:i:s'),
					'origen'	=>	'mssql_model'
				);
				$this->db->insert('log_error', $log_error);
			}	
		}
		else if(preg_match("/vendedor/i",$tabla)){	
			$source 	= $this->prefijo.strtolower($tabla);
			$target 	= "vendedores";
			$id_target	= "id_db";
			$id_source	= "ven_Cod";//---En caso de cambiar las tablas cambiar el ID---//
			$id_clave	= "id_vendedor";
			
			$tablasin	= $this->getTablasSin($source);
			$id_insert	= $this->getIdSinInsert($source, $target, $id_source, $id_target);
			
			$cantidad_vendedores = 0;
			
			if($id_insert){
				foreach($id_insert as $id){
					$vendedores	= array();
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
								        $sql .= "REPLACE($fila->bj_columna,'-','')";
									else
										$sql .= "REPLACE($fila->bj_columna,'-','')".",";
								}
								
								$sql .=	" 	FROM 
												$source
											WHERE 
												$source.$id_source = '$id->id_faltante'";	
												
								foreach($columnassin as $fila){
									$sql .= " AND ".$fila->bj_columna." IS NOT NULL";
								}
								
								$this->db->query($sql);
								
								if($row->destino == 'vendedores'){
									array_push($vendedores, $this->db->insert_id());	
									$cantidad_vendedores++;	
								}
								else
									$cruce[$row->destino] = $this->db->insert_id();
							}
						}
					}
					if(count($vendedores) > 0){
						for ($i=0; $i < count($vendedores); $i++) {
							//--- Datos que no puedo traer de su tabla ---//	
							$datos_ext	= array(
								'pass'				=> 1234,
								'id_origen'			=> 3,
								'date_add'			=> date('Y-m-d H:i:s'),
								'date_upd'			=> date('Y-m-d H:i:s'),
								'eliminado'			=> 0,
								'user_add'			=> $session_data['id_usuario'],
								'user_upd'			=> $session_data['id_usuario']
							);
							
							$this->db->where($id_clave, $vendedores[$i]);
							$this->db->update($target, $datos_ext);
							
							foreach($cruce as $key => $value) {
									
								$tabla = 'sin_vendedores_'.$key;
								
								if($key == 'direcciones'){
									$arreglo = array(
										'id_vendedor'	=> $vendedores[$i],
										'id_direccion'	=> $value,
										'date_add'		=> date('Y-m-d H:i:s'),
										'date_upd'		=> date('Y-m-d H:i:s'),
										'eliminado'		=> 0,
										'user_add'		=> $session_data['id_usuario'],
										'user_upd'		=> $session_data['id_usuario']
									);
									
									//--- Datos que no puedo traer de su tabla ---//	
									$datos_perfil  = array(
										'id_tipo'			=> 1,
										'date_add'			=> date('Y-m-d H:i:s'),
										'date_upd'			=> date('Y-m-d H:i:s'),
										'eliminado'			=> 0,
										'user_add'			=> $session_data['id_usuario'],
										'user_upd'			=> $session_data['id_usuario']
									);
									
									$this->db->where('id_direccion', $value);
									$this->db->update($key, $datos_perfil);
								} 
								else if($key == 'telefonos') {
									$arreglo = array(
										'id_vendedor'	=> $vendedores[$i],
										'id_telefono'	=> $value,
										'date_add'		=> date('Y-m-d H:i:s'),
										'date_upd'		=> date('Y-m-d H:i:s'),
										'eliminado'		=> 0,
										'user_add'		=> $session_data['id_usuario'],
										'user_upd'		=> $session_data['id_usuario']
									);
									
									//--- Datos que no puedo traer de su tabla ---//	
									$datos_perfil	= array(
										'id_tipo'			=> 1,
										'date_add'			=> date('Y-m-d H:i:s'),
										'date_upd'			=> date('Y-m-d H:i:s'),
										'eliminado'			=> 0,
										'user_add'			=> $session_data['id_usuario'],
										'user_upd'			=> $session_data['id_usuario']
									);
									
									$this->db->where('id_telefono', $value);
									$this->db->update($key, $datos_perfil);
								}
								else if($key == 'mails') {
									$arreglo = array(
										'id_vendedor'	=> $vendedores[$i],
										'id_mail'		=> $value,
										'date_add'		=> date('Y-m-d H:i:s'),
										'date_upd'		=> date('Y-m-d H:i:s'),
										'eliminado'		=> 0,
										'user_add'		=> $session_data['id_usuario'],
										'user_upd'		=> $session_data['id_usuario']
									);
									
									//--- Datos que no puedo traer de su tabla ---//	
									$datos_perfil	= array(
										'id_tipo'			=> 1,
										'date_add'			=> date('Y-m-d H:i:s'),
										'date_upd'			=> date('Y-m-d H:i:s'),
										'eliminado'			=> 0,
										'user_add'			=> $session_data['id_usuario'],
										'user_upd'			=> $session_data['id_usuario']
									);
									
									$this->db->where('id_mail', $value);
									$this->db->update($key, $datos_perfil);
								}
								
								$this->db->insert($tabla, $arreglo);
								
								//echo $vendedores[$i].' '.$key.' '.$value;	
								//echo "<br>";
							}
						}
					}
					
				}
			}

			if($cantidad_vendedores > 0){
				$log_error = array(
					'tipo'		=>	'INFO',
					'mensaje'	=>	'Se insertaron '.$cantidad_vendedores.' registros en vendedores',
					'fecha'		=>	date('Y-m-d H:i:s'),
					'origen'	=>	'mssql_model'
				);
				$this->db->insert('log_error', $log_error);
			}
		}
		else if(preg_match("/clientes/i",$tabla)){
			$source 	= $this->prefijo.strtolower($tabla);
			$target 	= "clientes";
			$id_target	= "id_db";
			$id_source	= "cli_Cod";//---En caso de cambiar las tablas cambiar el ID---//
			$id_clave	= "id_cliente";
			
			$tablasin	= $this->getTablasSin($source);
			$id_insert	= $this->getIdSinInsert($source, $target, $id_source, $id_target);
			
			$cantidad_clientes = 0;
			
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
								        $sql .= "REPLACE($fila->bj_columna,'-','')";
									else
										$sql .= "REPLACE($fila->bj_columna,'-','')".",";
								}
								
								$sql .=	" 	FROM 
												$source
											WHERE 
												$source.$id_source = '$id->id_faltante'";	
												
								foreach($columnassin as $fila){
									$sql .= " AND ".$fila->bj_columna." IS NOT NULL";
								}
								
								$this->db->query($sql);
								
								if($row->destino == 'clientes'){
									array_push($clientes, $this->db->insert_id());	
									$cantidad_clientes++;	
								}
								else
									$cruce[$row->destino] = $this->db->insert_id();
							}
						}
					}
					if(count($clientes) > 0){
						for ($i=0; $i < count($clientes); $i++) {
							//--- Datos que no puedo traer de su tabla ---//	
							$datos_ext	= array(
								'id_grupo_cliente'	=> 1,
								'id_iva'			=> 1,
								'id_origen'			=> 3,
								'date_add'			=> date('Y-m-d H:i:s'),
								'date_upd'			=> date('Y-m-d H:i:s'),
								'eliminado'			=> 0,
								'user_add'			=> $session_data['id_usuario'],
								'user_upd'			=> $session_data['id_usuario']
							);
							
							$this->db->where($id_clave, $clientes[$i]);
							$this->db->update($target, $datos_ext);
							
							foreach($cruce as $key => $value) {
									
								$tabla = 'sin_clientes_'.$key;
								
								if($key == 'direcciones'){
									$arreglo = array(
										'id_cliente'	=> $clientes[$i],
										'id_direccion'	=> $value,
										'date_add'		=> date('Y-m-d H:i:s'),
										'date_upd'		=> date('Y-m-d H:i:s'),
										'eliminado'		=> 0,
										'user_add'		=> $session_data['id_usuario'],
										'user_upd'		=> $session_data['id_usuario']
									);
									
									//--- Datos que no puedo traer de su tabla ---//	
									$datos_perfil  = array(
										'id_tipo'			=> 1,
										'date_add'			=> date('Y-m-d H:i:s'),
										'date_upd'			=> date('Y-m-d H:i:s'),
										'eliminado'			=> 0,
										'user_add'			=> $session_data['id_usuario'],
										'user_upd'			=> $session_data['id_usuario']
									);
									
									$this->db->where('id_direccion', $value);
									$this->db->update($key, $datos_perfil);
								} 
								else if($key == 'telefonos') {	
									$arreglo = array(
										'id_cliente'	=> $clientes[$i],
										'id_telefono'	=> $value,
										'date_add'		=> date('Y-m-d H:i:s'),
										'date_upd'		=> date('Y-m-d H:i:s'),
										'eliminado'		=> 0,
										'user_add'		=> $session_data['id_usuario'],
										'user_upd'		=> $session_data['id_usuario']
									);
									
									//--- Datos que no puedo traer de su tabla ---//	
									$datos_perfil	= array(
										'id_tipo'			=> 1,
										'date_add'			=> date('Y-m-d H:i:s'),
										'date_upd'			=> date('Y-m-d H:i:s'),
										'eliminado'			=> 0,
										'user_add'			=> $session_data['id_usuario'],
										'user_upd'			=> $session_data['id_usuario']
									);
									
									$this->db->where('id_telefono', $value);
									$this->db->update($key, $datos_perfil);
								}
								else if($key == 'mails') {
									$arreglo = array(
										'id_cliente'	=> $clientes[$i],
										'id_mail'		=> $value,
										'date_add'		=> date('Y-m-d H:i:s'),
										'date_upd'		=> date('Y-m-d H:i:s'),
										'eliminado'		=> 0,
										'user_add'		=> $session_data['id_usuario'],
										'user_upd'		=> $session_data['id_usuario']
									);
									
									//--- Datos que no puedo traer de su tabla ---//	
									$datos_perfil	= array(
										'id_tipo'			=> 1,
										'date_add'			=> date('Y-m-d H:i:s'),
										'date_upd'			=> date('Y-m-d H:i:s'),
										'eliminado'			=> 0,
										'user_add'			=> $session_data['id_usuario'],
										'user_upd'			=> $session_data['id_usuario']
									);
									
									$this->db->where('id_mail', $value);
									$this->db->update($key, $datos_perfil);
								}
								
								$this->db->insert($tabla, $arreglo);
								
								//echo $clientes[$i].' '.$key.' '.$value;	
								//echo "<br>";
							}
						}
					}
					
				}
			}

			if($cantidad_clientes > 0){
				$log_error = array(
					'tipo'		=>	'INFO',
					'mensaje'	=>	'Se insertaron '.$cantidad_clientes.' registros en clientes',
					'fecha'		=>	date('Y-m-d H:i:s'),
					'origen'	=>	'mssql_model'
				);
				$this->db->insert('log_error', $log_error);
			}
		}
	}
	
} 
?>
