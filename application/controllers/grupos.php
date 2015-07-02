<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupos extends My_Controller {
	
	protected $_subject		= 'grupos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('vendedores_model');
		$this->load->model('clientes_model');
		$this->load->model($this->_subject.'_model');
	}

	public function adminClientes($id_grupo_cliente=null){
		
		$db['empresas']		=$this->empresas_model->getRegistro(1);
		$db['grupos']		=$this->grupos_model->getGrupos();
		
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
									<th>'.$this->lang->line('regla').'</th>
									<th>'.$this->lang->line('nombre').'</th>
									<th>'.$this->lang->line('tipo').'</th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('regla').'</th>
									<th>'.$this->lang->line('nombre').'</th>
									<th>'.$this->lang->line('tipo').'</th>
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


/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para Administrar clientes y grupos de clientes
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	
	
	public function getClientesGrupos($id=null){
		
		if($id==null){
			$id_grupo_cliente	= $this->input->post('id_grupo_cliente');	
			$clientes 			= $this->clientes_model->getClientesGrupos($id_grupo_cliente);
	
			//Armo tabla con el resultado
			
			$table =	'<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>'.$this->lang->line('nombre').'</th>
									<th>'.$this->lang->line('apellido').'</th>
									<th>'.$this->lang->line('cuit').'</th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('nombre').'</th>
									<th>'.$this->lang->line('apellido').'</th>
									<th>'.$this->lang->line('cuit').'</th>
								</tr>
							</tfoot>
										 
							<tbody>';
	
			foreach ($clientes as $key) {
				$table .= "<tr><td>";
				$table .= $key->nombre;
				$table .= "</td><td>";
				$table .= $key->apellido;
				$table .= "</td><td>";
				$table .= $key->cuit;
				$table .= "</td></tr>";
			}
			
			$table .=		'</tbody>
						</table>';
			
			echo $table;
		}
		else 
			$this->adminClientes($id);
	}

/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para agregar Grupos de clientes
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	

	public function agregarGrupo(){
		
		$db['empresas']		=$this->empresas_model->getRegistro(1);

		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");
		$this->load->view($this->_subject."/.php");
	}
		
}