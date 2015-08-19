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
	
	public function carga($id_visita=null, $tipo=1)
	{
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		$db['iva']			= $this->clientes_model->getTodo('iva');
		$db['estados']		= $this->presupuestos_model->getTodo('estados_presupuestos');
		$db['epocas']		= $this->visitas_model->getEpocas();
		$db['tipo']			= $tipo;
		$db['visitas']		= $this->visitas_model->getRegistro($id_visita);
		
		if($id_visita)
		{
			$db['visita']		= $id_visita;
			$db['presupuesto']	= $this->presupuestos_model->getPresupuesto($id_visita);
			$db['pedido']		= $this->pedidos_model->getPedido($id_visita);
		}
		
		if($id_visita)
		{
			$this->cargar_vista($db, 'pestanas');
		}
		else
		{
			$this->cargar_vista($db, 'carga');		
		}			
	}
	
	public function editar($id_visita)
	{
		$db['clientes']		= $this->clientes_model->getTodo();
		$db['vendedores']	= $this->vendedores_model->getTodo();
		$db['epocas']		= $this->visitas_model->getEpocas();
	
		if($id_visita)
		{
			$db['visita']		= $this->visitas_model->getRegistro($id_visita);
			$db['presupuesto']	= $this->presupuestos_model->getPresupuesto($id_visita);
			$db['pedido']		= $this->pedidos_model->getPedido($id_visita);
		}

		if($id_visita)
		{
			$this->cargar_vista($db, 'editar');
		}			
	}

	public function visitas_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('visitas.eliminado', 0);
			
			$crud->set_table('visitas');
			
			$crud->columns('id_visita',
							'id_cliente',
							'id_vendedor',
							'fecha');
			
			$crud->display_as('id_visita','N° Visita')
				 ->display_as('id_cliente','Cliente')
				 ->display_as('id_vendedor','Vendedor')
				 ->display_as('date_upd','Fecha Visita');
			
			$crud->set_subject('Visitas');
			
			$crud->fields(	'id_visita',
							'id_cliente',
							'id_vendedor');
			
			
							
			$crud->order_by('id_visita','desc');
							
			$crud->set_relation('id_cliente','clientes','{razon_social}');
			$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
	
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
		if($this->visitas_model->permitirEliminarPresupuesto($primary_key)){
			if($this->visitas_model->permitirEliminarPedido($primary_key)){
				$arreglo = array(
					'eliminado'		=> 1
				);
				
				$id 				= $this->visitas_model->update($arreglo,$primary_key);
			}
			else 
				echo "<script>alert('El registro no pude ser eliminado...');</script>";
		}
		else
			echo "<script>alert('El registro no pude ser eliminado...');</script>";
		
		return redirect($this->_subject.'/carga/'.$primary_key.'/0','refresh');	
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
			
			if($query)
			{	
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

	public function nuevaVisita()
	{
		$array_date = explode('/', $this->input->post('date_add'));
		$date = $array_date[2].'/'.$array_date[1].'/'.$array_date[0];
		
		$visita	= array(
		
			'id_cliente' 		=> $this->input->post('id_cliente'), 
			'id_vendedor' 		=> $this->input->post('id_vendedor'), 
			'id_epoca_visita'	=> $this->input->post('id_epoca_visita'),
			'fecha'				=> $date,
			'valoracion'		=> $this->input->post('star1'),
			'descripcion'		=> $this->input->post('comentarios'),
			'visto'				=> 0,
			'id_origen'			=> 2		
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
			'descripcion'		=> $this->input->post('comentarios'),
			'visto'				=> $this->input->post('visto')	
		);

		$id = $this->visitas_model->update($visita,$id_visita);
		
		redirect('Visitas/carga/'.$id_visita,'refresh');
		
	}
	
	public function buscar()
	{
		
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
			
		$crud->set_language("spanish");
			
		$crud->set_table('visitas');
			
		$crud->columns('id_visita',
						'id_cliente',
						'id_vendedor',
						'fecha');
			
		$crud->display_as('id_visita','N° Visita')
			 ->display_as('id_cliente','Cliente')
			 ->display_as('id_vendedor','Vendedor')
			 ->display_as('fecha','Fecha Visita');
		
		$crud->set_subject('Visitas');
		
		$crud->fields(	'id_visita',
						'id_cliente',
						'id_vendedor');
							
		$crud->order_by('fecha','desc');
						
		$crud->set_relation('id_cliente','clientes','{razon_social}');
		$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			
		$crud->add_action('Elegir', '', '','edit_button',array($this,'volverBusqueda'));
			
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_read();
		$crud->unset_operations();
			
		$output = $crud->render();
		
		$this->crud_tabla($output, 'buscar');
	}
	
	function volverBusqueda($primary_key , $row)
	{
	    return site_url('Presupuestos/carga').'/'.$row->id_visita;
	}
	
	public function vistaPresupuesto(){
		$id_presupuesto		= $this->input->post('id_presupuesto');
		
		$presupuesto	= $this->presupuestos_model->getRegistro($id_presupuesto);
		$detalle		= $this->presupuestos_model->getDetallePresupuesto($id_presupuesto);
		
		if($presupuesto)
		{
			foreach($presupuesto as $row)
			{
				$total = $row->total;
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
							<th class="th1">'.$this->lang->line("total").'</th>
							<th class="th1">$ '.$total.'</th>
							<th class="th1"></th>
						</tr>
					</tfoot>';
		
		$mensaje .= '<tbody>';
		
		if($detalle)
		{
			foreach($detalle as $row)
			{
				$mensaje .= '<tr>
								<th>'.$row->nombre.'</th>
								<th>'.$row->cantidad.'</th>
								<th>$ '.$row->precio.'</th>
								<th>$ '.$row->subtotal.'</th>
								<th>'.$row->estado.'</th>
							</tr>';
			}
		}
		
		$mensaje .= '</tbody>';
		$mensaje .= '</table>';			
		echo $mensaje;
	}

	public function getClientes(){
		
		$id_vendedor	= $this->input->post('id_vendedor');
		
		$cruce			= $this->vendedores_model->sinCruce($id_vendedor);
		
		$mensaje = '';
		if($cruce)
		{
			foreach ($cruce as $row) 
			{
				if($row->eliminado!=1)
				{
					$cliente 		= $this->clientes_model->getRegistro($row->id_cliente);	
					if($cliente)
					{
						foreach ($cliente as $key) 
						{
							if($key->eliminado != 1)
							{
								$mensaje  .= '<option value="'.$key->id_cliente.'">'.$key->razon_social;
								$mensaje  .= '</option>';
							}
						}
					}
				}
			}		
		}
			
		echo $mensaje;
	}
	
	function editarVisto(){
		$mensaje 	= $this->visitas_model->mensajesNuevos();
	
		if($mensaje){
			foreach($mensaje as $row) {
				$id = $row->id_visita; 	
				if($row->id_visita = $this->input->post('id_visita'.$id)){
					$arreglo = array(
						'visto'		=> $this->input->post('estado'.$id)
					);
					$id = $this->visitas_model->update($arreglo, $id);
				}
			}	
		}
		
		redirect($this->input->post('url'),'refresh');
	}
}