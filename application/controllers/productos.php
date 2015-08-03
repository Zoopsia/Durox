<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends My_Controller {
	
	protected $_subject		= 'productos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		$this->load->library('image_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id)
	{
		
		$db['productos'] 	= $this->productos_model->getRegistro($id);
		$db['imagenes'] 	= $this->productos_model->getImagenes($id);
		$db['precios'] 		= $this->productos_model->getPrecios();

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
				 ->display_as('ficha_tecnica','Ficha Técnica');
				
			$crud->required_fields('nombre',
							'precio');
			
			$crud->set_subject('Productos');
			
			$crud->fields('nombre',
						  'precio',
						  'ficha_tecnica');
						  
			$crud->set_field_upload('ficha_tecnica','img/productos/documentos');			  
							
			$crud->unset_fields('id_producto');		
							
			$crud->order_by('id_producto','asc');
			
			$crud->add_action('Img', '', '','icon-images-gallery', array($this, 'buscar_imagen'));
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			$crud->callback_delete(array($this,'delete_user'));
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_edit();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);		 
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
		$arreglo = array(
			'eliminado'		=> 1
		);
		return $this->productos_model->update($arreglo,$primary_key);
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
}