<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){

		parent::__construct();
        $this->load->model('client/users_model', 'users');
	}

    public function index()
    {
        $this->register();
    }

    public function register()
    {
        $data = array();
		$this->load->view('user/register', $data);
    }

    public function save()
    {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Nome',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                    'valid_email' => 'Informe um e-mail válido',
                    'is_unique' => 'e-mail já cadastrado anteriormente.',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Senha',
                'rules' => 'required|min_length[6]',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                    'min_length' => 'Sua senha deve conter no mínimo 06 caracteres.',
                ),
            ),
            array(
                'field' => 'password_match',
                'label' => 'Confirmação de senha',
                'rules' => 'required|matches[password]',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                    'matches'  => 'As senhas não conferem.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $this->register();
        }
        else
        {
            $user['fullname']   = $this->input->post('name');
            $user['email']      = $this->input->post('email');
            $user['avatar']     = base_url()."assets/client/template/img/avatar/default_man.png";
            $user['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $user['auth']       = "database";

            $user_id = $this->users->insert($user);

            if ( ! $user_id ){

                $return['toast_type']    = "error";
                $return['toast_title']   = "Erro ao realizar cadastro.";
                $return['toast_message'] = "Falha ao tentar realizar cadastro do usuário";

                $this->session->set_flashdata($return);
                redirect("user");
            }

            // send to email confirmation
            $this->load->library('email');

            $hash_mail    = md5($this->input->post('email'));
            $active_login = base_url()."user/active/{$hash_mail}/{$user_id}";

            $body  = "";
            $body .= "Falta pouco para você acessar a plataforma Diário Trader. Basta ativar seu Login<br>";
            $body .= "<a href='{$active_login}' target='_blank'>Clique aqui para ativar seu login ou copie e cole o link abaixo em seu navegador</a><br>";
            $body .= $active_login;

            $mail_config['to_mail']  = $this->input->post('email');
            $mail_config['subject']  = '- Ative seu Login -';
            $mail_config['cc']       = null;
            $mail_config['bcc']      = null;
            $mail_config['files']    = null;
            $mail_config['body']     = $body;

            $sendMail = $this->email->mySendMail($mail_config);

            if(!$sendMail){

                $return['toast_type']    = "error";
                $return['toast_title']   = "Erro ao realizar cadastro.";
                $return['toast_message'] = "Falha ao tentar enviar e-mail de confirmação";

                $this->session->set_flashdata($return);
                redirect("user");
            }
            
            $return['toast_type']    = "success";
            $return['toast_title']   = "Cadastro realizado com sucesso!";
            $return['toast_message'] = "Entre em seu e-mail e clique no link para validar seu login!";

            $this->session->set_flashdata($return);
            redirect("user");
            
        }
    }

    public function activeUser($encrypt_mail = null, $user_id = null)
    {
        if (empty($encrypt_mail) || empty($user_id)){
            $return['toast_type']    = "error";
            $return['toast_title']   = "Falha ao ativar login!";
            $return['toast_message'] = "Verifique a URL de ativação!";

            $this->session->set_flashdata($return);
            redirect("login");
        }

		$result = $this->users->show(['id' => $user_id]);
        
        if (!$result){
            $return['toast_type']    = "error";
            $return['toast_title']   = "Falha ao ativar login!";
            $return['toast_message'] = "Dados de ativação inválido!";

            $this->session->set_flashdata($return);
            redirect("login");
        }
        foreach ($result as $user);

        if ( $encrypt_mail != md5($user->email) ){
            $return['toast_type']    = "error";
            $return['toast_title']   = "Falha ao ativar login!";
            $return['toast_message'] = "Dados de ativação inválido!";

            $this->session->set_flashdata($return);
            redirect("login");
        }

        $this->users->update(['active' => 1], $user_id );

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
        redirect("dashboard");

    }

    public function recoveryPassword()
    {
        $data = array();
		$this->load->view('user/recovery_password', $data);
    }

    public function forgotPassword()
    {
        $config = array(
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'callback_check_email_exist',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                    'valid_email' => 'Informe um e-mail válido',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $this->recoveryPassword();
        }
        else
        {

    		$result = $this->users->show(['email' => $email]);

            if (!$result){
                $return['toast_type']    = "error";
                $return['toast_title']   = "Falha ao reenviar senha ao email cadastrado!";
                $return['toast_message'] = "Verifique o e-mail informado";
    
                $this->session->set_flashdata($return);
                redirect("recovery-password");
            }

            foreach ($result as $user);

            // send to email confirmation
            $this->load->library('email');

            $hash_mail    = md5($this->input->post('email'));
            $reset_password = base_url()."user/reset-password/{$hash_mail}/{$user_id}";

            $body  = "";
            $body .= "Você solicitou a recuperação de senha!<br>";
            $body .= "<a href='{$reset_password}' target='_blank'>Clique aqui para cadastrar uma nova senha ou copie e cole o link abaixo em seu navegador</a><br>";
            $body .= $reset_password;
            $body .= "<br>Caso você não tenha solicitado a alteração desconsidere esse e-mail.";

            $mail_config['to_mail']  = $this->input->post('email');
            $mail_config['subject']  = '- Recuperação de senha -';
            $mail_config['cc']       = null;
            $mail_config['bcc']      = null;
            $mail_config['files']    = null;
            $mail_config['body']     = $body;

            $sendMail = $this->email->mySendMail($mail_config);

            if(!$sendMail){

                $return['toast_type']    = "error";
                $return['toast_title']   = "Erro ao realizar cadastro.";
                $return['toast_message'] = "Falha ao tentar enviar e-mail de recuperação de senha";

                $this->session->set_flashdata($return);
                redirect("recovery-password");
            }
            
            $return['toast_type']    = "success";
            $return['toast_title']   = "e-mail enviado com sucesso!";
            $return['toast_message'] = "Entre em seu e-mail e clique no link para recuperar a senha do seu login!";

            $this->session->set_flashdata($return);
            redirect("login");

        }
    }

    public function resetPassword($encrypt_mail = null, $user_id = null)
    {
        if (empty($encrypt_mail) || empty($user_id)){
            $return['toast_type']    = "error";
            $return['toast_title']   = "Falha ao recuperar senha";
            $return['toast_message'] = "Verifique a URL!";

            $this->session->set_flashdata($return);
            redirect("login");
        }

		$result = $this->users->show(['id' => $user_id]);
        
        if (!$result){
            $return['toast_type']    = "error";
            $return['toast_title']   = "Falha ao recuperar senha";
            $return['toast_message'] = "Dados da URL inválido!";

            $this->session->set_flashdata($return);
            redirect("login");
        }
        foreach ($result as $user);

        if ( $encrypt_mail != md5($user->email) ){
            $return['toast_type']    = "error";
            $return['toast_title']   = "Falha ao recuperar senha";
            $return['toast_message'] = "Dados da URL inválido!";

            $this->session->set_flashdata($return);
            redirect("login");
        }

        $data = array();
        $data['encrypt_mail']   = $encrypt_mail;
        $data['user_id']        = $user_id;

		$this->load->view('user/reset_password', $data);
    }

    public function savePassword()
    {
        $config = array(
            array(
                'field' => 'password',
                'label' => 'senha',
                'rules' => 'required|min_length[6]',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                    'min_length' => 'Sua senha deve conter no mínimo 06 caracteres.',
                ),
            ),
            array(
                'field' => 'password_match',
                'label' => 'Confirmação de senha',
                'rules' => 'required|matches[password]',
                'errors' => array(
                    'required' => 'Campo Obrigatório',
                    'matches'  => 'As senhas não conferem.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        $encrypt_mail   = $this->input->post('encrypt_mail');
        $user_id        = $this->input->post('user_id');

        if ($this->form_validation->run() == FALSE)
        {            
            $this->resetPassword($encrypt_mail, $user_id);
        }
        else
        {

            if (empty($encrypt_mail) || empty($user_id)){
                $return['toast_type']    = "error";
                $return['toast_title']   = "Falha ao recuperar senha";
                $return['toast_message'] = "Verifique a URL!";
    
                $this->session->set_flashdata($return);
                redirect("login");
            }
    
            $result = $this->users->show(['id' => $user_id]);
            
            if (!$result){
                $return['toast_type']    = "error";
                $return['toast_title']   = "Falha ao recuperar senha";
                $return['toast_message'] = "Dados da URL inválido!";
    
                $this->session->set_flashdata($return);
                redirect("login");
            }
            foreach ($result as $user);
    
            if ( $encrypt_mail != md5($user->email) ){
                $return['toast_type']    = "error";
                $return['toast_title']   = "Falha ao recuperar senha";
                $return['toast_message'] = "Dados da URL inválido!";
    
                $this->session->set_flashdata($return);
                redirect("login");
            }

            $update['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $update['auth']       = "database";

            if ( ! $this->users->update($update, $user_id) ){
                $return['toast_type']    = "error";
                $return['toast_title']   = "Falha ao atualizar nova senha";
                $return['toast_message'] = "tente mais tarde, novamente!";
    
                $this->session->set_flashdata($return);
                redirect("user/reset-password/{$encrypt_mail}/{$user_id}");
            }


            $return['toast_type']    = "success";
            $return['toast_title']   = "Senha atualizada com sucesso";
            $return['toast_message'] = "Faça o login utilizando sua nova senha!";

            $this->session->set_flashdata($return);
            redirect("login");
        }


    }

	public function check_email_exist($email)
	{
		if ( empty($email) ){
			$this->form_validation->set_message('check_email_exist', 'Informe o e-mail');
			return false;
		}

		$result = $this->users->show(['email' => $email]);

		if ( ! $result ){
			$this->form_validation->set_message('check_email_exist', 'e-mail não encontrado. Verifique o e-mail informado.');
			return false;
		}

		return true;
	}



}