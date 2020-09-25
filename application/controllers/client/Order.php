<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function index()
	{
		$data = array();
		$data['active_menu'] = "order";
		$data['title_page']  = "Vendas";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/order/index');
		$this->load->view('client/_fixed/footer');
	}

	public function create()
	{
		$data = array();
		$data['active_menu'] = "order";
		$data['title_page']  = "Criar Venda";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/order/create');
		$this->load->view('client/_fixed/footer');
	}

	public function save()
	{
		var_dump($this->input->post());
	}


}
