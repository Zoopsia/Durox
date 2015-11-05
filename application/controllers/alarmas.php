<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alarmas extends My_Controller {
	
	protected $_subject		= 'alarmas';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		
	}
	
	public function nuevaAlarma($id_alarma=null){
		
		$db['alarmas']	= $this->alarmas_model->getTodo('tipos_alarmas');
		
		if($id_alarma){
			$db['id_alarma']		= $id_alarma;
		}
		else
			$db['id_alarma']		= 0;
		$this->cargar_vista($db, 'tabla');
	}
	
	public function insertAlarma(){
		$session_data = $this->session->userdata('logged_in');
		
		$alarma	= array(
			'id_tipo_alarma'	=> $this->input->post('tipo'),
			'mensaje'			=> $this->input->post('mensaje'),
			'visto_back'		=> 0,
			'visto_front'		=> 0,
			'eliminado'			=> 0,
			'id_origen'			=> 2,
			'id_creador'		=> $session_data['id_usuario'],
		);
		
		$id_alarma 			= $this->alarmas_model->insert($alarma);
		
		$this->alarmas_model->insertCruce($this->input->post('cruce'),$id_alarma,$this->input->post('id'));
		
		$tipo_alarma 		= $this->alarmas_model->getTipoAlarma($this->input->post('tipo'));
		
		if($tipo_alarma || $this->input->post('mensaje')){
			foreach($tipo_alarma as $row){
				$arreglo	= array(
					'id_tipo'	=> $row->id_tipo_alarma,
					'tipo'		=> $row->tipo_alarma,
					'mensaje'	=> $this->input->post('mensaje'),
					'nombre'	=> $row->nombre,
					'color'		=> $row->color
				);
			}
		}
		echo armarAlarma($arreglo);
	}
	
	public function guardarTipoAlarma(){
		
		$alarma = array(
		'nombre'		=> $this->input->post('nombre'),
		'tipo_alarma'	=> $this->input->post('icono'),
		'color'			=> $this->input->post('color')
		);
		
		$id_alarma = $this->alarmas_model->insertTipo($alarma);
		
		if($id_alarma){
			redirect('Alarmas/nuevaAlarma/'.$id_alarma,'refresh');
		}
	}
	
	public function tipoAlarma(){
		$tipo_alarma 		= $this->alarmas_model->getTipoAlarma($this->input->post('tipo'));
		if($tipo_alarma){
			foreach($tipo_alarma as $row){
				echo $row->color;
			}
		}
	}
	
	public function buscarAlarma(){
		$alarma 	= $this->input->post('alarma');
		
		$arreglo 	= array(
			'visto_back'	=> 1,
			'eliminado'		=> 0
		);
		
		$this->alarmas_model->update($arreglo, $alarma);
		
		if($alarma){
			if($this->alarmas_model->buscarAlarma($alarma, "clientes")){
				$datos 		= $this->alarmas_model->buscarAlarma($alarma, "clientes");
				foreach($datos as $row){
					$url 	= base_url("index.php/clientes/pestanas/".$row->id_cliente."#tab7");
				}
			}
			else if($this->alarmas_model->buscarAlarma($alarma, "vendedores")){
				$datos 		= $this->alarmas_model->buscarAlarma($alarma, "vendedores");
				foreach($datos as $row){
					$url 	= base_url()."index.php/vendedores/pestanas/".$row->id_vendedor."#tab7";
				}
			}
			else if($this->alarmas_model->buscarAlarma($alarma, "pedidos")){
				$datos 		= $this->alarmas_model->buscarAlarma($alarma, "pedidos");
				foreach($datos as $row){
					$url 	= base_url()."index.php/pedidos/pestanas/".$row->id_pedido."#tab2";
				}
			}
			else if($this->alarmas_model->buscarAlarma($alarma, "presupuestos")){
				$datos 		= $this->alarmas_model->buscarAlarma($alarma, "presupuestos");
				foreach($datos as $row){
					$url 	= base_url()."index.php/presupuestos/pestanas/".$row->id_presupuesto."#tab2";
				}
			}
			else if($this->alarmas_model->buscarAlarma($alarma, "visitas")){
				$datos 		= $this->alarmas_model->buscarAlarma($alarma, "visitas");
				foreach($datos as $row){
					$url 	= base_url()."index.php/visitas/carga/".$row->id_visita."/0#tab2";
				}
			}
			else if($this->alarmas_model->buscarAlarma($alarma, "productos")){
				$datos 		= $this->alarmas_model->buscarAlarma($alarma, "productos");
				foreach($datos as $row){
					$url 	= base_url()."index.php/productos/pestanas/".$row->id_producto."#tab2";
				}
			}
		}
		
		echo $url;
	}
	
	public function editarTipoAlarma(){
		
		$alarma = array(
			'nombre'		=> $this->input->post('nombre_editar'),
			'tipo_alarma'	=> $this->input->post('icono_editar'),
			'color'			=> $this->input->post('color_editar')
		);
		
		$this->alarmas_model->updateAlarma($alarma, $this->input->post('id_alarma_editar'));
		
		redirect('Alarmas/nuevaAlarma/','refresh');
		
	}
}