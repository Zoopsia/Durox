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
		
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['vendedores']	= $this->vendedores_model->getRegistro($id);
		$db['clientes']		= $this->vendedores_model->getCruce($id,'clientes');
		$db['telefonos']	= $this->vendedores_model->getCruce($id,'telefonos');
		$db['direcciones']	= $this->vendedores_model->getCruce($id,'direcciones');
		$db['mails']		= $this->vendedores_model->getCruce($id,'mails');
		$db['presupuestos']	= $this->vendedores_model->getPresupuestos($id);
		
		$db['cruce']		= $this->vendedores_model->sinCruce($id);
		$db['clientes_todo']= $this->clientes_model->getTodo();
		$db['aux']			= $aux;
		if($aux2){
			$db['aux2']		= $aux2;
		}
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/pestanas.php");					
	}
	

	public function vendedores_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('vendedores.eliminado', 0);
			
			$crud->set_table('vendedores');
			
			$crud->columns(	'nombre',
							'apellido');
			
			$crud->display_as('nombre','Nombre')
				 ->display_as('apellido','Apellido');
			
			$crud->set_subject('vendedor');
			
			$crud->fields(	'nombre',
							'apellido',
							'contraseña');
					
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
		return $this->vendedores_model->update($arreglo,$primary_key);
	}

	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_vendedor;
	}
	
	function editarVendedor($id_vendedor)
	{
		$registro	= $this->vendedores_model->getRegistro($id_vendedor);
		
		$destino 	= 'img/vendedores/';
		
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
					'contraseña' 		=> $this->input->post('contraseña'),
					'imagen'			=> $imagen
			);
			
		}
			
		$id = $this->vendedores_model->update($vendedor, $id_vendedor);	
		
		$this->pestanas($id_vendedor);
		
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
	
}