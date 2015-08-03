<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images_examples extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		/* ------------------ */
		
		$this->load->helper('url'); //Just for the examples, this is not required thought for the library
		
		$this->load->library('image_CRUD');
	}
	
	
	
	
	function example4()
	{
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('url');
		$image_crud->set_title_field('title');
		$image_crud->set_table('example_4')
		->set_ordering_field('priority')
		->set_image_path('assets/uploads');
			
		$output = $image_crud->render();
	
		$this->load->view('example.php',$output);	
	}
	
	
}