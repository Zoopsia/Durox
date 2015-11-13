<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presupuestos extends My_Controller {
	
	protected $_subject		= 'presupuestos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('clientes_model');
		$this->load->model('vendedores_model');
		$this->load->model('productos_model');
		$this->load->model('grupos_model');
		$this->load->model('reglas_model');
		$this->load->model('visitas_model');
		$this->load->model('pedidos_model');
		$this->load->model('modos_pago_model');
		$this->load->model('condiciones_pago_model');
		$this->load->model('tiempos_entrega_model');
			
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id)
	{
		$presupuesto			= $this->presupuestos_model->getRegistro($id);
		$db['presupuesto']		= $presupuesto;
		
		if($presupuesto){
			foreach($presupuesto as $row) {
				$db['clientes']		= $this->clientes_model->getRegistro($row->id_cliente);
				$db['vendedores']	= $this->vendedores_model->getRegistro($row->id_vendedor);
				$db['pedido']		= $this->pedidos_model->getPedido($row->id_visita);
			}
		}
		$db['iva']				= $this->clientes_model->getTodo('iva');		
		$db['presupuestos']		= $this->presupuestos_model->getDetallePresupuesto($id);
		$db['estados']			= $this->presupuestos_model->getTodo('estados_presupuestos');
		$db['alarmas']			= $this->presupuestos_model->getAlarmas($id);
		$db['tipos_alarmas']	= $this->presupuestos_model->getTodo('tipos_alarmas');
		$db['id_presupuesto']	= $id;
		
		$db['modos_pago']		= $this->modos_pago_model->getTodo();
		$db['sin_modos']		= $this->presupuestos_model->getModos($id);
		$db['condiciones_pago']	= $this->condiciones_pago_model->getTodo();
		$db['tiempos_entrega']	= $this->tiempos_entrega_model->getTodo();
	
		$this->cargar_vista($db, 'pestanas');	
	}
	

	public function presupuestos_abm()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('presupuestos.eliminado', 0);
			
			$crud->set_table('presupuestos');
			
			$crud->columns('id_presupuesto',
							'id_cliente',
							'id_vendedor',
							'id_estado_presupuesto',
							'fecha');
			
			$crud->callback_column('fecha',array($this,'_callback_fecha'));
			
			$crud->display_as('id_presupuesto','N° Presupuesto')
				 ->display_as('id_cliente','Cliente')
				 ->display_as('id_vendedor','Vendedor')
				 ->display_as('id_estado_presupuesto','Estado')
				 ->display_as('date_add','Fecha');
			
			$crud->set_subject('Presupuestos');
			
			$crud->fields(	'id_presupuesto',
							'id_cliente',
							'id_vendedor',
							'id_estado_presupuesto');
							
			$crud->order_by('id_presupuesto','desc');
							
			$crud->set_relation('id_cliente','clientes','{razon_social}');
			$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			$crud->set_relation('id_estado_presupuesto','estados_presupuestos','estado');
			
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
		return $this->presupuestos_model->update($arreglo,$primary_key);
	}


	function just_a_test($primary_key , $row)
	{
		echo "<script>sessionStorage.clear();</script>";
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_presupuesto;
	}
	
	public function _callback_fecha($value, $row){
		$date = date_create($value);
		return  "<span style='visibility:hidden;display:none;'>".$value."</span>".date_format($date, 'd/m/Y');
	}
	
	public function carga($id_visita=null)
	{
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		$db['productos']	= $this->presupuestos_model->getProductosTodo();
		$db['visitas']		= $this->presupuestos_model->getVisitas();
		$db['estados']		= $this->presupuestos_model->getTodo('estados_presupuestos');
		
		if($id_visita)
		{
			$db['visita']	= $this->visitas_model->getRegistro($id_visita);;
		}
		else
			$db['visita']	= '';
		
		$this->cargar_vista($db, 'carga');
				
	}
	
	public function nuevoPresupuesto()
	{
		$id_presupuesto	= $this->presupuestos_model->getCantidadRegistros() + 1;
		if($this->input->post('id_visita')){
			$id_visita	= $this->input->post('id_visita');
		}
		else{
			$id_visita	= $this->visitas_model->getCantidadRegistros() + 1;
		}
		
		$id_cliente		= $this->input->post('id_cliente');
		$id_vendedor	= $this->input->post('id_vendedor');
		$fecha			= formato_fecha($this->input->post('fecha'));
		
		if($id_presupuesto){
			$db['clientes']			= $this->clientes_model->getRegistro($id_cliente);
			$db['vendedores']		= $this->vendedores_model->getRegistro($id_vendedor);
			$db['fecha']			= $fecha;
			$db['id_cliente']		= $id_cliente;
			$db['id_vendedor']		= $id_vendedor;
			$db['visita']			= $id_visita;
			$db['presupuesto']		= $id_presupuesto;
			$db['productos']		= $this->presupuestos_model->getProductosTodo();
			
			$db['iva']				= $this->clientes_model->getTodo('iva');		
			$db['modos_pago']		= $this->modos_pago_model->getTodo();
			$db['condiciones_pago']	= $this->condiciones_pago_model->getTodo();
			$db['tiempos_entrega']	= $this->tiempos_entrega_model->getTodo();
			$db['estados']			= $this->presupuestos_model->getTodo('estados_presupuestos');
			$db['nota']				= '';
			$db['anterior_presup']	= 0;
			$db['detalle']			= '';
			
			$db['presupuestos']		= $this->presupuestos_model->getRegistro($id_presupuesto);
			
			$this->cargar_vista($db, 'carga_productos');
		}
	}
	
	public function guardarNuevoPresupuesto(){
		
		$cliente 			= $this->input->post('cliente');
		$vendedor			= $this->input->post('vendedor');
		$fecha				= $this->input->post('fecha');
		$condicion_pago		= $this->input->post('condicion_pago');
		$tiempo_entrega		= $this->input->post('tiempo_entrega');
		$nota				= $this->input->post('nota-publica');
		$id_visita			= $this->input->post('visita');
		$estado				= $this->input->post('estado_presupuesto');
		$total				= $this->input->post('total-ped');
		$anterior			= $this->input->post('anterior_presupuesto');
		
		if($this->visitas_model->getCantidadRegistros() + 1 == $id_visita){
			
			$visita			= array(
				'id_cliente' 		=> $cliente, 
				'id_vendedor' 		=> $vendedor,
				'fecha'				=> $fecha,
				'id_origen_visita'	=> 0,
				'id_origen'			=> 2
						
			);
	
			$id_visita = $this->visitas_model->insert($visita);
		}

		$presupuesto	= array(
				'id_visita'				=> $id_visita,
				'id_cliente' 			=> $cliente, 
				'id_vendedor' 			=> $vendedor,
				'fecha'					=> $fecha,
				'id_origen'				=> 2,
				'visto_back'			=> 0,
				'id_estado_presupuesto'	=> $estado,
				'id_condicion_pago'		=> $condicion_pago,
				'id_tiempo_entrega'		=> $tiempo_entrega,
				'nota_publica'			=> $nota,
				'total'					=> $total
		);
	
		$id_presupuesto 	= $this->presupuestos_model->insert($presupuesto);
			
		$arreglo_cruce	= array(
				'id_visita'				=> $id_visita,
				'id_presupuesto'		=> $id_presupuesto, 
		);
			
		$this->presupuestos_model->insertCruceVisita($arreglo_cruce);
		
		foreach($_POST['modos_pago'] as $modos){
			$cruce_presupuesto_modo	= array(
				'id_modo_pago'		=> $modos,
				'id_presupuesto'	=> $id_presupuesto
			);
			
			$this->presupuestos_model->insertCruceModos($cruce_presupuesto_modo);
		}
		
		if($anterior != 0){
			$arreglo_anterior = array(
				'id_estado_presupuesto' => 3,
				'eliminado'				=> 0
			);
			
			$this->presupuestos_model->update($arreglo_anterior, $anterior);
		}
		
		redirect('Presupuestos/pestanas/'.$id_presupuesto,'refresh');
		
	}
	
	function armarTotales(){
		$total = 0;
		$presupuesto		= $this->presupuestos_model->getDetallePresupuesto($this->input->post('presupuesto'));
		
		if($presupuesto)
		{
			foreach ($presupuesto as $row) 
			{
				if($row->estado_linea != 3)
					$total = $row->subtotal + $total;
			}
		}
		$total = $total + $this->input->post('subtotal');
		
		$mensaje = '<table class="table">
				        <tr>
				        	<th style="width:50%">'.$this->lang->line('subtotal').'</th>
				       		<td>$ '.round($total,2).'<input type="number" name="total-ped" id="total-ped" value="'.$total.'" hidden form="formGuardar"></td>
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
	
	public function getVendedor(){
		
		$id_visita			= $this->input->post('id_visita');
		
		$visita				= $this->visitas_model->getRegistro($id_visita);

		foreach ($visita as $row) {
			$vendedor 		= $this->vendedores_model->getRegistro($row->id_vendedor);
		}
		
		
		foreach ($vendedor as $key) {
			if($key->eliminado != 1){
				$mensaje  = '<option value="'.$key->id_vendedor.'" selected>'.$key->nombre.', '.$key->apellido;
				$mensaje .= '</option>';
			}
			else{
				$mensaje  = '<option value="0" disabled>'.$this->lang->line('vendedor').' '.$this->lang->line('eliminado');
				$mensaje .= '</option>';
			}
			
		}
		echo $mensaje;
	}
	
	public function getCliente(){
		
		$id_visita			= $this->input->post('id_visita');
		
		$visita				= $this->visitas_model->getRegistro($id_visita);
		
		foreach ($visita as $row) {
			$cliente 		= $this->clientes_model->getRegistro($row->id_cliente);
		}
		
		foreach ($cliente as $key) {
			if($key->eliminado != 1){
				$mensaje  = '<option value="'.$key->id_cliente.'" selected>'.$key->razon_social;
				$mensaje .= '</option>';
			}
			else{
				$mensaje  = '<option value="" disabled>'.$this->lang->line('cliente').' '.$this->lang->line('eliminado');
				$mensaje .= '</option>';
			}
		}
		echo $mensaje;
	}
	
	public function getFecha(){
		
		$id_visita			= $this->input->post('id_visita');
		
		$visita				= $this->visitas_model->getRegistro($id_visita);
		
		foreach ($visita as $row) {
			echo '<input type="text" name="fecha" class="form-control datepicker" value="'.date('d/m/Y', strtotime($row->fecha)).'" required autocomplete="off">';
		}
		
	}
	
	public function cargaProducto(){
		
		$producto	= $this->productos_model->getRegistro($this->input->post('producto'));
		
		$cliente	= $this->clientes_model->getCliente($this->input->post('cliente'));
		
		if($this->input->post('producto')){
			if($this->input->post('cantidad')){
				$cantidad		= $this->input->post('cantidad');
				$producto		= $this->productos_model->getRegistro($this->input->post('producto'));
				
				if($producto){
					foreach ($producto as $row) {
						$precio 		= $row->precio;
						$nombre			= $row->nombre;
						$abreviatura	= $row->abreviatura;
						$simbolo		= $row->simbolo;
						$valor			= $row->valor;
						$id_moneda		= $row->id_moneda;
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
				$subtotal 		= round((round($preciofinal, 2)*$cantidad)*$valor, 2);	
				
				echo 	'<tr>
							<td><input type="text" id="id_producto'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$this->input->post('producto').'">'.$nombre.'
								<input type="text" id="nomb'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$nombre.'">
								<input type="text" id="id_moneda'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$id_moneda.'">
								<input type="text" id="valor_moneda'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$valor.'">
								<input type="text" id="estado'.$this->input->post('aux').'" autocomplete="off" required hidden value="1">
							</td>
							<td><input type="text" id="cant'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$this->input->post('cantidad').'">'.$cantidad.'</td>
							<td><input type="text" id="precio'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$preciototal.'">'.$abreviatura.$simbolo.' '.$preciototal.'
								<input type="text" id="simbolo'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$abreviatura.$simbolo.'">
							</td>
							<td><input type="text" id="subtotal'.$this->input->post('aux').'" autocomplete="off" required hidden value="'.$subtotal.'">$ '.$subtotal.'</td>
							<td>Nuevo</td>
							<td><a class="btn btn-danger btn-xs" onclick="sacarProducto(this,'.$this->input->post('aux').')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></td>
							<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'.$this->input->post('aux').'\').show(); $(\'#text-coment'.$this->input->post('aux').'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>
								<span id="open-coment'.$this->input->post('aux').'" style="display:none">
									<div class="talkbubble" >
										<div class="talkbubble-rectangulo">
											<textarea rows="4" id="text-coment'.$this->input->post('aux').'" name="text-coment'.$this->input->post('aux').'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'.$this->input->post('aux').'\').hide(); guardarComentario('.$this->input->post('aux').')"></textarea>
										</div>
									</div>
								</span>
							</td>
						</tr>'; 
		
			}																
		}
	}
	
	public function guardarLineasPresupuesto(){
		
		$arreglo	= array(
			'id_presupuesto'				=> $this->input->post('presupuesto'),
			'id_producto' 					=> $this->input->post('producto'), 
			'cantidad' 						=> $this->input->post('cantidad'),
			'precio'						=> $this->input->post('precio'),
			'subtotal'						=> $this->input->post('subtotal'),	
			'id_moneda'						=> $this->input->post('id_moneda'),
			'valor_moneda'					=> $this->input->post('valor_moneda'),
			'comentario'					=> $this->input->post('comentario'),
			'id_estado_producto_presupuesto'=> $this->input->post('estado'),
			'eliminado'						=> 0
		);

		$linea				= $this->presupuestos_model->insertLinea($arreglo);
	}
	
	public function guardarLineasViejas(){
		
		$linea = $this->presupuestos_model->getLinea($this->input->post('linea'));
		
		if($linea){
			foreach($linea as $row){
					
				$arreglo	= array(
					'id_presupuesto'				=> $this->input->post('id_presupuesto'),
					'id_producto' 					=> $row->id_producto,
					'cantidad' 						=> $row->cantidad,
					'precio'						=> $row->precio,
					'subtotal'						=> $row->subtotal,
					'id_moneda'						=> $row->id_moneda,
					'valor_moneda'					=> $row->valor_moneda,
					'comentario'					=> $this->input->post('comentario'),
					'id_estado_producto_presupuesto'=> $this->input->post('estado'),
					'eliminado'						=> 0
				);
		
				$lineanueva				= $this->presupuestos_model->insertLinea($arreglo);
				echo $lineanueva;
			}
		}	
			
		
	}
	
	public function buscarProducto() 
	{
        $producto = $this->input->post('producto');
        $query = $this->presupuestos_model->buscarProducto($producto);

        foreach ($query->result() as $row){
        	echo '<li><a onclick="funcion1('.$row->id_producto.')">'.$row->nombre.'<input type="text" id="id_valor'.$row->id_producto.'" value="'.$row->nombre.'" hidden></a></li>';
        }
    }
	
	public function generarNuevoPresupuesto($id_presupuesto)
	{
		$presupuesto	= $this->presupuestos_model->getRegistro($id_presupuesto);
		$detalle		= $this->presupuestos_model->getDetallePresupuesto($id_presupuesto);
		$modos			= $this->presupuestos_model->getModos($id_presupuesto);
		
		if($presupuesto)
		{
			foreach($presupuesto as $row)
			{
				$id_cliente		= $row->id_cliente;
				$id_vendedor	= $row->id_vendedor;
				$id_visita		= $row->id_visita;
				$fecha			= date('Y-m-d');
				$condicion		= $row->id_condicion_pago;
				$tiempo			= $row->id_tiempo_entrega;
				$nota			= $row->nota_publica;
			}
		}
		
		$id = $this->presupuestos_model->getCantidadRegistros() + 1;
		if($id)
		{
			$db['clientes']			= $this->clientes_model->getRegistro($id_cliente);
			$db['vendedores']		= $this->vendedores_model->getRegistro($id_vendedor);
			$db['fecha']			= $fecha;
			$db['id_cliente']		= $id_cliente;
			$db['id_vendedor']		= $id_vendedor;
			$db['visita']			= $id_visita;
			$db['presupuesto']		= $id;
			$db['productos']		= $this->presupuestos_model->getProductosTodo();
			
			$db['iva']				= $this->clientes_model->getTodo('iva');		
			$db['modos_pago']		= $this->modos_pago_model->getTodo();
			$db['condiciones_pago']	= $this->condiciones_pago_model->getTodo();
			$db['tiempos_entrega']	= $this->tiempos_entrega_model->getTodo();
			$db['estados']			= $this->presupuestos_model->getTodo('estados_presupuestos');
			
			
			$db['condicion']		= $condicion;		
			$db['tiempo']			= $tiempo;		
			$db['nota']				= $nota;
			$db['modos']			= $modos;
			
			$db['anterior_presup']	= $id_presupuesto;
			
			$db['presupuestos']		= $this->presupuestos_model->getRegistro($id_presupuesto);
			
			$db['detalle']			= $detalle;
						
			$this->cargar_vista($db, 'carga_productos');
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
	
	function editarVisto($id=null){
		if($id){
			$arreglo = array(
				'visto_back'	=> $this->input->post('visto'),
				'eliminado'		=> 0
			);
			$id = $this->presupuestos_model->update($arreglo, $id);
		}
		else{
			$mensaje 	= $this->presupuestos_model->presupuestosNuevos();
		
			if($mensaje){
				foreach($mensaje as $row) {
					$id = $row->id_presupuesto; 	
					if($row->id_presupuesto = $this->input->post('id_presupuesto'.$id)){
						$arreglo = array(
							'visto_back'	=> $this->input->post('estado'.$id),
							'eliminado'		=> 0
						);
						$id = $this->presupuestos_model->update($arreglo, $id);
					}
				}	
			}
		}
		
		redirect($this->input->post('url'),'refresh');
	}
	
	public function getAlarmas(){
		$alarmas = $this->presupuestos_model->getAlarmas($this->input->post('id'));
		if($alarmas){
			echo count($alarmas);
		}
		else {
			echo 0;
		}
	}
}