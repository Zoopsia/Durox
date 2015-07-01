<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends My_Controller {
	
	protected $_subject		= 'clientes';
	
	
	
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
		
		$db['empresas']		=$this->empresas_model->getRegistro(1);
		$db['clientes']		=$this->clientes_model->getCliente($id);
		$db['vendedores']	=$this->clientes_model->getCruce($id,'vendedores');	
		$db['telefonos']	=$this->clientes_model->getCruce($id,'telefonos');
		$db['direcciones']	=$this->clientes_model->getCruce($id,'direcciones');
		$db['mails']		=$this->clientes_model->getCruce($id,'mails');
		$db['pedidos']		=$this->clientes_model->getPedidos($id);
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/pestanas.php");
			
					
	}
	

	public function clientes_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			//$crud->where('clientes', 0);
			
			$crud->set_table('clientes');
			
			$crud->columns(	'nombre',
							'apellido');
			
			$crud->display_as('nombre','Nombre')
				 ->display_as('apellido','Apellido')
				 ->display_as('id_grupo_cliente','Grupo')
				 ->display_as('id_razon_social','Razón Social');
			
			$crud->set_subject('Cliente');
			
			$crud->fields(	'nombre',
							'apellido',
							'cuit',
							'id_grupo_cliente',
							'id_razon_social');
							
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));

			$crud->set_relation('id_razon_social','razon_social','razon_social');
			
			$crud->set_relation('id_grupo_cliente','grupos_clientes','grupo_nombre');
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}


	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_cliente;
	}
	
	public function adminClientes($id_grupo_cliente=null){
		
		$db['empresas']		=$this->empresas_model->getRegistro(1);
		$db['grupos']		=$this->clientes_model->getGrupos();
		
		if($id_grupo_cliente!=null)
			$db['id_grupo'] =$id_grupo_cliente;

		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");
		$this->load->view($this->_subject."/administracion.php");
	}	
	
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para Administrar reglas y grupos de clientes
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	
	
	public function getReglasGrupos($id=null){
		
		if($id==null){
			$id_grupo_cliente	= $this->input->post('id_grupo_cliente');	
			$reglas	 			= $this->clientes_model->getReglasGrupos($id_grupo_cliente);
	
			//Armo tabla con el resultado
			
			$table =	'<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Regla N°</th>
									<th>Nombre</th>
									<th>Tipo</th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>Regla N°</th>
									<th>Nombre</th>
									<th>Tipo</th>
								</tr>
							</tfoot>
										 
							<tbody>';
	
			foreach ($reglas as $key) {
				$table .= "<tr><td>";
				$table .= $key->id_regla;
				$table .= "</td><td>";
				$table .= $key->nombre;
				$table .= "</td><td>";
				if($key->aumento_descuento==1)
					$table .= "Descuento";
				else
					$table .= "Aumento";
				$table .= "</td></tr>";
			}
			
			$table .=		'</tbody>
						</table>';
			
			echo $table;
		}
		else 
			$this->adminClientes($id);

	}
}