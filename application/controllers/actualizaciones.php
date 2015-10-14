<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualizaciones extends CI_Controller {
	
	protected $_subject		= 'actualizaciones';
	
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('clientes_model');
		$this->load->model('direcciones_model');
		$this->load->model('documentos_model');
		$this->load->model('epocas_model');
		$this->load->model('estados_presupuestos_model');
		$this->load->model('grupos_model');
		$this->load->model('iva_model');
		$this->load->model('mails_model');
		$this->load->model('presupuestos_model');
		$this->load->model('productos_model');
		$this->load->model('tipos_model');
		$this->load->model('telefonos_model');
		$this->load->model('usuarios_model');
		$this->load->model('visitas_model');
		$this->load->model('vendedores_model');
		
	}
	
	public function getClientes(){
		if(isset($_POST['id_vendedor'])){	
			
			$db['array']		= "clientes";
			$db['registros']	= $this->clientes_model->getActualizacion($_POST['id_vendedor'], 'vendedores');
			log_message('DEBUG', 'Actualización de '.$db['array'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array2']		= "grupos";
			$db['registros2']	= $this->grupos_model->getTodo();
			log_message('DEBUG', 'Actualización de '.$db['array2']);
			
			
			$db['array3']		= "iva";
			$db['registros3']	= $this->iva_model->getTodo();
			log_message('DEBUG', 'Actualización de '.$db['array3']);
			
			
			$db['array4']		= "tipos";
			$db['registros4']	= $this->tipos_model->getTodo();
			log_message('DEBUG', 'Actualización de '.$db['array4']);
			
			
			$db['array5']		= "telefonos";
			$db['registros5']	= $this->clientes_model->getActualizacion($_POST['id_vendedor'], 'telefonos');
			log_message('DEBUG', 'Actualización de '.$db['array5'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array6']		= "mails";
			$db['registros6']	= $this->clientes_model->getActualizacion($_POST['id_vendedor'], 'mails');
			log_message('DEBUG', 'Actualización de '.$db['array6'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array7']		= "direcciones";
			$db['registros7']	= $this->clientes_model->getActualizacion($_POST['id_vendedor'], 'direcciones');
			log_message('DEBUG', 'Actualización de '.$db['array7'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array8']		= "sin_clientes_telefonos";
			$sql = $this->consultaSin($db['array8'], $_POST['id_vendedor']);
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data8[] = $row;
				}
			}
			$db['registros8']	= $data8;
			log_message('DEBUG', 'Actualización de '.$db['array8'].', vendedor: '.$_POST['id_vendedor']);
			
		
			$db['array9']		= "sin_clientes_mails";
			$sql = $this->consultaSin($db['array9'], $_POST['id_vendedor']);
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data9[] = $row;
				}
			}
			$db['registros9']	= $data9;
			log_message('DEBUG', 'Actualización de '.$db['array9'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array10']		= "sin_clientes_direcciones";
			$sql = $this->consultaSin($db['array10'], $_POST['id_vendedor']);
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data10[] = $row;
				}
			}
			$db['registros10']	= $data10;
			log_message('DEBUG', 'Actualización de '.$db['array10'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array11']		= "departamentos" ;
			$sql = "SELECT * FROM `departamentos` WHERE eliminado = '0'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data11[] = $row;
				}
			}
			$db['registros11']	= $data11;
			log_message('DEBUG', 'Actualización de '.$db['array11'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array12']		= "provincias" ;
			$sql = "SELECT * FROM `provincias` WHERE eliminado = '0'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data[] = $row;
				}
			}
			$db['registros12']	= $data;
			log_message('DEBUG', 'Actualización de '.$db['array12'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$this->load->view($this->_subject."/getRegistrosClientes.php", $db);
		}
	}
	
	public function setClientes(){
		if(isset($_POST['id_back'])){
		
			log_message('DEBUG', 'ID '.$_POST['id_back']);

			if($_POST['id_back'] != '0'){
				$cliente_db = $this->clientes_model->getRegistro($_POST['id_back']);
				
				if($cliente_db){
					foreach($cliente_db as $row){
						$log =	array(
						  'id_cliente' => $_POST['id_back'],
						  'razon_social_old' => $row->razon_social,
						  'razon_social_new' => $_POST['razon_social'],
						  'nombre_old' => $row->nombre,
						  'nombre_new' => $_POST['nombre'],
						  'apellido_old' => $row->apellido,
						  'apellido_new' => $_POST['apellido'],
						  'cuit_old' => $row->cuit,
						  'cuit_new' => $_POST['cuit'],
						  'id_grupo_cliente_old' => $row->id_grupo_cliente,
						  'id_grupo_cliente_new' => $_POST['id_grupo_cliente'],		
						  'id_iva_old' => $row->id_iva,
						  'id_iva_new' => $_POST['id_iva'],
						  'nombre_fantasia_old' => $row->nombre_fantasia,
						  'nombre_fantasia_new' => $_POST['nombre_fantasia'],
						  'web_old' => $row->web,
						  'web_new' => $_POST['web'],
						  'date_upd' => date("Y-m-d H:i:s"),
						  'id_vendedor' => $_POST['id_vendedor']
						);
						
						$this->db->insert("clientes_log_front", $log);
					}
				}
				$cliente = array(
					'razon_social' => $_POST['razon_social'],
					'nombre_fantasia' => $_POST['nombre_fantasia'],
					'nombre' => $_POST['nombre'],
					'apellido' => $_POST['apellido'],
					'id_grupo_cliente' => $_POST['id_grupo_cliente'],
					'id_iva' => $_POST['id_iva'],
					'web' => $_POST['web'],
					'cuit' => $_POST['cuit'],
					'visto' => 0,
					'id_origen' => 1,
					'date_upd' => date("Y-m-d H:i:s")
				);
				$this->db->update('clientes', $cliente, array('id_cliente' => $_POST['id_back']));
				
				log_message('DEBUG', 'Update del cliente '.$_POST['id_back']);
			}else{
				$cliente = array(
					'razon_social' => $_POST['razon_social'],
					'nombre_fantasia' => $_POST['nombre_fantasia'],
					'nombre' => $_POST['nombre'],
					'apellido' => $_POST['apellido'],
					'id_grupo_cliente' => $_POST['id_grupo_cliente'],
					'id_iva' => $_POST['id_iva'],
					'web' => $_POST['web'],
					'cuit' => $_POST['cuit'],
					'visto' => 0,
					'id_origen' => 1,
					'date_add' => date("Y-m-d H:i:s"),
					'date_upd' => date("Y-m-d H:i:s")
				);
				
				$this->db->insert('clientes', $cliente);
				$id = $this->db->insert_id();
				
				$sin = array(
					'id_vendedor' => $_POST['id_vendedor'],
					'id_cliente' => $id,
					'date_add' => date("Y-m-d H:i:s"),
					'date_upd' => date("Y-m-d H:i:s")
				);
				$this->db->insert('sin_vendedores_clientes', $sin);
				
				log_message('DEBUG', 'Insert del cliente '.$id);

			}
			
		}
	}
	
	public function setTelefonos(){
		if(isset($_POST['id_back'])){	
			$telefono_db = $this->telefonos_model->getRegistro($_POST['id_back']);
			
			if($telefono_db){
				foreach($telefono_db as $row){
					$log =	array(
					  'id_telefono' => $_POST['id_back'],
					  'telefono_old' => $row->telefono,
					  'telefono_new' => $_POST['telefono'],
					  'cod_area_old' => $row->cod_area,
					  'cod_area_new' => $_POST['cod_area'],
					  'id_tipo_old' => $row->id_tipo,
					  'id_tipo_new' => $_POST['id_tipo'],
					  'date_upd' => date("Y-m-d H:i:s"),
					  'id_vendedor' => $_POST['id_vendedor']
					);
					
					$this->db->insert("clientes_log_telefonos_front", $log);
				}
			}
		
			$telefono = array(
				'telefono' => $_POST['telefono'],
				'cod_area' => $_POST['cod_area'],
				'id_tipo' => $_POST['id_tipo'],
				'date_upd' => date("Y-m-d H:i:s")
			);
			
			$this->db->update('telefonos', $telefono, array('id_telefono' => $_POST['id_back']));
			
			log_message('DEBUG', 'Update del telefono '.$_POST['id_back']);
		}
	}
	
	
	public function setDirecciones(){
		if(isset($_POST['id_back'])){	
			$direccion_db = $this->direcciones_model->getRegistro($_POST['id_back']);
			
			if($direccion_db){
				foreach($direccion_db as $row){
					$log =	array(
					  'id_direccion' => $_POST['id_back'],
					  'direccion_old' => $row->direccion,
					  'direccion_new' => $_POST['direccion'],
					  'id_departamento_old' => $row->id_departamento,
					  'id_departamento_new' => $_POST['id_departamento'],
					  'id_provincia_old' => $row->id_provincia,
					  'id_provincia_new' => $_POST['id_provincia'],
					  'id_tipo_old' => $row->id_tipo,
					  'id_tipo_new' => $_POST['id_tipo'],
					  'date_upd' => date("Y-m-d H:i:s"),
					  'id_vendedor' => $_POST['id_vendedor']
					);
					
					$this->db->insert("clientes_log_direcciones_front", $log);
				}
			}
		
			$direccion = array(
				'direccion' => $_POST['direccion'],
				'id_departamento' => $_POST['id_departamento'],
				'id_provincia' => $_POST['id_provincia'],
				'id_tipo' => $_POST['id_tipo'],
				'date_upd' => date("Y-m-d H:i:s")
			);
			
			$this->db->update('direcciones', $direccion, array('id_direccion' => $_POST['id_back']));
			
			log_message('DEBUG', 'Update del direccion '.$_POST['id_back']);
		}
	}
	
	
	public function setMails(){
		if(isset($_POST['id_back'])){	
			$mails_db = $this->mails_model->getRegistro($_POST['id_back']);
			
			if($mails_db){
				foreach($mails_db as $row){
					$log =	array(
					  'id_mail' => $_POST['id_back'],
					  'mail_old' => $row->mail,
					  'mail_new' => $_POST['mail'],
					  'id_tipo_old' => $row->id_tipo,
					  'id_tipo_new' => $_POST['id_tipo'],
					  'date_upd' => date("Y-m-d H:i:s"),
					  'id_vendedor' => $_POST['id_vendedor']
					);
					
					$this->db->insert("clientes_log_mails_front", $log);
				}
			}
		
			$mail = array(
				'mail' => $_POST['mail'],
				'id_tipo' => $_POST['id_tipo'],
				'date_upd' => date("Y-m-d H:i:s")
			);
			
			$this->db->update('mails', $mail, array('id_mail' => $_POST['id_back']));
			
			log_message('DEBUG', 'Update del mail '.$_POST['id_back']);
		}
	}
	
	
	
	public function getProductos(){
		$db['array']		= "productos";
		$db['registros']	= $this->productos_model->getTodo();
		log_message('DEBUG', 'Actualización de '.$db['array']);
		
		$db['array2']		= "monedas" ;
		$sql = "SELECT * FROM `monedas` WHERE eliminado = '0'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			foreach ($query->result() as $row){
				$data[] = $row;
			}
		}
		$db['registros2']	= $data;
		log_message('DEBUG', 'Actualización de '.$db['array2']);
		
		$this->load->view($this->_subject."/getRegistrosProductos.php", $db);
		
	}
	
	
	
	public function getMensajes(){
		if(isset($_POST['id_vendedor'])){	
			$id_vendedor = $_POST['id_vendedor'];
		
			$db['array']		= "mensajes";
			
			// Recibidos
			$sql = "SELECT 
								* 
							FROM 
								`mensajes` 
							INNER JOIN 
								`sin_mensajes_vendedores` ON(`mensajes`.`id_mensaje` = `sin_mensajes_vendedores`.`id_mensaje`)
							WHERE 
								`id_origen` = '2' AND 
								`id_receptor` = '$id_vendedor'
							ORDER BY 
								mensajes.date_add DESC";
			
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data[] = $row;
				}
			}
			
			// Enviados
			$sql = "SELECT 
								* 
							FROM 
								`mensajes` 
							INNER JOIN 
								`sin_mensajes_vendedores` ON(`mensajes`.`id_mensaje` = `sin_mensajes_vendedores`.`id_mensaje`)
							WHERE 
								`id_origen` = '1' AND 
								`id_emisor` = '$id_vendedor' 
							ORDER BY 
								mensajes.date_add DESC";
			
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data[] = $row;
				}
			}
			
			$db['registros']	= $data;
			log_message('DEBUG', 'Actualización de '.$db['array']);
			
			$this->load->view($this->_subject."/getRegistros.php", $db);
		}
	}
	
	
	public function setMensajes(){
		if(isset($_POST['id_vendedor'])){	
			
			$mensaje = array(
				'asunto'					=> $_POST['asunto'],
				'mensaje'					=> $_POST['mensaje'],
				'id_origen'				=> $_POST['id_origen'],
				'id_mensaje_padre'	=> $_POST['id_mensaje_padre'],
				'user_add'				=> 0,
				'user_upd'				=> 0,
				'date_add'				=> date("Y-m-d H:i:s"),
				'date_upd'				=> date("Y-m-d H:i:s")
			);
			
			$this->db->insert("mensajes", $mensaje);
			
			$id_mensaje = $this->db->insert_id();
			
			$sin_mensajes = array(
				'id_mensaje' 	=> $id_mensaje,
				'id_receptor' 	=> "1",
				'id_emisor'		=> $_POST['id_vendedor'],
				'visto'			=> $_POST['visto'],
				'date_add'				=> date("Y-m-d H:i:s"),
				'date_upd'				=> date("Y-m-d H:i:s")
			);
			
			$this->db->insert("sin_mensajes_vendedores", $sin_mensajes);
			
			$db['mensaje'] = TRUE;
			
		}else{
			log_message('error', 'Post a setMensajes sin id_vendedor');
		
			$db['mensaje']	=	FALSE;
		}
		
		$this->load->view($this->_subject."/setRegistro.php", $db);
	}
	
	
	
	public function getVisitas(){
		if(isset($_POST['id_vendedor'])){	
			$db['array']		= "visitas";
			$db['registros']	= $this->visitas_model->getActualizacion($_POST['id_vendedor']);
			log_message('DEBUG', 'Actualización de '.$db['array'].', vendedor: '.$_POST['id_vendedor']);
			
			$this->load->view($this->_subject."/getRegistros.php", $db);
		}
	}
	
	
	
	public function getEpocas(){
		$db['array']		= "epocas";
		$db['registros']	= $this->epocas_model->getTodo();
		log_message('DEBUG', 'Actualización de '.$db['array']);
		
		$this->load->view($this->_subject."/getRegistros.php", $db);
	}
	
	
	
	public function getDocumentos(){
		$db['array']		= "documentos";
		$db['registros']	= $this->documentos_model->getTodo();
		log_message('DEBUG', 'Actualización de '.$db['array']);
		
		$this->load->view($this->_subject."/getRegistros.php", $db);
	}
	
	
	
	public function getPresupuestos(){
		//if(isset($_POST['id_vendedor'])){	
			$_POST['id_vendedor'] = 1;
		
			$db['array']		= "presupuestos";
			$db['registros']	= $this->presupuestos_model->getActualizacion($_POST['id_vendedor']);
			log_message('DEBUG', 'Actualización de '.$db['array'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$sql = "SELECT 
							`id_linea_producto_presupuesto`, 
							`id_presupuesto`, 
							`id_front` 
						FROM 
							`linea_productos_presupuestos` 
						WHERE 
							`id_presupuesto` = 0";
		
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$sql_presupuesto = "SELECT 
														`id_presupuesto`, 
														`id_front` 
													FROM 
														`presupuestos` 
													WHERE 
														`id_front` = '$row->id_front'";
		
					$query_presupuesto = $this->db->query($sql_presupuesto);
					
					if($query_presupuesto->num_rows() > 0){
						foreach ($query_presupuesto->result() as $row_presupuesto){
							$sql_update = 
							"UPDATE 
								linea_productos_presupuestos 
							SET 
								id_presupuesto = '$row_presupuesto->id_presupuesto' 
							WHERE 
								id_linea_producto_presupuesto = '$row->id_linea_producto_presupuesto'";
								
							$this->db->query($sql_update);	
						}
					}
				}
			}
			
			
			$db['array2']		= "lineas_presupuestos";
			$id_vendedor = $_POST['id_vendedor'];
			$sql = "SELECT 
							linea_productos_presupuestos.* 
						FROM 
							`linea_productos_presupuestos` 
						INNER JOIN 
							presupuestos ON(linea_productos_presupuestos.id_presupuesto = presupuestos.id_presupuesto) 
						WHERE 
							presupuestos.id_vendedor = '$id_vendedor'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data[] = $row;
				}
			}
			$db['registros2']	= $data;
			log_message('DEBUG', 'Actualización de '.$db['array2'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array3']		= "estados_presupuestos";
			$db['registros3']	= $this->estados_presupuestos_model->getTodo();
			log_message('DEBUG', 'Actualización de '.$db['array3'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$db['array4']		= "epocas";
			$db['registros4']	= $this->epocas_model->getTodo();
			log_message('DEBUG', 'Actualización de '.$db['array4'].', vendedor: '.$_POST['id_vendedor']);
			
			
			$this->load->view($this->_subject."/getRegistrosPresupuestos.php", $db);
		
		//}
	}
	
	
	public function getLogin(){
		if(isset($_POST['usuario'])){	
			$username = $_POST['usuario'];
			$password = $_POST['password'];
			
			$db['registros']	= $this->vendedores_model->login($username, $password);
			
			if(!$db['registros']){
				log_message('ERROR', 'Usuario y pass erroneos en el login; user: '.$username.' pass: '.$password);
			}else{
				foreach($db['registros'] as $row){
					log_message('DEBUG', 'El vendedor '.$row->nombre.' ha realizado login');
				}
			}
		}else{
			$db['registros'] = FALSE;
			   log_message('ERROR', 'No se envio el post con el usuario');
		}
		
		$this->load->view($this->_subject."/getLogin.php", $db);
	}
	
	
	public function setVisita(){
		if(isset($_POST['id_cliente'])){		
			$visita = array(
				'id_cliente'			=> $_POST['id_cliente'],
				'id_vendedor'			=> $_POST['id_vendedor'],
				'id_epoca_visita'	=> $_POST['id_epoca_visita'],
				'fecha'					=> $_POST['fecha'],
				'valoracion'			=> $_POST['valoracion'],
				'descripcion'			=> $_POST['descripcion'],
				'id_origen'				=> 1,
				'visto'					=> 0,
				'user_add'				=> 0,
				'user_upd'				=> 0,
				'date_add'				=> date("Y-m-d H:i:s"),
				'date_upd'				=> date("Y-m-d H:i:s")
			);
			
			$this->db->insert("visitas", $visita);
		 
			$db['mensaje'] = TRUE;
		}else{
			log_message('error', 'Post a setVisitas sin id_cliente');
		
			$db['mensaje']	=	FALSE;
		}
		
		$this->load->view($this->_subject."/setRegistro.php", $db);
	}
	
	
	
	public function setPresupuestos(){
		if(isset($_POST['id_cliente'])){		
			log_message('error', 'Total del Presupuesto'.$_POST['total']);
		
			$registro = array(
				'id_front' 				=> $_POST['id_front'],
				'id_visita' 			=> $_POST['id_visita'],
				'id_cliente' 			=> $_POST['id_cliente'],
				'id_vendedor'			=> $_POST['id_vendedor'],
				'fecha'						=> date("Y-m-d"),
				'id_estado_presupuesto' => $_POST['id_estado_presupuesto'],
				'total'						=> $_POST['total'],
				'id_origen'				=> $_POST['id_origen'],
				'aprobado_back'		=> $_POST['aprobado_back'],
				'aprobado_front'	=> $_POST['aprobado_front'],
				'visto_back'			=> $_POST['visto_back'],
				'visto_front'			=> $_POST['visto_front'],
				'eliminado'				=> $_POST['eliminado'],
				'user_add'				=> 0,
				'user_upd'				=> 0,
				'date_add'				=> date("Y-m-d H:i:s"),
				'date_upd'				=> date("Y-m-d H:i:s")
			);
			
			$this->db->insert("presupuestos", $registro);
		 
			$db['mensaje'] = TRUE;
		}else{
			log_message('error', 'Post a setPresupuestos sin id_cliente');
		
			$db['mensaje']	=	FALSE;
		}
		$this->load->view($this->_subject."/setRegistro.php", $db);
	}
	
	public function setLineasPresupuestos(){
		if(isset($_POST['id_temporario'])){		
			$registro = array(
				'id_front' 				=> $_POST['id_temporario'],		
				'id_producto' 			=> $_POST['id_producto'],
				'precio' 					=> $_POST['precio'],
				'id_moneda' 			=> $_POST['id_moneda'],
				'valor_moneda'		=> $_POST['valor_moneda'],
				'cantidad' 				=> $_POST['cantidad'],
				'subtotal' 				=> $_POST['subtotal'],
				'id_estado_producto_presupuesto' 				=> $_POST['id_estado_producto_presupuesto'],
				'comentario' 			=> $_POST['comentario'],
				'eliminado' 			=> $_POST['eliminado'],
				'user_add'				=> 0,
				'user_upd'				=> 0,
				'date_add'				=> date("Y-m-d H:i:s"),
				'date_upd'				=> date("Y-m-d H:i:s")
			);
			
			$this->db->insert("linea_productos_presupuestos", $registro);
		 
			$db['mensaje'] = TRUE;
		}else{
			log_message('error', 'Post a setLineasPresupuestos sin id_temporario');
		
			$db['mensaje']	=	FALSE;
		}
		$this->load->view($this->_subject."/setRegistro.php", $db);
	}
	
	
	function consultaSin($table, $id_vendedor){
		$sql = "SELECT 
				$table.* 
			FROM 
				`$table` 
			INNER JOIN 
				`clientes` ON($table.id_cliente = clientes.id_cliente)
			INNER JOIN 
				`sin_vendedores_clientes` ON(sin_vendedores_clientes.id_cliente = clientes.id_cliente)
			WHERE 
				sin_vendedores_clientes.id_vendedor = '$id_vendedor' AND 
				$table.eliminado = 0";
				
		return $sql;		
	}
	
}