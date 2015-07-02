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

	public function adminClientes($id_grupo=null,$tabla=null,$save=null){
		
		$db['empresas']		=$this->empresas_model->getRegistro(1);
		$db['grupos']		=$this->grupos_model->getGrupos();
		
		if($id_grupo!=null){
			$db['id_grupo'] =$id_grupo;
			$db['tabla'] 	=$tabla;
		}
		
		$db['save']			=$save;
		
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
			$reglas	 			= $this->grupos_model->getReglasGrupos($id_grupo_cliente);
	
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
			if($reglas){
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
			$clientes 			= $this->grupos_model->getClientesGrupos($id_grupo_cliente);
	
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
			if($clientes){
				foreach ($clientes as $key) {
					$table .= "<tr><td>";
					$table .= $key->nombre;
					$table .= "</td><td>";
					$table .= $key->apellido;
					$table .= "</td><td>";
					$table .= $key->cuit;
					$table .= "</td></tr>";
				}
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

	public function nuevoGrupo(){
		
		$grupo	= array(
			'grupo_nombre' 		=> $this->input->post('grupo_nombre')			
		);

		$id_grupo = $this->grupos_model->insert($grupo);
		
		$save = $this->input->post('btn-save');
	
		$arreglo_mensaje = array(			
				'save' 			=> $save,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_grupo	
		);	
	
		if($save==1){
			$this->adminClientes($id_grupo,$this->_subject,$save);
		}
		else if($save==2){
			$mensaje = get_mensaje($arreglo_mensaje);
			$this->adminClientes($id_grupo);
		}
	}
	
	public function cargaEditar($id_grupo){
	
			$db['empresas']		=$this->empresas_model->getRegistro(1);
			$db['grupos']		=$this->grupos_model->getGrupos();

			$db['id_grupo'] 	=$id_grupo;
			
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/administracion.php");
				
	}
		
}