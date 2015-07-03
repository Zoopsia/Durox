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
		$db['grupos']		=$this->grupos_model->getTodo();
		
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
			$table .=	'</tbody>
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
			
		if($this->input->post('grupo_nombre')){
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
				$mensaje  = '<div class="alert alert-success alert-dismissible slideDown" id="registro" role="alert">';
		  		$mensaje .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';	
		  		$mensaje .= "El registro ";
				$mensaje .= '<a href="#">';
				$mensaje .= $id_grupo;
				$mensaje .= '</a>';
				$mensaje .=	" fué insertado con exito";
				$mensaje .= "</div>";
				echo $mensaje;
				
			}
			else if($save==2){
				$mensaje = get_mensaje($arreglo_mensaje);
				$this->adminClientes($id_grupo);
			}
		}
		else {
			$mensaje  = '<div class="alert alert-danger alert-dismissible slideDown" id="registro" role="alert">';
		  	$mensaje .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';	
		  	$mensaje .= "El registro no fué insertado";
			$mensaje .= "</div>";				
			echo $mensaje;
		}
	}
	
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para agregar Grupos de clientes
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	

	
	public function cargaEditar($id_grupo){
	
		$db['empresas']		=$this->empresas_model->getRegistro(1);
		$db['grupos']		=$this->grupos_model->getTodo();

		$db['id_grupo'] 	=$id_grupo;
			
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/administracion.php");
				
	}
	
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para agregar Clientes a Grupos
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	
	
	public function nuevoCliente(){
	
		$id_grupo_cliente	= $this->input->post('id_grupo_cliente');
		
		$grupos_clientes	= $this->grupos_model->getClientesGrupos($id_grupo_cliente);
		
		$clientes			= $this->clientes_model->getTodo();
		
		//-----LLENO TABLA CON CLIENTES FUERA DEL GRUPO------//

		$table =	'<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>'.$this->lang->line('nombre').'</th>
									<th>'.$this->lang->line('apellido').'</th>
									<th>'.$this->lang->line('cuit').'</th>
									<th></th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('nombre').'</th>
									<th>'.$this->lang->line('apellido').'</th>
									<th>'.$this->lang->line('cuit').'</th>
									<th></th>
								</tr>
							</tfoot>
							<tbody>';
			
			foreach ($clientes as $row) {
				$bandera = 0;
				if($grupos_clientes){
					foreach ($grupos_clientes as $key) {
						if($row->id_cliente == $key->id_cliente)
							$bandera = 1;
					}
				}
				if($bandera == 0){
						$table .= "<tr><td>";
						$table .= $row->nombre;
						$table .= "</td><td>";
						$table .= $row->apellido;
						$table .= "</td><td>";
						$table .= $row->cuit;
						$table .= '</td><td style="text-align: center">';
						$table .= '<button type="button" class="btn-sm btn-default btn-plus" onclick="cargarCliente('.$row->id_cliente.')">';
						$table .= '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
						$table .= '</button>';
						$table .= "</td></tr>";
				}	
			}
			
			$table .=	'</tbody>
						</table>';
			echo $table;		
	}
	
	public function grupoCliente(){
	
		$id_grupo_cliente	= $this->input->post('id_grupo_cliente');
		
		$grupos_clientes	= $this->grupos_model->getClientesGrupos($id_grupo_cliente);
		
		//-----LLENO TABLA CON CLIENTES FUERA DEL GRUPO------//

		$table =	'<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>'.$this->lang->line('nombre').'</th>
									<th>'.$this->lang->line('apellido').'</th>
									<th>'.$this->lang->line('cuit').'</th>
									<th></th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('nombre').'</th>
									<th>'.$this->lang->line('apellido').'</th>
									<th>'.$this->lang->line('cuit').'</th>
									<th></th>
								</tr>
							</tfoot>
							<tbody>';
			
			if($grupos_clientes){
				foreach ($grupos_clientes as $row) {
					$table .= "<tr><td>";
					$table .= $row->nombre;
					$table .= "</td><td>";
					$table .= $row->apellido;
					$table .= "</td><td>";
					$table .= $row->cuit;
					$table .= '</td><td style="text-align: center">';
					$table .= '<button type="button" class="btn-sm btn-default btn-minus" onclick="sacarCliente('.$row->id_cliente.')">';
					$table .= '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
					$table .= '</button>';
					$table .= "</td></tr>";
				}
			}
			$table .=	'</tbody>
						</table>';
						
			echo $table;		
	}

	public function cargarCliente(){
	
		$id_cliente	=	$this->input->post('id_cliente');
		
		$cliente	= array(		
				'id_grupo_cliente' 		=> $this->input->post('id_grupo_cliente')		
		);
			
		$id = $this->clientes_model->update($cliente, $id_cliente);	

	}
	public function sacarCliente(){
	
		$id_cliente	=	$this->input->post('id_cliente');
		
		$cliente	= array(		
				'id_grupo_cliente' 		=> 1		
		);
			
		$id = $this->clientes_model->update($cliente, $id_cliente);	
	}	
}