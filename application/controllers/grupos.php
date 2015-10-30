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
		$this->load->model('reglas_model');
		$this->load->model($this->_subject.'_model');
	}

	public function adminClientes($id_grupo=null,$tabla=null,$save=null)
	{
		$db['grupos']		=$this->grupos_model->getTodo();
		
		if($id_grupo!=null)
		{
			$db['id_grupo'] =$id_grupo;
			$db['tabla'] 	=$tabla;
		}
		
		$db['save']			= $save;
		
		$this->cargar_vista($db, 'administracion');
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
			
			$table =	'<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>'.$this->lang->line('grupo').'</th>
									<th>'.$this->lang->line('regla').'</th>
									<th>'.$this->lang->line('tipo').'</th>
									<th>'.$this->lang->line('valor').'</th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('grupo').'</th>
									<th>'.$this->lang->line('regla').'</th>
									<th>'.$this->lang->line('tipo').'</th>
									<th>'.$this->lang->line('valor').'</th>
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
					
					$table .= "</td><td>";
					$table .= $key->valor.' %';
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
									<th>'.$this->lang->line('razon_social').'</th>
									<th>'.$this->lang->line('cuit').'</th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('razon_social').'</th>
									<th>'.$this->lang->line('cuit').'</th>
								</tr>
							</tfoot>
							<tbody>';
			if($clientes){
				foreach ($clientes as $key) {
					$table .= "<tr><td>";
					$table .= $key->razon_social;
					$table .= "</td><td>";
					$table .= cuit($key->cuit);
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
		
		/*-----MENSAJE DE REGISTRO NO INSERTADO----*/
		$mensaje  = '<div class="alert alert-danger alert-dismissible slideDown" id="registro" role="alert">';
		$mensaje .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';	
		$mensaje .= " ".$this->lang->line('insert_ok');
		$mensaje .= "</div>";	
		
			
		if($this->input->post('grupo_nombre')){
			if($this->input->post('regla')){
				if($this->input->post('valor')){
						
					$grupo	= array(
					'grupo_nombre' 		=> $this->input->post('grupo_nombre')			
					);
				
					$id_grupo = $this->grupos_model->insert($grupo);
					
					$regla  = array(
						'id_grupo_cliente'	=> $id_grupo,
			 			'nombre'			=> $this->input->post('regla'),
			 			'valor'				=> $this->input->post('valor'),
			 			'aumento_descuento'	=> $this->input->post('tipo')
					);
					
					$save = $this->input->post('btn-save');
					
					$id_regla = $this->reglas_model->insert($regla);
					
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
						$mensaje .=	" ".$this->lang->line('insert_ok');
						$mensaje .= "</div>";
						echo $mensaje;
						
					}
					else if($save==2){
						$mensaje = get_mensaje($arreglo_mensaje);
						$this->adminClientes($id_grupo);
					}
			}
			else				
				echo $mensaje;	
		}
		else		
			echo $mensaje;
			
	}
	else 			
		echo $mensaje;
}
	
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para agregar Grupos de clientes
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	

	
	public function cargaEditar($id_grupo){
	
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['grupos']		= $this->grupos_model->getTodo();

		$db['id_grupo'] 	= $id_grupo;
			
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
									<th>'.$this->lang->line('razon_social').'</th>
									<th>'.$this->lang->line('cuit').'</th>
									<th></th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('razon_social').'</th>
									<th>'.$this->lang->line('cuit').'</th>
									<th></th>
								</tr>
							</tfoot>
							<tbody>';
			
			if($clientes){
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
							$table .= $row->razon_social;
							$table .= "</td><td>";
							$table .= cuit($row->cuit);
							$table .= '</td><td style="text-align: center">';
							$table .= '<button type="button" class="btn-sm btn-success btn-plus" onclick="cargarCliente('.$row->id_cliente.')">';
							$table .= '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
							$table .= '</button>';
							$table .= "</td></tr>";
					}	
				}
			}
			
			$table .=	'</tbody>
						</table>';
			echo $table;		
	}
	
	public function grupoCliente(){
	
		$id_grupo_cliente	= $this->input->post('id_grupo_cliente');
		
		$grupos_clientes	= $this->grupos_model->getClientesGrupos($id_grupo_cliente);
		
		//-----LLENO TABLA CON CLIENTES DEL GRUPO------//

		$table =	'<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>'.$this->lang->line('razon_social').'</th>
									<th>'.$this->lang->line('cuit').'</th>
									<th></th>
								</tr>
							</thead>
										 
							<tfoot>
								<tr>
									<th>'.$this->lang->line('razon_social').'</th>
									<th>'.$this->lang->line('cuit').'</th>
									<th></th>
								</tr>
							</tfoot>
							<tbody>';
			
			if($grupos_clientes){
				foreach ($grupos_clientes as $row) {
					$table .= "<tr><td>";
					$table .= $row->razon_social;
					$table .= "</td><td>";
					$table .= cuit($row->cuit);
					$table .= '</td><td style="text-align: center">';
					$table .= '<button type="button" class="btn-sm btn-danger btn-minus" onclick="sacarCliente('.$row->id_cliente.')">';
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
				'id_grupo_cliente' 		=> $this->input->post('id_grupo_cliente'),
				'eliminado'				=> 0		
		);
			
		$id = $this->clientes_model->update($cliente, $id_cliente);	

	}

	public function sacarCliente(){
	
		$id_cliente	=	$this->input->post('id_cliente');
		
		$cliente	= array(		
				'id_grupo_cliente' 		=> 1,
				'eliminado'				=> 0		
		);
			
		$id = $this->clientes_model->update($cliente, $id_cliente);	
	}
	
	public function getRegla(){
		$id_grupo_cliente	=	$this->input->post('id_grupo_cliente');
		
		if($id_grupo_cliente){
			if($id_grupo_cliente!=1){
				$reglas				= 	$this->reglas_model->getRegistro($id_grupo_cliente);
				foreach($reglas as $row)
				{
					$mensaje	= '<input type="text" id="regla" name="regla" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="'.$this->lang->line('nombre').'" required value="'.$row->nombre.'">';
				}
				echo $mensaje;
			}
		}
	}
	
	public function getValorRegla(){
		$id_grupo_cliente	=	$this->input->post('id_grupo_cliente');
		
		if($id_grupo_cliente){
			if($id_grupo_cliente!=1){
				$reglas				= 	$this->reglas_model->getRegistro($id_grupo_cliente);
				foreach($reglas as $row)
				{
					$mensaje	= '<input type="text" id="valor" name="valor" class="numeric form-control" pattern="[0-9]*" placeholder="%" required value="'.$row->valor.'">';
				}
				echo $mensaje;
			}
		}
	}
	
	public function getTipoRegla(){
		$id_grupo_cliente	=	$this->input->post('id_grupo_cliente');
		
		if($id_grupo_cliente){
			if($id_grupo_cliente!=1){
				$reglas				= 	$this->reglas_model->getRegistro($id_grupo_cliente);
				
				
				$mensaje = '<select name="tipo" id="tipo" class="form-control chosen-select">';
				foreach($reglas as $row)
				{
					if($row->aumento_descuento==1)
					{	
						$mensaje	.= '<option value="0">'.$this->lang->line('aumento').'</option>';					
						$mensaje	.= '<option value="1" selected>'.$this->lang->line('descuento').'</option>';
					}
					else
					{
						$mensaje	.= '<option value="0" selected>'.$this->lang->line('aumento').'</option>';					
						$mensaje	.= '<option value="1">'.$this->lang->line('descuento').'</option>';
					}
				}
				$mensaje .= '</select>';
				echo $mensaje;
			}
		}
	}
	
	public function editarGrupo(){
		
		$id_grupo_cliente	=	$this->input->post('id_grupo_cliente');
		
		if($id_grupo_cliente){
			if($id_grupo_cliente!=1){
				$grupo_cliente		=	$this->grupos_model->getRegistro($id_grupo_cliente);
				
				foreach ($grupo_cliente as $row){
					$mensaje  = '<div class="input-group-addon"><span class="fa fa-users" aria-hidden="true"></span></div>';
					$mensaje .= '<input type="text" name="grupo_nombre" class="form-control" pattern="^[A-Za-z0-9 ]+$" value="'.$row->grupo_nombre.'" placeholder="'.$this->lang->line('nombre').'" required>';
					$mensaje .= '<input type="hidden" name="id_grupo" class="form-control" value="'.$row->id_grupo_cliente.'" required>';
				}
				
				echo $mensaje;
			}	
		}

		$grupo	= array(		
				'grupo_nombre' 		=> $this->input->post('grupo_nombre'),
				'eliminado'			=> 0		
		);
		
		$save = $this->input->post('btn-save');
			
		if($save){
						
			$arreglo_mensaje = array(			
				'save' 			=> $save,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $this->input->post('id_grupo')	
			);	
					
						
			if($save==2){
				$id = $this->grupos_model->update($grupo, $this->input->post('id_grupo'));	
				$mensaje2 = get_mensaje($arreglo_mensaje);
				$this->adminClientes($this->input->post('id_grupo'));
			}
		}		
	}

}