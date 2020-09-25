<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "users";
		$data['title_page']  = "Usuários";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/users/index');
		$this->load->view('client/_fixed/footer');
	}

}
