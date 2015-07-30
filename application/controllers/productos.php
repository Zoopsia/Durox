<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends My_Controller {
	
	protected $_subject		= 'productos';
	
	
	
	function __construct()
	{
		parent::__construct(
				$subjet		= $this->_subject 
		);

		$this->load->library('grocery_CRUD');
		
		$this->load->model('empresas_model');
		$this->load->model($this->_subject.'_model');
	}
	

	public function pestanas($id)
	{
		
		$db['empresas']=$this->empresas_model->getRegistro(1);

		$this->cargar_vista($db, 'pestanas');			
	}
	

	public function productos_abm(){
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_language("spanish");
			
			$crud->where('productos.eliminado', 0);
			
			$crud->set_table('productos');
			
			$crud->columns('id_producto',
							'nombre');
			
			$crud->display_as('id_producto','N° Producto')
				 ->display_as('nombre','Producto');
			
			$crud->set_subject('Productos');
			
			$crud->fields('nombre',
						  'precio');
							
			$crud->unset_fields('id_producto');		
							
			$crud->order_by('id_producto','asc');
			
			$crud->add_action('Ver', '', '','ui-icon-document',array($this,'just_a_test'));
			$crud->callback_delete(array($this,'delete_user'));
			
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_read();
			$crud->unset_edit();
			
			$output = $crud->render();
			
			$this->crud_tabla($output);		 
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