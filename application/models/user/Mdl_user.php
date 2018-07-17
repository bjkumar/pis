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
        $query = $this->db->select("D_P.department as dept,U_R.id as user_id,U_R.email,U_R.fname,U_R.lname,U_R.mobile,U_R.pro_image,U_R.identity")
                ->from('user as U_R')
                ->where('U_R.email', $email)
                ->where('U_R.password', encode3t($password))
                ->where('U_R.status', '1')
                ->where('U_R.identity', 'emp')
                ->join('department as D_P', 'D_P.id = U_R.department')
                ->get();
        $result = $query->row_array();
        return $result;
    }

    function save_user($post) {
        $insert_data = array(
            'fname' => $post['first_name'],
            'lname' => $post['last_name'],
            'email' => $post['email'],
            'mobile' => $post['mobile'],
            'password' => encode3t($post['password']),
            'identity' => 'emp'
        );

        $this->db->insert('user', $insert_data);
        // $insert_id = $this->db->insert_id();
        $inserted_rows = $this->db->affected_rows();
        if ($inserted_rows > 0) {
            return 2;
        }
    }

    function update_user($post) {

        $update_data = array(
            'fname' => $post['first_name'],
            'lname' => $post['last_name'],
            'email' => $post['email'],
            'mobile' => $post['mobile']
        );

        $this->db->where('id', $post['id']);
        $this->db->update('user', $update_data);

        if ($post['password'] != '') {
            $this->db->where('id', $post['id']);
            $this->db->update('user', array('password' => encode3t($post['password'])));
        }
    }

    function update_status($post) {
        if ($post['status'] == '0') {
            $update_data = array(
                'status' => 1,
            );
        }
        if ($post['status'] == '1') {
            $update_data = array(
                'status' => 0,
            );
        }

        $this->db->where('id', $post['id']);
        $this->db->update('user', $update_data);
    }

    function password_change($post) {
        $id = $this->session->userdata('user_id');
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
        $id = $this->session->userdata('user_id');
        $this->db->where('id', $id);
        $this->db->update('user', array('pro_image' => $file_name));
    }

    function save_edit_details($post) {

        /*         * ****** Save tgram after check **** */
        $last_tgram_id = $this->mdl_common->save_tgram_by_user($post);
        if ($last_tgram_id) {
            $post['tgrmid'] = $last_tgram_id;
        }

        $this->mdl_common->save_pm_by_user($post);


        $insert_data = array(
            'tgrmid' => $post['tgrmid'],
            'tgram_id' => $post['tgram_id'],
            'account_name' => $post['account_name'],
            'received_date' => $post['received_date'],
            'revision' => $post['revision'],
            'account_type_id' => $post['account_type_id'],
            'pm_id' => $post['pm_id'],
            'pages_worked' => $post['pages_worked'],
            'plp' => $post['plp'],
            'billing_hour' => $post['billing_hour'],
            'total_hour' => $post['billing_hour'],
            'actual_hour' => $post['billing_hour'],
            'comments' => $post['comments'],
            'user_id' => $post['user_id'],
            'submit_time' => date("Y-m-d G:i:s", time())
        );

        $this->db->insert('tbl_edit', $insert_data);
        $post['edit_id'] = $this->db->insert_id();
        $inserted_rows = $this->db->affected_rows();





        if ($post['plp'] == 'Yes') {
            $post['account_type_id'] = $post['plp_account_type'];
            $post['error_details_plp'] = $post['error_details_plp'];
            $post['comments'] = $post['comments_plp'];
            $post['billing_hour'] = $post['billing_hour_plp'];
            $this->save_plp_details($post);
        }



        if ($inserted_rows > 0) {
            return 1;
        }
    }

    function update_edit_details_by_user($post) {

        /*         * ****** Save tgram after check **** */
        $last_tgram_id = $this->mdl_common->save_tgram_by_user($post);
        if ($last_tgram_id) {
            $post['tgrmid'] = $last_tgram_id;
        }

        $this->mdl_common->save_pm_by_user($post);


        $edit_data = array(
            'tgrmid' => $post['tgrmid'],
            'tgram_id' => $post['tgram_id'],
            'account_name' => $post['account_name'],
            'received_date' => $post['received_date'],
            'revision' => $post['revision'],
            'account_type_id' => $post['account_type_id'],
            'pm_id' => $post['pm_id'],
            'pages_worked' => $post['pages_worked'],
            'plp' => $post['plp'],
            'billing_hour' => $post['billing_hour'],
            'total_hour' => $post['billing_hour'],
            'actual_hour' => $post['billing_hour'],
            'comments' => $post['comments'],
            'user_id' => $post['user_id'],
            'submit_time' => date("Y-m-d G:i:s", time())
        );

        $this->db->where('id', $post['edit_id']);
        $this->db->update('tbl_edit', $edit_data);


        if ($post['plp'] == 'Yes') {

            $plp_data = array(
                'tgrmid' => $post['tgrmid'],
                'tgram_id' => $post['tgram_id'],
                'account_name' => $post['account_name'],
                'cid' => $post['cid'],
                'error_details_plp' => $post['error_details_plp'],
                'received_date' => $post['received_date'],
                'account_type_id' => $post['plp_account_type'],
                'pm_id' => $post['pm_id'],
                'billing_hour' => $post['billing_hour_plp'],
                'total_hour' => $post['billing_hour_plp'],
                'actual_hour' => $post['billing_hour_plp'],
                'comments' => $post['comments_plp'],
                'user_id' => $post['user_id'],
                'submit_time' => date("Y-m-d G:i:s", time())
            );
            $this->db->where('id', $post['plp_id']);
            $this->db->update('tbl_plp', $plp_data);
        }

        return 1;
    }

    function get_profile_details() {
        $id = $this->session->userdata('user_id');
        $query = $this->db->select("D_P.department as dept,U_R.id as user_id,U_R.email,U_R.fname,U_R.lname,U_R.mobile,U_R.pro_image,U_R.position,U_R.responsibility,U_R.birthday,U_R.my_status,U_R.update_time")
                ->from('user as U_R')
                ->where('U_R.id', $id)
                ->join('department as D_P', 'D_P.id = U_R.department')
                ->get();
        $result = $query->row_array();
        return $result;
    }

    function update_profile_details($post) {
        $id = $this->session->userdata('user_id');
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

    function save_plp_details($post) {
        /*         * ****** Save tgram after check **** */
        $last_tgram_id = $this->mdl_common->save_tgram_by_user($post);
        if ($last_tgram_id) {
            $post['tgrmid'] = $last_tgram_id;
        }
        $this->mdl_common->save_pm_by_user($post);
        $insert_data = array(
            'tgrmid' => $post['tgrmid'],
            'tgram_id' => $post['tgram_id'],
            'account_name' => $post['account_name'],
            'cid' => $post['cid'],
            'error_details_plp' => $post['error_details_plp'],
            'received_date' => $post['received_date'],
            'account_type_id' => $post['account_type_id'],
            'pm_id' => $post['pm_id'],
            'billing_hour' => $post['billing_hour'],
            'total_hour' => $post['billing_hour'],
            'actual_hour' => $post['billing_hour'],
            'comments' => $post['comments'],
            'user_id' => $post['user_id'],
            'submit_time' => date("Y-m-d G:i:s", time())
        );

        $this->db->insert('tbl_plp', $insert_data);
        $plp_id = $this->db->insert_id();
        $inserted_rows = $this->db->affected_rows();

        if (isset($post['edit_id'])) {
            $this->db->where('id', $plp_id);
            $this->db->update('tbl_plp', array('edit_id' => $post['edit_id']));

            $this->db->where('id', $post['edit_id']);
            $this->db->update('tbl_edit', array('plp_id' => $plp_id));
        }


        if ($inserted_rows > 0) {
            return 1;
        }
    }

    function update_plp_details_by_user($post) {
        /*         * ****** Save tgram after check **** */
        $last_tgram_id = $this->mdl_common->save_tgram_by_user($post);
        if ($last_tgram_id) {
            $post['tgrmid'] = $last_tgram_id;
        }
        $this->mdl_common->save_pm_by_user($post);
        $update_data = array(
            'tgrmid' => $post['tgrmid'],
            'tgram_id' => $post['tgram_id'],
            'account_name' => $post['account_name'],
            'cid' => $post['cid'],
            'error_details_plp' => $post['error_details_plp'],
            'received_date' => $post['received_date'],
            'account_type_id' => $post['account_type_id'],
            'pm_id' => $post['pm_id'],
            'billing_hour' => $post['billing_hour'],
            'total_hour' => $post['billing_hour'],
            'actual_hour' => $post['billing_hour'],
            'comments' => $post['comments'],
            'user_id' => $post['user_id'],
            'submit_time' => date("Y-m-d G:i:s", time())
        );
 
        $this->db->where('id', $post['plp_id']);
        $this->db->update('tbl_plp', $update_data);

        return 1;
    }

    function save_rpm_details($post) {

        /*         * ****** Save tgram after check **** */
        $last_tgram_id = $this->mdl_common->save_tgram_by_user($post);
        if ($last_tgram_id) {
            $post['tgrmid'] = $last_tgram_id;
        }
        $this->mdl_common->save_pm_by_user($post);
        $insert_data = array(
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
            //'due_date' => $post['due_date'],
            // 'due_date_n' => get_day_name($post['due_date']),
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
            'comments' => $post['comments'],
            'remark' => $post['remark'],
            'helper_id' => $post['helper_id'],
            'helper_hour' => $post['helper_hour'],
            'user_hour' => $post['user_hour'],
            'user_id' => $post['user_id'],
            'submit_time' => date("Y-m-d G:i:s", time())
        );

        $this->db->insert('tbl_rpm', $insert_data);
        $inserted_rows = $this->db->affected_rows();
        if ($inserted_rows > 0) {
            return 1;
        }
    }

}

?>
