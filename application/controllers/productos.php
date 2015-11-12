<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends My_Controller {
	
	protected $_subject		= 'productos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		$this->load->library('pdf');

		$this->load->library('image_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model('monedas_model');
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id)
	{
		$db['id']				= $id;
		$db['productos'] 		= $this->productos_model->getRegistro($id);
		$db['imagenes'] 		= $this->productos_model->getImagenes($id);
		$db['precios'] 			= $this->productos_model->getPrecios();
		$db['alarmas']			= $this->productos_model->getAlarmas($id);
		$db['tipos_alarmas']	= $this->productos_model->getTodo('tipos_alarmas');
		$db['datosDB']			= $this->productos_model->traerDatosDBExterna($id);
		$db['monedas']			= $this->monedas_model->getTodo();

		$this->cargar_vista($db, 'pestanas');			
	}
	

	public function productos_abm()
	{
		$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('productos.eliminado', 0);
			
			$crud->set_table('productos');
			
			$crud->columns('id_producto',
							'nombre');
			
			$crud->display_as('id_producto','N° Producto')
				 ->display_as('nombre','Producto')
				 ->display_as('ficha_tecnica','Ficha Técnica')
				 ->display_as('descripcion','Descripción')
				 ->display_as('id_moneda','Tipo Moneda');
				
			$crud->required_fields('nombre',
							'precio',
							'id_moneda');
			
			$crud->set_subject('Productos');
			
			$crud->fields('nombre',
						  'precio',
						  'id_moneda',
						  'ficha_tecnica',
						  'descripcion');
			
			$crud->set_rules('precio','Precio','numeric');
						  
			$crud->set_field_upload('ficha_tecnica','img/productos/documentos');			  
							
			$crud->unset_fields('id_producto');		
							
			$crud->order_by('id_producto','asc');
			
			$crud->add_action('Img', '', '','icon-images-gallery', array($this, 'buscar_imagen'));
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			$crud->callback_delete(array($this,'delete_user'));
			$crud->callback_after_insert(array($this, 'insertDatos'));
			
			$crud->set_relation('id_moneda','monedas','{moneda} {abreviatura}');
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_edit();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);		 
	}

	function insertDatos($post_array, $primary_key)
	{
		$session_data = $this->session->userdata('logged_in');
		
		$arreglo	= array(
			'date_add'		=> date('Y-m-d H:i:s'),
			'visto'			=> 0,
			'id_origen'		=> 2,
			'id_db'			=> 0,
			'user_add'		=> $session_data['id_usuario'],
			'user_upd'		=> $session_data['id_usuario'],
			'eliminado'		=> 0
		);
		
		$log		= array(
			'accion'	=> 'INSERT',
			'tabla'		=> 'productos',
			'id_cambio'	=> $primary_key
		);
		
		$this->productos_model->logRegistros($log);
		
		$id			= $this->productos_model->update($arreglo,$primary_key);
		
		return true;
	}

	function buscar_imagen($id)
	{
		return site_url('/productos/producto_imagen').'/'.$id;	
	}
	
	function producto_imagen($id = NULL)
	{
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id_imagen');
		$image_crud->set_url_field('url');
		$image_crud->set_title_field('nombre');
		$image_crud->set_table('productos_imagenes')
		 		   ->set_relation_field('id_producto')
				   ->set_ordering_field('orden')
				   ->set_image_path('img/productos/imagenes');
			
		$output = $image_crud->render();
	
		$this->crud_tabla($output, 'imagenes');	
	}


	public function delete_user($primary_key)
	{
		if($this->productos_model->permitirEliminarEstadoPresupuesto($primary_key)){
			if($this->productos_model->permitirEliminarEstadoPedido($primary_key)){
				$arreglo = array(
					'eliminado'		=> 1
				);
				
				$id 	= $this->productos_model->update($arreglo,$primary_key);
			}
			else
				echo "<script>alert('El registro no pude ser eliminado...');</script>";	
		}
		else
			echo "<script>alert('El registro no pude ser eliminado...');</script>";
		
		
		return redirect($this->_subject.'/pestanas/'.$primary_key,'refresh');
	}

	function just_a_test($primary_key , $row)
	{
	    return site_url($this->_subject.'/pestanas').'/'.$row->id_producto;
	}
	
	public function reglas()
	{
		
		$db['empresas'] = $this->empresas_model->getRegistro(1);
		$this->cargar_vista($db, 'reglas');	
						
	}
	
	function editarProducto($id_producto)
	{
		$registro	= $this->productos_model->getRegistro($id_producto);
		$destino 	= 'img/productos/documentos/';
		
		if(devolverDir($destino)){
			if(isset($_FILES['ficha_tecnica']['tmp_name']))
			{
				$origen 		= $_FILES['ficha_tecnica']['tmp_name'];
				$url			= $destino.$_FILES['ficha_tecnica']['name'];
				$ficha_tecnica	= $_FILES['ficha_tecnica']['name'];
				if(!empty($_FILES['ficha_tecnica']['tmp_name'])){
					copy($origen, $url);	
				}
				else {
					foreach ($registro as $key) {
						$ficha_tecnica = $key->ficha_tecnica;
					}
				}			
				
				$producto	= array(
						'nombre'			=> $this->input->post('nombre'),
						'precio'			=> $this->input->post('precio'),		
						'codigo' 			=> $this->input->post('codigo'),
						'descripcion'		=> $this->input->post('editor1'),
						'ficha_tecnica'		=> $ficha_tecnica,
						'id_moneda'			=> $this->input->post('id_moneda'),
						'eliminado'			=> 0
				);
			}
			else{
				$producto	= array(
						'nombre'			=> $this->input->post('nombre'),
						'precio'			=> $this->input->post('precio'),		
						'codigo' 			=> $this->input->post('codigo'),
						'descripcion'		=> $this->input->post('editor1'),
						'id_moneda'			=> $this->input->post('id_moneda'),
						'eliminado'			=> 0
				);
			}
				
			$id = $this->productos_model->update($producto, $id_producto);	
		}

		redirect('productos/pestanas/'.$id_producto,'refresh');
	}

	function editarVisto($id=null){
		if($id){
			$arreglo = array(
				'visto'			=> $this->input->post('visto'),
				'eliminado'		=> 0
			);
			$id = $this->productos_model->update($arreglo, $id);
		}
		else{
			$mensaje 	= $this->productos_model->mensajesNuevos();
		
			if($mensaje){
				foreach($mensaje as $row) {
					$id = $row->id_producto; 	
					if($row->id_producto = $this->input->post('id_producto'.$id)){
						$arreglo = array(
							'visto'			=> $this->input->post('estado'.$id),
							'eliminado'		=> 0
						);
						$id = $this->productos_model->update($arreglo, $id);
					}
				}	
			}
		}
		redirect($this->input->post('url'),'refresh');
	}
	
	public function getAlarmas(){
		$alarmas = $this->productos_model->getAlarmas($this->input->post('id'));
		if($alarmas){
			echo count($alarmas);
		}
		else {
			echo 0;
		}
	}

	public function armarListaPrecios(){
			
		$destino 	= 'documentos/';
		
		if(devolverDir($destino)){
			
	    	//require('libraries/fpdf/fpdf.php');
			$this->pdf = new PDF();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages();
			
			$productos = $this->productos_model->getListaPrecios();
			
			// Carga de Titulos
			$header = array('Producto', 'Precio');
			// Carga de datos

			$this->pdf->ListaPreciosTable($header,$productos);
			ob_end_clean();
			$this->pdf->Output();
        }
	}
}