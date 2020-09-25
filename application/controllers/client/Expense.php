<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "expense";
		$data['title_page']  = "Despesas";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/expense/index');
		$this->load->view('client/_fixed/footer');
	}

}
