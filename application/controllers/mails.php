<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mails extends My_Controller {
	
	protected $_subject		= 'mails';
	
	
	
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

/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para mostrar en pantalla formulario de nuevo mail
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/
		
	public function mails($id, $tipo, $save=null, $id_mail=null){
		
		if($tipo == 1){
			$db['clientes']		= $this->clientes_model->getRegistro($id);
			$db['mails']		= $this->clientes_model->getCruce($id,'mails');
		}
		else if($tipo == 2){
			$db['vendedores']	= $this->vendedores_model->getRegistro($id);
			$db['mails']		= $this->vendedores_model->getCruce($id,'mails');
		}
		
		$db['empresas']			= $this->empresas_model->getRegistro(1);
		
		$db['tipos']			= $this->mails_model->getTipos();	
		$db['id']				= $id;
		$db['tipo']				= $tipo;
		
		$db['save']				= $save;
		$db['id_mail']			= $id_mail;
		
		
		$this->load->view("head.php", $db);
		$this->load->view("nav_top.php");
		$this->load->view("nav_left.php");	
		
		$this->load->view($this->_subject."/mails.php");
					
	}
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para cargar pantalla editar
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/
	
	public function cargaEditar($id,$id_usuario,$tipo){
	
			$db['empresas']		= $this->empresas_model->getRegistro(1);
			$db['mails']		= $this->mails_model->getRegistro($id);
			$db['tipos']		= $this->mails_model->getTipos();
	
			$db['id'] 			= $id;
			$db['id_usuario']	= $id_usuario;
			$db['tipo']			= $tipo;
	
			$this->load->view("head.php", $db);
			$this->load->view("nav_top.php");
			$this->load->view("nav_left.php");	
			$this->load->view($this->_subject."/editar.php");
				
	}
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para editar Mails. Cargo array, update y redirect
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/
		
	public function editarMails($id,$id_usuario,$tipo){
	
			$mail	= array(
				'mail' 			=> $this->input->post('mail'), 
				'id_tipo'		=> $this->input->post('id_tipo')
			);
			
			$id_mail = $this->mails_model->update($mail, $id);
			
			if($tipo==1){
				$url = 'clientes/pestanas/'.$id_usuario;
			}
			else if($tipo==2){
				$url = 'vendedores/pestanas/'.$id_usuario;
			}
			
			$arreglo_mensaje = array(			
				'save' 			=> 4,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_mail,
				'id_usuario'	=> $id_usuario,
				'tipo'			=> $tipo	
			);
			
			$mensaje = get_mensaje($arreglo_mensaje);						
			redirect($url,'refresh');	
	}
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para cargar nuevo Mail. Armo array, insert y redirect
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/
		
	public function nuevoMail($id,$tipo){
		
		$mail	= array(
				'mail' 			=> $this->input->post('mail'), 
				'id_tipo'		=> $this->input->post('id_tipo')
		);
		
		$id_usuario			= $id;
		
		$id_mail = $this->mails_model->insert($mail);
		$this->mails_model->insertCruce($tipo,$id_mail,$id_usuario);
		
		$save = $this->input->post('btn-save');
	
		$arreglo_mensaje = array(			
				'save' 			=> $save,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_mail,
				'id_usuario'	=> $id_usuario,
				'tipo'			=> $tipo	
		);
	
		if($save == 1){			
			$this->mails($id, $tipo, $save, $id_mail);
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