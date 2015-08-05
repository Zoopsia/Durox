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
		$this->load->model('grupos_model');
		
	}
	

	public function pestanas($id)
	{
		$db['clientes']		= $this->clientes_model->getCliente($id);
		$db['vendedores']	= $this->clientes_model->getCruce($id,'vendedores');	
		$db['telefonos']	= $this->clientes_model->getCruce($id,'telefonos');
		$db['direcciones']	= $this->clientes_model->getCruce($id,'direcciones');
		$db['mails']		= $this->clientes_model->getCruce($id,'mails');
		$db['pedidos']		= $this->clientes_model->getPedidos($id);
		$db['presupuestos']	= $this->clientes_model->getPresupuestos($id);
		$db['iva']			= $this->clientes_model->getTodo('iva');
		$db['grupos']		= $this->grupos_model->getTodo();
		$db['id']			= $id;
		
		
		$this->cargar_vista($db, 'pestanas');				
	}
	

	public function clientes_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('clientes.eliminado', 0);
			
			$crud->set_table('clientes');
			
			$crud->columns(	'nombre',
							'apellido');
			
			$crud->display_as('nombre','Nombre')
				 ->display_as('apellido','Apellido')
				 ->display_as('razon_social','Razon Social')
				 ->display_as('id_grupo_cliente','Grupo')
				 ->display_as('id_iva','Situacion IVA');
				 
			$crud->required_fields('nombre',
							'apellido',
							'razon_social',
							'cuit',
							'id_grupo_cliente',
							'id_iva');	 
			
			$crud->set_subject('Cliente');
			
			$crud->fields(	'nombre',
							'apellido',
							'razon_social',
							'cuit',
							'id_grupo_cliente',
							'id_iva');
							
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			$crud->callback_delete(array($this,'delete_user'));
			$crud->callback_after_insert(array($this, 'insert_date'));
			
			$crud->set_relation('id_iva','iva','iva');
			
			$crud->set_relation('id_grupo_cliente','grupos_clientes','grupo_nombre');
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_edit();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);
	}
	
	function insert_date($post_array, $primary_key)
	{
		$arreglo	= array(
			'date_add'		=> date('Y-m-d H:i:s')
		);
		
		$id			= $this->clientes_model->update($arreglo,$primary_key);
		
		return true;
	}
	
	public function delete_user($primary_key)
	{
		if($this->clientes_model->permitirEliminar($primary_key)){
			$arreglo = array(
				'eliminado'		=> 1
			);
			
			$id 				= $this->clientes_model->update($arreglo,$primary_key);
		
		}
		return redirect($this->_subject.'/pestanas/'.$primary_key,'refresh');
	}
	
	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_cliente;
	}
	
	function editarCliente($id_cliente)
	{
		$registro	= $this->clientes_model->getRegistro($id_cliente);
		
		$destino 	= 'img/clientes/';
		
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
			
			$cliente	= array(
					'nombre'			=> $this->input->post('nombre'),
					'apellido'			=> $this->input->post('apellido'),
					'razon_social'		=> $this->input->post('razon_social'),
					'cuit'				=> $this->input->post('cuit'),		
					'nombre_fantasia'	=> $this->input->post('alias'),
					'web'				=> $this->input->post('web'),
					'id_grupo_cliente'	=> $this->input->post('id_grupo_cliente'),
					'id_iva'			=> $this->input->post('id_iva'),
					'imagen'			=> $imagen
			);
			
		}
		else{
			
			$cliente	= array(
					'nombre'			=> $this->input->post('nombre'),
					'apellido'			=> $this->input->post('apellido'),
					'razon_social'		=> $this->input->post('razon_social'),
					'cuit'				=> $this->input->post('cuit'),		
					'nombre_fantasia'	=> $this->input->post('alias'),
					'web'				=> $this->input->post('web'),
					'id_grupo_cliente'	=> $this->input->post('id_grupo_cliente'),
					'id_iva'			=> $this->input->post('id_iva')
			);
		}
			
		$id = $this->clientes_model->update($cliente, $id_cliente);	
		
		redirect('clientes/pestanas/'.$id_cliente,'refresh');
		
	}

}