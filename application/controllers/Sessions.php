<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {

	public function index()
	{
		include_once APPPATH."libraries/vendor/autoload.php";

		$google_client = new Google_Client();

		$google_client->setClientId('32431159595-36lhe8ts7l5bggrk4bmtorlkm89njgqi.apps.googleusercontent.com');
		$google_client->setClientSecret('6z_QpGg5bR2IyOprmObWYgXv');
		$google_client->setRedirectUri('http://localhost/diario-trader/login');

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

				$user_data['LOGIN'] = array(
						'id' 			=> $data['id'],
						'first_name' 	=> $data['given_name'],
						'last_name' 	=> $data['family_name'],
						'email' 		=> $data['email'],
						'avatar'	 	=> $data['picture']
				);

				$this->session->set_userdata($user_data);

				redirect('dashboard');

			}	
		}

		$login_button = "<a href='".$google_client->createAuthUrl()."'>LOGIN GOOGLE</a>";

		$data = array();

		$data['title_page'] = "Login";
		$data['login_button'] = $login_button;


		$this->load->view('sessions/login', $data);
	}
}
