<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "";
		$data['title_page']  = "Página não encontrada";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('errors/template/error_404');
		$this->load->view('client/_fixed/footer');
	}
}
