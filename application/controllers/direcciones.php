<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direcciones extends My_Controller {
	
	protected $_subject		= 'direcciones';
	
	
	
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

	
	public function direcciones($id, $tipo){
		
		if($tipo == 1){

		$db['clientes']		= $this->clientes_model->getRegistro($id);
		$db['direcciones']	= $this->clientes_model->getCruce($id,'direcciones');
		}
		else if($tipo == 2){
		$db['vendedores']	= $this->vendedores_model->getRegistro($id);
		$db['direcciones']	= $this->vendedores_model->getCruce($id,'direcciones');
		}

		$db['empresas']		= $this->empresas_model->getRegistro(1);
		$db['tipos']		= $this->direcciones_model->getTipos();
		$db['paises']		= $this->direcciones_model->getPaises();
		$db['id']		= $id;
		$db['tipo']		= $tipo;
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		$this->load->view($this->_subject."/direcciones.php");
					
	}

	public function cargaEditar($id){
	
			$db['empresas']		= $this->empresas_model->getRegistro(1);
			$db['direcciones']	= $this->direcciones_model->getRegistro($id);
			$db['tipos']		= $this->direcciones_model->getTipos();
	
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/editar.php");
				
	}
	
	public function editarDireccion($id){
	
			if (null!==  $this->input->post('fax')) {	
				$fax	= 1;		
			}
			else {
				$fax = 0;
			}
	
			$direccion	= array(
			
				'cod_postal' 	=> $this->input->post('cod_postal'),  
				'direccion' 	=> $this->input->post('direccion'), 
				'id_tipo'		=> $this->input->post('id_tipo'),		
			);
			
			$this->direcciones_model->editarDirecciones($direccion, $id);	
	}
	
	public function nuevaDireccion($id,$tipo){
		
		if (null!==  $this->input->post('fax')) {	
			$fax	= 1;		
		}
		else {
			$fax = 0;
		}

		$direccion	= array(	
			'cod_postal' 	=> $this->input->post('cod_postal'), 
			'direccion' 	=> $this->input->post('direccion'), 
			'id_tipo'		=> $this->input->post('id_tipo'),
		);
		
		$id_usuario			= $id;
		
		$this->direcciones_model->insertarDireccion($direccion,$id_usuario,$tipo);

	}
		
}