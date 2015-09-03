<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends My_Controller {
	
	protected $_subject		= 'pedidos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		$this->load->library('email');
		
		$this->load->model('empresas_model');
		$this->load->model('clientes_model');
		$this->load->model('vendedores_model');
		$this->load->model('productos_model');
		$this->load->model('grupos_model');
		$this->load->model('reglas_model');
		$this->load->model('visitas_model');
		$this->load->model('presupuestos_model');
		$this->load->model('log_linea_pedidos_model');
		$this->load->model('mails_model');
		
		$this->load->model($this->_subject.'_model');	
	}
	

	public function pestanas($id)
	{
		$pedido					= $this->pedidos_model->getRegistro($id);
		$db['pedido']			= $pedido;
		
		if($pedido){
			foreach($pedido as $row) {
				$clientes			= $this->clientes_model->getRegistro($row->id_cliente);
				$db['clientes']		= $clientes;
				$db['vendedores']	= $this->vendedores_model->getRegistro($row->id_vendedor);
			}
		}

		if($clientes){
			foreach($clientes as $clientes){
				$db['mails']		= $this->clientes_model->getCruce($clientes->id_cliente,'mails');
				$db['config_mail']	= $this->mails_model->getConfigMails();
			}
		}
		$db['iva']				= $this->clientes_model->getTodo('iva');		
		$db['pedidos']			= $this->pedidos_model->getDetallePedido($id);
		$db['estados']			= $this->pedidos_model->getTodo('estados_pedidos');
		$db['alarmas']			= $this->pedidos_model->getAlarmas($id);
		$db['tipos_alarmas']	= $this->pedidos_model->getTodo('tipos_alarmas');
		$db['id_pedido']		= $id;
		
		$this->cargar_vista($db, 'pestanas');	
	}
	

	public function pedidos_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('pedidos.eliminado', 0);
			
			$crud->set_table('pedidos');
			
			$crud->columns('id_pedido',
							'id_cliente',
							'id_vendedor',
							'id_estado_pedido',
							'fecha');
			
			$crud->display_as('id_pedido','N° Pedido')
				 ->display_as('id_cliente','Cliente')
				 ->display_as('id_vendedor','Vendedor')
				 ->display_as('id_estado_pedido','Estado')
				 ->display_as('date_add','Fecha Ingreso');
				 
			$crud->required_fields();
			
			$crud->set_subject('Pedidos');
			
			$crud->fields(	'id_pedido',
							'id_cliente',
							'id_vendedor',
							'id_estado_pedido');
			
			
							
			$crud->order_by('id_pedido','asc');
							
			$crud->set_relation('id_cliente','clientes','{razon_social}');
			$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			$crud->set_relation('id_estado_pedido','estados_pedidos','estado');
			
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			$crud->callback_delete(array($this,'delete_user'));
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_edit();
			$crud->unset_add();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}

	public function delete_user($primary_key)
	{
		$arreglo = array(
			'eliminado'		=> 1
		);
		return $this->pedidos_model->update($arreglo,$primary_key);
	}

	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_pedido;
	}
	
	public function carga()
	{
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		
		$this->cargar_vista($db, 'carga');
				
	}
	
	public function generarNuevoPedido($id_presupuesto)
	{
		$presupuesto	= $this->presupuestos_model->getRegistro($id_presupuesto);
		$detalle		= $this->presupuestos_model->getDetallePresupuesto($id_presupuesto);
		
		if($presupuesto)
		{
			foreach($presupuesto as $row)
			{
				$arreglo	= array(
					'id_visita'				=> $row->id_visita,
					'id_presupuesto'		=> $id_presupuesto,
					'id_cliente'			=> $row->id_cliente,
					'id_vendedor'			=> $row->id_vendedor,
					'id_estado_pedido'		=> 1,
					'total'					=> $row->total,
					'fecha'					=> date('Y-m-d'),
					'id_origen'				=> 2,
					'aprobado_back'			=> 0,
					'aprobado_front'		=> 0,
					'visto_back'			=> 1,
					'visto_front'			=> 0,
				);
			}
		}

		$id = $this->pedidos_model->insert($arreglo);
		if($id){
			$estado_presupuesto = array(
					'id_estado_presupuesto'	=> 2
			);
			$this->presupuestos_model->update($estado_presupuesto,$id_presupuesto);
		}
		
		if($detalle)
		{
			foreach($detalle as $row)
			{
				if($row->estado_linea!=3){
					$arreglo_linea	= array(
						'id_pedido'					=> $id,
						'id_producto'						=> $row->producto,
						'precio'							=> $row->precio,
						'subtotal'							=> $row->subtotal,
						'cantidad'							=> $row->cantidad,
						'id_estado_producto_pedido'			=> $row->estado_linea,
						'aprobado_back'						=> 0,
						'aprobado_front'					=> 1
					);
					$id_linea = $this->pedidos_model->insertLinea($arreglo_linea);
				}
				
				$update_linea	= array(
					'id_estado_producto_presupuesto'	=> 2, 	
				);
				
				$this->presupuestos_model->updateLinea($update_linea,$row->id_linea_producto_presupuesto);
			}	
		}
		redirect('Pedidos/pestanas/'.$id,'refresh');	
	}	
	
	function editarVisto($id=null){
		if($id){
			$arreglo = array(
				'visto_back'		=> $this->input->post('visto')
			);
			$id = $this->pedidos_model->update($arreglo, $id);
		}
		else{	
			$mensaje 	= $this->pedidos_model->pedidosNuevos();
		
			if($mensaje){
				foreach($mensaje as $row) {
					$id = $row->id_pedido; 	
					if($row->id_pedido = $this->input->post('id_pedido'.$id)){
						$arreglo = array(
							'visto_back'		=> $this->input->post('estado'.$id)
						);
						$id = $this->pedidos_model->update($arreglo, $id);
					}
				}	
			}
		}
		
		redirect($this->input->post('url'),'refresh');
	}
	
	public function cargaProducto(){
		
		$arreglo	= array(
			'id_pedido'						=> $this->input->post('pedido'),
			'id_producto' 					=> $this->input->post('producto'), 
			'cantidad' 						=> $this->input->post('cantidad'),
			'id_estado_producto_pedido'		=> 4,
			'precio'						=> $this->input->post('precio'),
			'subtotal'						=> $this->input->post('subtotal'),	
		);

		$linea				= $this->pedidos_model->insertLinea($arreglo);
		
	}

	function armarTabla($id){
		
		$pedidos				= $this->pedidos_model->getDetallePedido($id);
		$total = 0;
		$mensaje = '';
    	$bandera = 0;
		if($pedidos)
		{
			foreach ($pedidos as $row) 
			{
				if($row->estado_linea != 3){
					$total = $row->subtotal + $total;
				}
				else{
					$bandera = 1;
				}	
			}
		}
									
		if($bandera == 1)
	    {
	    	echo '<table class="table" cellspacing="0" width="100%" id="tablapedido">';
	    }
		else {
			echo '<table class="table table-striped" cellspacing="0" width="100%" id="tablapedido">';
		}	
		
		$mensaje .= '
			<thead class="tabla-datos-importantes">
				<tr>
					<th style="width: 210px">'.$this->lang->line('producto').'</th>
					<th style="width: 200px">'.$this->lang->line('cantidad').'</th>
					<th>'.$this->lang->line('precio').'</th>
					<th>'.$this->lang->line('subtotal').'</th>
					<th class="no-print">'.$this->lang->line('estado').'</th>
					<th></th>
					</tr>
			</thead>
									 
			<tbody>';
		if($pedidos)
		{
			foreach ($pedidos as $row) 
			{
				if($row->estado == 'Imposible de Enviar'){
					$mensaje .= '<tr class="no-print" style="background-color: #f56954 !important; color: #fff;">';
				}
				else{
					$mensaje .= '<tr>';	
				}
				$mensaje .=		'<td>'.$row->nombre.'</td>
								<td>'.$row->cantidad.'</td>
								<td>$ '.$row->precio.'</td>
								<td>$ '.$row->subtotal.'</td>
								<td class="no-print" style="width: 150px">'.$row->estado.'</th>';
				if($row->estado == 'En Proceso')
					$mensaje .=	 '<td style="width: 50px"><span class="display-none"><a class="btn btn-danger btn-xs" onclick="sacarProducto('.$row->id_linea_producto_pedido.','.$id.')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></span></td>';
				else if($row->estado == 'Nuevo')
					$mensaje .=	 '<td style="width: 50px"></td>';				
				/*else if($row->estado == 'Aprobado')
					$mensaje .=		'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';	
				else if($row->estado == 'Facturado')
					$mensaje .=		'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';	
				else if($row->estado == 'Enviado')
					$mensaje .=		'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';		
				else if($row->estado == 'Eliminado')
					$mensaje .=		'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';	*/	
				else if($row->estado == 'Imposible de Enviar')
					$mensaje .=	'<td style="width: 50px"><span class="display-none"><a class="btn btn-success btn-xs" onclick="cargarProducto('.$row->id_linea_producto_pedido.','.$id.')" role="button" data-toggle="tooltip" data-placement="bottom" title="Agregar Producto"><i class="fa fa-plus"></i></a></span></td>';	
				else
					$mensaje .=	 '<td style="width: 50px"></td>';
				$mensaje .=	'</tr>';
			}	
		}
		$mensaje .= '</tbody><tfoot>';
		$mensaje .=	'<tr class="cargarLinea" style="display: none">
					 <td style="width: 210px">
						<input type="text" id="producto" name="producto" class="numeric form-control editable" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" onkeyup="ajaxSearch();" placeholder="'.$this->lang->line('producto').'" required style="height: 20px">
						<div id="suggestions">
						    <div id="autoSuggestionsList">  
						    </div>
						</div>
						<input type="text" id="id_producto" name="id_producto" autocomplete="off" pattern="[0-9]*" required hidden>
					</td>
					<td style="width: 200px">
						<input type="text" id="cantidad" name="cantidad1" class="numeric form-control editable" onkeypress="if (event.keyCode==13){cargaProducto('.$id.'); return false;}" autocomplete="off" pattern="[0-9]*" placeholder="'.$this->lang->line('cantidad').'" style="height: 20px" required>
					</td>
					<td></td>
					<td></td>
					<td></td>	
					<td></td>			
				</tr>
				</tfoot>
			</table>';  
			
		echo $mensaje; 
	}

	function armarTotales(){
		$total = 0;
		$pedidos				= $this->pedidos_model->getDetallePedido($this->input->post('pedido'));
		
		if($pedidos)
		{
			foreach ($pedidos as $row) 
			{
				if($row->estado_linea != 3)
					$total = $row->subtotal + $total;
			}
		}
		$total = $total + $this->input->post('subtotal');
		
		$mensaje = '<table class="table">
				        <tr>
				        	<th style="width:50%">'.$this->lang->line('subtotal').'</th>
				       		<td>$ '.round($total,2).'</td>
				       	</tr>
				        <tr>
				       		<th>'.$this->lang->line('iva').'</th>
				       		<td>$ '.round($total*1.21-$total,2).'</td>
				       	</tr>
				       	<tr>
				      		<th>'.$this->lang->line('total').'</th>
				    		<td>$ '.round($total*1.21,2).'</td>
				       	</tr>
       				</table>';
       	
       	echo $mensaje;
	}

	public function sacarProducto(){
			
		$id_linea			= $this->input->post('id_linea');
		$pedido				= $this->input->post('pedido');
		
		if($id_linea){
			$arreglo	= array(
				'id_estado_producto_pedido'	=> 3, 	
			);
		}
		
		$id_pedido 	= $this->pedidos_model->updateLinea($arreglo,$id_linea);
		
		$this->armarTabla($pedido);
	}

	public function cargarProducto(){
			
		$id_linea			= $this->input->post('id_linea');
		$pedido				= $this->input->post('pedido');
		
		if($id_linea){
			$arreglo	= array(
				'id_estado_producto_pedido'	=> 1 	
			);
		}
		
		$id_pedido 	= $this->pedidos_model->updateLinea($arreglo,$id_linea);
		
		$this->armarTabla($pedido);
	}  

	function guardarPedido($id_pedido,$nuevo=null){
		$pedidos				= $this->pedidos_model->getDetallePedido($id_pedido);
		$total = 0;
		
		if($pedidos)
		{
			foreach ($pedidos as $row) 
			{
				if($row->estado_linea != 3)
					$total = $row->subtotal + $total;
				
				$iteracion = $row->iteracion;
			}
		}
		if($nuevo){
			$arreglo = array(
				'total'					=> $total,
				'id_estado_pedido'		=> 1,
				'aprobado_back'			=> 0,
				'aprobado_front'		=> 0,
				'visto_back'			=> 0,
				'visto_front'			=> 0,
				'iteracion'				=> 0
			);
		}
		else{
			$arreglo = array(
				'total'					=> $total,
				'id_estado_pedido'		=> 4,
				'aprobado_back'			=> 0,
				'aprobado_front'		=> 0,
				'visto_back'			=> 1,
				'visto_front'			=> 0,
				'iteracion'				=> $iteracion + 1
			);
		}

		$this->pedidos_model->update($arreglo, $id_pedido);
		
		//----- CARGO ACCION A UN REGISTRO LOG---//
		if($pedidos){
			foreach($pedidos as $row){
				if($row->estado_linea == 3){//--- Imposible de enviar ---//
					$arreglo	 = array(
						'id_estado_producto_pedido'	=> 1,
						'eliminado'					=> 1 	
					);
					
					$arreglo_log = array(
						'id_linea'					=> $row->id_linea_producto_pedido,
						'id_accion'					=> 3
					);
					
					$id 	= $this->pedidos_model->updateLinea($arreglo,$row->id_linea_producto_pedido);
					$id_log = $this->log_linea_pedidos_model->insert($arreglo_log);
				}
				else if($row->estado_linea == 4){//--- Nuevo ---//
					$arreglo	= array(
						'id_estado_producto_pedido'	=> 1	
					);
					
					$arreglo_log = array(
						'id_linea'					=> $row->id_linea_producto_pedido,
						'id_accion'					=> 4
					);
					
					$id 	= $this->pedidos_model->updateLinea($arreglo,$row->id_linea_producto_pedido);
					$id_log = $this->log_linea_pedidos_model->insert($arreglo_log);
				}
			}
		}

		redirect('Pedidos/pestanas/'.$id_pedido,'refresh');
	}

	function cancelarCambios(){
		$pedidos				= $this->pedidos_model->getDetallePedido($this->input->post('pedido'));
		
		if($pedidos){
			foreach($pedidos as $row){
				if($row->estado_linea == 4 ){
					$arreglo	= array(
						'id_estado_producto_pedido'	=> 1,
						'eliminado'					=> 1 	
					);
					
					$id 	= $this->pedidos_model->updateLinea($arreglo,$row->id_linea_producto_pedido);
				}
				else if($row->estado_linea == 3){
					$arreglo	= array(
						'id_estado_producto_pedido'	=> 1	
					);
					
					$id 	= $this->pedidos_model->updateLinea($arreglo,$row->id_linea_producto_pedido);
				
				}
			}
		}
		
		$this->armarTabla($this->input->post('pedido'));
	}
	
	function aprobarPedido($id_pedido){
		
		$mails = $this->input->post('mail');
		$pedido	= $this->pedidos_model->getDetallePedido($id_pedido);
		
		if($mails){
			foreach($mails as $row){
				$cuerpo = $this->armarCuerpo($this->input->post('cuerpo'),$id_pedido);
				mail($row, $this->input->post('titulo'), $cuerpo, $this->input->post('cabecera'));
			}
		}
		
		if($pedido){
			foreach($pedido as $row){
				$arreglo	= array(
					'id_estado_producto_pedido'	=> 2	
				);
				$id 	= $this->pedidos_model->updateLinea($arreglo,$row->id_linea_producto_pedido);
			}

			$arreglo_pedido = array(
				'id_estado_pedido'		=> 2,
				'aprobado_back'			=> 1
			);
			
			$this->pedidos_model->update($arreglo_pedido, $id_pedido);
		}
			
		redirect('Pedidos/pestanas/'.$id_pedido,'refresh');
	}
	
	function traerProducto(){
		$producto	= $this->productos_model->getRegistro($this->input->post('producto'));
		
		$pedi		= $this->pedidos_model->getRegistro($this->input->post('pedido'));
		
		foreach($pedi as $row){
			$cliente			= $this->clientes_model->getCliente($row->id_cliente);
		}
		
		if($this->input->post('producto')){
			if($this->input->post('cantidad')){
				$cantidad		= $this->input->post('cantidad');
				$producto		= $this->productos_model->getRegistro($this->input->post('producto'));
				
				if($producto){
					foreach ($producto as $row) {
						$precio 	= $row->precio;
						$nombre		= $row->nombre;
					}
				}
				
				foreach($cliente as $row){
					$descuento = ($precio * $row->valor)/100;
					if($row->aumento_descuento == 1){
						$preciofinal = $precio - $descuento;
					}
					else {
						$preciofinal = $precio + $descuento;
					}
				}
				
				$preciototal	= round($preciofinal, 2);
				$subtotal 		= round($preciofinal, 2)*$cantidad;	
				
				echo 	'<tr>
							<td><input type="text" id="id_producto'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$this->input->post('producto').'">'.$nombre.'
								<input type="text" id="nomb'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$nombre.'">
							</td>
							<td><input type="text" id="cant'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$this->input->post('cantidad').'">'.$cantidad.'</td>
							<td><input type="text" id="precio'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$preciototal.'">$ '.$preciototal.'</td>
							<td><input type="text" id="subtotal'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$subtotal.'">$ '.$subtotal.'</td>
							<td>Nuevo</td>
							<td></td>
						</tr>'; 
		
			}
		}
	}

	function traerProducto2(){
		$producto	= $this->productos_model->getRegistro($this->input->post('producto'));
		
		$pedi		= $this->pedidos_model->getRegistro($this->input->post('pedido'));
		
		foreach($pedi as $row){
			$cliente			= $this->clientes_model->getCliente($row->id_cliente);
		}
		
		if($this->input->post('producto')){
			if($this->input->post('cantidad')){
				$cantidad		= $this->input->post('cantidad');
				$producto		= $this->productos_model->getRegistro($this->input->post('producto'));
				
				if($producto){
					foreach ($producto as $row) {
						$precio 	= $row->precio;
						$nombre		= $row->nombre;
					}
				}
				
				foreach($cliente as $row){
					$descuento = ($precio * $row->valor)/100;
					if($row->aumento_descuento == 1){
						$preciofinal = $precio - $descuento;
					}
					else {
						$preciofinal = $precio + $descuento;
					}
				}
				
				$preciototal	= round($preciofinal, 2);
				$subtotal 		= round($preciofinal, 2)*$cantidad;	
				
				echo 	'<tr>
							<td><input type="text" id="id_producto'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$this->input->post('producto').'">'.$nombre.'
								<input type="text" id="nomb'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$nombre.'">
							</td>
							<td><input type="text" id="cant'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$this->input->post('cantidad').'">'.$cantidad.'</td>
							<td><input type="text" id="precio'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$preciototal.'">$ '.$preciototal.'</td>
							<td><input type="text" id="subtotal'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$subtotal.'">$ '.$subtotal.'</td>
							<td>Nuevo</td>
							<td><a class="btn btn-danger btn-xs" onclick="deleteRow(this,'.$this->input->post('pedido').')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></td>
						</tr>'; 
		
			}																
		}
	}

	function armarCuerpo($cuerpo,$id_pedido){
		
		$pedido 				= $this->pedidos_model->getRegistro($id_pedido);
		
		if($pedido){
			foreach($pedido as $row){
				$id_cliente 	= $row->id_cliente;
				$id_vendedor 	= $row->id_vendedor;
				$id_visita		= $row->id_visita;
			}
		}
		$cuerpo = str_replace("#pedido#", $row->id_pedido, $cuerpo);
		$cuerpo = str_replace("#total#", $row->total, $cuerpo);
		$date	 = date_create($row->fecha);
		$cuerpo = str_replace("#fecha#", fechaEspañol(date_format($date, 'l j F, Y')), $cuerpo);
		$date2	 = date_create($row->date_upd);
		$cuerpo = str_replace("#fecha_aprobado#", fechaEspañol(date_format($date2, 'l j F')), $cuerpo);
		$cuerpo = str_replace("#visita#", $row->id_visita, $cuerpo);
		$cuerpo = str_replace("#presupuesto#", $row->id_presupuesto, $cuerpo);
		
		$cliente				= $this->clientes_model->getCliente($id_cliente);	
		//$telefonos_cliente		= $this->clientes_model->getCruce($id_cliente,'telefonos');
		//$direcciones_cliente	= $this->clientes_model->getCruce($id_cliente,'direcciones');
		//$mails_cliente			= $this->clientes_model->getCruce($id_cliente,'mails');
		
		if($cliente){
			foreach($cliente as $cliente){
				$cuerpo = str_replace("#razon_social_cliente#", $cliente->razon_social, $cuerpo); 
				$cuerpo = str_replace("#nombre_cliente#", $cliente->nombre, $cuerpo); 
				$cuerpo = str_replace("#apellido_cliente#", $cliente->apellido, $cuerpo); 
				$cuerpo = str_replace("#cuit_cliente#", cuit($cliente->cuit), $cuerpo); 
				$cuerpo = str_replace("#iva_cliente#", $cliente->iva, $cuerpo); 
				$cuerpo = str_replace("#grupo_cliente#", $cliente->grupo_nombre, $cuerpo); 
				//$cuerpo = str_replace("#valor_cliente#", $cliente->nombre, $cuerpo); 
			}
		}
		
		$vendedor				= $this->vendedores_model->getRegistro($id_vendedor);
		/*
		$telefonos_vendedor		= $this->vendedores_model->getCruce($id_vendedor,'telefonos');
		$direcciones_vendedor	= $this->vendedores_model->getCruce($id_vendedor,'direcciones');
		$mails_vendedor			= $this->vendedores_model->getCruce($id_vendedor,'mails');
		*/
		
		if($vendedor){
			foreach($vendedor as $vendedor){
				$cuerpo = str_replace("#nombre_vendedor#", $vendedor->nombre, $cuerpo);
				$cuerpo = str_replace("#apellido_vendedor#", $vendedor->apellido, $cuerpo);
			}
		}
		
		return $cuerpo;	
	
	}

	public function getAlarmas(){
		$alarmas = $this->pedidos_model->getAlarmas($this->input->post('id'));
		if($alarmas){
			echo count($alarmas);
		}
		else {
			echo 0;
		}
	}
	
	public function getClientes()
	{
		$id_vendedor	= $this->input->post('id_vendedor');
		
		$cruce			= $this->vendedores_model->sinCruce($id_vendedor);
		
		$mensaje = '';
		foreach ($cruce as $row) {
			if($row->eliminado!=1){
				$cliente 		= $this->clientes_model->getRegistro($row->id_cliente);	
				foreach ($cliente as $key) {
					if($key->eliminado !=1){
						$mensaje  .= '<option value="'.$key->id_cliente.'">'.$key->razon_social;
						$mensaje  .= '</option>';
					}
				}
			}
		}		
		echo $mensaje;
	}
	
	public function nuevoPedido(){
		
		$fecha = formato_fecha($this->input->post('fecha'));
			
		$visita			= array(
			'id_cliente' 		=> $this->input->post('id_cliente'), 
			'id_vendedor' 		=> $this->input->post('id_vendedor'),
			'fecha'				=> $fecha		
		);

		$id_visita = $this->visitas_model->insert($visita);
			
		$presupuesto	= array(
				'id_visita'				=> $id_visita,
				'id_cliente' 			=> $this->input->post('id_cliente'), 
				'id_vendedor' 			=> $this->input->post('id_vendedor'),
				'fecha'					=> $fecha,
				'id_origen'				=> 2,
				'visto_back'			=> 1,
				'id_estado_presupuesto'	=> 2
		);
	
		$id_presupuesto 	= $this->presupuestos_model->insert($presupuesto);
			
		$arreglo_cruce	= array(
				'id_visita'				=> $id_visita,
				'id_presupuesto'		=> $id_presupuesto, 
		);
			
		$this->presupuestos_model->insertCruceVisita($arreglo_cruce);
		
		$pedido			= array(
				'id_visita'				=> $id_visita,
				'id_presupuesto'		=> $id_presupuesto,
				'id_cliente' 			=> $this->input->post('id_cliente'), 
				'id_vendedor' 			=> $this->input->post('id_vendedor'),
				'fecha'					=> $fecha,
				'id_origen'				=> 2,
				'visto_back'			=> 0,
				'id_estado_pedido'		=> 1
		);
	
		$id_pedido 		= $this->pedidos_model->insert($pedido);
		
		
		if($id_pedido){
			$pedido					= $this->pedidos_model->getRegistro($id_pedido);
			$db['pedido']			= $pedido;
			
			if($pedido){
				foreach($pedido as $row) {
					$db['clientes']		= $this->clientes_model->getRegistro($row->id_cliente);
					$db['vendedores']	= $this->vendedores_model->getRegistro($row->id_vendedor);
				}
			}
			
			$db['iva']				= $this->clientes_model->getTodo('iva');		
			$db['pedidos']			= $this->pedidos_model->getDetallePedido($id_pedido);
			$db['estados']			= $this->pedidos_model->getTodo('estados_pedidos');
			$db['id_pedido']		= $id_pedido;
			
			$this->cargar_vista($db, 'carga_pedido');
		}
	}
}