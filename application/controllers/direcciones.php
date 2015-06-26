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

	
	public function direcciones($id, $tipo, $save=null){
		
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
		$db['id']			= $id;
		$db['tipo']			= $tipo;
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		
		
		if($save!=null){
			$this->load->view($this->_subject."/success.php");
		}
		else{
			$this->load->view($this->_subject."/direcciones.php");
		}
					
	}

	public function cargaEditar($id){
	
			$db['empresas']		= $this->empresas_model->getRegistro(1);
			$db['direcciones']	= $this->direcciones_model->getRegistro($id);
			
			foreach ($db['direcciones'] as $row) {
				$db['provincias']	= $this->direcciones_model->getProvincias($row->id_pais);
			}

			foreach ($db['direcciones'] as $key) {
					$db['departamentos'] = $this->direcciones_model->getDepartamentos($key->id_provincia);
			}
			$db['tipos']		= $this->direcciones_model->getTipos();
			$db['paises']		= $this->direcciones_model->getPaises();
			
			$db['id'] 			= $id;
	
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/editar.php");
				
	}
	
	public function editarDireccion($id){
	
			$direccion	= array(
			
				'cod_postal' 			=> $this->input->post('cod_postal'),  
				'direccion' 			=> $this->input->post('direccion'), 
				'id_tipo'				=> $this->input->post('id_tipo'),
				'id_pais'				=> $this->input->post('id_pais'),
				'id_provincia'			=> $this->input->post('id_provincia'),
				'id_departamento'		=> $this->input->post('id_departamento')		
			);
			
			$this->direcciones_model->editarDirecciones($direccion, $id);	
	}
	
	public function nuevaDireccion($id,$tipo){
		
		$direccion	= array(	
			'cod_postal' 			=> $this->input->post('cod_postal'), 
			'direccion' 			=> $this->input->post('direccion'), 
			'id_tipo'				=> $this->input->post('id_tipo'),
			'id_pais'				=> $this->input->post('id_pais'),
			'id_provincia'			=> $this->input->post('id_provincia'),
			'id_departamento'		=> $this->input->post('id_departamento')
		);
		
		$id_usuario			= $id;
		
		//$id_direccion = $this->direcciones_model->insertarDireccion($direccion,$id_usuario,$tipo);
		
		$save = $this->input->post('btn-save');
		
		
		if($save == 1){
			
			$this->direcciones($id, $tipo, $save);
		}
		else if ($save == 2){
			
		
		}
	}
	
	public function prueba(){
		
		$id_pais = $this->input->post('id_pais');
		$id = $this->input->post('id');
		
		$provincias 	= $this->direcciones_model->getProvincias($id_pais);
		
		echo '<option value="" disabled selected style="display:none;">Seleccione una opcion...</option>';
		foreach ($provincias  as $row) {
			echo '<option value="'.$row->id_provincia.'">'.$row->nombre_provincia.'</option>';
		}
		
					
	}
	
	public function prueba2(){
		
		$id_provincia = $this->input->post('id_provincia');
		
		$departamentos 	= $this->direcciones_model->getDepartamentos($id_provincia);
		
		echo '<option value="" disabled selected style="display:none;">Seleccione una opcion...</option>';
		foreach ($departamentos  as $row) {
			echo '<option value="'.$row->id_departamento.'">'.$row->nombre_departamento.'</option>';
		}
					
	}
}