<?php

class Mdl_common extends CI_Model {

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
    function get_all_department() {
        $this->db->from('department');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_job_type() {
        $this->db->from('job_type');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_account_type() {
        $this->db->select('id,account_type')->from('account_type')->where('status', 1)->order_by('account_type', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_account_type_plp() {
        $this->db->select('id,account_type')->from('account_type_plp')->where('status', 1)->order_by('account_type', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_request_type() {
        $this->db->select('*')->from('request_type')->where('status', 1)->order_by('request_type', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_requester() {
        $this->db->select('id,requester')->from('requester')->where('status', 1)->order_by('requester', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_program_rpm() {
        $this->db->select('id,program_rpm')->from('program_rpm')->where('status', 1)->order_by('program_rpm', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_tgram_id() {
        $this->db->select('id,tgram,account_name')->from('tgram')->where('status', 1)->order_by('tgram', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_pm_list() {
        $this->db->select('id,pm')->from('pm')->where('status', 1)->order_by('pm', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_standerd_count($table_name) {
        $this->db->from($table_name);
        $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
    }

    function get_standerd_count_unread($table_name) {
        $this->db->from($table_name);
        if ($table_name == 'tbl_rpm') {
            $this->db->where('qc_done_by <', 1);
        } else {
            $this->db->where('tl_id <', 1);
        }
        $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
    }

    function get_leave_days($post) {
        /* $first_date = '2018-03-24';
          $second_date = '2018-03-25';
          $first_date = $post['startdate'];
          $second_date =$post['end_date']; */
        $this->db->from('leave_dates');
        $this->db->where('leave_date >=', $post['startdate']);
        $this->db->where('leave_date <=', $post['end_date']);
        $query = $this->db->get();
        $num = $query->num_rows();
        // $result = $query->result_array();
        return $num;
    }

    function get_user_list($id = null) {

        $this->db->select('D_P.department as dept,D_P.id as dept_id,U_R.*')
                ->from('user as U_R');
        $this->db->where('U_R.identity', 'emp');
        if ($id) {
            $this->db->where('U_R.id', $id);
        }

        $this->db->join('department as D_P', 'D_P.id = U_R.department');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_tl_list($id = null) {

        $this->db->select('D_P.department as dept,D_P.id as dept_id,T_L.*')
                ->from('user as T_L');
        $this->db->where('T_L.identity', 'TL');
        if ($id) {
            $this->db->where('T_L.id', $id);
        }
        $this->db->join('department as D_P', 'D_P.id = T_L.department');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_edit_list($id = null) {

        $this->db->select('T_E.id,T_E.received_date,T_E.submit_time,T_E.update_time,T_E.tl_id,U_R.fname,U_R.lname,U_R.pro_image,T_E.tgram_id,T_E.account_name,T_L.fname as tl_fname,T_L.lname as tl_lname')
                ->from('tbl_edit as T_E');

        $this->db->join('user as U_R', 'U_R.id = T_E.user_id');
        $this->db->join('tgram as T_M', 'T_M.id = T_E.tgrmid', 'Left');
        $this->db->join('user as T_L', 'T_L.id = T_E.tl_id', 'Left');
        $this->db->order_by('T_E.id', 'DESC');
        if ($id) {
            $this->db->where('T_E.user_id', $id);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_edit_list_noti($dept_id) {

        $this->db->select('T_E.id,T_E.submit_time,U_R.fname,U_R.lname,U_R.pro_image,T_E.tgram_id,T_E.account_name')
                ->from('tbl_edit as T_E');
        $this->db->join('user as U_R', 'U_R.id = T_E.user_id');
        $this->db->join('tgram as T_M', 'T_M.id = T_E.tgrmid', 'Left');
        $this->db->join('user as T_L', 'T_L.id = T_E.tl_id', 'Left');
        $this->db->order_by('T_E.id', 'ASC');
        $this->db->where('T_E.tl_id', '0');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_plp_details_byid($id) {

        $this->db->select('P_L.*,
                          U_R.fname,
                          U_R.lname,U_R.pro_image, 
                          P_M.pm
                          ')
                ->from('tbl_plp as P_L');

        $this->db->join('user as U_R', 'U_R.id = P_L.user_id', 'Left');
        $this->db->join('tgram as T_M', 'T_M.id = P_L.tgrmid', 'Left');
        $this->db->join('pm as P_M', 'P_M.PM = P_L.pm_id', 'Left');
        $this->db->where('P_L.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function get_plp_list($id = null) {

        $this->db->select('P_L.id,P_L.received_date,P_L.submit_time,P_L.update_time,P_L.tl_id,U_R.fname,U_R.lname,U_R.pro_image,P_L.tgram_id,P_L.account_name,T_L.fname as tl_fname,T_L.lname as tl_lname')
                ->from('tbl_plp as P_L');

        $this->db->join('user as U_R', 'U_R.id = P_L.user_id');
        $this->db->join('tgram as T_M', 'T_M.id = P_L.tgrmid', 'Left');
        $this->db->join('user as T_L', 'T_L.id = P_L.tl_id', 'Left');
        $this->db->order_by('P_L.id', 'DESC');
        if ($id) {
            $this->db->where('P_L.user_id', $id);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_rpm_details_byid($id) {

        $this->db->select('R_M.*,
                          U_R.fname,
                          U_R.lname,U_R.pro_image, 
                          P_R.program_rpm,
                          R_Q.request_type
                          ')
                ->from('tbl_rpm as R_M');

        $this->db->join('user as U_R', 'U_R.id = R_M.user_id', 'Left');
        $this->db->join('program_rpm as P_R', 'P_R.id = R_M.program_id', 'Left');
        $this->db->join('request_type as R_Q', 'R_Q.id = R_M.request_type_id', 'Left');
        $this->db->where('R_M.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function get_rpm_list($id = null) {

        $this->db->select('R_M.id,R_M.received_date,R_M.submit_time,R_M.delivered_on,R_M.update_time,R_M.review_by,R_M.qc_done_by,R_M.qc_score,U_R.fname,U_R.lname,U_R.pro_image,R_M.tgram_id,R_M.account_name,T_L.fname as tl_fname,T_L.lname as tl_lname')
                ->from('tbl_rpm as R_M');

        $this->db->join('user as U_R', 'U_R.id = R_M.user_id');
        $this->db->join('tgram as T_M', 'T_M.id = R_M.tgrmid', 'Left');
        $this->db->join('user as T_L', 'T_L.id = R_M.review_by', 'Left');
        $this->db->order_by('R_M.id', 'DESC');
        if (!$id) {
            $this->db->where('R_M.qc_score', '0');
            $this->db->or_where('R_M.qc_done_by', '0');
        }

        if ($id) {
            $this->db->where('R_M.user_id', $id);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_qc_rpm_list($id = null) {

        $this->db->select('R_M.id,R_M.received_date,R_M.submit_time,R_M.delivered_on,R_M.update_time,R_M.review_by,R_M.qc_done_by,R_M.qc_time,R_M.qc_score,U_R.fname,U_R.lname,U_R.pro_image,R_M.tgram_id,R_M.account_name,T_L.fname as tl_fname,T_L.lname as tl_lname,Q_C.fname as qc_fname,Q_C.lname as qc_lname')
                ->from('tbl_rpm as R_M');

        $this->db->join('user as U_R', 'U_R.id = R_M.user_id');
        $this->db->join('tgram as T_M', 'T_M.id = R_M.tgrmid', 'Left');
        $this->db->join('user as T_L', 'T_L.id = R_M.review_by', 'Left');
        $this->db->join('user as Q_C', 'Q_C.id = R_M.qc_done_by', 'Left');
        $this->db->order_by('R_M.id', 'DESC');
        // $this->db->where('R_M.final_qc_score is NOT NULL', NULL, FALSE);
        $this->db->where('R_M.qc_score >', '0');
        if ($id) {
            $this->db->where('R_M.user_id', $id);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_birthday_list_noti() {
        $today_date = date('Y-m-d', time());
        $todaydd = date('Y-m-d', time() + 172800);
        // $query =  "SELECT * FROM table WHERE DATE_FORMAT(field, '%m-%d') = DATE_FORMAT('2000-07-10', '%m-%d') AND id = 1 ";
        $query = $this->db->query("SELECT id,fname,lname,position,pro_image,birthday FROM user WHERE DATE_FORMAT(birthday, '%m-%d') >= DATE_FORMAT('$today_date', '%m-%d')  AND  DATE_FORMAT(birthday, '%m-%d') <= DATE_FORMAT('$todaydd', '%m-%d') ");
        $result = $query->result_array();
        return $result;
    }

    function get_edit_details_byid($id) {

        $this->db->select('T_E.*,
                          U_R.fname,
                          U_R.lname,U_R.pro_image, 
                          P_M.pm
                          ')
                ->from('tbl_edit as T_E');

        $this->db->join('user as U_R', 'U_R.id = T_E.user_id', 'Left');
        $this->db->join('tgram as T_M', 'T_M.id = T_E.tgrmid', 'Left');
        $this->db->join('pm as P_M', 'P_M.PM = T_E.pm_id', 'Left');
        $this->db->where('T_E.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function get_all_edit_list($tl_id = null) {

        $this->db->select('
                  T_E.id,
                  T_E.received_date,
                  T_E.revision,
                  T_E.return_e,
                  T_E.re_assigned_date,
                  T_E.pages_worked,
                  T_E.billing_hour,
                  T_E.qc_hour,
                  T_E.total_hour,
                  T_E.actual_hour,
                  T_E.push_to_live,
                  T_E.status,
                  T_E.delivered_on,
                  T_E.days,
                  T_E.invoice_month,
                  T_E.inv_date,
                  T_E.hours,
                  T_E.hhmmss,
                  T_E.late,
                  T_E.m_c_details,
                  T_E.comments,
                  T_E.submit_time,
                  T_E.update_time,
                  T_E.re_assigned_date,
                  T_E.a_t_status,
                  T_E.plp,   
                  T_E.no_of_edits,
                  T_E.no_of_errors,
                  T_E.qc_score,
                  T_E.tgram_id,
                  T_E.account_name,
                  T_E.pm_id as pm,
                  AC_T.account_type,
                  U_R.fname as user_fname,
                  T_L.fname as tl_fname
                 ')
                ->from('tbl_edit as T_E');

        $this->db->join('user as U_R', 'U_R.id = T_E.user_id', 'Left');
        $this->db->join('user as T_L', 'T_L.id = T_E.tl_id', 'Left');
        $this->db->join('account_type as AC_T', 'AC_T.id = T_E.account_type_id', 'Left');
        if ($tl_id) {
            $this->db->where('T_L.id', $tl_id);
        }
        $this->db->order_by('T_E.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_all_plp_list($tl_id = null) {

        $this->db->select('
                  T_E.id,
                  T_E.received_date, 
                  T_E.return_e,
                  T_E.re_assigned_date, 
                  T_E.billing_hour,
                  T_E.qc_hour,
                  T_E.total_hour,
                  T_E.actual_hour, 
                  T_E.status,
                  T_E.delivered_on,
                  T_E.days,
                  T_E.invoice_month,
                  T_E.inv_date,
                  T_E.hours,
                  T_E.hhmmss,
                  T_E.late, 
                  T_E.comments,
                  T_E.error_details_plp,
                  T_E.submit_time,
                  T_E.update_time,
                  T_E.re_assigned_date,
                  T_E.a_t_status,  
                  T_E.no_of_errors,
                  T_E.qc_score,
                  T_E.tgram_id,
                  T_E.account_name,
                  T_E.cid,
                  T_E.pm_id as pm,
                  AC_T.account_type,
                  U_R.fname as user_fname,
                  T_L.fname as tl_fname
                 ')
                ->from('tbl_plp as T_E');

        $this->db->join('user as U_R', 'U_R.id = T_E.user_id', 'Left');
        $this->db->join('user as T_L', 'T_L.id = T_E.tl_id', 'Left');
        $this->db->join('account_type_plp as AC_T', 'AC_T.id = T_E.account_type_id', 'Left');
        if ($tl_id) {
            $this->db->where('T_L.id', $tl_id);
        }
        $this->db->order_by('T_E.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_all_rpm_list($tl_id = null) {

        $this->db->select('
                  T_RPM.id,
                  T_RPM.tgram_id,
                  T_RPM.account_name,
                  T_RPM.rec_date_n,   
                  AC_T.request_type,
                  PR_M.program_rpm,  
                  T_RPM.requester_id,
                  T_RPM.queries,
                  T_RPM.days_reqd,
                  T_RPM.due_date_n,
                  T_RPM.status, 
                  T_RPM.billing_hour,
                  T_RPM.qc_hour,
                  T_RPM.total_hour,
                  T_RPM.actual_hour, 
                  T_RPM.no_of_pages,
                  T_RPM.deliv_date_n, 
                  T_RPM.invoice_month,
                  T_RPM.inv_date,  
                  T_RPM.comments,    
                  T_RPM.url_rpm,
                  T_RPM.remark,
                  T_RPM.submit_time,
                  T_RPM.update_time, 
                   U_R.fname as user_fname,
                  T_L.fname as tl_fname,
                  ')
                ->from('tbl_rpm as T_RPM');

        $this->db->join('user as U_R', 'U_R.id = T_RPM.user_id', 'Left');
        $this->db->join('user as T_L', 'T_L.id = T_RPM.qc_done_by', 'Left');
        $this->db->join('request_type as AC_T', 'AC_T.id = T_RPM.request_type_id', 'Left');
        $this->db->join('program_rpm as PR_M', 'PR_M.id = T_RPM.program_id', 'Left');
        if ($tl_id) {
            $this->db->where('T_RPM.id', $tl_id);
        }
        $this->db->order_by('T_RPM.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_all_rpm_developer($tl_id = null) {
        //  $this->db->query('SET @pos=0');
        /*         * * query for main developer ** */
        $this->db->select('T_RPM.id,
                  T_RPM.tgram_id,
                  T_RPM.account_name,
                  T_RPM.rec_date_n,   
                  AC_T.request_type,
                  PR_M.program_rpm,  
                  T_RPM.requester_id,
                  T_RPM.queries,
                  T_RPM.days_reqd,
                  T_RPM.due_date_n,
                  T_RPM.status, 
                  T_RPM.billing_hour,
                  T_RPM.qc_hour,
                  T_RPM.total_hour,
                  T_RPM.actual_hour, 
                  T_RPM.no_of_pages,
                  T_RPM.deliv_date_n, 
                  T_RPM.invoice_month,
                  T_RPM.inv_date,  
                  T_RPM.comments,    
                  T_RPM.url_rpm,
                  T_RPM.remark,
                  T_RPM.submit_time,
                  T_RPM.update_time, 
                   U_R.fname as user_fname,
                  T_L.fname as tl_fname')
                ->from('tbl_rpm as T_RPM');

        $this->db->join('user as U_R', 'U_R.id = T_RPM.user_id', 'Left');
        $this->db->join('user as T_L', 'T_L.id = T_RPM.qc_done_by', 'Left');
        $this->db->join('request_type as AC_T', 'AC_T.id = T_RPM.request_type_id', 'Left');
        $this->db->join('program_rpm as PR_M', 'PR_M.id = T_RPM.program_id', 'Left');
        if ($tl_id) {
            $this->db->where('T_RPM.id', $tl_id);
        }
        $this->db->order_by('T_RPM.id', 'DESC');
        $query1 = $this->db->get();
        $result1 = $query1->result_array();

        /*         * * query for Helper developer ** */
        $this->db->select('
                  T_RPM.id,
                  T_RPM.tgram_id,
                  T_RPM.account_name,
                  T_RPM.rec_date_n,   
                  AC_T.request_type,
                  PR_M.program_rpm,  
                  T_RPM.requester_id,
                  T_RPM.queries,
                  T_RPM.days_reqd,
                  T_RPM.due_date_n,
                  T_RPM.status, 
                  T_RPM.helper_hour as billing_hour,
                  T_RPM.helper_hour,
                  T_RPM.qc_hour,
                  T_RPM.total_hour,
                  T_RPM.actual_hour, 
                  T_RPM.no_of_pages,
                  T_RPM.deliv_date_n, 
                  T_RPM.invoice_month,
                  T_RPM.inv_date,  
                  T_RPM.comments,    
                  T_RPM.url_rpm,
                  T_RPM.remark,
                  T_RPM.submit_time,
                  T_RPM.update_time, 
                  U_R.fname as user_fname,
                  T_L.fname as tl_fname,
                  ')
                ->from('tbl_rpm as T_RPM');

        $this->db->join('user as U_R', 'U_R.id = T_RPM.helper_id', 'Left');
        $this->db->join('user as T_L', 'T_L.id = T_RPM.qc_done_by', 'Left');
        $this->db->join('request_type as AC_T', 'AC_T.id = T_RPM.request_type_id', 'Left');
        $this->db->join('program_rpm as PR_M', 'PR_M.id = T_RPM.program_id', 'Left');
        if ($tl_id) {
            $this->db->where('T_RPM.id', $tl_id);
        }
        $this->db->where('T_RPM.helper_id >', '0');
        $this->db->order_by('T_RPM.id', 'DESC');
        $query2 = $this->db->get();
        $result2 = $query2->result_array();
        $result3 = array_merge($result1, $result2);
        // sort($result3);
        //rsort($result3);
        foreach ($result3 as $key => $row) {
            $occurrences[$key] = $row['id'];
        }
        array_multisort($occurrences, SORT_DESC, $result3);
        return $result3;
    }

    function delete_standard($field, $id, $table) {
        $this->db->where($field, $id);
        $this->db->delete($table);
    }

    function photo_upload($image_data, $imagePath, $height = 0, $width = 0) {
        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        $temp = explode(".", $image_data["name"]);
        $extension = end($temp);

        if (in_array($extension, $allowedExts)) {
            if ($image_data["error"] > 0) {
                $response = array(
                    "status" => 'error',
                    "message" => 'ERROR Return Code: ' . $image_data["error"],
                );
                echo "Return Code: " . $image_data["error"];
            } else {

                $filename = $image_data["tmp_name"];
                $temp = explode(".", $image_data["name"]);
                $extension = end($temp);
                $new_image_name = strtotime("now") . '.' . $extension;
                move_uploaded_file($filename, $imagePath . $new_image_name);
                if ($height != 0 || $width != 0) {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $imagePath . $new_image_name;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = $width;
                    $config['height'] = $height;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                }
                list($width, $height) = getimagesize($imagePath . $new_image_name);
                $response = array(
                    "status" => 'success',
                    "url" => $imagePath . $new_image_name,
                    "width" => $width,
                    "height" => $height,
                    "upload_image_name" => $new_image_name
                );
            }
        } else {
            $response = array(
                "status" => 'error',
                "message" => 'something went wrong'
            );
        }

        return $response;
    }

    function save_tgram($post) {
        $this->db->from('tgram');
        $this->db->where('tgram', $post['tgram']);
        $this->db->where('account_name', $post['account_name']);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            return 2;
        } else {
            $this->db->insert('tgram', array('account_name' => $post['account_name'], 'tgram' => $post['tgram']));
            $inserted_rows = $this->db->affected_rows();
            if ($inserted_rows > 0) {
                return 1;
            }
        }
    }

    function save_tgram_by_user($post) {
        $this->db->from('tgram');
        $this->db->where('tgram', $post['tgram_id']);
        $this->db->where('account_name', $post['account_name']);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num == 0) {
            $this->db->insert('tgram', array('account_name' => $post['account_name'], 'tgram' => $post['tgram_id']));
            return $this->db->insert_id();
        }
    }

    function save_leaves($post) {
        $this->db->from('leave_dates');
        $this->db->where('leave_date', $post['leave_date']);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            return 2;
        } else {
            $this->db->insert('leave_dates', array('leave_date' => $post['leave_date'], 'title' => $post['title']));
            $inserted_rows = $this->db->affected_rows();
            if ($inserted_rows > 0) {
                return 1;
            }
        }
    }

    function save_pm($post) {
        $this->db->from('pm');
        $this->db->where('pm', $post['pm']);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            return 2;
        } else {
            $this->db->insert('pm', array('pm' => $post['pm']));
            $inserted_rows = $this->db->affected_rows();
            if ($inserted_rows > 0) {
                return 1;
            }
        }
    }

    function save_pm_by_user($post) {
        $this->db->from('pm');
        $this->db->where('pm', $post['pm_id']);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num == 0) {
            $this->db->insert('pm', array('pm' => $post['pm_id']));
        }
    }

    function save_account_type($post) {
        $this->db->from('account_type');
        $this->db->where('account_type', $post['account_type']);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            return 2;
        } else {
            $this->db->insert('account_type', array('account_type' => $post['account_type']));
            $inserted_rows = $this->db->affected_rows();
            if ($inserted_rows > 0) {
                return 1;
            }
        }
    }

    function save_timeline($post) {
        // $user_id = $this->session->userdata('user_id');
        $this->db->insert('chat', array('message' => $post['chat_message'], 'sender_id' => $post['sender_id'], 'receiver_id' => $post['receiver_id'], 'read_chat' => $post['read_chat']));
        //$this->db->insert('chat', array('message' => 'Hello Jim', 'sender_id' => '8', 'receiver_id' => '1'));
    }

    function get_timeline($post) {
        $start = null;
        //$start='5';
        $limit = '100';
        $user_id = $this->session->userdata('user_id');
        if ($user_id == '') {
            $user_id = $this->session->userdata('user_id_tl');
        }

        $this->db->select('id,message,sender_id,receiver_id,send_time');
        $this->db->from('chat');
        $where = '((sender_id="' . $user_id . '" and receiver_id = "' . $post['receiver_id'] . '") OR  (sender_id="' . $post['receiver_id'] . '" and receiver_id = "' . $user_id . '"))';
        $this->db->where($where);
        if ($post['last_id'] != '') {
            $this->db->where('id >', $post['last_id']);
        }
        $this->db->order_by('send_time', 'ASC');

        // $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        if ($result) {

            return $result;
        } else {
            $result = array(
                "id" => '0'
            );
            return $result;
        }
    }

    function get_user_info_for_chat($post) {
        $this->db->select('U_R.id,U_R.fname,U_R.pro_image')->from('user as U_R');
        $this->db->where('U_R.id', $post['id']);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_online_status($receiver_id) {

        if ($receiver_id) {
            $this->db->select('U_R.active,U_R.last_seen')
                    ->from('user as U_R');
            $this->db->where('U_R.id', $receiver_id);
        } else {
            
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_day_name($date) {
        //$date = '30/10/2018'; 
        $date = explode(' ', $date); // bcoz coming undefind after space //
        $date = $date['0'];
        //$date = $date['2'].'/'.$date['1'].'/'.$date['0'];  
        return $date = date('D', strtotime($date)) . ', ' . date('d', strtotime($date)) . '-' . date('M', strtotime($date)) . '-' . date('y', strtotime($date));
    }

    /* function get_monthly_received1($table) {
      $this->db->select('MONTHNAME(received_date) as month, count(id) as total,sum(billing_hour) as working_hour,sum(qc_hour) as qc_hour,sum(total_hour) as total_hour,sum(actual_hour) as billing_hour');
      $this->db->from($table);
      $this->db->where('received_date !=', '0000-00-00 00:00:00');
      $this->db->group_by('MONTHNAME(received_date)');
      $this->db->order_by('received_date', 'ASC');
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
      } */

    function get_monthly_received($table) {
        //   $table = 'tbl_rpm';
        $SQL = "SELECT count(tbl.id) as total, m.month,sum(tbl.billing_hour) as working_hour,sum(tbl.qc_hour) as qc_hour,sum(tbl.total_hour) as total_hour,sum(tbl.actual_hour) as billing_hour
     FROM (
           SELECT 'Jan' AS MONTH
           UNION SELECT 'Feb' AS MONTH
           UNION SELECT 'Mar' AS MONTH
           UNION SELECT 'Apr' AS MONTH
           UNION SELECT 'May' AS MONTH
           UNION SELECT 'Jun' AS MONTH
           UNION SELECT 'Jul' AS MONTH
           UNION SELECT 'Aug' AS MONTH
           UNION SELECT 'Sep' AS MONTH
           UNION SELECT 'Oct' AS MONTH
           UNION SELECT 'Nov' AS MONTH
           UNION SELECT 'Dec' AS MONTH
          ) AS m
LEFT JOIN " . $table . " tbl 
ON MONTH(STR_TO_DATE(CONCAT(m.month, ' 2018'),'%M %Y')) = MONTH(tbl.received_date)
   AND YEAR(tbl.received_date) = '2018' AND received_date != '0000-00-00 00:00:00'
GROUP BY m.month
ORDER BY FIELD(MONTH,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec')";
        $query = $this->db->query($SQL);
        return $query->result_array();
    }

    /* function get_monthly_delivery1($table) {
      $this->db->select('MONTHNAME(delivered_on) as month, count(id) as total');
      $this->db->from($table);
      $this->db->where('delivered_on !=', '0000-00-00 00:00:00');
      $this->db->group_by('MONTHNAME(delivered_on)');
      $this->db->order_by('delivered_on', 'ASC');
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
      } */

    function get_monthly_delivery($table) {
        $SQL = "SELECT count(tbl.id) as total, m.month
     FROM (
           SELECT 'Jan' AS MONTH
           UNION SELECT 'Feb' AS MONTH
           UNION SELECT 'Mar' AS MONTH
           UNION SELECT 'Apr' AS MONTH
           UNION SELECT 'May' AS MONTH
           UNION SELECT 'Jun' AS MONTH
           UNION SELECT 'Jul' AS MONTH
           UNION SELECT 'Aug' AS MONTH
           UNION SELECT 'Sep' AS MONTH
           UNION SELECT 'Oct' AS MONTH
           UNION SELECT 'Nov' AS MONTH
           UNION SELECT 'Dec' AS MONTH
          ) AS m
LEFT JOIN " . $table . " tbl 
ON MONTH(STR_TO_DATE(CONCAT(m.month, ' 2018'),'%M %Y')) = MONTH(tbl.delivered_on)
   AND YEAR(tbl.delivered_on) = '2018' AND delivered_on != '0000-00-00 00:00:00'
GROUP BY m.month
ORDER BY FIELD(MONTH,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec')";
        $query = $this->db->query($SQL);
        return $query->result_array();
    }

    function get_employee($empid = null) {

        $this->db->select("id,fname,lname")->from('user');
        if ($empid != null) {
            $this->db->where('id !=', $empid);
        }
        $this->db->where('identity', 'emp');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_unread_message() {
        $this->db->select("C_T.message as chat_message,C_T.sender_id,C_T.receiver_id,C_T.send_time,U_R.fname as sender_name,U_R.pro_image as sender_img")->from('chat as C_T');
        $this->db->join('user as U_R', 'U_R.id = C_T.sender_id');
        $this->db->where('read_chat', '0');
        $this->db->where('receiver_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function save_score($score, $user_id) {
        $play_times = 1;
        /*         * **** Check Max Score ************* */
        $query = $this->db->select("max_score,played_no,play_date,play_times")
                ->from('game')
                ->where('player_id', $user_id)
                ->get();
        $result = $query->row_array();
        if ($result) {
            if ($result['max_score'] < $score) {

                if ($result['play_date'] == date('Y-m-d')) {
                    $play_times = $result['play_times'] + 1;
                }
                $played_no = $result['played_no'] + 1;
                $this->db->where('player_id', $user_id);
                $this->db->update('game', array('max_score' => $score, 'played_no' => $played_no, 'play_date' => date('Y-m-d'), 'play_times' => $play_times));
                return $score;  // maximum score
            } else {

                if ($result['play_date'] == date('Y-m-d')) {
                    $play_times = $result['play_times'] + 1;
                }
                $played_no = $result['played_no'] + 1;
                $this->db->where('player_id', $user_id);
                $this->db->update('game', array('played_no' => $played_no, 'play_date' => date('Y-m-d'), 'play_times' => $play_times));
                return 0;  // not a maximum score
            }
        } else {
            $this->db->insert('game', array('player_id' => $user_id, 'max_score' => $score, 'played_no' => 1, 'play_date' => date('Y-m-d'), 'play_times' => $play_times));
            return 1;   // first time entry
        }
    }

    function get_three_max_scorer() {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        }
        if ($this->session->userdata('user_id_tl')) {
            $user_id = $this->session->userdata('user_id_tl');
        }
        $this->db->select("G_M.max_score,     
            G_M.played_no,
            U_R.fname")
                ->from('game as G_M');
        $this->db->join('user as U_R', 'U_R.id = G_M.player_id');
        $this->db->order_by('max_score', 'DESC');
        $this->db->limit('3');
        $query1 = $this->db->get();
        $result1 = $query1->result_array();

        $this->db->select("max_score as my_max_score")
                ->from('game')
                ->where('player_id', $user_id);
        $query2 = $this->db->get();
        $result2 = $query2->result_array();

        $this->db->select("play_times")
                ->from('game')
                ->where('play_date', date('Y-m-d'))
                ->where('player_id', $user_id);
        $query3 = $this->db->get();
        $result3 = $query3->result_array();



        $result = array_merge($result1, $result2, $result3);


        return $result;
    }

    function sending_mail_smtp($from_mail, $from_name, $to, $subject, $message) {

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
