<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Measurements extends CI_Controller {		

	public function __construct(){

		parent::__construct();

		// check permission
		
		// load database
		$this->load->model('client/measurements_model', 'measurements');
	}

	public function show($id = null)
	{
		$this->output
       		->set_content_type('application/json')
			->set_output(json_encode( $this->measurements->show($id) ));
	}

	public function insert()
	{	
		if( $this->input->post() ){

			$measurements['name'] 		= $this->input->post('name');
			$measurements['short_name'] = $this->input->post('short_name');

			$measurements_id = $this->measurements->insert($measurements);

			echo json_encode( array( 'id' => $measurements_id ) );
		}
	}

	public function update()
	{	
		if( $this->input->post() ){

			$id	= $this->input->post('id');

			if(!$id){
				echo json_encode( array('type' => 'danger', 'title' => 'error' ,'message'=> 'id não econtrado') );
			}

			$measurements['name'] 		= $this->input->post('name');
			$measurements['short_name'] = $this->input->post('short_name');

			echo json_encode( $this->measurements->update($measurements, $id) );
		}
	}

	public function delete()
	{	
		if( $this->input->post() ){

			$id	= $this->input->post('id');

			if(!$id){
				echo json_encode( array('type' => 'danger', 'title' => 'error' ,'message'=> 'id não econtrado') );
			}
			echo json_encode( $this->measurements->delete($id) );
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
					->set_output(json_encode( $this->measurements->restore($id) ));
		}
	}


}
