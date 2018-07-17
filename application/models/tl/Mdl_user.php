<?php

class Mdl_user extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public $limit = NULL;
    public $offset = 0;

    /**
     * get
     * @author  Binod Yadav
     * @access  public
     * @params  int $id or unique value
     * @params  boolean $row to return single row
     */
    function login_check($email, $password) {
        $query = $this->db->select("
            D_P.department as dept_tl,
            D_P.id as dept_id,
            U_R.id as user_id_tl,
            U_R.email as email_tl,
            U_R.fname as fname_tl,
            U_R.lname as lname_tl,
            U_R.mobile as mobile_tl,
            U_R.pro_image as pro_image_tl,
            U_R.identity
            ")
                ->from('user as U_R')
                ->where('U_R.email', $email)
                ->where('U_R.password', encode3t($password))
                ->where('U_R.status', '1')
                ->where('U_R.identity', 'TL')
                ->join('department as D_P', 'D_P.id = U_R.department')
                ->get();
        $result = $query->row_array();
        return $result;
    }

    function qc_login_check($email, $password) {
        $query = $this->db->select("
            D_P.department as dept_tl,
            D_P.id as dept_id,
            U_R.id as user_id_qc,
            U_R.email as email_tl,
            U_R.fname as fname_tl,
            U_R.lname as lname_tl,
            U_R.mobile as mobile_tl,
            U_R.pro_image as pro_image_tl,
            U_R.identity
            ")
                ->from('user as U_R')
                ->where('U_R.email', $email)
                ->where('U_R.password', encode3t($password))
                ->where('U_R.status', '1')
                ->where('U_R.identity', 'QC')
                ->join('department as D_P', 'D_P.id = U_R.department')
                ->get();
        $result = $query->row_array();
        return $result;
    }

    function password_change($post) {
        $id = $this->session->userdata('user_id_tl');
        $this->db->from('user');
        $this->db->where('password', encode3t($post['oldpassword']));
        $this->db->where('id', $id);
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            $this->db->where('id', $id);
            $this->db->update('user', array('password' => encode3t($post['member_password'])));
            return $count;
            die;
        }
        return $count;
    }

    function profile_image_change($file_name) {
        $id = $this->session->userdata('user_id_tl');
        $this->db->where('id', $id);
        $this->db->update('user', array('pro_image' => $file_name));
    }

    function update_edit_details($post) {
        /************ Save tgram after check & save pm **** */
        $last_tgram_id = $this->mdl_common->save_tgram_by_user($post);
        if ($last_tgram_id) {
            $post['tgrmid'] = $last_tgram_id;
        }
        $this->mdl_common->save_pm_by_user($post);
        
        $id = $this->session->userdata('user_id_tl');
        $update_data = array(
            'tgrmid' => $post['tgrmid'],
            'tgram_id' => $post['tgram_id'],
            'account_name' => $post['account_name'],
            'received_date' => $post['received_date'],
            'revision' => $post['revision'],
            'account_type_id' => $post['account_type_id'],
            'a_t_status' => $post['a_t_status'],
            'pm_id' => $post['pm_id'],
            'return_e' => $post['return_e'],
            're_assigned_date' => $post['re_assigned_date'],
            'pages_worked' => $post['pages_worked'],
            'billing_hour' => $post['billing_hour'],
            'qc_hour' => $post['qc_hour'],
            'total_hour' => $post['total_hour'],
            'actual_hour' => $post['actual_hour'],
            'push_to_live' => $post['push_to_live'],
            'status' => $post['status'],
            'delivered_on' => $post['delivered_on'],
            'days' => $post['days'],
            'invoice_month' => $post['invoice_month'],
            'inv_date' => $post['inv_date'],
            'hours' => $post['hours'],
            'ac_late_hour' => $post['ac_late_hour'],
            'hhmmss' => $post['hhmmss'],
            'late' => $post['late'],
            'm_c_details' => $post['m_c_details'],
            'comments' => $post['comments'],
            'tl_id' => $id,
            'update_time' => date("Y-m-d G:i:s", time()),
            'no_of_edits' => $post['no_of_edits'],
            'no_of_errors' => $post['no_of_errors'],
            'qc_score' => $post['qc_score']
        );
        $this->db->where('id', $post['id']);
        $this->db->update('tbl_edit', $update_data);
        $inserted_rows = $this->db->affected_rows();
        if ($inserted_rows > 0) {
            return 1;
        }
    }

    function update_plp_details($post) {
        
        /************ Save tgram after check & save pm **** */
        $last_tgram_id = $this->mdl_common->save_tgram_by_user($post);
        if ($last_tgram_id) {
            $post['tgrmid'] = $last_tgram_id;
        }
        $this->mdl_common->save_pm_by_user($post);
        
        $id = $this->session->userdata('user_id_tl');
        $update_data = array(
            'tgrmid' => $post['tgrmid'],
            'tgram_id' => $post['tgram_id'],
            'account_name' => $post['account_name'],
            'received_date' => $post['received_date'],
            'cid' => $post['cid'],
            'account_type_id' => $post['account_type_id'],
            //  'a_t_status' => $post['a_t_status'],
            'pm_id' => $post['pm_id'],
            'return_e' => $post['return_e'],
            're_assigned_date' => $post['re_assigned_date'],
            'billing_hour' => $post['billing_hour'],
            'qc_hour' => $post['qc_hour'],
            'total_hour' => $post['total_hour'],
            'actual_hour' => $post['actual_hour'],
            'status' => $post['status'],
            'delivered_on' => $post['delivered_on'],
            'days' => $post['days'],
            'invoice_month' => $post['invoice_month'],
            'inv_date' => $post['inv_date'],
            'hours' => $post['hours'],
            'ac_late_hour' => $post['ac_late_hour'],
            'hhmmss' => $post['hhmmss'],
            'late' => $post['late'],
            'comments' => $post['comments'],
            'error_details_plp' => $post['error_details_plp'],
            'tl_id' => $id,
            'update_time' => date("Y-m-d G:i:s", time()),
            'no_of_edits' => $post['no_of_edits'],
            'no_of_errors' => $post['no_of_errors'],
            'qc_score' => $post['qc_score']
        );
        $this->db->where('id', $post['id']);
        $this->db->update('tbl_plp', $update_data);
        $inserted_rows = $this->db->affected_rows();
        if ($inserted_rows > 0) {
            return 1;
        }
    }

    function update_rpm_details($post) {
        
        /************ Save tgram after check & save pm **** */
        $last_tgram_id = $this->mdl_common->save_tgram_by_user($post);
        if ($last_tgram_id) {
            $post['tgrmid'] = $last_tgram_id;
        }
        $this->mdl_common->save_pm_by_user($post);
        
        if ($this->session->userdata('user_id_tl') != "") {
            $id = $this->session->userdata('user_id_tl');
        }
        if ($this->session->userdata('user_id_qc') != "") {
            $id = $this->session->userdata('user_id_qc');
        }

        // $id = $this->session->userdata('user_id_tl');

        $update_data = array(
            'tgrmid' => $post['tgrmid'],
            'tgram_id' => $post['tgram_id'],
            'account_name' => $post['account_name'],
            'cid' => $post['cid'],
            'received_date' => $post['received_date'],
            'rec_date_n' => get_day_name($post['received_date']),
            'request_type_id' => $post['request_type_id'],
            'program_id' => $post['program_id'],
            'requester_id' => $post['pm_id'],
            'queries' => $post['queries'],
            'resolution_date' => $post['resolution_date'],
            'resolution_date_n' => get_day_name($post['resolution_date']),
            'no_of_pages' => $post['no_of_pages'],
            'billing_hour' => $post['billing_hour'],
            'qc_hour' => $post['qc_hour'],
            'total_hour' => $post['total_hour'],
            'actual_hour' => $post['actual_hour'],
            'start_date' => $post['start_date'],
            'start_date_n' => get_day_name($post['start_date']),
            'delivered_on' => $post['delivered_on'],
            'deliv_date_n' => get_day_name($post['delivered_on']),
            'days' => $post['days'],
            'late' => $post['late'],
            'invoice_month' => $post['invoice_month'],
            'inv_date' => $post['inv_date'],
            'url_rpm' => $post['url_rpm'],
            'remark' => $post['remark'],
            'comments' => $post['comments'],
            'helper_id' => $post['helper_id'],
            'helper_hour' => $post['helper_hour'],
            'user_hour' => $post['user_hour']
        );
        $this->db->where('id', $post['id']);
        $this->db->update('tbl_rpm', $update_data);

        if ($this->session->userdata('user_id_tl') != "") {
            $this->db->where('id', $post['id']);
            $this->db->update('tbl_rpm', array('review_by' => $id, 'update_time' => date("Y-m-d G:i:s", time())));
        }


        if (isset($post['qc_score'])) {
            if ($this->session->userdata('user_id_qc') != "") {
                $this->db->where('id', $post['id']);
                $this->db->update('tbl_rpm', array('qc_score' => $post['qc_score'], 'qc_done_by' => $id, 'qc_time' => date("Y-m-d G:i:s", time())));
            }
        }

        $inserted_rows = $this->db->affected_rows();
        if ($inserted_rows > 0) {
            return 1;
        }
    }

    function get_profile_details() {
        $id = $this->session->userdata('user_id_tl');
        $query = $this->db->select("D_P.department as dept_tl,U_R.id as user_id_tl,U_R.email as email,U_R.fname,U_R.lname,U_R.mobile,U_R.pro_image,U_R.position,U_R.responsibility,U_R.birthday,U_R.my_status,U_R.update_time")
                ->from('user as U_R')
                ->where('U_R.id', $id)
                ->join('department as D_P', 'D_P.id = U_R.department')
                ->get();
        $result = $query->row_array();
        return $result;
    }

    function update_profile_details($post) {
        $id = $this->session->userdata('user_id_tl');
        $update_data = array(
            'fname' => $post['pr_fname'],
            'lname' => $post['pr_lname'],
            'mobile' => $post['pr_mobile'],
            'position' => $post['pr_position'],
            'responsibility' => $post['pr_responsibility'],
            'birthday' => $post['pr_b_date'],
            'update_time' => date("Y-m-d G:i:s", time())
        );
        $this->db->where('id', $id);
        $this->db->update('user', $update_data);
        $inserted_rows = $this->db->affected_rows();
        if ($inserted_rows > 0) {
            return 1;
        }
    }

}

?>
