<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Localidades extends My_Controller {
	
	protected $_subject		= 'localidades';
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
		$this->load->model('direcciones_model');
		
	}
	
	public function Localidades(){
		
		$paises				= $this->direcciones_model->getPaises();
		$provincias			= $this->localidades_model->getTodo('provincias');
		$departamentos		= $this->localidades_model->getTodo('departamentos');
		$db['paises']		= $paises;
		$db['paises2']		= $paises;
		$db['paises3']		= $paises;
		$db['paises4']		= $paises;
		$db['provincias']	= $provincias;
		$db['provincias2']	= $provincias;
		$db['provincias3']	= $provincias;
		$db['departamentos']= $departamentos;
		
		$this->cargar_vista($db, 'tabla');
	}
	
	public function editarPais(){
		$id		= $this->input->post('paises');
		$nombre = $this->input->post('input_pais');
		
		$arreglo = array(
			'nombre_pais'	=> $nombre,
		);
		
		$this->localidades_model->updatePais($arreglo,$id);
		
		$log = array(
			'accion'	=> 'UPDATE',
			'tabla'		=> 'paises',
			'id_cambio'	=> $id
		);
 
		$this->localidades_model->logRegistros($log);
		
		$this->Localidades();
	}
	
	public function editarProvincia(){
		$id_provincia	= $this->input->post('provincias');
		$id_pais 		= $this->input->post('paises_provincias');
		$nombre 		= $this->input->post('input_provincia');
		
		$arreglo = array(
			'nombre_provincia'	=> $nombre,
			'id_pais'			=> $id_pais
		);
		
		$this->localidades_model->updateProvincia($arreglo,$id_provincia);
		
		$log = array(
			'accion'	=> 'UPDATE',
			'tabla'		=> 'provincias',
			'id_cambio'	=> $id_provincia
		);
 
		$this->localidades_model->logRegistros($log);
		
		$this->Localidades();
	}
	
	public function editarDepartamento(){
		$id_departamento	= $this->input->post('departamentos');
		$id_provincia 		= $this->input->post('provincias_departamentos');
		$id_pais 			= $this->input->post('paises_departamentos');
		$nombre 			= $this->input->post('input_departamento');
		
		$arreglo = array(
			'nombre_departamento'	=> $nombre,
			'id_provincia'			=> $id_provincia
		);
		
		$this->localidades_model->updateDepartamento($arreglo,$id_departamento);
		
		$arreglo = array(
			'id_pais'			=> $id_pais
		);
		
		$this->localidades_model->updateProvincia($arreglo,$id_provincia);
		
		$log = array(
			'accion'	=> 'UPDATE',
			'tabla'		=> 'departamentos',
			'id_cambio'	=> $id_departamento
		);
 
		$this->localidades_model->logRegistros($log);
		
		$this->Localidades();
	}

	public function getPais(){
		$id			= $this->input->post('id_provincia');
		
		$id_pais 	= $this->localidades_model->getPais($id);
		
		if($id_pais){
			foreach($id_pais as $row){
				if($row->id_pais <= 99)
					echo "0".$row->id_pais;
				else
					echo $row->id_pais;
			}
		}
	}
	
	public function getProvincia(){
		$id				= $this->input->post('id_departamento');
		
		$id_provincia 	= $this->localidades_model->getProvincia($id);
		
		if($id_provincia){
			foreach($id_provincia as $row){
				echo $row->id_provincia;
			}
		}
	}
	
	public function nuevoPais(){
		$pais		= $this->input->post('nuevo_pais');
		$paises		= $this->direcciones_model->getPaises();
		if($paises){
			$i = 0;
			foreach($paises as $paises){
				if($paises->nombre_pais == $pais)
					$i = 1;
			}
		}
		if($i == 0){
				
			$arreglo = array(
				'nombre_pais'	=> $pais
			);
			
			$id = $this->localidades_model->insertNuevo($arreglo,"paises");
			
			$log = array(
				'accion'	=> 'INSERT',
				'tabla'		=> 'paises',
				'id_cambio'	=> $id
			);
 
			$this->localidades_model->logRegistros($log);
		}
		
		$this->Localidades();
	}
	
	public function nuevoDepartamento(){
		$departamento		= $this->input->post('nuevo_departamento');
		$departamentos		= $this->localidades_model->getTodo('departamentos');
		if($departamentos){
			$i = 0;
			foreach($departamentos as $departamentos){
				if($departamentos->nombre_departamento == $departamento)
					$i = 1;
			}
		}
		if($i == 0){
				
			$arreglo = array(
				'nombre_departamento'	=> $departamento,
				'id_provincia'			=> $this->input->post('nuevo_departamento_provincia')
			);
			
			$id = $this->localidades_model->insertNuevo($arreglo,"departamentos");
			
			$log = array(
				'accion'	=> 'INSERT',
				'tabla'		=> 'departamentos',
				'id_cambio'	=> $id
			);
 
			$this->localidades_model->logRegistros($log);
		}
		
		$this->Localidades();
	}
	
	public function nuevaProvincia(){
		$provincia		= $this->input->post('nueva_provincia');
		$provincias			= $this->localidades_model->getTodo('provincias');
		if($provincias){
			$i = 0;
			foreach($provincias as $provincias){
				if($provincias->nombre_provincia == $provincia)
					$i = 1;
			}
		}
		if($i == 0){
				
			$arreglo = array(
				'nombre_provincia'	=> $provincia,
				'id_pais'			=> $this->input->post('nueva_provincia_pais')
			);
			
			$id = $this->localidades_model->insertNuevo($arreglo,"provincias");
			
			$log = array(
				'accion'	=> 'INSERT',
				'tabla'		=> 'provincias',
				'id_cambio'	=> $id
			);
 
			$this->localidades_model->logRegistros($log);
		}
		
		$this->Localidades();
	}
}