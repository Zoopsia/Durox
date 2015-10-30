<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualizaciones extends CI_Controller {
	
	protected $_subject		= 'actualizaciones';
	
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('alarmas_model');
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
	
	public function setLog($tipo, $tabla, $id_vendedor = NULL){
		if($tipo == 'DEBUG'){
			if($id_vendedor){
				log_message('DEBUG', 'Actualización de '.$tabla.', vendedor: '.$id_vendedor);
			}
		}	
	}
	
	
	public function getClientes(){
		if(isset($_POST['id_vendedor'])){	
			$tablas = array(
				'clientes'		=> 'clientes',
				'grupos'			=> 'grupos',
				'iva'					=> 'iva',
				'tipos'				=> 'tipos',
				'telefonos'		=> 'telefonos',
				'mails'				=> 'mails',
				'direcciones'	=> 'direcciones',
				'sin_clientes_telefonos'	=> 'sin_clientes_telefonos',
				'sin_clientes_mails'			=> 'sin_clientes_mails',
				'sin_clientes_direcciones'=> 'sin_clientes_direcciones',
				'departamentos'	=> 'departamentos',
				'provincias'		=> 'provincias',
				
			);
			
			$array[$tablas['clientes']]	= $this->clientes_model->getActualizacion($_POST['id_vendedor'], 'vendedores');
			$this->setLog('DEBUG', $tablas['clientes'], $_POST['id_vendedor']);
						
			$array[$tablas['grupos']]	= $this->grupos_model->getTodo();
			$this->setLog('DEBUG', $tablas['grupos']);
			
			$array[$tablas['iva']]	= $this->iva_model->getTodo();
			$this->setLog('DEBUG', $tablas['iva']);
			
			$array[$tablas['tipos']]	= $this->tipos_model->getTodo();
			$this->setLog('DEBUG', $tablas['tipos']);
			
			$array[$tablas['telefonos']]	= $this->clientes_model->getActualizacion($_POST['id_vendedor'], $tablas['telefonos']);
			$this->setLog('DEBUG', $tablas['telefonos']);
			
			$array[$tablas['mails']]	= $this->clientes_model->getActualizacion($_POST['id_vendedor'], $tablas['mails']);
			$this->setLog('DEBUG', $tablas['mails']);
			
			$array[$tablas['direcciones']]	= $this->clientes_model->getActualizacion($_POST['id_vendedor'], $tablas['direcciones']);
			$this->setLog('DEBUG', $tablas['direcciones']);
			
			
			$sql = $this->consultaSin($tablas['sin_clientes_telefonos'], $_POST['id_vendedor']);
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data8[] = $row;
				}
				
				$array[$tablas['sin_clientes_telefonos']]	= $data8;
				$this->setLog('DEBUG', $tablas['sin_clientes_telefonos'], $_POST['id_vendedor']);
			}
			
		
			$sql = $this->consultaSin($tablas['sin_clientes_mails'], $_POST['id_vendedor']);
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data9[] = $row;
				}
				
				$array[$tablas['sin_clientes_mails']]	= $data9;
				$this->setLog('DEBUG', $tablas['sin_clientes_mails'], $_POST['id_vendedor']);
			}
			
			
			$sql = $this->consultaSin($tablas['sin_clientes_direcciones'], $_POST['id_vendedor']);
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data10[] = $row;
				}
				
				$array[$tablas['sin_clientes_direcciones']]	= $data10;
				$this->setLog('DEBUG', $tablas['sin_clientes_direcciones'], $_POST['id_vendedor']);
			}
			
			
			$sql = "SELECT * FROM `departamentos` WHERE eliminado = '0'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data11[] = $row;
				}
				
				$array[$tablas['departamentos']]	= $data11;
				$this->setLog('DEBUG', $tablas['departamentos']);
			}
			
			
			
			$sql = "SELECT * FROM `provincias` WHERE eliminado = '0'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data[] = $row;
				}
				
				$array[$tablas['provincias']]	= $data;
				$this->setLog('DEBUG', $tablas['provincias']);
			}
			
			
			$db['registros'] = $array;
			$this->load->view($this->_subject."/getRegistrosVarios.php", $db);
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
		$tablas = array(
			'productos' => 'productos',
			'monedas'		=> 'monedas'
		);
		
		$array[$tablas['productos']]	= $this->productos_model->getTodo();
		$this->setLog('DEBUG', $tablas['productos']);
		
		$sql = "SELECT * FROM `monedas` WHERE eliminado = '0'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			foreach ($query->result() as $row){
				$data[] = $row;
			}
		}
		$array[$tablas['monedas']]	= $data;
		$this->setLog('DEBUG', $tablas['monedas']);
		
		$db['registros'] = $array;
		
		$this->load->view($this->_subject."/getRegistrosVarios.php", $db);
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
			
			if(isset($data)){
				$db['registros']	= $data;
				log_message('DEBUG', 'Actualización de '.$db['array']);
				$this->load->view($this->_subject."/getRegistros.php", $db);
			}
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
			log_message('DEBUG', 'Entro de '.$_POST['id_vendedor']);
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
		if(isset($_POST['id_vendedor'])){	
			$tablas = array(
				'presupuestos'					=> 'presupuestos',
				'lineas_presupuestos'		=> 'lineas_presupuestos',
				'estados_presupuestos'	=> 'estados_presupuestos',
				'epocas'								=> 'epocas',
				'condiciones_pago'			=> 'condiciones_pago',
				'modos_pago'						=> 'modos_pago',
				'sin_clientes_modos'		=> 'sin_clientes_modos',
				'sin_pedidos_modos'			=> 'sin_pedidos_modos',
				'sin_presupuestos_modos'=> 'sin_presupuestos_modos',
				'tiempos_entrega'				=> 'tiempos_entrega',
			);
		
			$array[$tablas['presupuestos']]	= $this->presupuestos_model->getActualizacion($_POST['id_vendedor']);
			$this->setLog('DEBUG', $tablas['presupuestos'], $_POST['id_vendedor']);
			
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
				$array[$tablas['lineas_presupuestos']] = $data;
				$this->setLog('DEBUG', $tablas['lineas_presupuestos'], $_POST['id_vendedor']);
			}
			
			$array[$tablas['estados_presupuestos']]	= $this->estados_presupuestos_model->getTodo();
			$this->setLog('DEBUG', $tablas['estados_presupuestos'], $_POST['id_vendedor']);
			
			$array[$tablas['epocas']]	= $this->estados_presupuestos_model->getTodo();
			$this->setLog('DEBUG', $tablas['epocas'], $_POST['id_vendedor']);
			
			$sql = "SELECT * FROM condiciones_pago";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$condiciones_pago[] = $row;
				}
				$array[$tablas['condiciones_pago']] = $condiciones_pago;
				$this->setLog('DEBUG', $tablas['condiciones_pago'], $_POST['id_vendedor']);
			}
			
			$sql = "SELECT * FROM modos_pago";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$modos_pago[] = $row;
				}
				$array[$tablas['modos_pago']] = $modos_pago;
				$this->setLog('DEBUG', $tablas['modos_pago'], $_POST['id_vendedor']);
			}
			
			$sql = "SELECT * FROM sin_presupuestos_modos";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$sin_presupuestos_modos[] = $row;
				}
				$array[$tablas['sin_presupuestos_modos']] = $sin_presupuestos_modos;
				$this->setLog('DEBUG', $tablas['sin_presupuestos_modos'], $_POST['id_vendedor']);
			}
			
			$sql = "SELECT * FROM tiempos_entrega";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$tiempos_entrega[] = $row;
				}
				$array[$tablas['tiempos_entrega']] = $tiempos_entrega;
				$this->setLog('DEBUG', $tablas['tiempos_entrega'], $_POST['id_vendedor']);
			}
			
			$db['registros'] = $array;
			
			
			$this->load->view($this->_subject."/getRegistrosVarios.php", $db);
		
		}
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
				'id_condicion_pago' => $_POST['id_condicion_pago'],
				'id_tiempo_entrega' => $_POST['id_tiempo_entrega'],
				'nota_publica'		=> $_POST['nota_publica'],
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
	
	
	
	function getAlarmas(){
	
		$sin = array(
				'sin_alarmas_clientes'		=> 'id_cliente',
				'sin_alarmas_pedidos'			=> 'id_pedido',
				'sin_alarmas_productos'		=> 'id_producto',
				'sin_alarmas_presupuestos'=> 'id_presupuesto',
				'sin_alarmas_visitas'			=> 'id_visita',
				'sin_alarmas_vendedores'	=> 'id_vendedor',
		);
		
		$i = 0;
		
		foreach($sin as $table => $id_table){
			$sql = "SELECT 
								*
						FROM 
								$table
						WHERE 
							eliminado = 0";
				
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data[] = $row;
				}
			}
			
			if(isset($data)){
				$array[$table]	= $data;
			}
		}
		
		$tablas = array(
			'alarmas' => 'alarmas',
			'tipos_alarmas' => 'tipos_alarmas'
		);
		
		$array[$tablas['alarmas']]	= $this->alarmas_model->getTodo();
		$this->setLog('DEBUG', $tablas['alarmas']);
		
		$sql = "SELECT * FROM `tipos_alarmas` WHERE eliminado = '0'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				foreach ($query->result() as $row){
					$data11[] = $row;
				}
				
				$array[$tablas['tipos_alarmas']]	= $data11;
				$this->setLog('DEBUG', $tablas['tipos_alarmas']);
				
			}
		
		$db['registros']	= $array;
		
		$this->load->view($this->_subject."/getRegistrosAlarmas.php", $db);	
	}
	
	
	
	public function setAlarmas(){
		if(isset($_POST['id_alarma'])){		
			$registro = array(
				'id_front'				=> $_POST['id_alarma'],
				'id_tipo_alarma'	=> $_POST['id_tipo_alarma'],
 				'mensaje'					=> $_POST['mensaje'],
 				'id_creador'			=> $_POST['id_creador'],
 				'id_origen'				=> $_POST['id_origen'],
 				'visto_back'			=> $_POST['visto_back'],
 				'visto_front'			=> $_POST['visto_front'],
				'eliminado' 			=> 0,
				'user_add'				=> 0,
				'user_upd'				=> 0,
				'date_add'				=> date("Y-m-d H:i:s"),
				'date_upd'				=> date("Y-m-d H:i:s")
			);
			
			$this->db->insert("alarmas", $registro);
		 
			$db['mensaje'] = TRUE;
		}else{
			log_message('error', 'Post a setAlarmas sin id_alarma');
		
			$db['mensaje']	=	FALSE;
		}
		$this->load->view($this->_subject."/setRegistro.php", $db);
	}
	
	
	
	public function setAlarmasSin(){
		if(isset($_POST['id_front_alarma'])){		
			$registro = array(
				'id_alarma'				=> $_POST['id_alarma'],
 				'id_front_alarma'	=> $_POST['id_front_alarma'],
 				'id_presupuesto'	=> $_POST['id_presupuesto'],
 				'id_front_tabla'	=> $_POST['id_front_tabla'],
 				'eliminado' 			=> 0,
				'user_add'				=> 0,
				'user_upd'				=> 0,
				'date_add'				=> date("Y-m-d H:i:s"),
				'date_upd'				=> date("Y-m-d H:i:s")
			);
			
			$this->db->insert("sin_alarmas_presupuestos", $registro);
		 
			$db['mensaje'] = TRUE;
		}else{
			log_message('error', 'Post a setAlarmasSin sin id_front_alarma');
		
			$db['mensaje']	=	FALSE;
		}
		$this->load->view($this->_subject."/setRegistro.php", $db);
	}
	
	
	
	public function setModosSin(){
		if(isset($_POST['id_presupuesto_front'])){		
			$registro = array(
				'id_presupuesto'	=> $_POST['id_presupuesto'],
 				'id_presupuesto_front'	=> $_POST['id_presupuesto_front'],
 				'id_modo_pago'		=> $_POST['id_modo_pago'],
 				'eliminado' 			=> 0,
				'user_add'				=> 0,
				'user_upd'				=> 0,
				'date_add'				=> date("Y-m-d H:i:s"),
				'date_upd'				=> date("Y-m-d H:i:s")
			);
			
			$this->db->insert("sin_presupuestos_modos", $registro);
		 
			$db['mensaje'] = TRUE;
		}else{
			log_message('error', 'Post a setModosSin sin id_presupuesto_front');
		
			$db['mensaje']	=	FALSE;
		}
		$this->load->view($this->_subject."/setRegistro.php", $db);
	}
}