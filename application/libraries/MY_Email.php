<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Email extends CI_Email{

        private $ci;
        
        function __construct()
        {
           parent::__construct();
           
           $this->ci=& get_instance();
           
        }

        /*
        mail_config array
        ['from_mail']   => '',    // default = noreply@diariotrader.com.br
        ['from_name']   => '',    // default = Diário de Trader
        ['to_mail']     => '',
        ['subject']     => '',
        ['cc']          => '',
        ['bcc']         => '',
        ['files']       => '',
        ['template']    => '',    // default = default
        ['body']        => '',
        */
        public function mySendMail($mail_config = null)
        {

                $config = array(
                        'useragent' => 'Diario de Trader',
                        'protocol'  => 'mail',
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8'
                );  

                $this->initialize($config);
                
                $this->from( ( isset($mail_config['from_mail']) ) ? $mail_config['from_mail'] : 'noreply@diariotrader.com.br', ( isset($mail_config['from_name']) ) ? $mail_config['from_name'] : 'Diário de Trader' );
                $this->to($mail_config['to_mail']);
                $this->subject($mail_config['subject']);
                
                $this->cc($mail_config['cc']);
                $this->bcc($mail_config['bcc']);

                if(!empty($mail_config['files'])){
                        foreach ($mail_config['files'] as $key => $value) {
                                $this->attach($value, 'attachment', $key);
                        }
                }

                $message = $this->ci->load->view("emails/".(!is_null($mail_config['template']) ? $mail_config['template'] : 'default'), $mail_config['body'], TRUE);
    
                $this->message($message); 

                return $this->send();;
                
        }

}