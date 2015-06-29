<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Telefonos extends My_Controller {
	
	protected $_subject		= 'telefonos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);
		

		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('view');

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('vendedores_model');
		$this->load->model('clientes_model');
		$this->load->model($this->_subject.'_model');
	}

	
	public function telefonos($id, $tipo, $save=null, $id_telefono=null){
		
		if($tipo == 1){
			$db['clientes']		= $this->clientes_model->getRegistro($id);
			$db['telefonos']	= $this->clientes_model->getCruce($id,'telefonos');
		}
		else if($tipo == 2){
			$db['vendedores']	= $this->vendedores_model->getRegistro($id);
			$db['telefonos']	= $this->vendedores_model->getCruce($id,'telefonos');
		}
		
		$db['empresas']			= $this->empresas_model->getRegistro(1);
		$db['tipos']			= $this->telefonos_model->getTipos();	
		$db['id']				= $id;
		$db['tipo']				= $tipo;
		
		$db['save']					= $save;
		$db['id_telefono']			= $id_telefono;
		
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		
		$this->load->view($this->_subject."/telefonos.php");
					
	}

	public function cargaEditar($id,$id_usuario,$tipo){
	
			$db['empresas']		= $this->empresas_model->getRegistro(1);
			$db['telefonos']	= $this->telefonos_model->getRegistro($id);
			$db['tipos']		= $this->telefonos_model->getTipos();
	
			$db['id'] 			= $id;
			$db['id_usuario']	= $id_usuario;
			$db['tipo']			= $tipo;
	
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/editar.php");
				
	}
	
	public function editarTelefonos($id,$id_usuario,$tipo){
	
			if (null!==  $this->input->post('fax')) {	
				$fax	= 1;		
			}
			else {
				$fax = 0;
			}
	
			$telefono	= array(
			
				'cod_area' 		=> $this->input->post('cod_area'), 
				'telefono' 		=> $this->input->post('telefono'), 
				'id_tipo'		=> $this->input->post('id_tipo'),
				'fax'			=> $fax,			
			);
			
			$id_telefono = $this->telefonos_model->update($telefono, $id);
			
			if($tipo==1){
				$url = 'clientes/pestanas/'.$id_usuario;
			}
			else if($tipo==2){
				$url = 'vendedores/pestanas/'.$id_usuario;
			}
			
			$arreglo_mensaje = array(			
				'save' 			=> 4,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_telefono,
				'id_usuario'	=> $id_usuario,
				'tipo'			=> $tipo	
			);
			
			$mensaje = get_mensaje($arreglo_mensaje);						
			redirect($url,'refresh');	
	}
	
	public function nuevoTelefono($id,$tipo){
		
		if (null!==  $this->input->post('fax')) {	
			$fax	= 1;		
		}
		else {
			$fax = 0;
		}

		$telefono	= array(
		
			'cod_area' 		=> $this->input->post('cod_area'), 
			'telefono' 		=> $this->input->post('telefono'), 
			'id_tipo'		=> $this->input->post('id_tipo'),
			'fax'			=> $fax,			
		);
		
		$id_usuario			= $id;
		
		$id_telefono = $this->telefonos_model->insert($telefono);
		$this->telefonos_model->insertCruce($tipo,$id_telefono,$id_usuario);
		
		$save = $this->input->post('btn-save');
	
		$arreglo_mensaje = array(			
				'save' 			=> $save,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_telefono,
				'id_usuario'	=> $id_usuario,
				'tipo'			=> $tipo	
		);
		
		if($save == 1){			
			$this->telefonos($id, $tipo, $save, $id_telefono);
		}
		else if ($save == 2){
			if($tipo==1){
				$url = 'clientes/pestanas/'.$id_usuario;
			}
			else if($tipo==2){
				$url = 'vendedores/pestanas/'.$id_usuario;
			}			
			$mensaje = get_mensaje($arreglo_mensaje);			
			redirect($url,'refresh');	
		}
	}
		
}