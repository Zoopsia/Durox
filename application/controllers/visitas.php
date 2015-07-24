<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitas extends My_Controller {
	
	protected $_subject		= 'visitas';
	
	
	
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
		$this->load->model('presupuestos_model');
		$this->load->model('pedidos_model');
		
		$this->load->model($this->_subject.'_model');
	}
	
	public function carga($id_visita=null, $tipo=1){
		
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		$db['razon_social']	= $this->clientes_model->getTodo('razon_social');
		$db['estados']		= $this->presupuestos_model->getTodo('estados_presupuestos');
		$db['epocas']		= $this->visitas_model->getEpocas();
		$db['tipo']			= $tipo;
		$db['visitas']		= $this->visitas_model->getRegistro($id_visita);
		
		if($id_visita){
			$db['visita']		= $id_visita;
			$db['presupuesto']	= $this->presupuestos_model->getPresupuesto($id_visita);
			$db['pedido']		= $this->pedidos_model->getPedido($id_visita);
		}
		

		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		if($id_visita){
			$this->load->view($this->_subject."/pestanas.php");
		}
		else{		
			$this->load->view($this->_subject."/carga.php");
		}			
	}
	
	public function editar($id_visita){
		
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		$db['epocas']		= $this->visitas_model->getEpocas();
	
		if($id_visita){
			$db['visita']		= $this->visitas_model->getRegistro($id_visita);
			$db['presupuesto']	= $this->presupuestos_model->getPresupuesto($id_visita);
			$db['pedido']		= $this->pedidos_model->getPedido($id_visita);
		}

		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		if($id_visita){
			$this->load->view($this->_subject."/editar.php");
		}			
	}

	public function visitas_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			//$crud->where('pedidos', 0);
			
			$crud->set_table('visitas');
			
			$crud->columns('id_visita',
							'id_cliente',
							'id_vendedor',
							'date_upd');
			
			$crud->display_as('id_visita','N° Visita')
				 ->display_as('id_cliente','Cliente')
				 ->display_as('id_vendedor','Vendedor')
				 ->display_as('date_upd','Fecha Visita');
			
			$crud->set_subject('Visitas');
			
			$crud->fields(	'id_visita',
							'id_cliente',
							'id_vendedor');
			
			
							
			$crud->order_by('date_upd','desc');
							
			$crud->set_relation('id_cliente','clientes','{apellido} {nombre}');
			$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			
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
		$tipo = 0;	
	    return site_url($this->_subject.'/carga').'/'.$row->id_visita.'/'.$tipo;
	}
	
	function busqueda(){
		
		if($this->input->post('id_visita') 		|| 
		$this->input->post('date_upd')			||
		$this->input->post('cliente_nombre')	||
		$this->input->post('cliente_apellido')	||
		$this->input->post('vendedor_nombre')	||
		$this->input->post('vendedor_apellido')){
		
			$array = array(
				'id_visita'				=> $this->input->post('id_visita'),
				'date_upd'				=> $this->input->post('date_upd'),
				'cliente_nombre'		=> $this->input->post('cliente_nombre'),
				'cliente_apellido'		=> $this->input->post('cliente_apellido'),
				'vendedor_nombre'		=> $this->input->post('vendedor_nombre'),
				'vendedor_apellido'		=> $this->input->post('vendedor_apellido')
			);
			
			$query = $this->visitas_model->busqueda($array);
			
			$table =	'<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>'.$this->lang->line('visita').'</th>
									<th>'.$this->lang->line('cliente').'</th>
									<th>'.$this->lang->line('vendedor').'</th>
									<th>'.$this->lang->line('fecha').' '.$this->lang->line('visita').'</th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('visita').'</th>
									<th>'.$this->lang->line('cliente').'</th>
									<th>'.$this->lang->line('vendedor').'</th>
									<th>'.$this->lang->line('fecha').' '.$this->lang->line('visita').'</th>
								</tr>
							</tfoot>
										 
							<tbody>';
			
			if($query){	
				foreach ($query as $fila)
				{
				    $table .= "<tr><td>";	
				    $table .= $fila->id_visita;
					$table .= "</td><td>";
					$table .= $fila->Cnombre.' '.$fila->Capellido;
					$table .= "</td><td>";
					$table .= $fila->Vnombre.' '.$fila->Vapellido;
					$table .= "</td><td>";
					$table .= $fila->fecha_visita;
					$table .= "</td></tr>";
				}	
			}

			$table .=		'</tbody>
						</table>';
			
			echo $table;
			}
	}

	public function nuevaVisita(){
		
		$visita	= array(
		
			'id_cliente' 		=> $this->input->post('id_cliente'), 
			'id_vendedor' 		=> $this->input->post('id_vendedor'), 
			'id_epoca_visita'	=> $this->input->post('id_epoca_visita'),
			'date_add'			=> $this->input->post('date_add'),
			'date_upd'			=> $this->input->post('date_add'),
			'valoracion'		=> $this->input->post('star1'),
			'descripcion'		=> $this->input->post('comentarios')		
		);

		$id_visita = $this->visitas_model->insert($visita);
		
		redirect('Visitas/carga/'.$id_visita,'refresh');
		
	}
	
	public function editarVisita($id_visita){
		
		$visita	= array(
		
			'id_cliente' 		=> $this->input->post('id_cliente'), 
			'id_vendedor' 		=> $this->input->post('id_vendedor'), 
			'id_epoca_visita'	=> $this->input->post('id_epoca_visita'),
			'date_upd'			=> $this->input->post('date_upd'),
			'valoracion'		=> $this->input->post('star1'),
			'descripcion'		=> $this->input->post('comentarios')		
		);

		$id = $this->visitas_model->update($visita,$id_visita);
		
		redirect('Visitas/carga/'.$id_visita,'refresh');
		
	}
	
	public function buscar(){
		
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
			
		$crud->set_language("spanish");
			
		$crud->set_table('visitas');
			
		$crud->columns('id_visita',
						'id_cliente',
						'id_vendedor',
						'date_upd');
			
		$crud->display_as('id_visita','N° Visita')
			 ->display_as('id_cliente','Cliente')
			 ->display_as('id_vendedor','Vendedor')
			 ->display_as('date_upd','Fecha Visita');
		
		$crud->set_subject('Visitas');
		
		$crud->fields(	'id_visita',
						'id_cliente',
						'id_vendedor');
							
		$crud->order_by('date_upd','desc');
						
		$crud->set_relation('id_cliente','clientes','{apellido} {nombre}');
		$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			
		$crud->add_action('Elegir', '', '','edit_button',array($this,'volverBusqueda'));
			
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_read();
		$crud->unset_operations();
			
		$output = $crud->render();
		
		$db['empresas']=$this->empresas_model->getRegistro(1);

		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php", $output);
		$this->load->view("nav_left.php");
		
		$this->load->view($this->_subject."/buscar.php");
	}
	
	function volverBusqueda($primary_key , $row)
	{
	    return site_url('Presupuestos/carga').'/'.$row->id_visita;
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
		$mensaje .= '</table>';			
		echo $mensaje;
	}
}