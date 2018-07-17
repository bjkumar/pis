<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctl_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/mdl_admin', 'model');
        $this->load->model('mdl_common');
        date_default_timezone_set("Asia/Kolkata");
    }

    public function index() {
        $this->load->view('admin/login');
    }

    public function login_check() {

        $name = $this->input->post('name');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[admin.name]');
        if ($this->form_validation->run() == FALSE) {

            $getdata = $this->model->login_check($name, $password);
            if ($getdata) {
                //echo $getdata['name'];  die;
                $this->session->set_userdata($getdata);
                echo '10';
                // $tname = $this->session->userdata('admin_id');  echo $tname;
                //redirect('ctl_user');
                // $this->load->view('dashboard/user_list');
            } else {
                echo '1';
            }
        } else {
            echo '0';
            die();
        }
    }

    function admin_logout() {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('profile_pic');
        $this->session->sess_destroy();
        $this->load->view('admin/login');
    }

    function save_user() {
        $email = $this->input->post('email');
        $post = $this->input->post();
        if (isset($post['id'])) {
            $updateddata = $this->model->update_user($post);
            echo 3;
            die;
        }
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        if ($this->form_validation->run() == FALSE) {
            echo 1; // email already exists//
        } else {
            $savedata = $this->model->save_user($post);
            echo $savedata;
        }
    }

    function save_user_self() {
        $post = $this->input->post();
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        if ($this->form_validation->run() == FALSE) {
            echo 1; // email already exists//
        } else {
            $savedata = $this->model->save_user_self($post);
            echo $savedata;
        }
    }

    function delete_standard($val) {
        $val = explode(':', $val);
        $id = $val['0'];
        $table = $val['1'];
        $del = $this->model->delete_standard($id, $table);
    }

    function update_status_standard() {
        $post = $this->input->post();
        $savedata = $this->model->update_status_standard($post);
        echo $savedata;
    }

    function update_status() {
        $post = $this->input->post();

        $savedata = $this->model->update_status($post);
        echo $savedata;
    }

    function update_Tgrams() {
        $post = $this->input->post();
        $updatedata = $this->model->update_Tgrams($post);
        echo $updatedata;
    }

    function update_account_type() {
        $post = $this->input->post();
        $updatedata = $this->model->update_account_type($post);
        echo $updatedata;
    }

    function update_pm() {
        $post = $this->input->post();
        $updatedata = $this->model->update_pm($post);
        echo $updatedata;
    }

    function update_leaves() {
        $post = $this->input->post();
        $updatedata = $this->model->update_leaves($post);
        echo $updatedata;
    }

    function update_user($id) {
        $user['list'] = $this->model->get_user_list($id);
        $user['dept'] = $this->model->get_all_department();
        $this->load->view('admin/register', $user);
    }

    function user_list() {
        $user['list'] = $this->model->get_user_list($id = null);
        $user['dept'] = $this->model->get_all_department();
// echo "<pre>";
// print_r($user['list']);
// echo "</pre>";
        $this->load->view('admin/user_list', $user);
    }

    function testemail() {
        $this->load->library('email');

//SMTP & mail configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.technosofteng.in',
            'smtp_port' => 587,
            'smtp_user' => 'donotreply@technosofteng.in',
            'smtp_pass' => 'donotreply@1',
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

//Email content
        $htmlContent = '<h1>Sending email via SMTP server</h1>';
        $htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

        $this->email->to('bjkumar@technosofteng.com');
        $this->email->from('bjkumar@technosofteng.com', 'MyWebsite');
        $this->email->subject('How to send email via SMTP server in CodeIgniter');
        $this->email->message($htmlContent);

//Send email
        $this->email->send();
        echo $this->email->print_debugger();
    }

    function register() {
        $user['list'] = '';
        $user['dept'] = $this->model->get_all_department();

        $this->load->view('admin/register', $user);
    }

    function home() {
        $result['edit_del'] = $this->mdl_common->get_monthly_delivery('tbl_edit');
        $result['plp_del'] = $this->mdl_common->get_monthly_delivery('tbl_plp');
        $result['rpm_del'] = $this->mdl_common->get_monthly_delivery('tbl_rpm');

        $result['edi_ed'] = $this->mdl_common->get_monthly_received('tbl_edit');
        $result['plp_ed'] = $this->mdl_common->get_monthly_received('tbl_plp');
        $result['rpm_ed'] = $this->mdl_common->get_monthly_received('tbl_rpm');
        // echo '<pre>'; print_r($result); echo '</pre>';
        $this->load->view('admin/home', $result);
    }

    function tgrams() {
        $array['list'] = $this->model->get_tgram_list();
        $this->load->view('admin/tgrams', $array);
    }

    function leave_dates() {
        $array['list'] = $this->model->get_leave_dates();
        $this->load->view('admin/leave_dates', $array);
    }

    function account_type($delete_id = null) {
        if ($delete_id) {
            $table = 'account_type';
            $field = 'id';
            delete_standard($field, $delete_id, $table);
        }
        $array['list'] = get_account_type();
        $this->load->view('admin/account_type', $array);
    }

    function account_type_plp($delete_id = null) {
        if ($delete_id) {
            $table = 'account_type_plp';
            $field = 'id';
            delete_standard($field, $delete_id, $table);
        }
        $array['list'] = $this->mdl_common->get_account_type_plp();
        $this->load->view('admin/account_type_plp', $array);
    }

    function program_rpm($delete_id = null) {
        if ($delete_id) {
            $table = 'program_rpm';
            $field = 'id';
            delete_standard($field, $delete_id, $table);
        }
        $array['list'] = $this->mdl_common->get_program_rpm();
        $this->load->view('admin/program_rpm', $array);
    }

    function requester_rpm($delete_id = null) {
        if ($delete_id) {
            $table = 'requester';
            $field = 'id';
            delete_standard($field, $delete_id, $table);
        }
        $array['list'] = $this->mdl_common->get_requester();
        $this->load->view('admin/requester_rpm', $array);
    }

    function request_type_rpm($delete_id = null) {
        if ($delete_id) {
            $table = 'request_type';
            $field = 'id';
            delete_standard($field, $delete_id, $table);
        }
        $array['list'] = $this->mdl_common->get_request_type();
        $this->load->view('admin/request_type_rpm', $array);
    }

    function pm($delete_id = null) {
        if ($delete_id) {
            $table = 'pm';
            $field = 'id';
            delete_standard($field, $delete_id, $table);
        }
        $array['list'] = get_pm_list();
        $this->load->view('admin/pm', $array);
    }

    function my404() {
        $this->load->view('admin/my404');
    }
 
    function get_Count_all_list() {
        $edit = $this->mdl_common->get_standerd_count('tbl_edit');
        $plp = $this->mdl_common->get_standerd_count('tbl_plp');
        $rpm = $this->mdl_common->get_standerd_count('tbl_rpm');
        $edit_unrd = $this->mdl_common->get_standerd_count_unread('tbl_edit');
        $plp_unrd = $this->mdl_common->get_standerd_count_unread('tbl_plp');
        $rpm_unrd = $this->mdl_common->get_standerd_count_unread('tbl_rpm');

        $newarr = array(
            'Edit' => $edit,
            'PLP' => $plp,
            'RPM' => $rpm,
            'Edit_unrd' => $edit_unrd,
            'PLP_unrd' => $plp_unrd,
            'RPM_unrd' => $rpm_unrd,
        );
        echo json_encode($newarr);
    } 
    
    
    

}
