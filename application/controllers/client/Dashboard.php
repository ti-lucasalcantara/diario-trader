<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "dashboard";
		$data['title_page']  = "Dashboard";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/dashboard/index');
		$this->load->view('client/_fixed/footer');
	}
}
