<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direcciones extends My_Controller {
	
	protected $_subject		= 'direcciones';
	
	
	
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

	
	public function direcciones($id, $tipo, $save=null, $id_direccion=null){
		
		if($tipo == 1){
			$db['clientes']			= $this->clientes_model->getRegistro($id);
			$db['direcciones']		= $this->clientes_model->getCruce($id,'direcciones');
		}
		else if($tipo == 2){
			$db['vendedores']		= $this->vendedores_model->getRegistro($id);
			$db['direcciones']		= $this->vendedores_model->getCruce($id,'direcciones');
		}

		$db['tipos']				= $this->direcciones_model->getTipos();
		$db['paises']				= $this->direcciones_model->getPaises();
		$db['id']					= $id;
		$db['tipo']					= $tipo;

		$db['save']					= $save;
		$db['id_direccion']			= $id_direccion;
		
		$this->cargar_vista($db, 'direcciones');
	}

	public function cargaEditar($id,$id_usuario,$tipo){
	
		$db['direcciones']	= $this->direcciones_model->getRegistro($id);
			
		foreach ($db['direcciones'] as $row) 
		{
			$db['provincias']	= $this->direcciones_model->getProvincias($row->id_pais);
		}

		foreach ($db['direcciones'] as $key) 
		{
			$db['departamentos'] = $this->direcciones_model->getDepartamentos($key->id_provincia);
		}
		
		$db['tipos']		= $this->direcciones_model->getTipos();
		$db['paises']		= $this->direcciones_model->getPaises();
			
		$db['id'] 			= $id;
		$db['id_usuario']	= $id_usuario;
		$db['tipo']			= $tipo;
	
		$this->cargar_vista($db, 'editar');
	}
	
	public function editarDireccion($id,$id_usuario,$tipo){
	
			$direccion	= array(		
				'cod_postal' 			=> $this->input->post('cod_postal'),  
				'direccion' 			=> $this->input->post('direccion'), 
				'id_tipo'				=> $this->input->post('id_tipo'),
				'id_pais'				=> $this->input->post('id_pais'),
				'id_provincia'			=> $this->input->post('id_provincia'),
				'id_departamento'		=> $this->input->post('id_departamento')		
			);
			
			$id_direccion = $this->direcciones_model->update($direccion, $id);	
			
			if($tipo==1){
				$url = 'clientes/pestanas/'.$id_usuario;
			}
			else if($tipo==2){
				$url = 'vendedores/pestanas/'.$id_usuario;
			}
			$arreglo_mensaje = array(			
				'save' 			=> 4,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_direccion,
				'id_usuario'	=> $id_usuario,
				'tipo'			=> $tipo	
			);
								
			$mensaje = get_mensaje($arreglo_mensaje);						
			redirect($url,'refresh');	
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
		$id_direccion = $this->direcciones_model->insert($direccion);
		$this->direcciones_model->insertCruce($tipo,$id_direccion,$id_usuario);
		
		$save = $this->input->post('btn-save');
	
		$arreglo_mensaje = array(			
				'save' 			=> $save,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_direccion,
				'id_usuario'	=> $id_usuario,
				'tipo'			=> $tipo	
		);
	
		if($save == 1){			
			$this->direcciones($id, $tipo, $save, $id_direccion);
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
	
	public function getProvincias(){
		
		$id_pais = $this->input->post('id_pais');	
		$provincias 	= $this->direcciones_model->getProvincias($id_pais);

		echo '<option value="" disabled selected style="display:none;">Seleccione una opcion...</option>';
		foreach ($provincias  as $row) {
			echo '<option value="'.$row->id_provincia.'">'.$row->nombre_provincia.'</option>';
		}
		
					
	}
	
	public function getDepartamentos(){
		
		$id_provincia = $this->input->post('id_provincia');		
		$departamentos 	= $this->direcciones_model->getDepartamentos($id_provincia);
		
		echo '<option value="" disabled selected style="display:none;">Seleccione una opcion...</option>';
		foreach ($departamentos  as $row) {
			echo '<option value="'.$row->id_departamento.'">'.$row->nombre_departamento.'</option>';
		}
					
	}

	public function eliminarDireccion(){

		$direccion	= array(	
			'eliminado' 			=> 1,	
		);
			
		$id_direccion   = $this->direcciones_model->update($direccion, $this->input->post('direccion'));	
		
		$tipo			= $this->input->post('tipo');
		
		if($tipo == 1){
			$direcciones 	= $this->clientes_model->getCruce($this->input->post('usuario'),'direcciones');
			$usuario	 	= $this->clientes_model->getRegistro($this->input->post('usuario'));
		}
		else if($tipo == 2){
			$direcciones 	= $this->vendedores_model->getCruce($this->input->post('usuario'),'direcciones');
			$usuario	 	= $this->vendedores_model->getRegistro($this->input->post('usuario'));
		}
		$mensaje = '<table class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>'.$this -> lang -> line('direccion').'</th>
				<th>'.$this -> lang -> line('tipo').'</th>
				<th>'.$this -> lang -> line('departamento').'</th>
				<th>'.$this -> lang -> line('provincia').'</th>
				<th>'.$this -> lang -> line('pais').'</th>
				<th>'.$this -> lang -> line('acciones').'</th>
			</tr>
		</thead>
												 
		<tfoot>
			<tr>
				<th>'.$this -> lang -> line('direccion').'</th>
				<th>'.$this -> lang -> line('tipo').'</th>
				<th>'.$this -> lang -> line('departamento').'</th>
				<th>'.$this -> lang -> line('provincia').'</th>
				<th>'.$this -> lang -> line('pais').'</th>
				<th>'.$this -> lang -> line('acciones').'</th>
			</tr>
		</tfoot>
												 
		<tbody>';
												        	
		if ($direcciones) {
			foreach ($direcciones as $row) {
				foreach ($usuario as $key) {
					$mensaje .= '<tr>';
					$mensaje .= '<td>' . $row -> direccion . '</td>';
					$mensaje .= '<td>' . $row -> tipo . '</td>';
					$mensaje .= '<td>' . $row -> nombre_departamento . '</td>';
					$mensaje .= '<td>' . $row -> nombre_provincia . '</td>';
					$mensaje .= '<td>' . $row -> nombre_pais . '</td>';
					if($tipo == 1){
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<td style="text-align: center;">';
						$mensaje .= '<a href="' . base_url() . 'index.php/direcciones/cargaEditar/' . $row -> id_direccion . '/' . $key -> id_cliente . '/1"';
						$mensaje .= 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="' . $this -> lang -> line('editar') . '" style="margin : 0 5px">';
						$mensaje .= '<i class="fa fa-edit"></i>';
						$mensaje .= '</a>';
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<a href="#" onclick="eliminarDireccion('.$row->id_direccion.','.$key->id_cliente.',1)"';
						$mensaje .= 'class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="' . $this -> lang -> line('eliminar') . '">';
						$mensaje .= '<i class="fa fa-minus"></i>';
						$mensaje .= '</a>';
						$mensaje .= '</td>';
						$mensaje .= "</tr>";
					}
					else if($tipo == 2){
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<td style="text-align: center;">';
						$mensaje .= '<a href="' . base_url() . 'index.php/direcciones/cargaEditar/' . $row -> id_direccion . '/' . $key -> id_vendedor . '/2"';
						$mensaje .= 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="' . $this -> lang -> line('editar') . '" style="margin : 0 5px">';
						$mensaje .= '<i class="fa fa-edit"></i>';
						$mensaje .= '</a>';
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<a href="#" onclick="eliminarDireccion('.$row->id_direccion.','.$key->id_vendedor.',2)"';
						$mensaje .= 'class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="' . $this -> lang -> line('eliminar') . '">';
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
}