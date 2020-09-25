<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "report";
		$data['title_page']  = "Relatórios";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/report/index');
		$this->load->view('client/_fixed/footer');
	}
}
