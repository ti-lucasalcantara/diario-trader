<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		redirect('dashboard');
		$data = array();
		$data['active_menu'] = "home";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/_fixed/footer');
	}
}
