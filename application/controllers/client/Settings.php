<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function index()
	{	
		$data = array();
		$data['active_menu'] = "settings";
		$data['title_page']  = "Configurações";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/settings/index');
		$this->load->view('client/_fixed/footer');
	}
}
