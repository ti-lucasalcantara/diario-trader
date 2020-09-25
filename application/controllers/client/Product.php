<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){

		parent::__construct();
		// check permission

		// load database
		$this->load->model('client/products_model', 'products');

	}

	public function index($page = 1)
	{
		$data = array();
		$data['active_menu'] = "product";
		$data['title_page']  = "Produtos";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/product/index', $data);
		$this->load->view('client/_fixed/footer');
	}

	public function create()
	{

		$data = array();
		$data['active_menu'] = "product";
		$data['title_page']  = "Novo Produto";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/product/create');
		$this->load->view('client/_fixed/footer');
	}

	public function edit($id = null)
	{

		$result = $this->products->show($id);
		if ( empty ( $id ) || empty ( $result )  ){

			$response['response_type'] 		= 'error';
			$response['response_title'] 	= 'Falha ao buscar dados!';
			$response['response_message'] 	= 'Nenhum produto encontrado';
			
			$this->session->set_flashdata( $response );
			redirect(base_url().'product');
		}

		foreach ($result as $product);

		$data = array();
		$data['active_menu'] = "product";
		$data['title_page']  = "Editar Produto";
		$data['product'] 	 = $product;

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/product/edit');
		$this->load->view('client/_fixed/footer');
	}

	public function show($id = null)
	{
		$this->output
       		->set_content_type('application/json')
			->set_output(json_encode( $this->products->show($id) ));
		return true;
	}

	public function insert()
	{
		if( ! $this->input->post() ){
			
			$response['response_type'] 		= 'error';
			$response['response_title'] 	= 'Error';
			$response['response_message'] 	= 'Falha na requisição.';

			$this->output
				->set_status_header(401)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response));

			return false;
		}else{
			
			$this->load->library('form_validation');

			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Nome do Produto',
					'rules' => 'required|min_length[2]',
					'errors' => array(
						'required' => 'campo obrigatório',
						'min_length' => 'O campo %s deve ter no mínimo 02 caracteres.'
					),
				),
				array(
					'field' => 'barcode',
					'label' => 'Código de barras',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'purchase_price',
					'label' => 'Preço de Compra',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'profit_margin',
					'label' => 'Margem de Lucro',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'price',
					'label' => 'Preço de Venda',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'quantity',
					'label' => 'Qtd. Estoque',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'minimum_quantity',
					'label' => 'Qtd. minima',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'measurements_id',
					'label' => 'Unidade de Medida',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'description',
					'label' => 'Descrição',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'product_categories_id',
					'label' => 'Categoria do Produto',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => '',
					'label' => '',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),

				
			);
		
			$this->form_validation->set_rules($rules);
		
			if ($this->form_validation->run() == FALSE)
			{
				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode( array_merge( 
												array('response_type'	=> 'error', 
													  'response_title' 	=> 'Falha ao enviar dados', 
													  'response_message'=>'Verifique os dados do formulário',
													), 
												$this->form_validation->error_array()) 
											));
					return false;
			}
			else
			{
				$product['name'] 					= $this->input->post('name');
				$product['barcode'] 				= $this->input->post('barcode');
				$product['purchase_price'] 			= $this->input->post('purchase_price');
				$product['profit_margin'] 			= $this->input->post('profit_margin');
				$product['price'] 					= $this->input->post('price');
				$product['description'] 			= $this->input->post('description');
				$product['quantity'] 				= $this->input->post('quantity');
				$product['minimum_quantity'] 		= $this->input->post('minimum_quantity');
				$product['measurements_id'] 		= $this->input->post('measurements_id');
				$product['product_categories_id'] 	= $this->input->post('product_categories_id');
				$product['product_status_id'] 		= 1;
				
				$insert_id = $this->products->insert($product);

				if( ! $insert_id ){
					$response['response_type'] 		= 'error';
					$response['response_title'] 	= 'Error';
					$response['response_message'] 	= 'Falha ao inserir no banco de dados.';

					$this->output
						->set_status_header(401)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($response));

					return false;
				}
				

				$response['response_type'] 		= 'success';
				$response['response_title'] 	= 'Tudo certo!';
				$response['response_message'] 	= 'Operação realizada com sucesso';
				$response['insert_id'] 			= $insert_id;
	
				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return true;

			}
		}

	}

	public function update()
	{
		echo json_encode('aqui estou');
	}


	public function insertImage()
	{
		echo json_encode('aqui estou');
	}

}
