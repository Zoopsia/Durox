<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Telefonos extends My_Controller {
	
	protected $_subject		= 'telefonos';
	
	
	
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

	
	public function telefonos($id, $tipo, $save=null, $id_telefono=null){
		
		if($tipo == 1)
		{
			$db['clientes']		= $this->clientes_model->getRegistro($id);
			$db['telefonos']	= $this->clientes_model->getCruce($id,'telefonos');
		}
		else if($tipo == 2)
		{
			$db['vendedores']	= $this->vendedores_model->getRegistro($id);
			$db['telefonos']	= $this->vendedores_model->getCruce($id,'telefonos');
		}
		
		$db['tipos']			= $this->telefonos_model->getTipos();	
		$db['id']				= $id;
		$db['tipo']				= $tipo;
		
		$db['save']					= $save;
		$db['id_telefono']			= $id_telefono;
		
		$this->cargar_vista($db, 'telefonos');
					
	}

	public function cargaEditar($id,$id_usuario,$tipo){
	
		$db['telefonos']	= $this->telefonos_model->getRegistro($id);
		$db['tipos']		= $this->telefonos_model->getTipos();
	
		$db['id'] 			= $id;
		$db['id_usuario']	= $id_usuario;
		$db['tipo']			= $tipo;
	
		$this->cargar_vista($db, 'editar');				
	}
	
	public function editarTelefonos($id,$id_usuario,$tipo){
	
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
				'eliminado'		=> 0		
			);
			
			$id_telefono = $this->telefonos_model->update($telefono, $id);
			
			if($tipo==1){
				$url = 'clientes/pestanas/'.$id_usuario;
			}
			else if($tipo==2){
				$url = 'vendedores/pestanas/'.$id_usuario;
			}
			
			$arreglo_mensaje = array(			
				'save' 			=> 4,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_telefono,
				'id_usuario'	=> $id_usuario,
				'tipo'			=> $tipo	
			);
			
			$mensaje = get_mensaje($arreglo_mensaje);						
			redirect($url,'refresh');	
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
		
		$id_telefono = $this->telefonos_model->insert($telefono);
		$this->telefonos_model->insertCruce($tipo,$id_telefono,$id_usuario);
		
		$save = $this->input->post('btn-save');
	
		$arreglo_mensaje = array(			
				'save' 			=> $save,
				'tabla'			=> $this->_subject,
				'id_tabla'		=> $id_telefono,
				'id_usuario'	=> $id_usuario,
				'tipo'			=> $tipo	
		);
		
		if($save == 1){			
			$this->telefonos($id, $tipo, $save, $id_telefono);
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

	public function eliminarTelefono(){

		$telefono	= array(	
			'eliminado' 			=> 1,	
		);
			
		$id_telefono    = $this->telefonos_model->update($telefono, $this->input->post('telefono'));	
		
		$tipo			= $this->input->post('tipo');
		
		if($tipo == 1){
			$telefonos 		= $this->clientes_model->getCruce($this->input->post('usuario'),'telefonos');
			$usuario	 	= $this->clientes_model->getRegistro($this->input->post('usuario'));
		}
		else if($tipo == 2){
			$telefonos 		= $this->vendedores_model->getCruce($this->input->post('usuario'),'telefonos');
			$usuario	 	= $this->vendedores_model->getRegistro($this->input->post('usuario'));
		}
		$mensaje = '<table class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>'.$this->lang->line('cod_area').'</th>
				<th>'.$this->lang->line('telefonos').'</th>
				<th>'.$this->lang->line('tipo').'</th>
				<th>'.$this->lang->line('fax').'</th>
				<th>'.$this->lang->line('acciones').'</th>
			</tr>
		</thead>
												 
		<tfoot>
			<tr>
				<th>'.$this->lang->line('cod_area').'</th>
				<th>'.$this->lang->line('telefonos').'</th>
				<th>'.$this->lang->line('tipo').'</th>
				<th>'.$this->lang->line('fax').'</th>
				<th>'.$this->lang->line('acciones').'</th>
			</tr>
		</tfoot>
												 
		<tbody>';
												        	
		if ($telefonos) {
			foreach ($telefonos as $row) {
				foreach ($usuario as $key) {
					$mensaje .= '<tr>';
					$mensaje .= '<td>' . $row -> cod_area . '</td>';
					$mensaje .= '<td>' . $row -> telefono . '</td>';
					$mensaje .= '<td>' . $row -> tipo . '</td>';
					if($row->fax == 0)
						$mensaje .= "<td>NO</td>";
					else
						$mensaje .= "<td>SI</td>";
					if($tipo == 1){
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<td style="text-align: center;">';
						$mensaje .= '<a href="' . base_url() . 'index.php/telefonos/cargaEditar/' . $row -> id_telefono . '/' . $key -> id_cliente . '/1"';
						$mensaje .= 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="' . $this -> lang -> line('editar') . '" style="margin : 0 5px">';
						$mensaje .= '<i class="fa fa-edit"></i>';
						$mensaje .= '</a>';
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<a href="#" onclick="eliminarTelefono('.$row->id_telefono.','.$key->id_cliente.',1)"';
						$mensaje .= 'class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="' . $this -> lang -> line('eliminar') . '">';
						$mensaje .= '<i class="fa fa-minus"></i>';
						$mensaje .= '</a>';
						$mensaje .= '</td>';
						$mensaje .= "</tr>";
					}
					else if($tipo == 2){
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<td style="text-align: center;">';
						$mensaje .= '<a href="'.base_url().'index.php/telefonos/cargaEditar/'.$row->id_telefono.'/'.$key->id_vendedor.'/2"';
						$mensaje .= 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="' . $this -> lang -> line('editar') . '" style="margin : 0 5px">';
						$mensaje .= '<i class="fa fa-edit"></i>';
						$mensaje .= '</a>';
						/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
						$mensaje .= '<a href="#" onclick="eliminarTelefono('.$row->id_telefono.','.$key->id_vendedor.',2)"';
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
		
}