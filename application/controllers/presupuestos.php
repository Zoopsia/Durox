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
			
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id, $tipo=1)
	{
		$presupuesto			= $this->presupuestos_model->getRegistro($id);
		$db['presupuesto']		= $presupuesto;
		
		foreach($presupuesto as $row) {
			$db['clientes']		= $this->clientes_model->getRegistro($row->id_cliente);
			$db['vendedores']	= $this->vendedores_model->getRegistro($row->id_vendedor);
			$db['pedido']		= $this->pedidos_model->getPedido($row->id_visita);
		}
		$db['iva']				= $this->clientes_model->getTodo('iva');		
		$db['presupuestos']		= $this->presupuestos_model->getDetallePresupuesto($id);
		$db['estados']			= $this->presupuestos_model->getTodo('estados_presupuestos');
		$db['id_presupuesto']	= $id;
		$db['tipo']				= $tipo;
		
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
							
			$crud->set_relation('id_cliente','clientes','{apellido} {nombre}');
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
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_presupuesto;
	}
	
	public function carga($id_visita=null)
	{
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		$db['productos']	= $this->presupuestos_model->getProductosTodo();
		$db['visitas']		= $this->visitas_model->getTodo();
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
		
		//----- SI LA VISITA YA EXISTIA----//
		
		$fecha = formato_fecha($this->input->post('fecha'));
		
		if($this->input->post('id_visita'))
		{
			$presupuesto	= array(
				'id_visita'				=> $this->input->post('id_visita'),
				'id_cliente' 			=> $this->input->post('id_cliente'), 
				'id_vendedor' 			=> $this->input->post('id_vendedor'),
				'fecha'					=> $fecha
			);
	
			$id_presupuesto 	= $this->presupuestos_model->insert($presupuesto);
			
			$arreglo_cruce	= array(
				'id_visita'				=> $this->input->post('id_visita'),
				'id_presupuesto'		=> $id_presupuesto, 
			);
			
			$this->presupuestos_model->insertCruceVisita($arreglo_cruce);
			
			$id_visita		= $this->input->post('id_visita');
		}
		else 
		{//------ SI LA VISITA NO SE ELIGIÓ O NO EXISTIA----//
			
			$visita	= array(
			'id_cliente' 		=> $this->input->post('id_cliente'), 
			'id_vendedor' 		=> $this->input->post('id_vendedor'),
			'fecha'				=> $fecha		
			);

			$id_visita = $this->visitas_model->insert($visita);
			
			$presupuesto	= array(
				'id_visita'				=> $id_visita,
				'id_cliente' 			=> $this->input->post('id_cliente'), 
				'id_vendedor' 			=> $this->input->post('id_vendedor'),
				'fecha'					=> $fecha
			);
	
			$id_presupuesto 	= $this->presupuestos_model->insert($presupuesto);
			
			$arreglo_cruce	= array(
				'id_visita'				=> $id_visita,
				'id_presupuesto'		=> $id_presupuesto, 
			);
			
			$this->presupuestos_model->insertCruceVisita($arreglo_cruce);
		}
		
		//----- LO LLEVO A LA CARGA DE PRODUCTOS DEL PRESUPUESTO -----//
		if($id_presupuesto)
		{
			$db['presupuesto']		= $id_presupuesto;
			$db['informacion']		= $this->presupuestos_model->getPresupuestoInfo($id_presupuesto);
			$db['productos']		= $this->presupuestos_model->getProductosTodo();
			$db['visita']			= $id_visita;
			$db['tipo']				= 0;
			$db['presupuestos']		= $this->presupuestos_model->getRegistro($id_presupuesto);
			$db['clientes']			= $this->clientes_model->getTodo();
			$db['vendedores']		= $this->vendedores_model->getTodo();
			$db['iva']				= $this->clientes_model->getTodo('iva');	
			$db['estados']			= $this->presupuestos_model->getTodo('estados_presupuestos');
			
			$this->cargar_vista($db, 'carga_productos');
		}
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
				$mensaje  = '<option value="'.$key->id_cliente.'" selected>'.$key->nombre.', '.$key->apellido;
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
			echo '<input type="text" name="fecha" class="form-control datepicker" value="'.date('d/m/Y', strtotime($row->fecha)).'" required>';
		}
		
	}
	
	public function cargaProducto(){
		
		$presupuesto		= $this->input->post('presupuesto');
		$pres				= $this->presupuestos_model->getRegistro($presupuesto);
		
		foreach($pres as $row){
			$cliente			= $this->clientes_model->getCliente($row->id_cliente);
		}
		
		if($this->input->post('producto')){
			if($this->input->post('cantidad')){

				$producto			= $this->input->post('producto');
				$cantidad			= $this->input->post('cantidad');

				$productos			= $this->presupuestos_model->getProductosTodo();
				
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
					'id_presupuesto'				=> $this->input->post('presupuesto'),
					'id_producto' 					=> $this->input->post('producto'), 
					'cantidad' 						=> $cantidad,
					'id_estado_producto_presupuesto'=> 1,
					'precio'						=> round($preciofinal, 2),
					'subtotal'						=> round($preciofinal, 2)*$cantidad,	
				);

				$linea				= $this->presupuestos_model->insertLinea($arreglo);
			}
		}
	
		$this->armarTabla($presupuesto);	
	}

	public function sacarProducto(){
			
		$id_linea			= $this->input->post('id_linea');
		$presupuesto		= $this->input->post('presupuesto');
		
		if($id_linea){
			$arreglo	= array(
				'id_estado_producto_presupuesto'	=> 3, 	
			);
		}
		
		$id_presupuesto 	= $this->presupuestos_model->updateLinea($arreglo,$id_linea);
		
		$this->armarTabla($presupuesto);
	} 
	
	public function ingresarProducto(){
			
		$id_linea			= $this->input->post('id_linea');
		$presupuesto		= $this->input->post('presupuesto');
		
		
		$arreglo	= array(
			'id_estado_producto_presupuesto'	=> 1, 	
		);
		
		$id_presupuesto 	= $this->presupuestos_model->updateLinea($arreglo,$id_linea);
		
		$this->armarTabla($presupuesto);
	} 
	
	public function armarTabla($presupuesto){
		
		$pres			= $this->presupuestos_model->getRegistro($presupuesto);
		
		foreach($pres as $row){
			$cliente			= $this->clientes_model->getCliente($row->id_cliente);
		}

		$detalle			= $this->presupuestos_model->getDetallePresupuesto($presupuesto);
			
		$mensaje = '<form action="" id="formProducto" class="form-inline" method="post">
					<table class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							
							<th class="th">'.$this->lang->line("producto").'</th>
							<th class="th">'.$this->lang->line("cantidad").'</th>
							<th class="th">'.$this->lang->line("precio").' '.$this->lang->line("base").'</th>
							<th class="th">'.$this->lang->line("precio").'</th>
							<th class="th">'.$this->lang->line("subtotal").'</th>
							<th></th>
							<th></th>
						</tr>
					</thead>';
					
		$mensaje .= '<tbody>';		
		
		$mensaje .= '<tr>
							<th>
							<input type="text" id="producto" name="producto" class="numeric form-control" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" onkeyup="ajaxSearch();" placeholder="'.$this->lang->line('producto').'" required>
								<div id="suggestions">
									<div id="autoSuggestionsList">  
									</div>
							    </div>
								<input type="text" id="id_producto" name="id_producto" autocomplete="off" pattern="[0-9]*" required hidden>
							</th>
							<th><input type="text" id="cantidad" name="cantidad1" class="numeric form-control" onkeypress="if (event.keyCode==13){nuevaLinea(); return false;}" autocomplete="off" pattern="[0-9]*" placeholder="'.$this->lang->line('cantidad').'" required></th>
							<th></th>
							<th></th>
							<th></th>
							<th>
								<a role="button" id="nuevalinea" class="btn btn-success btn-sm" onclick="cargaProducto('.$presupuesto.')" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('agregar').' '.$this->lang->line('producto').'">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</a>
							</th>
							<th></th>
					</tr>';
		
		foreach ($detalle as $row) {
			if($row->estado_linea == 1){
				$mensaje	.= '<tr>';					
				$mensaje	.= '<th>'.$row->nombre.'</th>';
				$mensaje	.= '<th>'.$row->cantidad.'</th>';
				$mensaje	.= '<th>'.'$'.$row->preciobase.'</th>';
				$mensaje	.= '<th>'.'$'.$row->precio.'</th>';
				$mensaje	.= '<th>'.'$'.$row->subtotal.'</th>';
				$mensaje	.= '<th><a href="#" class="btn btn-danger btn-xs" onclick="sacarProducto('.$row->id_linea_producto_presupuesto.','.$presupuesto.')" role="button" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('sacar').' '.$this->lang->line('producto').'">';
				$mensaje	.= '<i class="fa fa-minus"></i>';
				$mensaje	.= '</a></th>';
				$mensaje	.= '<th style="width: 107px"></th>';
				$mensaje	.= '</tr>';
			}
			else{
				$mensaje	.= '<tr class="rechazado">';					
				$mensaje	.= '<th>'.$row->nombre.'</th>';
				$mensaje	.= '<th>'.$row->cantidad.'</th>';
				$mensaje	.= '<th>'.'$'.$row->preciobase.'</th>';
				$mensaje	.= '<th>'.'$'.$row->precio.'</th>';
				$mensaje	.= '<th>'.'$'.$row->subtotal.'</th>';
				$mensaje	.= '<th><a href="#" class="btn btn-success btn-xs" onclick="ingresarProducto('.$row->id_linea_producto_presupuesto.','.$presupuesto.')" role="button" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('insertar').' '.$this->lang->line('producto').'">';
				$mensaje	.= '<i class="fa fa-plus"></i>';
				$mensaje	.= '</a></th>';
				$mensaje	.= '<th>'.$row->estado.'</th>';
				$mensaje	.= '</tr>';
			}
		}
		
		$mensaje .= '</tbody>';
		
		$total = 0;
		foreach ($detalle as $row) {
			if($row->estado_linea!=3){
				$total = $row->subtotal + $total;
			}
		}
		
		$mensaje .= '<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th class="th1">'.$this->lang->line("total").'</th>
							<th>'.'$'.$total.'</th>
							<th></th>
							<th></th>
						</tr>
					</tfoot>';
		
		
		$mensaje .= '</table>
					</form>';
		
		$mensaje .= '<form action="'.base_url().'index.php/Presupuestos/totalPresupuesto/'.$presupuesto.'" id="formGuardar" class="form-inline" method="post">';			
		$mensaje .= '<input type="number" id="total" name="total" pattern="[0-9 ]*" placeholder="'.$total.'" value="'.$total.'" required hidden>';			
		$mensaje .= '</form>';
		echo $mensaje;
	}

	function totalPresupuesto($presupuesto){
		
		$tabla				= $this->presupuestos_model->getDetallePresupuesto($presupuesto);

		$cambioEstado		= $this->presupuestos_model->getTodo();

		if($cambioEstado){
			foreach($cambioEstado as $row){
				if($row->id_presupuesto == $presupuesto){
					$visita = $row->id_visita; 
				}
			}
		}
		
		if($cambioEstado)
		{
			foreach($cambioEstado as $row){
				if($visita == $row->id_visita){
					$arreglo	= array(
						'id_estado_presupuesto'	=> 3, 	
					);
					$id_presupuesto 	= $this->presupuestos_model->update($arreglo,$row->id_presupuesto);	
				}
			}
		}
	
		if($this->input->post('total'))
		{
			$total		= $this->input->post('total');
			$bandera = 0;
			foreach ($tabla as $row) {
				if($row->estado_linea==3){
					$bandera = 1;
				}
			}
			
			if($bandera==1){
				$arreglo	= array(
					'total'					=> $total,
					'id_estado_presupuesto'	=> 3, 	
				);
			}
			else{
				$arreglo	= array(
					'total'					=> $total,
					'id_estado_presupuesto'	=> 1, 	
				);
			}
	
			$id_presupuesto 	= $this->presupuestos_model->update($arreglo,$presupuesto);
		}
		
		$tipo = 0;
		
		redirect('Presupuestos/pestanas/'.$presupuesto.'/'.$tipo,'refresh');
	}
	
	public function buscarProducto() 
	{
        $producto = $this->input->post('producto');
        $query = $this->presupuestos_model->buscarProducto($producto);

        foreach ($query->result() as $row){
        	echo '<li><a href="#" onclick="funcion1('.$row->id_producto.')">'.$row->nombre.'<input type="text" id="id_valor'.$row->id_producto.'" value="'.$row->nombre.'" hidden></a></li>';
        }
    }

	public function deletePresupuesto()
	{
		$presupuesto = $this->input->post('presupuesto');
		
		if($presupuesto){
			$this->presupuestos_model->deletePresupuesto($presupuesto);
		}
		
		echo $presupuesto;
	}
	
	public function generarNuevoPresupuesto($id_presupuesto)
	{
		$presupuesto	= $this->presupuestos_model->getRegistro($id_presupuesto);
		$detalle		= $this->presupuestos_model->getDetallePresupuesto($id_presupuesto);
		
		if($presupuesto)
		{
			foreach($presupuesto as $row)
			{
				$arreglo	= array(
					'id_visita'				=> $row->id_visita,
					'id_cliente'			=> $row->id_cliente,
					'id_vendedor'			=> $row->id_vendedor,
					'id_estado_presupuesto'	=> 1,
					'total'					=> $row->total,
					'fecha'					=> date('Y-m-d')	
				);
				
				$arreglo_cruce	= array(
					'id_visita'				=> $row->id_visita,
					'id_presupuesto'		=> $id_presupuesto, 
				);
			}
		}

		$id = $this->presupuestos_model->insert($arreglo);
			
		$this->presupuestos_model->insertCruceVisita($arreglo_cruce);
		
		if($detalle)
		{
			foreach($detalle as $row)
			{
				if($row->estado_linea!=3){
					$arreglo_linea	= array(
						'id_presupuesto'					=> $id,
						'id_producto'						=> $row->producto,
						'precio'							=> $row->precio,
						'subtotal'							=> $row->subtotal,
						'cantidad'							=> $row->cantidad,
						'id_estado_producto_presupuesto'	=> $row->estado_linea,
					);
					
					$id_linea = $this->presupuestos_model->insertLinea($arreglo_linea);
				}
			}
			
		}
		
		
		if($id)
		{
			$db['clientes']			= $this->clientes_model->getTodo();
			$db['vendedores']		= $this->vendedores_model->getTodo();
			$db['iva']				= $this->clientes_model->getTodo('iva');		
			$db['estados']			= $this->presupuestos_model->getTodo('estados_presupuestos');
			
			$db['detalle']			= $this->presupuestos_model->getDetallePresupuesto($id);
			$db['presupuesto']		= $id;
			$db['presupuestos']		= $this->presupuestos_model->getRegistro($id);
			$db['productos']		= $this->presupuestos_model->getProductosTodo();
			$db['tipo']				= 1;
			$db['informacion']		= $this->presupuestos_model->getPresupuestoInfo($id);
			
			foreach($db['presupuestos'] as $row)
			{
				$db['visita']			= $row->id_visita;
			}
			
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
						$mensaje  .= '<option value="'.$key->id_cliente.'">'.$key->apellido.', '.$key->nombre;
						$mensaje  .= '</option>';
					}
				}
			}
		}		
		echo $mensaje;
	}
}