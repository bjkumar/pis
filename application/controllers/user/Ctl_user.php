<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctl_user extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user/mdl_user', 'model');
        $this->load->model('mdl_common');
        date_default_timezone_set("Asia/Kolkata");
    }

    public function index() {

        $this->load->view('user/login');
    }

   

    public function login_check() {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        if ($this->form_validation->run() == FALSE) {

            $getdata = $this->model->login_check($email, $password);
            if ($getdata) {
                if ((strlen($getdata['pro_image'])) < 6) {
                    $getdata['pro_image'] = 'user.png';
                }

                $this->db->where('id', $getdata['user_id']);
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

    function user_logout() {
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user', array('active' => '0', 'last_seen' => date("Y-m-d G:i:s", time())));
        $this->session->unset_userdata('dept');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('fname');
        $this->session->unset_userdata('lname');
        $this->session->sess_destroy();
        $this->load->view('user/login');
    }

    function update_user($id) {
        $user['list'] = get_user_list($id);
        $user['dept'] = get_all_department();
        $this->load->view('user/register', $user);
    }

    function user_profile() {
        $array['list'] = $this->model->get_profile_details();
        //print_r($array['list']); die;
        //$this->load->view('user/user_profile', $array);
        $array['middle'] = 'user/user_profile';
        $this->load->view('user/master-page', $array);
    }

    function password_change() {
        $post = $this->input->post();
        $data = $this->model->password_change($post);
        echo $data;
        // print_r($post);
    }

    function get_employee() {
        $id = $this->session->userdata('user_id');
        $emp = $this->mdl_common->get_employee($id);
        echo json_encode($emp);
        /*
        $option = '<select class="form-control"  name="emp_id" name="emp_id">';
        $option .= '<option value="">-- Select --</option>';
        foreach ($emp as $row) {
            $option .= '<option value="' . $row['id'] . '">' . $row['fname'] . ' ' . $row['lname'] . '</option>';
        }
        $option .= '</select>';
        echo ($option);
          */
    }

    function profile_image_change() {


        $img_file = $_FILES['pro_image'];
        $imagePath = UPLOADS . 'profile_pic/';
        /* old image delete */
        if ($this->session->userdata('pro_image') != '') {
            $path = $imagePath . $this->session->userdata('pro_image');
            if (file_exists($path)) {
                unlink($path);
            }
        }
        /* old image delete */
        $height = 250;
        $width = 250;
        $file_details = photo_upload($img_file, $imagePath, $height, $width);


        $this->session->unset_userdata('pro_image');
        $this->session->set_userdata('pro_image', $file_details['upload_image_name']);
        $save_img = $this->model->profile_image_change($file_details['upload_image_name']);
    }

    function add_account() {
        $array['job_type'] = get_job_type();
        $array['middle'] = 'user/add_account';
        $this->load->view('user/master-page', $array);
        // $this->load->view('user/add_account', $array);
    }

    function get_account_type() {
        $account_type = get_account_type();
        $option = '<select class="form-control"  name="account_type" id="ed_account_type"   required>';
        $option .= '<option value="">-- Select --</option>';
        foreach ($account_type as $row) {
            $option .= '<option value="' . $row['id'] . '">' . $row['account_type'] . '</option>';
        }
        $option .= '</select>';
        echo ($option);
    }

    function get_account_type_plp() {
        $account_type = $this->mdl_common->get_account_type_plp();
        $option = '<select class="form-control"  name="plp_account_type" id="plp_account_type" required>';
        $option .= '<option value="">-- Select --</option>';
        foreach ($account_type as $row) {
            $option .= '<option value="' . $row['id'] . '">' . $row['account_type'] . '</option>';
        }
        $option .= '</select>';
        echo ($option);
    }

    function get_request_type() {
        
        $request_type = $this->mdl_common->get_request_type();
        echo json_encode($request_type); 
     }

    function get_requester() {
        $requester = $this->mdl_common->get_requester();
        echo json_encode($requester);
     }

    function get_program_rpm() {
        $program = $this->mdl_common->get_program_rpm();
         echo json_encode($program);
         /*
        $option = '<select class="form-control" name="program_rpm" id="program_rpm" required>';
        $option .= '<option value="">-- Select --</option>';
        foreach ($program as $row) {
            $option .= '<option value="' . $row['id'] . '">' . $row['program_rpm'] . '</option>';
        }
        $option .= '</select>';
        echo ($option);
          */
    }

    function get_pm_list() {
        $revert_type = get_pm_list();
        echo json_encode($revert_type);
    }

    function get_tgram_id() {
        $revert_type = get_tgram_id();
        echo json_encode($revert_type); 
    }

    function get_leave_days() {
        $post = $this->input->post();
        $days = get_leave_days($post);
        echo $days;
    }

    function save_edit_details() {
        $post = $this->input->post();
        $data = $this->model->save_edit_details($post);
        echo $data;
    }
    
    function update_edit_details_by_user() {
        $post = $this->input->post();
        $data = $this->model->update_edit_details_by_user($post);
         print_r($data);
    }
    
    function update_plp_details_by_user() {
        $post = $this->input->post();
        $data = $this->model->update_plp_details_by_user($post);
        echo $data;
    }

    function save_plp_details() {
        $post = $this->input->post();  //print_r($post); die;
        $data = $this->model->save_plp_details($post);
        echo $data;
    }

    function save_rpm_details() {
        $post = $this->input->post();  //print_r($post); die;
        $data = $this->model->save_rpm_details($post);
        echo $data;
    }

    function update_profile_details() {
        $post = $this->input->post();
        $data = $this->model->update_profile_details($post);
        echo $data;
    }

}
