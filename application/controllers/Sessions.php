<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {

	public function __construct(){

		parent::__construct();

		setlocale(LC_TIME, 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		// load database
		$this->load->model('client/users_model', 'users');
	}

	public function index()
	{
		include_once APPPATH."libraries/vendor/autoload.php";

		$google_client = new Google_Client();

		$google_client->setClientId('32431159595-36lhe8ts7l5bggrk4bmtorlkm89njgqi.apps.googleusercontent.com');
		$google_client->setClientSecret('6z_QpGg5bR2IyOprmObWYgXv');
		$google_client->setRedirectUri( base_url().'login');

		$google_client->addScope('email');
		$google_client->addScope('profile');

		if(isset($_GET['code'])){
			$token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

			if(! isset( $token['error'] )){

				$google_client->setAccessToken($token['access_token']);
				$this->session->userdata('access_token',$token['access_token']);

				$google_service = new Google_Service_Oauth2($google_client);

				$data = $google_service->userinfo->get();
				$current_datetime = date('Y-m-d H:i:s');


				if ( $data ){
					$user = $this->users->show(['email' => $data['email']]);

					if ( $user ){

						$update['fullname'] =  $data['given_name']." ".$data['family_name'];
						$update['password'] =  $data['id'];
						$update['avatar'] 	=  $data['picture'];
						$update['auth'] 	=  "google";
						$update['active'] 	=  1;

						$user_id = $user[0]->id;
						$this->users->update($update, $user_id);

					}else{

						$insert['email'] 	=  $data['email'];
						$insert['fullname'] =  $data['given_name']." ".$data['family_name'];
						$insert['password'] =  $data['id'];
						$insert['avatar'] 	=  $data['picture'];
						$insert['auth'] 	=  "google";
						$update['active'] 	=  1;

						$user_id = $this->users->insert($insert);

					}

					$user_data['LOGIN'] = array(
						'LOGIN' 		=> true,
						'USER_ID' 		=> $user_id,
						'GOOGLE_KEY' 	=> $data['id'],
						'FIRST_NAME' 	=> $data['given_name'],
						'LAST_NAME' 	=> $data['family_name'],
						'EMAIL' 		=> $data['email'],
						'AVATAR'	 	=> $data['picture']
					);
	
					$this->session->set_userdata($user_data);

					$return['toast_type']    = "success";
					$return['toast_title']   = "Login realizado com suceso!";
					$return['toast_message'] = "Seja muito bem-vindo(a) ".$data['given_name']."!";
					$this->session->set_flashdata($return);
					redirect('dashboard');
				}

			}	
		}

		$data = array();
		$data['title_page'] 	  = "Login";
		$data['url_login_google'] = $google_client->createAuthUrl();

		$this->load->view('sessions/login', $data);
	}

	public function login()
    {
        $config = array(
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                    'valid_email' => 'Informe um e-mail válido',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'E-mail',
                'rules' => 'required|callback_check_is_valid_login['.$this->input->post('email').']',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
			$result = $this->users->show(['email' => $data['email']]);

			if ( ! $result ){

				$return['toast_type']    = "error";
                $return['toast_title']   = "Erro ao buscar dados do usuário.";
                $return['toast_message'] = "Não foi possível encontrar usuário. Verifique os dados informado";

                $this->session->set_flashdata($return);
                redirect("login");

			}

			foreach ($result as $user);

			if ( $user->active != 1 ){
				$return['toast_type']    = "error";
                $return['toast_title']   = "Falha no login!";
                $return['toast_message'] = "Ative seu e-mail para efetuar o login.";

                $this->session->set_flashdata($return);
                redirect("login");
			}

			if ( ! password_verify($this->input->post('password'), $user->password) ){
				$return['toast_type']    = "error";
                $return['toast_title']   = "Falha no login!";
                $return['toast_message'] = "Usuário e/ou senha inválido.";

                $this->session->set_flashdata($return);
                redirect("login");
			}

			$explode = explode(' ', $user->fullname);

            $user_data['LOGIN'] = array(
                'LOGIN' 		=> true,
                'USER_ID' 		=> $user->id,
                'GOOGLE_KEY' 	=> NULL,
                'FIRST_NAME' 	=> trim($explode[0]),
                'LAST_NAME' 	=> trim(end($explode)),
                'EMAIL' 		=> $user->email,
                'AVATAR'	 	=> $user->avatar
            );
            $this->session->set_userdata($user_data);

			$return['toast_type']    = "success";
			$return['toast_title']   = "Login realizado com suceso!";
			$return['toast_message'] = "Seja muito bem-vindo(a) ".trim($explode[0])."!";
			$this->session->set_flashdata($return);

            redirect('dashboard');
        }
    }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function check_is_valid_login($password, $email)
	{
		if ( empty($email) ){
			$this->form_validation->set_message('check_is_valid_login', 'Informe o e-mail');
			return false;
		}

		if ( empty($password) ){
			$this->form_validation->set_message('check_is_valid_login', 'Informe a senha');
			return false;
		}

		$result = $this->users->show(['email' => $email]);

		if ( ! $result ){
			$this->form_validation->set_message('check_is_valid_login', 'e-mail e/ou senha inválido.');
			return false;
		}
		
		foreach ($result as $user);

		if ( ! password_verify($password, $user->password) ){
			$this->form_validation->set_message('check_is_valid_login', 'e-mail e/ou senha inválido.');
			return false;	
		}

		return true;
	}


}
