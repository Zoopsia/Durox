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
		
		$db['recibidos']	= $this->mensajes_model->mensajesNuevos();
		$db['enviados']		= $this->mensajes_model->mensajesEnviados();
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function nuevoMensaje(){
		$todos 		= 0;
		$para 		= $this->input->post('para');
			
		$mensaje	= array(
			'mensaje'			=> $this->input->post('mensaje'),
			'asunto'			=> $this->input->post('asunto'),
			'eliminado'			=> 0,
			'id_origen'			=> 2
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

	public function verDetalle(){
		$mail = $this->mensajes_model->mensajesNuevos($this->input->post('id'));
		
		$this->mensajes_model->updateMensaje($this->input->post('id'));
		
		if($mail){
			foreach($mail as $row){
		$mensaje = '<div class="col-md-12 col-sm-10">
							<h3>
								'.$row->asunto.'
							</h3>
					</div>';
			}
			
			$padre = $row->id_mensaje_padre;
		}

		if($mail){
			foreach($mail as $row){ 
		$date	= date_create($row->date_add);
		$mensaje .= '<div class="col-md-12 col-sm-10">
						<hr style="margin-top: 0px">
						<a href="#" class="name pull-right">
							'.$row->nombre.' '.$row->apellido.'
						</a>
						<br>
						<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> '.date_format($date, 'd/m/y H:m:s').'</small>
						<img src="'.$row->imagen.'" alt="user image" class="img-perfil-sm img-responsive img-mensajeria">
					</div>
					<div class="col-md-12 col-sm-10">
						<hr style="margin-top: 30px">
						<div>      
							<p class="message">
								'.$row->mensaje.'
							</p>
						</div>
					</div>';
			}
		}	
		
		$mensaje .= '<input type="text" name="id_mensaje_vendedor" value="'.$row->id_sin_mensaje_vendedor.'" style="display:none">';	
		
		
		echo $mensaje;
	}
	
	public function verDetalle2(){
		
		$mail = $this->mensajes_model->mensajesEnviados($this->input->post('id'));
		
		
		if($mail){
			foreach($mail as $row){
		$mensaje = '<div class="col-md-12 col-sm-10">
							<h3>
								'.$row->asunto.'
							</h3>
					</div>';
			}
			$imagen_usuario  = $row->Uimagen;
			$padre = $row->id_mensaje_padre;
			$resultado = $row->mensaje ;
			$date	= date_create($row->date_add);
		}
		
		if($padre != 0){
			$mensaje_padre = $this->mensajes_model->mensajesNuevos($padre);
				if($mensaje_padre){
				foreach($mensaje_padre as $row){
					$date	= date_create($row->date_add);
					$mensaje .= '<div class="col-md-12 col-sm-10">
									<hr style="margin-top: 0px">
									<a href="#" class="name pull-right">
										'.$row->nombre.' '.$row->apellido.'
									</a>
									<br>
									<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> '.date_format($date, 'd/m/y H:m:s').'</small>
									<img src="'.$row->imagen.'" alt="user image" class="img-perfil-sm img-responsive img-mensajeria">
								</div>
								<div class="col-md-12 col-sm-10">
									<hr style="margin-top: 30px">
									<div>      
										<p class="message">
											'.$row->mensaje.'
										</p>
									</div>
								</div>';
				}
			}
		}

		$mensaje .= '<div class="col-md-12 col-sm-10">
						<hr style="margin-top: 0px">
						<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> '.date_format($date, 'd/m/y H:m:s').'</small>
						<img src="'.$imagen_usuario.'" alt="user image" class="img-perfil-sm img-responsive img-mensajeria">
						<br>
						';		
		
		if($mail){
			foreach($mail as $row){ 
		$mensaje .= 	'<a href="#" class="name pull-right">
							'.$row->nombre.' '.$row->apellido.'
						</a><br>';
			}
		}	
		
		$mensaje .='</div>';
		$mensaje .=	'<div class="col-md-12 col-sm-10">
						<hr style="margin-top: 30px">
						<div>      
							<p class="message">
								'.$resultado.'
							</p>
						</div>
					</div>';
		
		
		echo $mensaje;
		
	}

	public function responderMensaje(){
		
		$mail = $this->mensajes_model->getMensaje($this->input->post('id_mensaje_vendedor'));
		
		if($mail){
			foreach($mail as $row){
				$arreglo = array(
					'mensaje'			=> $this->input->post('editor'),
					'asunto'			=> 'RE: '.$row->asunto,
					'eliminado'			=> 0,
					'id_origen'			=> 2
				);
				$vendedor = $row->id_emisor;
			}
		}

		$id_mensaje 			= $this->mensajes_model->insert($arreglo);
		
		$this->mensajes_model->insertCruceMensaje($id_mensaje, $vendedor, $this->input->post('id_mensaje_vendedor'));
		
		redirect($this->_subject.'/verMensajes','refresh');
	}
}