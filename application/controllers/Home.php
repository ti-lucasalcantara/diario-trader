<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "home";

		$this->load->view('fixed/header', $data);
		$this->load->view('fixed/footer');
	}
}
