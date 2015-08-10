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
		
		$this->load->model($this->_subject.'_model');	
	}
	

	public function pestanas($id)
	{
		$pedido					= $this->pedidos_model->getRegistro($id);
		$db['pedido']			= $pedido;
		
		foreach($pedido as $row) {
			$db['clientes']		= $this->clientes_model->getRegistro($row->id_cliente);
			$db['vendedores']	= $this->vendedores_model->getRegistro($row->id_vendedor);
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
							'date_add');
			
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
							
			$crud->set_relation('id_cliente','clientes','{apellido} {nombre}');
			$crud->set_relation('id_vendedor','vendedores','{apellido} {nombre}');
			$crud->set_relation('id_estado_pedido','estados_pedidos','estado');
			
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			$crud->callback_delete(array($this,'delete_user'));
			
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_edit();
			
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
					'fecha'					=> date('Y-m-d')	
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


}