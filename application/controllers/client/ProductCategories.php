<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class ProductCategories extends CI_Controller {		

	public function __construct(){

		parent::__construct();

		// check permission
		
		// load database
		$this->load->model('client/product_categories_model', 'product_categories');
	}

	public function show($id = null)
	{
		$this->output
       		->set_content_type('application/json')
			->set_output(json_encode( $this->product_categories->show($id) ));
	}

	public function insert()
	{	
		if( $this->input->post() ){
			$product_categories['name'] = $this->input->post('name');
			$product_categories_id 		= $this->product_categories->insert($product_categories);

			$this->output
       		->set_content_type('application/json')
			->set_output(json_encode( array( 'id' => $product_categories_id ) ));
		}
	}

	public function update()
	{	
		if( $this->input->post() ){

			$id	= $this->input->post('id');

			if(!$id){
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode( array('type' => 'danger', 'title' => 'error' ,'message'=> 'id não econtrado') ));
			}

			$product_categories['name'] = $this->input->post('name');

			$this->output
					->set_content_type('application/json')
					->set_output(json_encode( $this->product_categories->update($product_categories, $id) ));
		}
	}

	public function delete()
	{	
		if( $this->input->post() ){

			$id	= $this->input->post('id');

			if(!$id){
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode( array('type' => 'danger', 'title' => 'error' ,'message'=> 'id não econtrado') ));
			}
			$this->output
					->set_content_type('application/json')
					->set_output(json_encode( $this->product_categories->delete($id) ));
		}
	}

	public function restore()
	{	
		if( $this->input->post() ){

			$id	= $this->input->post('id');

			if(!$id){
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode( array('type' => 'danger', 'title' => 'error' ,'message'=> 'id não econtrado') ));
			}

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode( $this->product_categories->restore($id) ));
		}
	}


}
