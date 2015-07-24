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
			
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id, $tipo=1){
		
		$db['empresas']			= $this->empresas_model->getRegistro(1);
		$presupuesto			= $this->presupuestos_model->getRegistro($id);
		
		foreach($presupuesto as $row){
			
			$db['clientes']			= $this->clientes_model->getRegistro($row->id_cliente);
			$db['vendedores']		= $this->vendedores_model->getRegistro($row->id_vendedor);
		}

		$db['razon_social']		= $this->clientes_model->getTodo('razon_social');		
		$db['presupuestos']		= $this->presupuestos_model->getDetallePresupuesto($id);
		$db['estados']			= $this->presupuestos_model->getTodo('estados_presupuestos');
		$db['productos']		= $this->productos_model->getTodo();
		$db['id_presupuesto']	= $id;
		$db['tipo']				= $tipo;
		$db['presupuesto']		= $presupuesto;
		
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/pestanas.php");
					
	}
	

	public function presupuestos_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			//$crud->where('pedidos', 0);
			
			$crud->set_table('presupuestos');
			
			$crud->columns('id_presupuesto',
							'id_cliente',
							'id_vendedor',
							'id_estado_presupuesto',
							'date_add');
			
			$crud->display_as('id_presupuesto','N° Presupuesto')
				 ->display_as('id_cliente','Cliente')
				 ->display_as('id_vendedor','Vendedor')
				 ->display_as('id_estado_presupuesto','Estado')
				 ->display_as('date_add','Fecha Ingreso');
			
			$crud->set_subject('Presupuestos');
			
			$crud->fields(	'id_presupuesto',
							'id_cliente',
							'id_vendedor',
							'id_estado_presupuesto');
			
			
							
			$crud->order_by('date_add','asc');
							
			$crud->set_relation('id_cliente','clientes','{apellido} {nombre}');
			$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			$crud->set_relation('id_estado_presupuesto','estados_presupuestos','estado');
			
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_operations();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_presupuesto;
	}
	
	public function carga($id_visita=null){
		
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		$db['productos']	= $this->productos_model->getTodo();
		$db['visitas']		= $this->visitas_model->getTodo();
		$db['estados']		= $this->presupuestos_model->getTodo('estados_presupuestos');
		
		if($id_visita){
			$db['visita']	= $this->visitas_model->getRegistro($id_visita);;
		}
		else
			$db['visita']	= '';
			
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/carga.php");
				
	}
	
	public function nuevoPresupuesto(){
		
		//----- SI LA VISITA YA EXISTIA----//
		
		if($this->input->post('id_visita')){
						
			$presupuesto	= array(
				'id_visita'				=> $this->input->post('id_visita'),
				'id_cliente' 			=> $this->input->post('id_cliente'), 
				'id_vendedor' 			=> $this->input->post('id_vendedor'),
				'date_add'				=> $this->input->post('date_add'),
				'date_upd'				=> $this->input->post('date_add'),	
			);
	
			$id_presupuesto 	= $this->presupuestos_model->insert($presupuesto);
			
			$arreglo_cruce	= array(
				'id_visita'				=> $this->input->post('id_visita'),
				'id_presupuesto'		=> $id_presupuesto, 
			);
			
			$this->presupuestos_model->insertCruceVisita($arreglo_cruce);
			
			$id_visita		= $this->input->post('id_visita');
		}
		else {//------ SI LA VISITA NO SE ELIGIÓ O NO EXISTIA----//
			
			$visita	= array(
			'id_cliente' 		=> $this->input->post('id_cliente'), 
			'id_vendedor' 		=> $this->input->post('id_vendedor'),
			'date_add'			=> $this->input->post('date_add'),
			'date_upd'			=> $this->input->post('date_add'),		
			);

			$id_visita = $this->visitas_model->insert($visita);
			
			$presupuesto	= array(
				'id_visita'				=> $id_visita,
				'id_cliente' 			=> $this->input->post('id_cliente'), 
				'id_vendedor' 			=> $this->input->post('id_vendedor'),
				'date_add'				=> $this->input->post('date_add'),
				'date_upd'				=> $this->input->post('date_add'),	
			);
	
			$id_presupuesto 	= $this->presupuestos_model->insert($presupuesto);
			
			$arreglo_cruce	= array(
				'id_visita'				=> $id_visita,
				'id_presupuesto'		=> $id_presupuesto, 
			);
			
			$this->presupuestos_model->insertCruceVisita($arreglo_cruce);
		}
		
		//----- LO LLEVO A LA CARGA DE PRODUCTOS DEL PRESUPUESTO -----//
		if($id_presupuesto){
			$db['empresas']		= $this->empresas_model->getRegistro(1);
			$db['presupuesto']	= $id_presupuesto;
			$db['productos']	= $this->productos_model->getTodo();
			$db['visita']		= $id_visita;
			$db['tipo']			= 0;
			
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/carga_productos.php");
		}
	}
	
	public function getVendedor(){
		
		$id_visita			= $this->input->post('id_visita');
		
		$visita				= $this->visitas_model->getRegistro($id_visita);

		foreach ($visita as $row) {
			$vendedor 		= $this->vendedores_model->getRegistro($row->id_vendedor);
		}
		
		
		foreach ($vendedor as $key) {
			$mensaje  = '<option value="'.$key->id_vendedor.'" selected>'.$key->nombre.', '.$key->apellido;
			$mensaje .= '</option>';
			
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
			$mensaje  = '<option value="'.$key->id_cliente.'" selected>'.$key->nombre.', '.$key->apellido;
			$mensaje .= '</option>';
			
		}
		echo $mensaje;
	}
	
	public function getFecha(){
		
		$id_visita			= $this->input->post('id_visita');
		
		$visita				= $this->visitas_model->getRegistro($id_visita);
		
		foreach ($visita as $row) {
			echo '<input type="text" name="date_add" class="form-control" value="'.$row->date_add.'" required>';
		}
		
	}
	
	public function cargaProducto(){
		
		$presupuesto		= $this->input->post('presupuesto');
		
		
		if($this->input->post('producto')){
			if($this->input->post('cantidad')){

				$producto			= $this->input->post('producto');
				$cantidad			= $this->input->post('cantidad');

				$productos			= $this->productos_model->getTodo();
				
				foreach ($productos as $row) {
					if($row->id_producto == $producto){
						$precio 	= $row->precio;
					}
				}
				
				$cantidad = $this->input->post('cantidad');
				
				$arreglo	= array(
					'id_presupuesto'				=> $this->input->post('presupuesto'),
					'id_producto' 					=> $this->input->post('producto'), 
					'cantidad' 						=> $cantidad,
					'id_estado_producto_presupuesto'=> 1,
					'precio'						=> $precio*$cantidad,	
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
	
	public function vistaPresupuesto(){
		$id_presupuesto		= $this->input->post('id_presupuesto');
		
		$presupuesto	= $this->presupuestos_model->getRegistro($id_presupuesto);
		$detalle		= $this->presupuestos_model->getDetallePresupuesto($id_presupuesto);
		$productos		= $this->productos_model->getTodo();
		
		foreach($presupuesto as $row){
			$total = $row->total;
		}
		
		$subtotal = 0;
		foreach ($detalle as $row) {
			if($row->estado_linea != 3)
				$subtotal = $row->precio + $subtotal;
		}
										
		foreach($presupuesto as $row){
			if($subtotal>=$row->total){
				$descuento	= $subtotal-$row->total;
				$tipo		= 'Descuento';
			}
			else{
				$descuento	= $row->total-$subtotal;
				$tipo		= 'Aumento';
			}
		}
		
		$mensaje = '<table class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th class="th1">'.$this->lang->line("producto").'</th>
							<th class="th1">'.$this->lang->line("cantidad").'</th>
							<th class="th1">'.$this->lang->line("precio").'</th>
							<th class="th1">'.$this->lang->line("subtotal").'</th>
							<th class="th1">'.$this->lang->line("estado").'</th>
						</tr>
					</thead>';
		
		$mensaje .= '<tfoot>
						<tr>
							<th class="th1"></th>
							<th class="th1"></th>
							<th class="th1"></th>
							<th class="th1">'.$this->lang->line("subtotal").'</th>
							<th class="th1">$ '.$subtotal.'</th>
						</tr>
						<tr>
							<th class="th1"></th>
							<th class="th1"></th>
							<th class="th1"></th>
							<th class="th1">'.$tipo.'</th>
							<th class="th1">$ '.$descuento.'</th>
						</tr>
						<tr>
							<th class="th1"></th>
							<th class="th1"></th>
							<th class="th1"></th>
							<th class="th1">'.$this->lang->line("total").'</th>
							<th class="th1">$ '.$total.'</th>
						</tr>
					</tfoot>';
		
		$mensaje .= '<tbody>';
		foreach($detalle as $row){
			foreach($productos as $key){
				if($row->producto == $key->id_producto){
					$mensaje .= '<tr>
									<th>'.$row->nombre.'</th>
									<th>'.$row->cantidad.'</th>
									<th>$ '.$key->precio.'</th>
									<th>$ '.$row->precio.'</th>
									<th>'.$row->estado.'</th>
								</tr>';
				}
			}
		}
		$mensaje .= '</tbody>';
						
		echo $mensaje;
	}
	
	public function armarTabla($presupuesto){
		
		$pres			= $this->presupuestos_model->getRegistro($presupuesto);
		
		foreach($pres as $row){
			$cliente			= $this->clientes_model->getRegistro($row->id_cliente);
		}
		
		$grupos				= $this->grupos_model->getTodo();
		$reglas				= $this->reglas_model->getTodo();
		$productos			= $this->productos_model->getTodo();
		$tabla				= $this->presupuestos_model->getLineas($presupuesto);
		$estado_linea		= $this->presupuestos_model->getTodo('estados_productos_presupuestos');
		
		
		
		foreach($cliente as $cliente){
			foreach($grupos as $grupos){
				if($cliente->id_grupo_cliente == $grupos->id_grupo_cliente){
					foreach($reglas as $reglas){
						if($reglas->id_grupo_cliente == $grupos->id_grupo_cliente){
							
							if($reglas->aumento_descuento==0){
								$arreglo_reglas = array(
									'valor'		=> $reglas->valor,
									'tipo'		=> $reglas->aumento_descuento,
									'nombre'	=> 'Aumento',
								);
							}
							else {
								$arreglo_reglas = array(
									'valor'		=> $reglas->valor,
									'tipo'		=> $reglas->aumento_descuento,
									'nombre'	=> 'Descuento',
								);
							}
						}
					}
				}
			}
		}
		
		$mensaje = '<table class="table table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							
							<th class="th1">'.$this->lang->line("producto").'</th>
							<th class="th1">'.$this->lang->line("cantidad").'</th>
							<th class="th1">'.$this->lang->line("precio").'</th>
							<th class="th1">'.$this->lang->line("subtotal").'</th>
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
							<th>
								<a role="button" id="nuevalinea" class="btn btn-success btn-sm" onclick="cargaProducto('.$presupuesto.')" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('agregar').' '.$this->lang->line('producto').'">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</a>
							</th>
							<th></th>
					</tr>';
		
		
		
		
		
		foreach ($tabla->result() as $row) {
			if($row->id_presupuesto == $presupuesto){
				
				foreach ($productos as $key) {
					
					if($row->id_producto == $key->id_producto){
						
						if($row->id_estado_producto_presupuesto == 1){
							$mensaje	.= '<tr>';					
							$mensaje	.= '<th>'.$key->nombre.'</th>';
							$mensaje	.= '<th>'.$row->cantidad.'</th>';
							$mensaje	.= '<th>'.'$'.$key->precio.'</th>';
							$mensaje	.= '<th>'.'$'.$row->precio.'</th>';
							$mensaje	.= '<th><a href="#" class="btn btn-danger btn-xs glyphicon glyphicon-minus" onclick="sacarProducto('.$row->id_linea_producto_presupuesto.','.$presupuesto.')" role="button" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('anular').' '.$this->lang->line('producto').'"></th>';
							$mensaje	.= '<th style="width: 118px"></th>';
							$mensaje	.= '</tr>';
						}
						else{
							$mensaje	.= '<tr class="rechazado">';					
							$mensaje	.= '<th>'.$key->nombre.'</th>';
							$mensaje	.= '<th>'.$row->cantidad.'</th>';
							$mensaje	.= '<th>'.'$'.$key->precio.'</th>';
							$mensaje	.= '<th>'.'$'.$row->precio.'</th>';
							$mensaje	.= '<th><a href="#" class="btn btn-success btn-xs glyphicon glyphicon-plus" onclick="ingresarProducto('.$row->id_linea_producto_presupuesto.','.$presupuesto.')" role="button" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('insertar').' '.$this->lang->line('producto').'"></th>';
							foreach ($estado_linea as $fila) {
								if($row->id_estado_producto_presupuesto == $fila->id_estado_producto_presupuesto)
									$mensaje	.= '<th>'.$fila->estado.'</th>';
							}
							$mensaje	.= '</tr>';
						}
					}
				}
			}
		}
		
		
		$mensaje .= '</tbody>';
		
		$subtotal = 0;
		foreach ($tabla->result() as $row) {
			if($row->id_estado_producto_presupuesto!=3){
				if($row->id_presupuesto == $presupuesto){
					$subtotal = $row->precio + $subtotal;
				}
			}
		}
		
		$descuento = ($subtotal * $arreglo_reglas['valor'])/100;
		
		if($arreglo_reglas['tipo']==1){
			$total = $subtotal - $descuento;
		}
		else {
			$total = $subtotal + $descuento;
		}
		
		$mensaje .= '<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th class="th1">'.$this->lang->line("subtotal").'</th>
							<th>'.'$'.$subtotal.'</th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
							<th class="th1">'.$arreglo_reglas['nombre'].'</th>
							<th>'.'$'.$descuento.'</th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
							<th class="th1">'.$this->lang->line("total").'</th>
							<th>'.'$'.$total.'</th>
							<th></th>
							<th></th>
						</tr>
					</tfoot>';
		
		
		$mensaje .= '</table>';
		
		$mensaje .= '<form action="'.base_url().'index.php/Presupuestos/totalPresupuesto/'.$presupuesto.'" id="formGuardar" class="form-inline" method="post">';			
		$mensaje .= '<input type="number" id="total" name="total" pattern="[0-9 ]*" placeholder="'.$total.'" value="'.$total.'" required hidden>';			
		$mensaje .= '</form>';
		echo $mensaje;
	}

	function totalPresupuesto($presupuesto){
		
		$tabla				= $this->presupuestos_model->getLineas($presupuesto);
		
		$cambioEstado		= $this->presupuestos_model->getTodo();
		
		if($cambioEstado){
			foreach($cambioEstado as $row){
				if($row->id_presupuesto == $presupuesto){
					$visita = $row->id_visita; 
				}
			}
		}
		
		if($cambioEstado){
			foreach($cambioEstado as $row){
				if($visita == $row->id_visita){
					$arreglo	= array(
						'id_estado_presupuesto'	=> 3, 	
					);
					$id_presupuesto 	= $this->presupuestos_model->update($arreglo,$row->id_presupuesto);	
				}
			}
		}
			
		if($this->input->post('total')){
			$total		= $this->input->post('total');
			$bandera = 0;
			foreach ($tabla->result() as $row) {
				if($row->id_estado_producto_presupuesto==3){
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
	
	public function buscarProducto() {
        $producto = $this->input->post('producto');
        $query = $this->presupuestos_model->buscarProducto($producto);

        foreach ($query->result() as $row){
        	echo '<li><a href="#" onclick="funcion1('.$row->id_producto.')">'.$row->nombre.'<input type="text" id="id_valor'.$row->id_producto.'" value="'.$row->nombre.'" hidden></a></li>';
        }
    }

	public function deletePresupuesto(){
		$presupuesto = $this->input->post('presupuesto');
		
		if($presupuesto){
			$this->presupuestos_model->deletePresupuesto($presupuesto);
		}
		
		echo $presupuesto;
	}
	
	public function generarNuevoPresupuesto($id_presupuesto){
		
		$presupuesto	= $this->presupuestos_model->getRegistro($id_presupuesto);
		$detalle		= $this->presupuestos_model->getDetallePresupuesto($id_presupuesto);
		foreach($presupuesto as $row){
			$arreglo	= array(
				'id_visita'				=>	$row->id_visita,
				'id_cliente'			=>	$row->id_cliente,
				'id_vendedor'			=>	$row->id_vendedor,
				'id_estado_presupuesto'	=>	1,
				'total'					=>	$row->total,
				'date_add'				=>	$row->date_add,
				'date_upd'				=>	$row->date_upd,			
			);
			
			$arreglo_cruce	= array(
				'id_visita'				=> $row->id_visita,
				'id_presupuesto'		=> $id_presupuesto, 
			);
		}

		$id = $this->presupuestos_model->insert($arreglo);
			
		$this->presupuestos_model->insertCruceVisita($arreglo_cruce);
		
		foreach($detalle as $row){
			if($row->estado_linea!=3){
				$arreglo_linea	= array(
					'id_presupuesto'					=> $id,
					'id_producto'						=> $row->producto,
					'precio'							=> $row->precio,
					'cantidad'							=> $row->cantidad,
					'id_estado_producto_presupuesto'	=> $row->estado_linea,
				);
				$id_linea = $this->presupuestos_model->insertLinea($arreglo_linea);
			}
		}
		
		if($id){
			$db['detalle']			= $this->presupuestos_model->getDetallePresupuesto($id);
			$db['empresas']			= $this->empresas_model->getRegistro(1);
			$db['presupuesto']		= $id;
			$db['presupuestos']		= $this->presupuestos_model->getRegistro($id);
			$db['productos']		= $this->productos_model->getTodo();
			$db['tipo']				= 1;
			
			foreach($db['presupuestos'] as $row){
				$db['visita']			= $row->id_visita;
			}
			
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/carga_productos.php");
		}
	}
}