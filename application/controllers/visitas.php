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
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id){
		
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['visitas']		= $this->visitas_model->getRegistro($id);

		
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/pestanas.php");
					
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
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_visita;
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
			
			$table .=		'</tbody>
						</table>';
			
			echo $table;
			}
	}
	
		
}