<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendedores extends My_Controller {
	
	protected $_subject		= 'vendedores';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
				
		);
		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('clientes_model');
		$this->load->model('productos_model');
		$this->load->model($this->_subject.'_model');
	}

		
	public function pestanas($id, $aux=0, $aux2=null){
		
		$db['vendedores']	= $this->vendedores_model->getRegistro($id);
		$db['clientes']		= $this->vendedores_model->getCruce($id,'clientes');
		$db['telefonos']	= $this->vendedores_model->getCruce($id,'telefonos');
		$db['direcciones']	= $this->vendedores_model->getCruce($id,'direcciones');
		$db['mails']		= $this->vendedores_model->getCruce($id,'mails');
		$db['pedidos']		= $this->vendedores_model->getPedidos($id);
		$db['presupuestos']	= $this->vendedores_model->getPresupuestos($id);
		$db['visitas']		= $this->vendedores_model->getVisitas($id);
		$db['alarmas']		= $this->vendedores_model->getAlarmas($id);
		$db['tipos_alarmas']= $this->vendedores_model->getTodo('tipos_alarmas');
		$db['datosDB']		= $this->vendedores_model->traerDatosDBExterna($id);
		$db['id']			= $id;
		
		$db['cruce']		= $this->vendedores_model->sinCruce($id);
		$db['clientes_todo']= $this->clientes_model->getTodo();
		$db['aux']			= $aux;
		if($aux2){
			$db['aux2']		= $aux2;
		}
		
		$this->cargar_vista($db, 'pestanas');			
	}
	

	public function vendedores_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('vendedores.eliminado', 0);
			
			$crud->set_table('vendedores');
			
			$crud->columns(	'id_vendedor',
							'nombre',
							'apellido');
			
			$crud->display_as('id_vendedor','ID')
				 ->display_as('nombre','Nombre')
				 ->display_as('pass','Contraseña')
				 ->display_as('apellido','Apellido');
				 
			$crud->required_fields('nombre',
							'apellido',
							'pass');
			
			$crud->set_subject('vendedor');
			
			$crud->fields(	'nombre',
							'apellido',
							'pass');
					
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			$crud->callback_delete(array($this,'delete_user'));
			$crud->callback_after_insert(array($this, 'insertDatos'));
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_edit();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}
	
	function insertDatos($post_array, $primary_key)
	{
		$session_data = $this->session->userdata('logged_in');
		
		$arreglo	= array(
			'date_add'		=> date('Y-m-d H:i:s'),
			'visto'			=> 0,
			'id_origen'		=> 2,
			'id_db'			=> 0,
			'user_add'		=> $session_data['id_usuario'],
			'user_upd'		=> $session_data['id_usuario'],
			'eliminado'		=> 0
		);
		
		$id			= $this->vendedores_model->update($arreglo,$primary_key);
		
		$log		= array(
			'accion'	=> 'INSERT',
			'tabla'		=> 'vendedores',
			'id_cambio'	=> $primary_key
		);
		
		$this->vendedores_model->logRegistros($log);
		
		return true;
	}
	
	public function delete_user($primary_key)
	{
		if($this->vendedores_model->permitirEliminarPresupuesto($primary_key)){
			if($this->vendedores_model->permitirEliminarPedido($primary_key)){
				$arreglo = array(
					'eliminado'		=> 1
				);
				
				$id 				= $this->vendedores_model->update($arreglo,$primary_key);
			}
			else
				echo "<script>alert('El registro no pude ser eliminado...');</script>";
		}
		else
			echo "<script>alert('El registro no pude ser eliminado...');</script>";
		
		return redirect($this->_subject.'/pestanas/'.$primary_key,'refresh');
	}

	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_vendedor;
	}
	
	function editarVendedor($id_vendedor)
	{
		$registro	= $this->vendedores_model->getRegistro($id_vendedor);
		
		$destino 	= 'img/vendedores/';
		
		if(devolverDir($destino)){
			if(isset($_FILES['imagen']['tmp_name']))
			{
				
				$origen 	= $_FILES['imagen']['tmp_name'];
				$url		= $destino.$_FILES['imagen']['name'];
				$imagen		= base_url().$url;
				if(!empty($_FILES['imagen']['tmp_name'])){
					copy($origen, $url);	
				}
				else {
					foreach ($registro as $key) {
						$imagen = $key->imagen;
					}
				}
				
				$vendedor	= array(
						'nombre'			=> $this->input->post('nombre'),
						'apellido'			=> $this->input->post('apellido'),		
						'pass' 				=> $this->input->post('contraseña'),
						'imagen'			=> $imagen,
						'eliminado'			=> 0
				);
				
			}
			else {
				$vendedor	= array(
						'nombre'			=> $this->input->post('nombre'),
						'apellido'			=> $this->input->post('apellido'),		
						'pass' 				=> $this->input->post('contraseña'),
						'eliminado'			=> 0
				);
			}
				
			$id = $this->vendedores_model->update($vendedor, $id_vendedor);	
		}
		redirect('vendedores/pestanas/'.$id_vendedor,'refresh');
		
	}
	
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para agregar Clientes a Vendedor
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	

 	public function cargarCliente($id_cliente,$id_vendedor){

		//----- 2 PORQUE ES TIPO VENDEDOR -----//
		$this->clientes_model->insertCruce(2,$id_cliente,$id_vendedor);
		$aux = 1;
		$aux2 = 3;
		
		redirect('/vendedores/pestanas/'.$id_vendedor.'/'.$aux.'/'.$aux2,'location');

	}

/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para Agregar Clientes a Vendedor
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	

 		public function volverCargarCliente($id_cliente,$id_vendedor){

		//----- 2 PORQUE ES TIPO VENDEDOR -----//
		
		$cruce		= $this->vendedores_model->sinCruce($id_vendedor);
		$aux  = 1;
		$aux2 = 2;
		
		foreach($cruce as $row){
			if($id_cliente == $row->id_cliente)
				$id_sin = $row->id_sin_vendedor_cliente;
		}

		$sin = array(
			'eliminado'		=> 0
		);
		
		$id_cliente	= $this->vendedores_model->updateSin($sin,$id_sin);
		redirect('/vendedores/pestanas/'.$id_vendedor.'/'.$aux.'/'.$aux2,'location');
	}	
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para Sacar Clientes a Vendedor
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/	

 		public function sacarCliente($id_cliente,$id_vendedor){

		//----- 2 PORQUE ES TIPO VENDEDOR -----//
		
		$cruce		= $this->vendedores_model->sinCruce($id_vendedor);
		$aux  = 1;
		$aux2 = 1;
		
		foreach($cruce as $row){
			if($id_cliente == $row->id_cliente)
				$id_sin = $row->id_sin_vendedor_cliente;
		}

		$sin = array(
			'eliminado'		=> 1
		);
		
		$id_cliente	= $this->vendedores_model->updateSin($sin,$id_sin);
		redirect('/vendedores/pestanas/'.$id_vendedor.'/'.$aux.'/'.$aux2,'location');
	}
		
	function editarVisto($id=null){
		if($id){
			$arreglo = array(
				'visto'			=> $this->input->post('visto'),
				'eliminado'		=> 0
			);
			$id = $this->vendedores_model->update($arreglo, $id);
		}
		else{
			$mensaje 	= $this->vendedores_model->mensajesNuevos();
		
			if($mensaje){
				foreach($mensaje as $row) {
					$id = $row->id_vendedor; 	
					if($row->id_vendedor = $this->input->post('id_vendedor'.$id)){
						$arreglo = array(
							'visto'			=> $this->input->post('estado'.$id),
							'eliminado'		=> 0
						);
						$id = $this->vendedores_model->update($arreglo, $id);
					}
				}	
			}
		}
		redirect($this->input->post('url'),'refresh');
	}
	
	public function getAlarmas(){
		$alarmas = $this->vendedores_model->getAlarmas($this->input->post('id'));
		if($alarmas){
			echo count($alarmas);
		}
		else {
			echo 0;
		}
	}
	
}