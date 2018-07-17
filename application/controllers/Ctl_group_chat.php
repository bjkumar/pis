<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctl_group_chat extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_common');
        date_default_timezone_set("Asia/Kolkata");
        // $this->load->library('excel');
    }

    public function index() {

        
        if ($this->session->userdata('user_id')) {
           $array['middle'] = 'user/group_chat';
        $this->load->view('user/master-page', $array);
        }
        if ($this->session->userdata('user_id_tl')) {
           $array['middle'] = 'tl/group_chat';
           $this->load->view('tl/master-page', $array);
        }
    }

    function Send_Message_test_delete() {

        require_once './application/third_party/Pusher.php';
        //  echo './application/third_party/vendor/autoload.php'; 
        //require 'vendor/autoload.php';
        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );
        // $pusher = new Pusher\Pusher("APP_KEY", "APP_SECRET", "APP_ID", array('cluster' => 'APP_CLUSTER'));
        $pusher = new Pusher\Pusher('127a9e8e9fb64bacfebc', '48b7beaf229d0fab5b89', '526637', array('cluster' => 'ap2', 'encrypted' => true));
//  $pusher = new Pusher\Pusher(
//    '5934f8f46c2e000e0568',
//    '242ba6405673be175575',
//    '526547',
//    $options
//  );
        $data['chat_message'] = $this->input->post('chat_message');
        $data['sender_id'] = $this->input->post('sender_id');
        $data['receiver_id'] = $this->input->post('receiver_id');
        $data['guest_name'] = $this->input->post('guest_name');
        // $data['message'] = 'hello world';
        $pusher->trigger('my-channel', 'my-event', $data);

        //** Save messages **/
        $this->mdl_common->save_timeline($data);
        //** Save messages end**/
    }

    function Send_Message() {
        require_once './application/third_party/Pusher.php';
        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );
        $pusher = new Pusher\Pusher('127a9e8e9fb64bacfebc', '48b7beaf229d0fab5b89', '526637', array('cluster' => 'ap2', 'encrypted' => true));

        $data['chat_message'] = $this->input->post('chat_message');
        $data['sender_id'] = $this->input->post('sender_id');
        $data['receiver_id'] = $this->input->post('receiver_id');
        $data['guest_name'] = $this->input->post('guest_name');
        $data['sender_name'] = $this->input->post('sender_name');
        $data['sender_img'] = $this->input->post('sender_img');
        $data['read_chat'] = $this->input->post('read_chat');
        $data['send_time'] = date("Y-m-d G:i:s", time());

      //  $pusher->trigger('MyChannel' . $data['receiver_id'], 'event-request', $data);
         // header("Content-Type: application/json");
          $pusher->trigger('MyChannel' . $data['receiver_id'], 'event-request', $data);

        $this->mdl_common->save_timeline($data);
    }

    function Auth_End_Point() {
        // session_start();

        require_once './application/third_party/Pusher.php';
        $pusher = new Pusher\Pusher('127a9e8e9fb64bacfebc', '48b7beaf229d0fab5b89', '526637', array('cluster' => 'ap2', 'encrypted' => true));
        //  require_once("pusher_info.php");
        /*
          if (!isset($_SESSION["user_id"])) {
          $_SESSION["user_id"] = time();
          }
         */
        //  $_SESSION["user_id"] = time();
        if ($this->session->userdata('user_id')) {
            $userid = $this->session->userdata('user_id');
            $user_name = $this->session->userdata('fname');
            $pro_image = $this->session->userdata('pro_image');
        }
        if ($this->session->userdata('user_id_tl')) {
            $userid = $this->session->userdata('user_id_tl');
            $user_name = $this->session->userdata('fname_tl');
            $pro_image = $this->session->userdata('pro_image_tl');
        }

        $channel_name = $this->input->post('channel_name');
        $socket_id = $this->input->post('socket_id');
        header("Content-Type: application/json");
// check user has access to $channel_name
        //echo $pusher->presence_auth($channel_name, $_POST["socket_id"], $_SESSION["user_id"], array("id" => $_SESSION["user_id"]));
        echo $pusher->presence_auth($channel_name, $socket_id, $userid, array("id" => $userid, "user_name" => $user_name, "pro_image" => $pro_image));
    }
    
    
    function get_user_info_for_chat() {
        $post = $this->input->post();
        $result = $this->mdl_common->get_user_info_for_chat($post);
        echo json_encode($result);
    }

}
