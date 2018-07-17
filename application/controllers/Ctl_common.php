<?php

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctl_common extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_common');
        date_default_timezone_set("Asia/Kolkata");
        // $this->load->library('excel');
    }

    public function index() {

        $this->load->model('logon_model');
        echo 'Hello';
    }

   /* function get_all_edit_list() {
        $array['list'] = get_all_edit_list($tl_id = null);
        return $array['list'];
    }  */

    function get_all_plp_list() {
        $array['list'] = $this->mdl_common->get_all_plp_list($tl_id = null);
        return $array['list'];
    }
  

    public function export_excel_file_test() {
        $this->load->library('excel');
        require_once './application/third_party/PHPExcel.php';
        require_once './application/third_party/PHPExcel/IOFactory.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        );

        $acc_default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => 'c7c7c7'),
        );
        $outlet_style_header = array(
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 10,
                'name' => 'Arial',
                'bold' => true,
            ),
        );
        $top_header_style = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 15,
                'name' => 'Arial',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
        );
        $account_value_style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
        );
        $text_align_style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
                'bold' => true,
            ),
        );

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:H1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Purchase Bonuses Report');

        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($top_header_style);

        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Date & Time');
        $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Product Code');
        $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Product Name');
        $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Outlet');
        $objPHPExcel->getActiveSheet()->setCellValue('E2', 'Bill No');
        $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Supplier');
        $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Quantity');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Value');


        $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

//        $row = 3;
//        $custDtaData = $this->Constant_model->getBonusPurchase();
//        foreach ($custDtaData as $value) {
//            $totalvalue = $value->purchase_price * $value->bonusqty;
//            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $value->created_datetime);
//            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $value->product_code);
//            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $value->productname);
//            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $value->outletsname);
//            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $value->bill_no);
//            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $value->suppliersname);
//            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $value->bonusqty);
//            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, round($totalvalue, 2));
//            $row++;
//        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Edit_Excel_Report.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    function Standerd_Save() {
        $post = $this->input->post();
        if ($post['table_name'] == 'request_type') {
            $insert_data = array(
                $post['field_name'] => $post['field_val'],
                'late_days' => $post['late_days']
            );
            $this->db->insert($post['table_name'], $insert_data);
        } else {
            $insert_data = array(
                $post['field_name'] => $post['field_val']
            );
            $this->db->insert($post['table_name'], $insert_data);
        }

        echo '1';
    }

    function Standerd_Update() {
        $post = $this->input->post();
        if ($post['table_name'] == 'request_type') {
            $update_data = array(
                $post['field_name'] => $post['field_val'],
                'late_days' => $post['late_days']
            );
            $this->db->where('id', $post['id']);
            $this->db->update($post['table_name'], $update_data);
        } else {
            $update_data = array(
                $post['field_name'] => $post['field_val']
            );
            $this->db->where('id', $post['id']);
            $this->db->update($post['table_name'], $update_data);
        }


        echo '1';
    }

    function csv_upload_tgram() {

        require_once './application/third_party/upload_csv_excel/Spout/Autoloader/autoload.php';
        if (!empty($_FILES['file']['name'])) {

            $pathinfo = pathinfo($_FILES["file"]["name"]);

            if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') && $_FILES['file']['size'] > 0) {

                // Temporary file name
                $inputFileName = $_FILES['file']['tmp_name'];

                // Read excel file by using ReadFactory object.
                $reader = ReaderFactory::create(Type::XLSX);

                // Open file
                $reader->open($inputFileName);
                $count = 1;
                $common_uniqe_no = '0.001';
                $incr = 1;
                $fordel = 1;
                // Number of sheet in excel file
                foreach ($reader->getSheetIterator() as $sheet) {
                    foreach ($sheet->getRowIterator() as $filesop) {
                        if ($count > 1) {
                            // $account_name = $filesop[0];
                            $account_name = str_replace("'", "", trim($filesop[0]));
                            $tgram = str_replace("'", "", trim($filesop[1]));
                            if ($account_name != '' && $tgram != '') {
                                $this->db->insert('tgram', array('account_name' => $account_name, 'tgram' => $tgram));
                            }
                        }
                        $count++;
                    }
                }
                $reader->close();
            } else {
                echo '2';
            }
        }
    }

    function save_tgram() {
        $post = $this->input->post();
        $return = $this->mdl_common->save_tgram($post);
        echo $return;
    }

    function save_pm() {
        $post = $this->input->post();
        $return = $this->mdl_common->save_pm($post);
        echo $return;
    }

    function save_account_type() {
        $post = $this->input->post();
        $return = $this->mdl_common->save_account_type($post);
        echo $return;
    }

    function save_leaves() {
        $post = $this->input->post();
        $return = $this->mdl_common->save_leaves($post);
        echo $return;
    }

    function my_organization($org) {

        $array['employee'] = $this->mdl_common->get_user_list($id = null);
        $array['tl'] = $this->mdl_common->get_tl_list($id = null);
        if ($org == 'tl') {
            $array['middle'] = 'tl/my_organization';
            $this->load->view('tl/master-page', $array);
        }
        if ($org == 'employee') {
            $array['middle'] = 'user/my_organization';
            $this->load->view('user/master-page', $array);
        }
    }

    function timeline() {
        if ($this->session->userdata('identity') == 'emp') {
            $this->load->view('user/timeline');
        }

        if ($this->session->userdata('identity') == 'TL') {
            $this->load->view('tl/timeline');
        }

        //$this->load->view('timeline');
    }

    function save_timeline() {
        $post = $this->input->post();
        $result = $this->mdl_common->save_timeline($post);
    }

    function get_timeline() {
        $post = $this->input->post();
        //echo '<pre>';    print_r($post);  echo '</pre>'; die;
        // $post['receiver_id']= '15';
        // $post['last_id']= '93';
        $result = array();
        $result['timeline'] = $this->mdl_common->get_timeline($post);
        $result['online_status'] = $this->mdl_common->get_online_status($post['receiver_id']);
        echo json_encode($result);
    }

    function get_birthday_list_noti() {
        $result = array();
        $emp_bday = $this->mdl_common->get_birthday_list_noti();
        $result['emp_bday'] = $emp_bday;
        // print_r($result['emp_bday']); die; 
        echo json_encode($result);
    }

    function edit_list() {


        if ($this->session->userdata('user_id')) {

            $id = $this->session->userdata('user_id');
            $result['list'] = get_edit_list($id);
            //$this->load->view('user/edit_list', $result);
            $result['middle'] = 'user/edit_list';
            $this->load->view('user/master-page', $result);
        }

        if ($this->session->userdata('user_id_tl')) {
            $result['list'] = get_edit_list(null);
            $result['middle'] = 'tl/edit_list';
            $this->load->view('tl/master-page', $result);
        }

        if ($this->session->userdata('admin_id')) {
            $result['list'] = get_edit_list(null);
            $this->load->view('admin/edit_list', $result);
        }
    }

    function view_edit($id) {

        $result['job_type'] = get_job_type();
        $result['tgram'] = get_tgram_id();
        $result['pmlist'] = get_pm_list();
        $result['account_type'] = get_account_type();
        $result['list'] = get_edit_details_byid($id);

        if ($result['list']['received_date'] != '0000-00-00 00:00:00') {
            $result['list']['received_date'] = date("d/m/Y H:i", strtotime($result['list']['received_date']));
        }

        if ($result['list']['re_assigned_date'] != '0000-00-00 00:00:00') {
            $result['list']['re_assigned_date'] = date("d/m/Y H:i", strtotime($result['list']['re_assigned_date']));
        }

        if ($result['list']['delivered_on'] != '0000-00-00 00:00:00') {
            $result['list']['delivered_on'] = date("d/m/Y H:i", strtotime($result['list']['delivered_on']));
        }

        /*         * **  edit with PLP ****** */
        if ($result['list']['plp'] == 'Yes' && $result['list']['plp_id'] > 1) {

            $result['Plist'] = $this->mdl_common->get_plp_details_byid($result['list']['plp_id']);

            $result['plp_account_type'] = $this->mdl_common->get_account_type_plp();
            if ($result['Plist']['re_assigned_date'] != '0000-00-00 00:00:00') {
                $result['Plist']['re_assigned_date'] = date("d/m/Y H:i", strtotime($result['Plist']['re_assigned_date']));
            }
            if ($result['Plist']['delivered_on'] != '0000-00-00 00:00:00') {
                $result['Plist']['delivered_on'] = date("d/m/Y H:i", strtotime($result['Plist']['delivered_on']));
            }
        }



        if ($this->session->userdata('user_id')) {
            // $this->load->view('user/view_edit', $result);
            $result['middle'] = 'user/view_edit';
            $this->load->view('user/master-page', $result);
        }
        if ($this->session->userdata('user_id_tl')) {
            // $this->load->view('tl/view_edit', $result);
            $result['middle'] = 'tl/view_edit';
            $this->load->view('tl/master-page', $result);
        }
    }

    function plp_list() {
        if ($this->session->userdata('user_id')) {
            $result['list'] = $this->mdl_common->get_plp_list($this->session->userdata('user_id'));
            // $this->load->view('user/plp_list', $result);
            $result['middle'] = 'user/plp_list';
            $this->load->view('user/master-page', $result);
        }

        if ($this->session->userdata('user_id_tl')) {
            $result['list'] = $this->mdl_common->get_plp_list();
            $result['middle'] = 'tl/plp_list';
            $this->load->view('tl/master-page', $result);
        }


        if ($this->session->userdata('admin_id')) {
            $result['list'] = $this->mdl_common->get_plp_list();
            $this->load->view('admin/plp_list', $result);
        }
    }

    function view_plp($id) {

        $result['job_type'] = get_job_type();
        $result['tgram'] = get_tgram_id();
        $result['pmlist'] = get_pm_list();
        $result['account_type'] = $this->mdl_common->get_account_type_plp();
        $result['list'] = $this->mdl_common->get_plp_details_byid($id);



        if ($result['list']['received_date'] != '0000-00-00 00:00:00') {
            $result['list']['received_date'] = date("d/m/Y H:i", strtotime($result['list']['received_date']));
        }

        if ($result['list']['re_assigned_date'] != '0000-00-00 00:00:00') {
            $result['list']['re_assigned_date'] = date("d/m/Y H:i", strtotime($result['list']['re_assigned_date']));
        }

        if ($result['list']['delivered_on'] != '0000-00-00 00:00:00') {
            $result['list']['delivered_on'] = date("d/m/Y H:i", strtotime($result['list']['delivered_on']));
        }

        // print_r($result['list']['delivered_on']); die;
        if ($this->session->userdata('user_id')) {
            $result['middle'] = 'user/view_plp';
            $this->load->view('user/master-page', $result);
        }

        if ($this->session->userdata('user_id_tl')) {
            $result['middle'] = 'tl/view_plp';
            $this->load->view('tl/master-page', $result);
        }
    }

    
    
    
    function rpm_list() {
        if ($this->session->userdata('user_id')) {
            $result['list'] = $this->mdl_common->get_rpm_list($this->session->userdata('user_id'));
             // $this->load->view('user/rpm_list', $result);
            $result['middle'] = 'user/rpm_list';
            $this->load->view('user/master-page', $result);
        }

        if ($this->session->userdata('user_id_tl')) {
            $result['list'] = $this->mdl_common->get_rpm_list();
            $result['middle'] = 'tl/rpm_list';
            $this->load->view('tl/master-page', $result);
        }
        
        if ($this->session->userdata('user_id_qc')) {
            $result['list'] = $this->mdl_common->get_rpm_list();
            $result['middle'] = 'qc/rpm_list';
            $this->load->view('qc/master-page', $result);
        }
        
        if ($this->session->userdata('admin_id')) {
            $result['list'] = $this->mdl_common->get_rpm_list();
            $this->load->view('admin/rpm_list', $result);
        }
        
        
    }
    
    function qc_rpm_list() {
        if ($this->session->userdata('user_id')) {
            $result['list'] = $this->mdl_common->get_rpm_list($this->session->userdata('user_id'));
            $result['middle'] = 'user/rpm_list';
            $this->load->view('user/master-page', $result);
        }

        if ($this->session->userdata('user_id_tl')) {
            $result['list'] = $this->mdl_common->get_qc_rpm_list();
            $result['middle'] = 'tl/qc_rpm_list';
            $this->load->view('tl/master-page', $result);
        }
        
         if ($this->session->userdata('user_id_qc')) {
            $result['list'] = $this->mdl_common->get_qc_rpm_list();
            $result['middle'] = 'qc/qc_rpm_list';
            $this->load->view('qc/master-page', $result);
        }
        
        if ($this->session->userdata('admin_id')) {
            $result['list'] = $this->mdl_common->get_rpm_list();
            $this->load->view('admin/rpm_list', $result);
        }
        
       
    }

    function view_rpm($id) {

        $result['tgram'] = get_tgram_id();
        $result['pmlist'] = get_pm_list();
       //  $result['requester_rpm'] = $this->mdl_common->get_requester();
        $result['account_type'] = $this->mdl_common->get_request_type();
        $result['program_rpm'] = $this->mdl_common->get_program_rpm();
        $result['list'] = $this->mdl_common->get_rpm_details_byid($id);
        $result['employee'] = $this->mdl_common->get_employee();
       // echo '<pre>'; print_r($result['list']);  echo '</pre>'; die;


        if ($result['list']['received_date'] != '0000-00-00') {
            $result['list']['received_date'] = date("d/m/Y", strtotime($result['list']['received_date']));
        }
        if ($result['list']['due_date'] != '0000-00-00') {
            $result['list']['due_date'] = date("d/m/Y", strtotime($result['list']['due_date']));
        }
        if ($result['list']['resolution_date'] != '0000-00-00') {
            $result['list']['resolution_date'] = date("d/m/Y", strtotime($result['list']['resolution_date']));
        }

        if ($result['list']['delivered_on'] != '0000-00-00') {
            $result['list']['delivered_on'] = date("d/m/Y", strtotime($result['list']['delivered_on']));
        }

        if ($result['list']['start_date'] != '0000-00-00') {
            $result['list']['start_date'] = date("d/m/Y", strtotime($result['list']['start_date']));
        }

        // print_r($result['list']['start_date']); die;
        if ($this->session->userdata('user_id')) {
            //$this->load->view('user/view_rpm', $result);
            $result['middle'] = 'user/view_rpm';
            $this->load->view('user/master-page', $result);
        }

        if ($this->session->userdata('user_id_tl')) {
            $result['middle'] = 'tl/view_rpm';
            $this->load->view('tl/master-page', $result);
        }
        
        if ($this->session->userdata('user_id_qc')) {
            $result['middle'] = 'qc/view_rpm';
            $this->load->view('qc/master-page', $result);
        }
    }

    function get_unread_message() {
        $result = $this->mdl_common->get_unread_message();
        echo json_encode($result);
    }

    function send_read_chat() {

        $this->db->where('sender_id', $this->input->post('sender_id'));
        $this->db->where('receiver_id', $this->session->userdata('user_id'));
        $this->db->update('chat', array('read_chat' => '1'));
    }

    function play_game() {

        if ($this->session->userdata('user_id')) {
            //$this->load->view('user/view_rpm', $result);
            $result['middle'] = 'user/play_game';
            $this->load->view('user/master-page', $result);
        }

        if ($this->session->userdata('user_id_tl')) {
            $result['middle'] = 'user/play_game';
            $this->load->view('tl/master-page', $result);
        }
    }

    function save_score() {
        $score = $this->input->post('score');
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        }
        if ($this->session->userdata('user_id_tl')) {
            $user_id = $this->session->userdata('user_id_tl');
        }
        $result = $this->mdl_common->save_score($score, $user_id);
        echo $result;
    }

    function get_three_max_scorer() {

        $result = $this->mdl_common->get_three_max_scorer();
        echo json_encode($result);
        //  print_r($result);
    }

    function sending_mail_smtp() {

        $email_id = 'bjkumar@technosofteng.com';
        $message = 'Hello';

        //mail($email_id,'hii');
        /*
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          mail($email_id, $message, $message ,$headers);
         */

        sending_mail_smtp(FROM_MAIL, FROM_NAME, $email_id, 'Password Has been Changed For Prodigy', $message);
    }

    function testtt() {
        // $query = $this->db->call_function('p_data_id');
        /* $query = $this->db->query("CALL GetEmployeeCount(22)");
          $result = $query->result();
          print_r($result); */

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://example.com/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        print_r($output);
        curl_close($ch);
    }
    
    

}

//PHP Socket and Network Programming with Signals