<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revenue extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "revenue";
		$data['title_page']  = "Receitas";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/revenue/index');
		$this->load->view('client/_fixed/footer');
	}

}
