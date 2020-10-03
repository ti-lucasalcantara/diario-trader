<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	

	public function __construct(){

		parent::__construct();

		setlocale(LC_TIME, 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		// check permission

		// load database
		$this->load->model('client/tradings_model', 'tradings');
		$this->load->library('calendar');
	}

	public function index()
	{

		$calendar = $this->calendar->generate();

		$data = array();
		$data['active_menu'] = "dashboard";
		$data['title_page']  = "Dashboard";
		$data['calendar']  	 = $calendar;

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/dashboard/index');
		$this->load->view('client/_fixed/footer');
	}
}
