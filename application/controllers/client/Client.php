<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {

	public function __construct(){

		parent::__construct();

		// check permission
		
		// load database
		$this->load->model('client/clients_model', 'clients');
	}

	public function index()
	{
		$data = array();
		$data['active_menu'] 	= "client";
		$data['title_page'] 	= "Clientes";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/client/index');
		$this->load->view('client/_fixed/footer');
	}

	public function create()
	{
		$data = array();
		$data['active_menu'] = "client";
		$data['title_page']  = "Novo Cliente";

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/client/create');
		$this->load->view('client/_fixed/footer');
	}
	
	public function edit($id = null)
	{

		$result = $this->clients->show($id);
		if ( empty ( $id ) || empty ( $result )  ){

			$response['response_type'] 		= 'error';
			$response['response_title'] 	= 'Falha ao buscar dados!';
			$response['response_message'] 	= 'Nenhum cliente encontrado';
			
			$this->session->set_flashdata( $response );
			redirect(base_url().'client');
		}
		
		foreach ($result as $client);

		$data = array();
		$data['active_menu'] 	= "client";
		$data['client'] 		= $client;
		$data['title_page']  	= "Cliente: ".$client->name;

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/client/edit');
		$this->load->view('client/_fixed/footer');
	}

	public function show($id = null)
	{
		$this->output
       		->set_content_type('application/json')
			->set_output(json_encode( $this->clients->show($id) ));
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
					'label' => 'Nome do Cliente',
					'rules' => 'required|min_length[2]',
					'errors' => array(
						'required' => 'campo obrigatório',
						'min_length' => 'O campo %s deve ter no mínimo 02 caracteres.'
					),
				),
				array(
					'field' => 'phone',
					'label' => 'Telefone',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'document',
					'label' => 'CPF',
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
				$clients['name'] 		= $this->input->post('name');
				$clients['phone'] 		= $this->input->post('phone');
				$clients['document'] 	= $this->input->post('document');
				$clients['description'] = $this->input->post('description');
				
				$insert_id = $this->clients->insert($clients);

				if( ! $insert_id ){

					$response['response_type'] 		= 'error';
					$response['response_title'] 	= 'Error';
					$response['response_message'] 	= 'Falha ao inserir no banco de dados.';
		
					$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($response));
					
					return false;
				}


				if ( isset($_FILES)  && !empty($_FILES['avatar']) ){

					$client_fk = 123123;
					$path = "./uploads/client/{$client_fk}/clients/{$insert_id}/";

					if( ! is_dir($path) ){
						mkdir($path, 0755, true);
					}

					$config['upload_path']    	= $path;
					$config['allowed_types']  	= 'gif|jpg|jpeg|png';
					$config['file_name']		= 'avatar';
					$config['overwrite']		= true;

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('avatar') )
					{
						$response['response_type'] 		= 'error';
						$response['response_title'] 	= 'Falha ao enviar imagem';
						$response['response_message'] 	= $this->upload->display_errors();
			
						$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response));
						
						return false;
					}
					else
					{
						$upload_data = $this->upload->data();

						// update column avatar
						$client['avatar'] = base_url().substr($path,2).$upload_data['file_name'];

						if (! $this->clients->update($client, $insert_id) ) {
							$response['response_type'] 		= 'error';
							$response['response_title'] 	= 'Error!';
							$response['response_message'] 	= 'Falha ao gravar imagem no banco de dados.';
				
							$this->output
								->set_status_header(200)
								->set_content_type('application/json', 'utf-8')
								->set_output(json_encode($response));
							
							return false;
						}

						$config_manip = array(
							'image_library' 	=> 'gd2',
							'source_image' 		=> $path.$upload_data['file_name'],
							'new_image' 		=> $path.$upload_data['file_name'],
							'maintain_ratio' 	=> TRUE,
							'width' 			=> ( $upload_data['image_width'] * 0.5 ),
							'height'			=> ( $upload_data['image_height'] * 0.5 )
						);
				
						$this->load->library('image_lib', $config_manip);
						if (!$this->image_lib->resize()) {
							$response['response_type'] 		= 'error';
							$response['response_title'] 	= 'Falha ao redimensionar imagem.';
							$response['response_message'] 	= $this->image_lib->display_errors();
				
							$this->output
								->set_status_header(200)
								->set_content_type('application/json', 'utf-8')
								->set_output(json_encode($response));
							
							return false;
						}
						$this->image_lib->clear();
					}
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
		if( $this->input->post() ){

			$id	= $this->input->post('id');

			if(!$id){
				$response['response_type'] 		= 'error';
				$response['response_title'] 	= 'Error!';
				$response['response_message'] 	= 'Id não econtrado';
	
				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return false;
			}

			$clients['name'] 		= $this->input->post('name');
			$clients['phone'] 		= $this->input->post('phone');
			$clients['document'] 	= $this->input->post('document');
			$clients['avatar'] 		= NULL;
			$clients['description'] = $this->input->post('description');

			if( ! $this->clients->update($clients, $id) ){

				$response['response_type'] 		= 'error';
				$response['response_title'] 	= 'Error!';
				$response['response_message'] 	= 'Falha ao atualizar dados';

				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return false;
			}

			$response['response_type'] 		= 'success';
			$response['response_title'] 	= 'Tudo certo!';
			$response['response_message'] 	= 'Dados atualizado com sucesso';

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response));
			return true;
			
		}
	}

	public function delete()
	{	
		if( $this->input->post() ){

			$id	= $this->input->post('id');

			if(!$id){
				$response['response_type'] 		= 'error';
				$response['response_title'] 	= 'Error!';
				$response['response_message'] 	= 'Id não econtrado';
	
				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return false;
			}
			if ( ! $this->clients->delete($id) ){

				$response['response_type'] 		= 'error';
				$response['response_title'] 	= 'Error!';
				$response['response_message'] 	= 'Falha ao remover dados';

				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return false;

			}

			$response['response_type'] 		= 'success';
			$response['response_title'] 	= 'Operação realizada com sucesso!';
			$response['response_message'] 	= 'Exclusão de dados realizada.';

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response));
			return true;
		}
	}

	public function restore()
	{	
		if( $this->input->post() ){

			$id	= $this->input->post('id');

			if(!$id){
				$response['response_type'] 		= 'error';
				$response['response_title'] 	= 'Error!';
				$response['response_message'] 	= 'Id não econtrado';
	
				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return false;
			}

			if ( ! $this->clients->restore($id) ){
				$response['response_type'] 		= 'error';
				$response['response_title'] 	= 'Error!';
				$response['response_message'] 	= 'Falha ao restaurar dados';

				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return false;
			}

			$response['response_type'] 		= 'success';
			$response['response_title'] 	= 'Ok';
			$response['response_message'] 	= 'Operação realizada com sucesso';

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response));
			return true;

		}
	}

	public function showByParams()
	{	
		$where =  array();
		if( $this->input->post() ){
			foreach ($this->input->post() as $key => $value) {
				if( ! is_null ($value) )
					$where[$key] = $value;
			}
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode( $this->clients->show( $where  ) ));
		return true;
	}



}
