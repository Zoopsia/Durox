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
		$this->load->model('visitas_model');
			
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id){
		
		$db['empresas']=$this->empresas_model->getRegistro(1);
		$db['presupuestos']=$this->presupuestos_model->getDetallePresupuesto($id);

		
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
		
		$this->presupuestos_model->sacarProducto($id_linea);
		
		
		$this->armarTabla($presupuesto);
		
	} 
	
	public function armarTabla($presupuesto){
		
		$productos			= $this->productos_model->getTodo();
		$tabla				= $this->presupuestos_model->getTodo('linea_productos_presupuestos');
		
		
		$mensaje = '<table class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							
							<th class="th1">'.$this->lang->line("producto").'</th>
							<th class="th1">'.$this->lang->line("cantidad").'</th>
							<th class="th1">'.$this->lang->line("precio").'</th>
							<th class="th1">'.$this->lang->line("subtotal").'</th>
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
							<th><input type="text" id="cantidad" name="cantidad1" class="numeric form-control" autocomplete="off" pattern="[0-9]*" placeholder="'.$this->lang->line('cantidad').'" required></th>
							<th></th>
							<th></th>
							<th>
								<a role="button" class="btn btn-success btn-sm" onclick="cargaProducto('.$presupuesto.')" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('agregar').' '.$this->lang->line('producto').'">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</a>
							</th>
					</tr>';
		
		
		
		
		
		foreach ($tabla as $row) {
			if($row->id_presupuesto == $presupuesto){
				
				foreach ($productos as $key) {
					
					if($row->id_producto == $key->id_producto){

						$mensaje	.= '<tr>';					
						$mensaje	.= '<th>'.$key->nombre.'</th>';
						$mensaje	.= '<th>'.$row->cantidad.'</th>';
						$mensaje	.= '<th>'.'$'.$key->precio.'</th>';
						$mensaje	.= '<th>'.'$'.$row->precio.'</th>';
						$mensaje	.= '<th><a href="#" class="btn btn-danger btn-xs glyphicon glyphicon-minus" onclick="sacarProducto('.$row->id_linea_producto_presupuesto.','.$presupuesto.')" role="button"></th>';
						$mensaje	.= '</tr>';
					}
				}
			}
		}
		
		
		$mensaje .= '</tbody>';
		
		$total = 0;
		foreach ($tabla as $row) {
			if($row->id_presupuesto == $presupuesto){
				$total = $row->precio + $total;
			}
		}
		
		$mensaje .= '<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th class="th1">'.$this->lang->line("total").'</th>
							<th>'.'$'.$total.'</th>
							<th></th>
						</tr>
					</tfoot>';
		
		
		$mensaje .= '</table>';
					
		$mensaje .= '<input type="number" name="total" pattern="[0-9 ]*" placeholder="'.$total.'" value="'.$total.'" required hidden>';			
		echo $mensaje;
	}

	function totalPresupuesto($presupuesto){
			
		if($this->input->post('total')){
			$total		= $this->input->post('total');
			$arreglo	= array(
				'total'					=> $total,
				'id_estado_presupuesto'	=> 1, 	
			);
	
			$id_presupuesto 	= $this->presupuestos_model->update($arreglo,$presupuesto);
		}
	}
	
	public function buscarProducto() {
        $producto = $this->input->post('producto');
        $query = $this->presupuestos_model->buscarProducto($producto);

        foreach ($query->result() as $row){
        	echo '<li><a href="#" onclick="funcion1('.$row->id_producto.')">'.$row->nombre.'<input type="text" id="id_valor'.$row->id_producto.'" value="'.$row->nombre.'" hidden></a></li>';
        }
    }	
}