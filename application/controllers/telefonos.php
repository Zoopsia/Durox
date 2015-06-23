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

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('vendedores_model');
		$this->load->model('clientes_model');
		$this->load->model($this->_subject.'_model');
	}

	
	public function telefonos($id, $tipo){
		
		if($tipo == 1){
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['clientes']		= $this->clientes_model->getRegistro($id);
		$db['telefonos']	= $this->clientes_model->getCruce($id,'telefonos');
		$db['tipos']		= $this->telefonos_model->getTipos();	
		}
		else if($tipo == 2){
		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['vendedores']	= $this->vendedores_model->getRegistro($id);
		$db['telefonos']	= $this->vendedores_model->getCruce($id,'telefonos');
		$db['tipos']		= $this->telefonos_model->getTipos();
		}
		
		$db['id']		= $id;
		$db['tipo']		= $tipo;
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/telefonos.php");
					
	}

	public function cargaEditar($id){
	
			$db['empresas']		= $this->empresas_model->getRegistro(1);
			$db['telefonos']	= $this->telefonos_model->getRegistro($id);
			$db['tipos']		= $this->telefonos_model->getTipos();
	
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/editarTelefonos.php");
				
	}
	
	public function editarTelefonos($id){
	
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
			
			$this->telefonos_model->editarTelefonos($telefono, $id);	
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
		//$tabla				= ;
		
		$this->telefonos_model->insertarTelefono($telefono,$id_usuario,$tipo);
		
		
		/*
		echo $this->input->post('cod_area');
		echo $this->input->post('telefono');
		echo "<br>";
		echo $this->input->post('fax');*/
		
	}
		
}