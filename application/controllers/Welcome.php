<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
       // $this->load->view('welcome_message');
        
        $this->load->view('home');
        
    }

    function my404() {
        $this->load->view('dashboard/my404');
    }
    
    function phpinfo() {
        print_r(phpinfo ());
        echo '<br/><br/> Port: ';
        print_r($_SERVER['SERVER_PORT']);
         echo '<br/><br/> CERT Locations: '; 
        print_r(openssl_get_cert_locations());
    }
    
    function curl(){
        $curl = curl_init('http://example.com'); 
curl_setopt($curl, CURLOPT_FAILONERROR, true); 
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   
$result = curl_exec($curl); 
echo $result;
    }
    
    function give_password($password){
         echo encode3t($password);
    }
    
    function take_password($password){
       // $password = '==AUXRWVUhFZKVWbORTUVh2V';
       echo decode3t($password);
    }
    
     function send_mail() {
         
   $from_mail  ='bjkumar@technosofteng.com'; 
   $from_name = 'Binod'; 
   $to = 'bjkumar@technosofteng.com'; 
   $subject = 'Test_Mail'; 
   $message = 'HEllo Teasting';
   
        $this->load->library('email'); 

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASS,
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );  
        /*
         $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'localhost',
            'smtp_port' => '25',
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASS,
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );
       */ 
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->to($to);
        $this->email->from($from_mail, $from_name);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
    }
    
   

}
