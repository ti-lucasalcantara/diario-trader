<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	

	public function __construct(){

		parent::__construct();

		setlocale(LC_TIME, 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		// check permission

		// load database

		$calendar_settings['start_day']    		= 'monday';
		$calendar_settings['month_type']   		= 'long';
		$calendar_settings['day_type']     		= 'short';
		$calendar_settings['show_next_prev'] 	= true;
		$calendar_settings['next_prev_url']		= 'dashboard/date';
		$calendar_settings['show_other_days']	= false;
		$calendar_settings['template'] 			= array(
													'table_open'  			=> '<table class="calendar px-5 text-center">',
													'heading_row_start'		=> '<tr class="heading_row_start">',

													'cal_cell_start'       	=> '<td class="day">',
        											'cal_cell_start_today' 	=> '<td class="today">'
												);

		$this->load->model('client/tradings_model', 'tradings');
		$this->load->library('calendar', $calendar_settings);
	}

	public function index($year = null, $month = null)
	{

		$year	= date('Y');
		$month	= date('m');

		$data = array(
			3  => 'http://example.com/news/article/2006/06/03/',
		);

		$calendar = $this->calendar->generate($year, $month, $data);


		$data = array();
		$data['active_menu'] = "dashboard";
		$data['title_page']  = "Dashboard";
		$data['calendar']  	 = $calendar;
		$data['year']  		 = $year;
		$data['month']  	 = $month;
		$data['month_name']  = $this->calendar->get_month_name($month);


		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/dashboard/index');
		$this->load->view('client/_fixed/footer');
	}
}
