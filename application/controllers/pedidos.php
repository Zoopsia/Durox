<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends My_Controller {
	
	protected $_subject		= 'pedidos';
	
	
	
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
		$this->load->model('presupuestos_model');
		$this->load->model('log_linea_pedidos_model');
		
		$this->load->model($this->_subject.'_model');	
	}
	

	public function pestanas($id)
	{
		$pedido					= $this->pedidos_model->getRegistro($id);
		$db['pedido']			= $pedido;
		
		if($pedido){
			foreach($pedido as $row) {
				$db['clientes']		= $this->clientes_model->getRegistro($row->id_cliente);
				$db['vendedores']	= $this->vendedores_model->getRegistro($row->id_vendedor);
			}
		}
		$db['iva']				= $this->clientes_model->getTodo('iva');		
		$db['pedidos']			= $this->pedidos_model->getDetallePedido($id);
		$db['estados']			= $this->pedidos_model->getTodo('estados_pedidos');
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
			
			
							
			$crud->order_by('date_add','asc');
							
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
		
		$pedido				= $this->input->post('pedido');
		$pedi				= $this->pedidos_model->getRegistro($pedido);
		
		foreach($pedi as $row){
			$cliente			= $this->clientes_model->getCliente($row->id_cliente);
		}
		
		if($this->input->post('producto')){
			if($this->input->post('cantidad')){

				$producto			= $this->input->post('producto');
				$cantidad			= $this->input->post('cantidad');

				$productos			= $this->pedidos_model->getProductosTodo();
				
				foreach ($productos as $row) {
					if($row->id_producto == $producto){
						$precio 	= $row->precio;
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
				
				$arreglo	= array(
					'id_pedido'						=> $this->input->post('pedido'),
					'id_producto' 					=> $this->input->post('producto'), 
					'cantidad' 						=> $cantidad,
					'id_estado_producto_pedido'		=> 4,
					'precio'						=> round($preciofinal, 2),
					'subtotal'						=> round($preciofinal, 2)*$cantidad,	
				);

				$linea				= $this->pedidos_model->insertLinea($arreglo);
			}
		}
	
		$this->armarTabla($pedido);	
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
	    	echo '<table class="table" cellspacing="0" width="100%">';
	    }
		else {
			echo '<table class="table table-striped" cellspacing="0" width="100%">';
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
					$mensaje .=	 '<td style="width: 50px"><span class="display-none" style="display:none"><a class="btn btn-danger btn-xs" onclick="sacarProducto('.$row->id_linea_producto_pedido.','.$id_pedido.')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></span></td>';			
				/*else if($row->estado == 'Aprobado')
					$mensaje .=		'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';	
				else if($row->estado == 'Facturado')
					$mensaje .=		'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';	
				else if($row->estado == 'Enviado')
					$mensaje .=		'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';		
				else if($row->estado == 'Eliminado')
					$mensaje .=		'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';	*/	
				else if($row->estado == 'Imposible de Enviar')
					$mensaje .=	'<td style="width: 50px"><span class="display-none" style="display:none"><a class="btn btn-success btn-xs" onclick="cargarProducto('.$row->id_linea_producto_pedido.','.$id_pedido.')" role="button" data-toggle="tooltip" data-placement="bottom" title="Agregar Producto"><i class="fa fa-plus"></i></a></span></td>';	
				$mensaje .=	'</tr>';
			}	
		}		
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
			</tbody>
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

	function guardarPedido($id_pedido){
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
		
		$arreglo = array(
			'total'					=> $total,
			'id_estado_pedido'		=> 4,
			'aprobado_back'			=> 0,
			'aprobado_front'		=> 0,
			'visto_back'			=> 1,
			'visto_front'			=> 0,
			'iteracion'				=> $iteracion + 1
		);
		
		$this->pedidos_model->update($arreglo, $id_pedido);
		
		if($pedidos){
			foreach($pedidos as $row){
				if($row->estado_linea == 3){
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
				else if($row->estado_linea == 4){
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
		$pedido	= $this->pedidos_model->getDetallePedido($id_pedido);
		
		if($pedido){
			foreach($pedido as $row){
				$arreglo	= array(
					'id_estado_producto_pedido'	=> 2	
				);
				$id 	= $this->pedidos_model->updateLinea($arreglo,$row->id_linea_producto_pedido);
			}

			$arreglo_pedido = array(
				'id_estado_pedido'		=>2
			);
			
			$this->pedidos_model->update($arreglo_pedido, $id_pedido);
		}
			
		redirect('Pedidos/pestanas/'.$id_pedido,'refresh');
	}
}