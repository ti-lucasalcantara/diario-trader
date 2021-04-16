<?php

class MY_Controller extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        $this->validate_sesssion();
    }

    public function validate_sesssion($data = null){

        if(!$this->session->LOGIN){

            
            $return['toast_type']    = "error";
            $return['toast_title']   = "Acesso negado.";
            $return['toast_message'] = "Faça o login para continuar";

            $this->session->set_flashdata($return);
            redirect( isset($data['current_url']) ? $data['current_url'] : "login");
        }

        return true;
    }

}