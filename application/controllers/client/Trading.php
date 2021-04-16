<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trading extends MY_Controller {

	public function __construct(){

		parent::__construct();

		setlocale(LC_TIME, 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		// check permission

		// load database
		$this->load->model('client/Tradings_in_model', 'tradings_in');
		$this->load->model('client/Tradings_out_model', 'tradings_out');
	}

	public function index($date = null)
	{	

		$date 	 = empty($date) ? date('d-m-Y') : $date;
		$explode = explode('-', $date);

		if ( ! checkdate ($explode[1], $explode[0], $explode[2]) ){
			redirect('trading');
		}

		$previus_date  = date('d-m-Y', strtotime("-1 days", strtotime($date)));
		$next_date 	   = date('d-m-Y', strtotime("+1 days", strtotime($date)));
		$selected_date = str_replace('-', '/', $date);
		$day_of_week   = strftime('%A', strtotime($date));
		
		switch ($day_of_week) {
			case 'Monday': 		$day_of_week = "Segunda-Feira"; break;
			case 'Tuesday': 	$day_of_week = "Terça-Feira"; 	break;
			case 'Wednesday': 	$day_of_week = "Quarta-Feira"; 	break;
			case 'Thursday': 	$day_of_week = "Quinta-Feira"; 	break;
			case 'Friday': 		$day_of_week = "Sexta-Feira"; 	break;
			case 'Saturday': 	$day_of_week = "Sábado"; 		break;
			case 'Sunday': 		$day_of_week = "Domingo"; 		break;
			default: break;
		}

		$explode 	= explode('/', $selected_date);
		$where_date = $explode[2]."-".$explode[1]."-".$explode[0];
		$tradings 	= $this->tradings_in->show( ['date_in' => $where_date] );

		
		$data = array();
		$data['active_menu'] 	= "trading";
		$data['title_page']  	= "Operações";
		$data['selected_date'] 	= $selected_date;
		$data['next_date'] 		= $next_date;
		$data['previus_date'] 	= $previus_date;
		$data['day_of_week'] 	= $day_of_week;
		$data['tradings'] 		= $tradings;

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/trading/index', $data);
		$this->load->view('client/_fixed/footer', $data);
	}

	public function create($date = null)
	{
		$date = empty($date) ? date('d-m-Y') : $date;

		$explode = explode('-', $date);

		if ( ! checkdate ($explode[1], $explode[0], $explode[2]) ){
			redirect('trading/create');
		}

		$selected_date 	= str_replace('-', '/', $date);

		$data = array();
		$data['active_menu'] 	= "trading";
		$data['title_page']  	= "Criar Trading";
		$data['selected_date']  = $date;
		$data['date_in']  	 	= $selected_date;

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/trading/create');
		$this->load->view('client/_fixed/footer');
	}

	public function edit($id = null)
	{	
		$result 	= $this->tradings->show( $id );
		
		if (empty($result)){
			die('erro');
		}
		foreach ($result as $trading);
		
		$tickers = array(
						'DOLFUT' =>  'DOLFUT',
						'WVM20'  =>  'WVM20',
					);

		$data = array();
		$data['active_menu'] 	= "trading";
		$data['title_page']  	= "Editar Operação";
		$data['trading'] 		= $trading;
		$data['selected_date'] 	= date('d-m-Y',strtotime($trading->date_in));
		$data['tickers'] 		= $tickers;

		$this->load->view('client/_fixed/header', $data);
		$this->load->view('client/trading/edit', $data);
		$this->load->view('client/_fixed/footer', $data);
	}
	
	public function show($id = null)
	{
		$this->output
       		 ->set_content_type('application/json')
			 ->set_output(json_encode( $this->tradings->show($id) ));
		return true;
	}

	public function insert()
	{		
		if( ! $this->input->post() ){
			
			$response['toast_type'] 	= 'error';
			$response['toast_title'] 	= 'Error';
			$response['toast_message'] 	= 'Falha na requisição.';

			$this->session->set_flashdata($response);
			redirect("trading/create");

		}else{
			
			$rules = array(
				array(
					'field' => 'ticker',
					'label' => 'Ativo',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'price_of_point',
					'label' => 'Preço por pontos',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'command',
					'label' => 'Operação',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'setup',
					'label' => 'Estratégia',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'number_of_papers',
					'label' => 'Qtd. Contratos',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'date_in',
					'label' => 'Data',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório',
					),
				),
				array(
					'field' => 'hour_in',
					'label' => 'Hora Entrada',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório',
					),
				),
				array(
					'field' => 'price_in',
					'label' => 'Preço Entrada',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),

			);
		
			/* 
			if ($this->input->post('quantity_line_out') > 0) {
                $this->form_validation->set_rules('nome', 'Nome', 'required',  array('required' => 'Campo obrigatório'));
            }  
			*/

			$this->form_validation->set_rules($rules);
		
			if ($this->form_validation->run() == FALSE)
			{
				$this->create();
			}
			else
			{

				// insert trading in
				$trading_in['users_id'] 		= $this->session->LOGIN['USER_ID'];
				$trading_in['ticker'] 			= $this->input->post('ticker');
				$trading_in['price_of_point'] 	= valueToDecimal($this->input->post('price_of_point'));
				$trading_in['command'] 			= $this->input->post('command');
				$trading_in['setup'] 			= $this->input->post('setup');
				$trading_in['number_of_papers'] = $this->input->post('number_of_papers');
				$trading_in['date_in'] 			= datePTBRtoENUS($this->input->post('date_in'));
				$trading_in['hour_in'] 			= $this->input->post('hour_in');
				$trading_in['price_in'] 		= valueToDecimal($this->input->post('price_in'));
				$trading_in['description'] 		= $this->input->post('description');

				$trading_in_id = $this->tradings_in->insert($trading_in);

				if ( ! $trading_in_id ){
					$response['toast_type'] 	= 'error';
					$response['toast_title'] 	= 'Error';
					$response['toast_message'] 	= 'Falha ao criar Trading [in]';
		
					$this->session->set_flashdata($response);
					redirect("trading/create/");
				}

				if ( $this->input->post('quantity_line_out')  > 0 ){
					// insert trading out
					for ($i=0; $i < $this->input->post('quantity_line_out'); $i++) { 
						$trading_out = array();
						$trading_out['users_id'] 			= $this->session->LOGIN['USER_ID'];
						$trading_out['trading_in_id'] 	 	= $trading_in_id;
						$trading_out['date_out'] 			= datePTBRtoENUS($this->input->post('date_out')[$i]);
						$trading_out['hour_out'] 			= $this->input->post('hour_out')[$i];
						$trading_out['price_out'] 			= valueToDecimal($this->input->post('price_out')[$i]);
						$trading_out['number_of_papers'] 	= $this->input->post('number_of_papers_out')[$i];

						$insert_trading_out = $this->tradings_out->insert($trading_out);

						if ( ! $insert_trading_out ){
							$response['toast_type'] 	= 'error';
							$response['toast_title'] 	= 'Error';
							$response['toast_message'] 	= 'Falha ao criar Trading [out] -> '.$i;
				
							$this->session->set_flashdata($response);
							redirect("trading/create/");
						}

					}

				}

				$response['toast_type'] 	= 'success';
				$response['toast_title'] 	= 'Tudo certo !';
				$response['toast_message'] 	= 'Dados armazenados com sucesso!';
	
				$this->session->set_flashdata($response);
				redirect("trading/");

				/* 
				$aux_date_out = ( $this->input->post('date_out') ) ? explode('/',$this->input->post('date_out')) : $aux_date_in;
				$date_out	  = $aux_date_out[2]."-".$aux_date_out[1]."-".$aux_date_out[0];

				$duration 	= '';
				$hour_in 	= new DateTime($date_in.(' ').$this->input->post('hour_in'));
				$hour_out 	= new DateTime($date_in.(' ').$this->input->post('hour_out'));
				$diff 		= $hour_in->diff($hour_out);

				if ( $diff->format('%y') != 0){
					$duration .= $diff->format('%y').'ano ';
				}
				if ( $diff->format('%m') != 0){
					$duration .= $diff->format('%m').'m ';
				}
				if ( $diff->format('%d') != 0){
					$duration .= $diff->format('%d').'d ';
				}
				if ( $diff->format('%h') != 0){
					$duration .= $diff->format('%h').'h ';
				}
				if ( $diff->format('%i') != 0){
					$duration .= $diff->format('%i').'min ';
				}
				if ( $diff->format('%s') != 0){
					$duration .= $diff->format('%s').'seg ';
				}

				if (empty($duration)){
					$duration = "0seg";
				}

				$price_in 	= str_replace(',', '.' , str_replace('.','', $this->input->post('price_in') ) );
				$price_out 	= str_replace(',', '.' , str_replace('.','', $this->input->post('price_out') ) );

				if( $this->input->post('command') == 'Compra'){
					@$points = $price_out - $price_in ;
				}
				if( $this->input->post('command') == 'Venda'){
					@$points = $price_in  - $price_out;
				}

				$tax = 0.12;

				$gross_value = ( ( $points * 10)  * $this->input->post('number_of_papers') );
				$net_value   = ( $gross_value - $tax);

				$users_id	 = 1; 

				$tradings['date_in'] 			= $date_in;
				$tradings['date_out'] 			= $date_out;
				$tradings['hour_in'] 			= $this->input->post('hour_in');
				$tradings['hour_out'] 			= $this->input->post('hour_out');
				$tradings['duration'] 			= $duration;
				$tradings['price_in'] 			= $price_in;
				$tradings['price_out'] 			= $price_out;
				$tradings['points'] 			= $points;
				$tradings['command'] 			= $this->input->post('command');
				$tradings['ticker'] 			= $this->input->post('ticker');
				$tradings['tax'] 				= $tax;
				$tradings['gross_value'] 		= $gross_value;
				$tradings['net_value'] 			= $net_value;
				$tradings['setup'] 				= $this->input->post('setup');
				$tradings['description'] 		= $this->input->post('description');
				$tradings['number_of_papers'] 	= $this->input->post('number_of_papers');
				$tradings['users_id'] 			= $users_id;
			
				$insert_id = $this->tradings->insert($tradings);

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


				if ( isset($_FILES)  && (!empty($_FILES['image']) )&& (!empty($_FILES['image']['name'])) && ( !empty($_FILES['image']['tmp_name']) ) ){
					$client_fk = 123123;
					$path = "./uploads/client/{$client_fk}/tradings/{$insert_id}/";

					if( ! is_dir($path) ){
						mkdir($path, 0755, true);
					}

					$config['upload_path']    	= $path;
					$config['allowed_types']  	= 'gif|jpg|jpeg|png';
					$config['encrypt_name']		= true;
					$config['overwrite']		= false;

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('image') )
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
						$tradings['image'] = base_url().substr($path,2).$upload_data['file_name'];

						if (! $this->tradings->update($tradings, $insert_id) ) {
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
				// end upload image
				

				$response['response_type'] 		= 'success';
				$response['response_title'] 	= 'Tudo certo!';
				$response['response_message'] 	= 'Operação realizada com sucesso';
				$response['response_redirect'] 	= base_url()."trading/date/".str_replace('/', '-', $this->input->post('date_in'));
				$response['insert_id'] 			= $insert_id;
	
				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return true;

				*/

			}
		}
	}

	public function update()
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
					'field' => 'date_in',
					'label' => 'Data',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório',
					),
				),
				array(
					'field' => 'hour_in',
					'label' => 'Hora Entrada',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório',
					),
				),
				array(
					'field' => 'hour_out',
					'label' => 'Hora Saída',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório',
					),
				),
				array(
					'field' => 'price_in',
					'label' => 'Preço Entrada',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'price_out',
					'label' => 'Preço Saída',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'price_out',
					'label' => 'Preço Saída',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'command',
					'label' => 'Operação',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'ticker',
					'label' => 'Ativo',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'setup',
					'label' => 'Estratégia',
					'rules' => 'required',
					'errors' => array(
						'required' => 'campo obrigatório'
					),
				),
				array(
					'field' => 'number_of_papers',
					'label' => 'Qtd. Contratos',
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

				$id = $this->input->post('id');

				if (empty($id)){
					$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode( array_merge( 
												array('response_type'	=> 'error', 
													  'response_title' 	=> 'Falha ao enviar dados', 
													  'response_message'=> 'Verifique os dados do formulário. ID não encontrado',
													), 
												$this->form_validation->error_array()) 
											));
					return false;
				}

				$users_id	 = 1; 
				$tradings 	 = $this->tradings->show([ 'id'=> $id, 'users_id' => $users_id ]);

				if (empty($tradings)){
					$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode( array_merge( 
												array('response_type'	=> 'warning', 
													  'response_title' 	=> 'Falha ao tentar efetuar operação', 
													  'response_message'=> 'Não foi possível editar dados. Registro não encontrado'.$this->input->post('date_in'),
													), 
												$this->form_validation->error_array()) 
											));
					return false;
				}

				$aux_date_in  = explode('/', $this->input->post('date_in'));
				$date_in	  = $aux_date_in[2]."-".$aux_date_in[1]."-".$aux_date_in[0];

				$aux_date_out = ( $this->input->post('date_out') ) ? explode('/',$this->input->post('date_out')) : $aux_date_in;
				$date_out	  = $aux_date_out[2]."-".$aux_date_out[1]."-".$aux_date_out[0];

				$duration 	= '';
				$hour_in 	= new DateTime($date_in.(' ').$this->input->post('hour_in'));
				$hour_out 	= new DateTime($date_in.(' ').$this->input->post('hour_out'));
				$diff 		= $hour_in->diff($hour_out);

				if ( $diff->format('%y') != 0){
					$duration .= $diff->format('%y').'ano ';
				}
				if ( $diff->format('%m') != 0){
					$duration .= $diff->format('%m').'m ';
				}
				if ( $diff->format('%d') != 0){
					$duration .= $diff->format('%d').'d ';
				}
				if ( $diff->format('%h') != 0){
					$duration .= $diff->format('%h').'h ';
				}
				if ( $diff->format('%i') != 0){
					$duration .= $diff->format('%i').'min ';
				}
				if ( $diff->format('%s') != 0){
					$duration .= $diff->format('%s').'seg ';
				}

				if (empty($duration)){
					$duration = "0seg";
				}

				$price_in 	= str_replace(',', '.' , str_replace('.','', $this->input->post('price_in') ) );
				$price_out 	= str_replace(',', '.' , str_replace('.','', $this->input->post('price_out') ) );

				if( $this->input->post('command') == 'Compra'){
					@$points = $price_out - $price_in ;
				}
				if( $this->input->post('command') == 'Venda'){
					@$points = $price_in  - $price_out;
				}

				$tax 		 = 0.12;

				$gross_value = ( ( $points * 10)  * $this->input->post('number_of_papers') );
				$net_value   = ( $gross_value - $tax);
				
				$tradings = array();
				$tradings['date_in'] 			= $date_in;
				$tradings['date_out'] 			= $date_out;
				$tradings['hour_in'] 			= $this->input->post('hour_in');
				$tradings['hour_out'] 			= $this->input->post('hour_out');
				$tradings['duration'] 			= $duration;
				$tradings['price_in'] 			= $price_in;
				$tradings['price_out'] 			= $price_out;
				$tradings['points'] 			= $points;
				$tradings['command'] 			= $this->input->post('command');
				$tradings['ticker'] 			= $this->input->post('ticker');
				$tradings['tax'] 				= $tax;
				$tradings['gross_value'] 		= $gross_value;
				$tradings['net_value'] 			= $net_value;
				$tradings['setup'] 				= $this->input->post('setup');
				$tradings['description'] 		= $this->input->post('description');
				$tradings['number_of_papers'] 	= $this->input->post('number_of_papers');
				$tradings['users_id'] 			= $users_id;
				
				$update = $this->tradings->update( $tradings, $id );

				if( ! $update ){

					$response['response_type'] 		= 'error';
					$response['response_title'] 	= 'Error';
					$response['response_message'] 	= 'Falha ao atualizar banco de dados.';
		
					$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($response));
					
					return false;
				}

				if ( isset($_FILES)  && (!empty($_FILES['image']) )&& (!empty($_FILES['image']['name'])) && ( !empty($_FILES['image']['tmp_name']) ) ){

					$client_fk = 123123;
					$path = "./uploads/client/{$client_fk}/tradings/{$id}/";

					if( ! is_dir($path) ){
						mkdir($path, 0755, true);
					}

					$config['upload_path']    	= $path;
					$config['allowed_types']  	= 'gif|jpg|jpeg|png';
					$config['encrypt_name']		= true;
					$config['overwrite']		= false;

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('image') )
					{
						$response['response_type'] 		= 'error';
						$response['response_title'] 	= 'Falha ao enviar imagem';
						$response['response_message'] 	= $this->upload->display_errors().json_encode($_FILES);
			
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
						$update = array();
						$update['image'] = base_url().substr($path,2).$upload_data['file_name'];

						if (! $this->tradings->update($update, $id) ) {
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
				// end upload image
				
				$response['response_type'] 		= 'success';
				$response['response_title'] 	= 'Tudo certo!';
				$response['response_message'] 	= 'Operação realizada com sucesso';
				$response['response_redirect'] 	= base_url()."trading/date/".str_replace('/', '-', $this->input->post('date_in'));
				$response['insert_id'] 			= $id;
	
				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response));
				return true;
			}
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
			if ( ! $this->tradings->delete($id) ){

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

			if ( ! $this->tradings->restore($id) ){
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

}
