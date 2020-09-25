<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "profile";
		$data['title_page']  = "Perfil";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/profile/index');
		$this->load->view('client/_fixed/footer');
	}

	public function edit()
	{
	}

}
