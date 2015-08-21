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
		
		$db['tipos']			= $this->mails_model->getTipos();	
		$db['id']				= $id;
		$db['tipo']				= $tipo;
		
		$db['save']				= $save;
		$db['id_mail']			= $id_mail;
		
		$this->cargar_vista($db, 'mails');
	}
/*--------------------------------------------------------------------------------	
 --------------------------------------------------------------------------------
 			Función para cargar pantalla editar
 --------------------------------------------------------------------------------
 --------------------------------------------------------------------------------*/
	
	public function cargaEditar($id,$id_usuario,$tipo){
		$db['mails']		= $this->mails_model->getRegistro($id);
		$db['tipos']		= $this->mails_model->getTipos();
	
		$db['id'] 			= $id;
		$db['id_usuario']	= $id_usuario;
		$db['tipo']			= $tipo;
	
		$this->cargar_vista($db, 'editar');			
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
	
	public function eliminarCorreo(){

		$mail	= array(	
			'eliminado' 			=> 1,	
		);
			
		$id_mail    	= $this->mails_model->update($mail, $this->input->post('correo'));	
		
		$tipo			= $this->input->post('tipo');
		
		if($tipo == 1){
			$mails 			= $this->clientes_model->getCruce($this->input->post('usuario'),'mails');
			$usuario	 	= $this->clientes_model->getRegistro($this->input->post('usuario'));
		}
		else if($tipo == 2){
			$mails 			= $this->vendedores_model->getCruce($this->input->post('usuario'),'mails');
			$usuario	 	= $this->vendedores_model->getRegistro($this->input->post('usuario'));
		}
		$mensaje = '<table class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>'.$this->lang->line('correo').'</th>
				<th>'.$this->lang->line('tipo').'</th>
				<th>'.$this->lang->line('acciones').'</th>
			</tr>
		</thead>
												 
		<tfoot>
			<tr>
				<th>'.$this->lang->line('correo').'</th>
				<th>'.$this->lang->line('tipo').'</th>
				<th>'.$this->lang->line('acciones').'</th>
			</tr>
		</tfoot>
												 
		<tbody>';
												        	
		if ($mails) {
			foreach ($mails as $row) {
				foreach ($usuario as $key) {
					$mensaje .= '<tr>';
					$mensaje .= '<td>' . $row -> mail . '</td>';
					$mensaje .= '<td>' . $row -> tipo . '</td>';
					if($tipo == 1){
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<td style="text-align: center;">';
						$mensaje .= '<a href="'.base_url().'index.php/mails/cargaEditar/'.$row->id_mail.'/'.$key->id_cliente.'/1"';
						$mensaje .= 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'" style="margin : 0 5px">';
						$mensaje .= '<i class="fa fa-edit"></i>';
						$mensaje .= '</a>';
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<a href="#" onclick="eliminarCorreo('.$row->id_mail.','.$key->id_cliente.',1)"';
						$mensaje .= 'class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('eliminar').'">';
						$mensaje .= '<i class="fa fa-minus"></i>';
						$mensaje .= '</a>';
						$mensaje .= '</td>';
						$mensaje .= "</tr>";
					}
					else if($tipo == 2){
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<td style="text-align: center;">';
						$mensaje .= '<a href="'.base_url().'index.php/mails/cargaEditar/'.$row->id_mail.'/'.$key->id_vendedor.'/2"';
						$mensaje .= 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'" style="margin : 0 5px">';
						$mensaje .= '<i class="fa fa-edit"></i>';
						$mensaje .= '</a>';
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<a href="#" onclick="eliminarCorreo('.$row->id_mail.','.$key->id_vendedor.',2)"';
						$mensaje .= 'class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('eliminar').'">';
						$mensaje .= '<i class="fa fa-minus"></i>';
						$mensaje .= '</a>';
						$mensaje .= '</td>';
						$mensaje .= "</tr>";	
					}
				}
			}
		}
		
		$mensaje .=	'</tbody>
		</table>';
		
		echo $mensaje;
	}
		
	public function editarMailsClientes(){
		
		$db['config_mail']	= $this->mails_model->getConfigMails();
		
		$this->cargar_vista($db, 'mail_clientes');
	}
	
	public function modificarMail(){
		$arreglo = array(
			'cuerpo'		=> $this->input->post('cuerpo'),
			'asunto'		=> $this->input->post('titulo')
		);
		
		$this->mails_model->updateMail($arreglo, 1);
		
		$db['config_mail']	= $this->mails_model->getConfigMails();
		
		$this->cargar_vista($db, 'mail_clientes');
		
	}
}