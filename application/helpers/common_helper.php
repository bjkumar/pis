<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include_once 'Mandrill.php';

function getall_by_email($email) {
    if (!$email) {
        $json_array['status'] = 'error';
        $json_array['msg'] = 'Email Id is Blank!';
        header('Content-Type: application/json');
        echo json_encode($json_array);
        exit;
    }
    $CI = & get_instance();
    $CI->load->model('api/Api_model');
    $user_data = $CI->Api_model->getUserbyEmailid($email);
    if ($user_data) {
        return $user_data;
    } else {
        $json_array['status'] = 'error';
        $json_array['msg'] = 'Invalid Email Id!';
        header('Content-Type: application/json');
        echo json_encode($json_array);
        exit;
        return FALSE;
    }
}

function getall_by_userid($user_id) {
    if (!$user_id) {
        $json_array['status'] = 'error';
        $json_array['msg'] = 'User Id is Blank!';
        header('Content-Type: application/json');
        echo json_encode($json_array);
        exit;
    }
    $CI = & get_instance();
    $CI->load->model('api/Api_model');
    $user_data = $CI->Api_model->getUserbyUserid($user_id);
    if ($user_data) {
        return $user_data;
    } else {
        $json_array['status'] = 'error';
        $json_array['msg'] = 'Invalid User Id!';
        header('Content-Type: application/json');
        echo json_encode($json_array);
        exit;
        return FALSE;
    }
}

function json_output($json_array) {
    header('Content-Type: application/json');
    echo json_encode($json_array);
    exit;
}

function check_doctor_access_token($access_token) {
    if (!$access_token) {
        $json_array['status'] = 'error';
        $json_array['msg'] = 'Doctor Access Token is Blank!';
        header('Content-Type: application/json');
        echo json_encode($json_array);
        exit;
    }
    $CI = & get_instance();
    $CI->load->model('api/Api_model');
    $user_data = $CI->Api_model->getDoctorbyAccessToken($access_token);
    if ($user_data) {
        return $user_data;
    } else {
        $json_array['status'] = 'error';
        $json_array['msg'] = 'Invalid Doctor Access Token!';
        header('Content-Type: application/json');
        echo json_encode($json_array);
        exit;
        return FALSE;
    }
}

/* encrypt all data by 3 times */

function encode3t($str) {
    for ($i = 0; $i < 3; $i++) {
        $str = strrev(base64_encode($str));
    }
    return $str;
}

function decode3t($str) {
    for ($i = 0; $i < 3; $i++) {
        $str = base64_decode(strrev($str));
    }
    return $str;
}

/* encrypt all data by 2 times */

function encode2t($str) {
    for ($i = 0; $i < 2; $i++) {
        $str = strrev(base64_encode($str));
    }
    return $str;
}

function decode2t($str) {
    for ($i = 0; $i < 2; $i++) {
        $str = base64_decode(strrev($str));
    }
    return $str;
}

/* encrypt all data by 4 times */

function encode4t($str) {
    for ($i = 0; $i < 4; $i++) {
        $str = strrev(base64_encode($str));
    }
    return $str;
}

function decode4t($str) {
    for ($i = 0; $i < 4; $i++) {
        $str = base64_decode(strrev($str));
    }
    return $str;
}

/* ... make unique digits ........ */

function generate_unique_digits() {

    $length = 50;
    $salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $len = strlen($salt);
    $makepass = '';
    mt_srand(10000000 * (double) microtime());
    for ($i = 0; $i < $length; $i++) {
        $makepass .= $salt[mt_rand(0, $len - 1)];
    }
    return $makepass;
}

/* * ******************** File Save ************************ */

function photo_upload($image_data, $imagePath, $height, $width) {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $file_details = $CI->mdl_common->photo_upload($image_data, $imagePath, $height, $width);
    return $file_details;
}

function get_all_department() {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_all_department();
    return $array;
}

function get_job_type() {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_job_type();
    return $array;
}

function get_account_type() {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_account_type();
    return $array;
}

function get_tgram_id() {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_tgram_id();
    return $array;
}

function get_pm_list() {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_pm_list();
    return $array;
}

function get_leave_days($post) {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_leave_days($post);
    return $array;
}

function get_user_list($id) {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_user_list($id);
    return $array;
}

function get_edit_list($id) {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_edit_list($id);
    return $array;
}
 
function get_edit_details_byid($id) {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_edit_details_byid($id);
    return $array;
}

function delete_standard($field,$delete_id,$table) {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->delete_standard($field,$delete_id,$table);
    return $array;
}

function get_all_edit_list($tl_id = null){
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_all_edit_list($tl_id = null);
    return $array; 
}
 
function get_day_name($date) {
    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $array = $CI->mdl_common->get_day_name($date);
    return $array;
}

function generateotp($length = 4, $chars = '0123456789') {
    $chars = '0123456789';
    return substr(str_shuffle($chars), 0, $length);
}

function sending_mail_smtp($from_mail, $from_name, $to, $subject, $message) {

    $CI = & get_instance();
    $CI->load->model('mdl_common');
    $send_email = $CI->mdl_common->sending_mail_smtp($from_mail, $from_name, $to, $subject, $message);
}
