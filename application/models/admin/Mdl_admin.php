<?php

class Mdl_admin extends CI_Model {

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
    function login_check($name, $password) {
        $query = $this->db->select("id as admin_id,name,last_name,profile_pic")
                ->from('admin')
                ->where('name', $name)
                ->where('password', encode3t($password))
                ->where('status', '1')
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
            'identity' => $post['identity'],
            'password' => encode3t($post['password']),
            'department' => $post['department']
          );

        $this->db->insert('user', $insert_data);
        // $insert_id = $this->db->insert_id();
        $inserted_rows = $this->db->affected_rows();
        if ($inserted_rows > 0) {
            return 2;
        }
    }
    
     function save_user_self($post) {
        $insert_data = array(
            'fname' => $post['first_name'],
            'lname' => $post['last_name'],
            'email' => $post['email'], 
            'identity' => 'emp',
            'password' => encode3t($post['password']),
            'department' => $post['department']
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

    function delete_standard($id, $table) {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function update_status_standard($post) {
        $this->db->where('id', $post['id']);
        $this->db->update($post['table_name'], array('status' => $post['status']));
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return 2;
        }
    }

    function update_Tgrams($post) {
        $this->db->where('id', $post['id']);
        $this->db->update('tgram', array('tgram' => $post['tgram'], 'account_name' => $post['account_name']));
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return 2;
        }
    }

    function update_leaves($post) {
        $this->db->where('id', $post['id']);
        $this->db->update('leave_dates', array('leave_date' => $post['leave_date'], 'title' => $post['title']));
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return 2;
        }
    }

    function update_account_type($post) {
        $this->db->where('id', $post['id']);
        $this->db->update('account_type', array('account_type' => $post['account_type']));
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return 2;
        }
    }

    function update_pm($post) {
        $this->db->where('id', $post['id']);
        $this->db->update('pm', array('pm' => $post['pm']));
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            return 2;
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

    function get_user_list($id = null) {

        $this->db->select('D_P.department as dept,D_P.id as dept_id,U_R.*')
                ->from('user as U_R');
        if ($id) {
            $this->db->where('U_R.id', $id);
        }

        $this->db->join('department as D_P', 'D_P.id = U_R.department');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_all_department() {
        $this->db->from('department');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_tgram_list() {
        $this->db->select('id,tgram,account_name,status')->from('tgram')->order_by('tgram', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_leave_dates() {
        $this->db->from('leave_dates');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function TestEmail() {
        $email_id = 'bjkumar@technosofteng.com';
        $message = 'Your account has been activated';
        sending_mail_smtp(FROM_MAIL, FROM_NAME, $email_id, 'Account Activated For Technosoft Portal', $message);
    }

    function sending_mail_smtp($from_mail, $from_name, $to, $subject, $message) {

        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASS,
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );
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

?>
