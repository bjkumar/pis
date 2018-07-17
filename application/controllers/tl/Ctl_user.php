<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctl_user extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('tl/mdl_user', 'model');
        $this->load->model('mdl_common');
        date_default_timezone_set("Asia/Kolkata");
    }

    public function index() {
        $this->load->view('tl/login');
    }

    
    
    public function login_check() {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        if ($this->form_validation->run() == FALSE) {

            $getdata = $this->model->login_check($email, $password);
            if ($getdata) {
                //echo '<pre>'; print_r($getdata); echo '</pre>'; die;
                //echo $getdata['name'];  die;
                $this->db->where('id', $getdata['user_id_tl']);
                $this->db->update('user', array('active' => '1'));
                $this->session->set_userdata($getdata);
                echo '10';
            } else {
                echo '1';
            }
        } else {
            echo '0';
            die();
        }
    }

    function home() {
        $array['edit_del'] = $this->mdl_common->get_monthly_delivery('tbl_edit');
        $array['plp_del'] = $this->mdl_common->get_monthly_delivery('tbl_plp');
        $array['rpm_del'] = $this->mdl_common->get_monthly_delivery('tbl_rpm');

        $array['edi_ed'] = $this->mdl_common->get_monthly_received('tbl_edit');
        $array['plp_ed'] = $this->mdl_common->get_monthly_received('tbl_plp');
        $array['rpm_ed'] = $this->mdl_common->get_monthly_received('tbl_rpm');
        //echo '<pre>'; print_r($array['edit_del']); echo '</pre>';

        $array['middle'] = 'tl/home';
        $this->load->view('tl/master-page', $array);
    }

    function user_logout() {
        $this->db->where('id', $this->session->userdata('user_id_tl'));
        $this->db->update('user', array('active' => '0', 'last_seen' => date("Y-m-d G:i:s", time())));
        $this->session->unset_userdata('dept_tl');
        $this->session->unset_userdata('user_id_tl');
        $this->session->unset_userdata('email_tl');
        $this->session->unset_userdata('fname_tl');
        $this->session->unset_userdata('lname_tl');
        $this->session->sess_destroy();
        $this->load->view('tl/login');
    }

    function user_profile() {
        $array['list'] = $this->model->get_profile_details();
        //print_r($list); die;
        //$this->load->view('tl/user_profile', $array);
        $array['middle'] = 'tl/user_profile';
        $this->load->view('tl/master-page', $array);
    }

    function password_change() {
        $post = $this->input->post();
        $data = $this->model->password_change($post);
        echo $data;
        // print_r($post);
    }

    function profile_image_change() {


        $img_file = $_FILES['pro_image'];
        $imagePath = UPLOADS . 'profile_pic/';
        /* old image delete */
        if ($this->session->userdata('pro_image_tl') != '') {
            $path = $imagePath . $this->session->userdata('pro_image_tl');
            if (file_exists($path)) {
                unlink($path);
            }
        }
        /* old image delete */
        $height = 250;
        $width = 250;
        $file_details = photo_upload($img_file, $imagePath, $height, $width);
        $this->session->unset_userdata('pro_image_tl');
        $this->session->set_userdata('pro_image_tl', $file_details['upload_image_name']);
        $save_img = $this->model->profile_image_change($file_details['upload_image_name']);
    }

    function add_account() {
        $array['job_type'] = get_job_type();
        $array['middle'] = 'user/add_account';
        $this->load->view('tl/master-page', $array);
    }

    function get_account_type() {
        $account_type = get_account_type();
        $option = '<select class="form-control"  name="account_type" id="ed_account_type"  required>';
        $option .= '<option value="">-- Select --</option>';
        foreach ($account_type as $row) {
            $option .= '<option value="' . $row['account_type'] . '">' . $row['account_type'] . '</option>';
        }
        $option .= '</select>';
        echo ($option);
    }

    function get_pm_list() {
        $pmlist = get_pm_list();
        echo json_encode($pmlist);
    }

    function get_tgram_id() {
        $tgramid = get_tgram_id();
        echo json_encode($tgramid);
    }

    function get_leave_days() {
        $post = $this->input->post();
        $days = get_leave_days($post);
        echo $days;
    }

//    function edit_list() {
//        $dept_id = $this->session->userdata('dept_tl');
//        $result['list'] = get_edit_list(null);
//        //print_r($result['list']); die;
//        $this->load->view('tl/edit_list', $result);
//    }

    function get_edit_list_noti() {
        $this->load->model('Mdl_common');
        $dept_id = $this->session->userdata('dept_id');
        //print_r($dept_id); die;
        $result = array();
        $edit_list = $this->Mdl_common->get_edit_list_noti($dept_id);
        $result['edit_list'] = $edit_list;
        // $result['second_table'] = $secondarray;
        echo json_encode($result);
        // print_r($result); die; 
    }

    function update_edit_details() {
        $post = $this->input->post();
        $data = $this->model->update_edit_details($post);
        echo $data;
    }

    function update_plp_details() {
        $post = $this->input->post();
        $data = $this->model->update_plp_details($post);
        echo $data;
    }

    function update_rpm_details() {
        $post = $this->input->post(); //print_r($post); die;
        $data = $this->model->update_rpm_details($post);
        echo $data;
    }

    function update_profile_details() {
        $post = $this->input->post();
        $data = $this->model->update_profile_details($post);
        echo $data;
    }
    
    
    
    /* **********************  QC Login ********************************************* */
    
    public function qc_login() {
        $this->load->view('qc/login');
    }

    
    
    public function qc_login_check() {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        if ($this->form_validation->run() == FALSE) {

            $getdata = $this->model->qc_login_check($email, $password);
            if ($getdata) {
                //echo '<pre>'; print_r($getdata); echo '</pre>'; die;
                //echo $getdata['name'];  die;
                $this->db->where('id', $getdata['user_id_qc']);
                $this->db->update('user', array('active' => '1'));
                $this->session->set_userdata($getdata);
                echo '10';
            } else {
                echo '1';
            }
        } else {
            echo '0';
            die();
        }
    }
    
     function qc_user_profile() {
        $array['list'] = $this->model->get_profile_details();
        //print_r($list); die;
        //$this->load->view('tl/user_profile', $array);
        $array['middle'] = 'qc/user_profile';
        $this->load->view('qc/master-page', $array);
    }
    
    function qc_user_logout() {
        $this->db->where('id', $this->session->userdata('user_id_tl'));
        $this->db->update('user', array('active' => '0', 'last_seen' => date("Y-m-d G:i:s", time())));
        $this->session->unset_userdata('dept_tl');
        $this->session->unset_userdata('user_id_qc');
        $this->session->unset_userdata('email_tl');
        $this->session->unset_userdata('fname_tl');
        $this->session->unset_userdata('lname_tl');
        $this->session->sess_destroy();
        $this->load->view('qc/login');
    }
    
    function qc_home() {
        $array['edit_del'] = $this->mdl_common->get_monthly_delivery('tbl_edit');
        $array['plp_del'] = $this->mdl_common->get_monthly_delivery('tbl_plp');
        $array['rpm_del'] = $this->mdl_common->get_monthly_delivery('tbl_rpm');

        $array['edi_ed'] = $this->mdl_common->get_monthly_received('tbl_edit');
        $array['plp_ed'] = $this->mdl_common->get_monthly_received('tbl_plp');
        $array['rpm_ed'] = $this->mdl_common->get_monthly_received('tbl_rpm');
        //echo '<pre>'; print_r($array['edit_del']); echo '</pre>';

        $array['middle'] = 'qc/home';
        $this->load->view('qc/master-page', $array);
    }

}
