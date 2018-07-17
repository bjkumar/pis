<?php

class Mdl_report extends CI_Model {

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
    function get_indivi_edit_developer($emp_id = null, $post = null) {
        if ($post) {
            $from_date_val = explode(' ', $post['from_date_val']);
            $from_date_val = $from_date_val[0];
            $to_date_val = explode(' ', $post['to_date_val']);
            $to_date_val = $to_date_val[0];
        }

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
        if ($emp_id) {
            $this->db->where('T_E.user_id', $emp_id);
        }
        if ($post) {
            $this->db->where('T_E.delivered_on >=', $post['from_date_val']);
            $this->db->where('T_E.delivered_on <=', $post['to_date_val']);
        }

        $this->db->order_by('T_E.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    } 

    function get_indivi_plp_developer($emp_id=null,$post=null) {

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
        if ($emp_id) {
            $this->db->where('T_E.user_id', $emp_id);
        }
        if ($post) {
            $this->db->where('T_E.delivered_on >=', $post['from_date_val']);
            $this->db->where('T_E.delivered_on <=', $post['to_date_val']);
        }
        $this->db->order_by('T_E.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_indivi_rpm_developer($emp_id) {
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
        if ($emp_id) {
            $this->db->where('T_RPM.user_id', $emp_id);
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
        if ($emp_id) {
            $this->db->or_where('T_RPM.helper_id', $emp_id);
        }
        $this->db->where('T_RPM.helper_id >', '0');
        $this->db->order_by('T_RPM.id', 'DESC');
        $query2 = $this->db->get();
        $result2 = $query2->result_array();
        if (!$result2 && !$result1) {
            $result3 = '';
            return $result3;
            die;
        }
        $result3 = array_merge($result1, $result2);

        foreach ($result3 as $key => $row) {
            $occurrences[$key] = $row['id'];
        }
        array_multisort($occurrences, SORT_DESC, $result3);
        return $result3;
    }

    /**     * ******  Get Between Dates report ********** */
    function get_reports_between_dates_rpm($post) {

        $from_date_val = explode(' ', $post['from_date_val']);
        $from_date_val = $from_date_val[0];

        $to_date_val = explode(' ', $post['to_date_val']);
        $to_date_val = $to_date_val[0];

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
        if (isset($post['emp_id'])) {
            $this->db->where('T_RPM.user_id', $emp_id);
        }

        $this->db->where('T_RPM.delivered_on >=', $from_date_val);
        $this->db->where('T_RPM.delivered_on <=', $to_date_val);
        $this->db->order_by('T_RPM.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();

        if (!$result) {
            $result = '';
            return $result;
            die;
        }
        return $result;
    }

}

?>
