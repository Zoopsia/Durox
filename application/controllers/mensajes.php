<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensajes extends My_Controller {
	
	protected $_subject		= 'mensajes';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function verMensajes(){
		
		$db['alarmas']	= $this->alarmas_model->getTodo();
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function nuevoMensaje(){
		$todos 		= 0;
		$para 		= $this->input->post('para');
			
		$mensaje	= array(
			'mensaje'			=> $this->input->post('mensaje'),
			'asunto'			=> $this->input->post('asunto'),
			'eliminado'			=> 0,
			'id_origen'			=> 2,
			'id_mensaje_padre'	=> 0
		);
		
		$id_mensaje 			= $this->mensajes_model->insert($mensaje);

		if($para){
			foreach($para as $row){
				if($row == 0){
					$todos = 1;
				}
			}
		}
		
		if($todos == 1){
			$vendedores 			= $this->vendedores_model->getTodo();
			foreach($vendedores as $vendedor){
				$this->mensajes_model->insertCruceMensaje($id_mensaje, $vendedor->id_vendedor);
			}
		}
		else {
			foreach($para as $row){
				$this->mensajes_model->insertCruceMensaje($id_mensaje, $row);
			}
		}
		
		redirect('Home','refresh');
	}
}