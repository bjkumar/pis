<?php

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctl_reports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_common');
        $this->load->model('Mdl_report');
        date_default_timezone_set("Asia/Kolkata");
    }

    /*   * ********************* Reports between dates ************************************************************ */

    function get_reports_between_dates() {
        $post = $this->input->post();
        if ($post['category'] == 'RPM') {
            $rpmData = $this->Mdl_report->get_reports_between_dates_rpm($post);
            $this->excel_rpm_all_report_common($rpmData); 
        }
        
        if ($post['category'] == 'EDIT') {
            $editData = $this->Mdl_report->get_indivi_edit_developer($id=null,$post);
            $this->get_report_indi_edit_developer($editData); 
        }
        
        if ($post['category'] == 'PLP') {
             $plpData = $this->Mdl_report->get_indivi_plp_developer($emp_id=null,$post);
             $this->get_report_plp_developer($plpData);
             //echo '<pre>';  print_r($plpData); echo '</pre>';die;
        }
    }

    /*  **************  RPM Report Start ****************************  */
    
    public function excel_indi_rpm_developer($emp_id = null) {
        $rpmData = $this->Mdl_report->get_indivi_rpm_developer($emp_id);
        $this->excel_rpm_all_report_common($rpmData);
    }

    public function excel_rpm_all() {
        $rpmData = $this->mdl_common->get_all_rpm_list($tl_id = null);
        $this->excel_rpm_all_report_common($rpmData);
    }

    public function excel_rpm_developer() {
        $rpmData = $this->mdl_common->get_all_rpm_developer($tl_id = null);
        $this->excel_rpm_all_report_common($rpmData);
    }

    /*  **************  RPM Report END ****************************  */
    
    function excel_indi_edit_developer($emp_id) {
        $editData = $this->Mdl_report->get_indivi_edit_developer($emp_id,$post=null);
        $this->get_report_indi_edit_developer($editData);
    }
    
    function excel_edit_all() {
        $editData = $this->Mdl_report->get_indivi_edit_developer($emp_id=null,$post=null);
        $this->get_report_indi_edit_developer($editData);
    } 

    public function get_report_indi_edit_developer($editData) {
            //  $editData = $this->get_indi_edit_developer($emp_id);

        if (!$editData) {
            echo 'Record Not Found For This User! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . base_url() . '/Ctl_common/edit_list">Back</a>';
            die;
        }
        require_once './application/third_party/PHPExcel.php';
        require_once './application/third_party/PHPExcel/IOFactory.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '585857'),
        );

        $acc_default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '585857'),
        );
        $outlet_style_header = array(
            'font' => array(
                'color' => array('rgb' => '585857'),
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
                'color' => array('rgb' => '585857'),
            ),
            'font' => array(
                'color' => array('rgb' => '585857'),
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
                'color' => array('rgb' => 'c0504d'), // for header background color //
            ),
            'font' => array(
                'color' => array('rgb' => 'ffffff'), // for text color
                'size' => 11,
                'name' => 'Calibri',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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

        /*         * **** For All whole Body styling ******** */
        $excel_body_style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $objPHPExcel->getDefaultStyle()->applyFromArray($excel_body_style);
        $objPHPExcel->getActiveSheet()->getStyle('A1:AF1')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sr. No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Invoice Month');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Month');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Date & Time');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Date');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'TGRAMS');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Account Name');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Revision');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Type');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'PM');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Ret');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Re-assigned');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Response');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Assigned To');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Pages Worked');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Working Hours');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'QC hours');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Total Hours');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Push to Live Date');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'PLP');
        $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Status');
        $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Delivered On');
        $objPHPExcel->getActiveSheet()->setCellValue('W1', 'Days');
        $objPHPExcel->getActiveSheet()->setCellValue('X1', 'Hours');
        $objPHPExcel->getActiveSheet()->setCellValue('Y1', 'HH:MM:SS');
        $objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Late');
        $objPHPExcel->getActiveSheet()->setCellValue('AA1', 'No of Edit requests');
        $objPHPExcel->getActiveSheet()->setCellValue('AB1', 'No. of Errors');
        $objPHPExcel->getActiveSheet()->setCellValue('AC1', 'QC Score');
        $objPHPExcel->getActiveSheet()->setCellValue('AD1', 'Maintenance Contract Details');
        $objPHPExcel->getActiveSheet()->setCellValue('AE1', 'Comments');
        $objPHPExcel->getActiveSheet()->setCellValue('AF1', 'Billing Hours');



        // $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('R1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('S1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('T1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('U1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('V1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('W1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('X1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('Y1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('Z1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('AA1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('AB1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('AC1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('AD1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('AE1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('AF1')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(11);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(29);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(22);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);


        $row = 2;

        foreach ($editData as $value) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $row);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $value['invoice_month']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $value['invoice_month']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $value['received_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $value['inv_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $value['tgram_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $value['account_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $value['revision']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $value['account_type'] . ' ' . $value['a_t_status']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $value['pm']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $value['return_e']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $value['re_assigned_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, 'response');          // response//
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $value['user_fname']);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $value['pages_worked']);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, $value['billing_hour']);
            $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $value['qc_hour']);
            $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, $value['total_hour']);
            $objPHPExcel->getActiveSheet()->setCellValue('S' . $row, $value['push_to_live']);
            $objPHPExcel->getActiveSheet()->setCellValue('T' . $row, $value['plp']);               // PLP//
            $objPHPExcel->getActiveSheet()->setCellValue('U' . $row, $value['status']);
            $objPHPExcel->getActiveSheet()->setCellValue('V' . $row, $value['delivered_on']);
            $objPHPExcel->getActiveSheet()->setCellValue('W' . $row, $value['days']);
            $objPHPExcel->getActiveSheet()->setCellValue('X' . $row, $value['hours']);
            $objPHPExcel->getActiveSheet()->setCellValue('Y' . $row, $value['hhmmss']);
            $objPHPExcel->getActiveSheet()->setCellValue('Z' . $row, $value['late']);
            $objPHPExcel->getActiveSheet()->setCellValue('AA' . $row, $value['no_of_edits']);                 //No of Edit requests
            $objPHPExcel->getActiveSheet()->setCellValue('AB' . $row, $value['no_of_errors']);                  //No. of Errors
            $objPHPExcel->getActiveSheet()->setCellValue('AC' . $row, $value['qc_score'] . '%');             //QC Score
            $objPHPExcel->getActiveSheet()->setCellValue('AD' . $row, $value['m_c_details']);
            $objPHPExcel->getActiveSheet()->setCellValue('AE' . $row, $value['comments']);
            $objPHPExcel->getActiveSheet()->setCellValue('AF' . $row, $value['actual_hour']);
            $row++;
        }
        $date_time = date("d-m-Y-G-i-s", time());
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Edit_Excel_Report-' . $date_time . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    
    function excel_indi_plp_developer($emp_id) {
        $plpData = $this->Mdl_report->get_indivi_plp_developer($emp_id,$post=null);
         $this->get_report_plp_developer($plpData);
    }
    
    function excel_plp_all() {
        $plpData = $this->Mdl_report->get_indivi_plp_developer($emp_id=null,$post=null);
         $this->get_report_plp_developer($plpData);
    }

    public function get_report_plp_developer($plpData) {
         
        if (!$plpData) {
            echo 'Record Not Found For This User! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . base_url() . '/Ctl_common/plp_list">Back</a>';
            die;
        }
        require_once './application/third_party/PHPExcel.php';
        require_once './application/third_party/PHPExcel/IOFactory.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '585857'),
        );

        $acc_default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '585857'),
        );
        $outlet_style_header = array(
            'font' => array(
                'color' => array('rgb' => '585857'),
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
                'color' => array('rgb' => '585857'),
            ),
            'font' => array(
                'color' => array('rgb' => '585857'),
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
                'color' => array('rgb' => '1f497d'), // for header background color //
            ),
            'font' => array(
                'color' => array('rgb' => 'ffffff'), // for text color
                'size' => 11,
                'name' => 'Calibri',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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

        /*         * **** For All whole Body styling ******** */
        $excel_body_style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $objPHPExcel->getDefaultStyle()->applyFromArray($excel_body_style);
        $objPHPExcel->getActiveSheet()->getStyle('A1:AF1')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sr. No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Invoice Month');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Month');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Date & Time');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Date');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'CID');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'TGRAMS');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Account Name');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Type');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'PM');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Ret');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Re-assigned');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Response');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Assigned To');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Working Hours');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'QC hours');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Total Hours');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Status');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Delivered On');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Days');
        $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Hours');
        $objPHPExcel->getActiveSheet()->setCellValue('V1', 'HH:MM:SS');
        $objPHPExcel->getActiveSheet()->setCellValue('W1', 'Late');
        $objPHPExcel->getActiveSheet()->setCellValue('X1', 'No. of Errors');
        $objPHPExcel->getActiveSheet()->setCellValue('Y1', 'QC Score');
        $objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Comments');
        $objPHPExcel->getActiveSheet()->setCellValue('AA1', 'Error Details');



        // $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('R1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('S1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('T1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('U1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('V1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('W1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('X1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('Y1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('Z1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('AA1')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(19);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(22);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(11);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(19);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(29);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);


        $row = 2;

        foreach ($plpData as $value) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $row);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $value['invoice_month']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $value['invoice_month']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $value['received_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $value['inv_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $value['cid']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $value['tgram_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $value['account_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $value['account_type']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $value['pm']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $value['return_e']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $value['re_assigned_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, 'response');          // response//
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $value['user_fname']);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $value['billing_hour']);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, $value['qc_hour']);
            $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $value['total_hour']);              // PLP//
            $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, $value['status']);
            $objPHPExcel->getActiveSheet()->setCellValue('S' . $row, $value['delivered_on']);
            $objPHPExcel->getActiveSheet()->setCellValue('T' . $row, $value['days']);
            $objPHPExcel->getActiveSheet()->setCellValue('U' . $row, $value['hours']);
            $objPHPExcel->getActiveSheet()->setCellValue('V' . $row, $value['hhmmss']);
            $objPHPExcel->getActiveSheet()->setCellValue('W' . $row, $value['late']);                 //No of Edit requests
            $objPHPExcel->getActiveSheet()->setCellValue('X' . $row, $value['no_of_errors']);                  //No. of Errors
            $objPHPExcel->getActiveSheet()->setCellValue('Y' . $row, $value['qc_score'] . '%');
            $objPHPExcel->getActiveSheet()->setCellValue('Z' . $row, $value['comments']);
            $objPHPExcel->getActiveSheet()->setCellValue('AA' . $row, $value['error_details_plp']);
            $row++;
        }
        $date_time = date("d-m-Y-G-i-s", time());
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PLP_Excel_Report-' . $date_time . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    /*     * *****************RPM ***********************RPM ************************  All RPM report ***********************************RPM *****************************RPM**************  */

    public function excel_rpm_all_report_common($rpmData) {
        if (!$rpmData) {
            echo 'Record Not Found! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . base_url() . '/Ctl_common/qc_rpm_list">Back</a>';
            die;
        }

        require_once './application/third_party/PHPExcel.php';
        require_once './application/third_party/PHPExcel/IOFactory.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '585857'),
        );

        $acc_default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '585857'),
        );
        $outlet_style_header = array(
            'font' => array(
                'color' => array('rgb' => '585857'),
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
                'color' => array('rgb' => '585857'),
            ),
            'font' => array(
                'color' => array('rgb' => '585857'),
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
                'color' => array('rgb' => 'c0504d'), // for header background color //
            ),
            'font' => array(
                'color' => array('rgb' => 'ffffff'), // for text color
                'size' => 11,
                'name' => 'Calibri',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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

        /*         * **** For All whole Body styling ******** */
        $excel_body_style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $objPHPExcel->getDefaultStyle()->applyFromArray($excel_body_style);
        $objPHPExcel->getActiveSheet()->getStyle('A1:AF1')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sr. No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Date Received');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'TGRAM ID');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Build Description');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Request Type');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Program');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Requester');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Queries');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Assigned To');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Days Reqd');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Due Date Given');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Status');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Hrs Worked');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'QC hours');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'QC Done By');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Total Hours');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Actual Hours');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', 'No. of Pages');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Date Delivered');
        $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Month');
        $objPHPExcel->getActiveSheet()->setCellValue('U1', 'URL');
        $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Comments');
        $objPHPExcel->getActiveSheet()->setCellValue('W1', 'Remarks');


        // $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('R1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('S1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('T1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('U1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('V1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('W1')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(11);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);


        $row = 2;
        $sr_no = 1;

        foreach ($rpmData as $value) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr_no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $value['rec_date_n']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $value['tgram_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $value['account_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $value['request_type']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $value['program_rpm']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $value['requester_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $value['queries']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $value['user_fname']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $value['days_reqd']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $value['due_date_n']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $value['status']);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $value['billing_hour']);          // response//
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $value['qc_hour']);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $value['tl_fname']);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, $value['total_hour']);
            $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $value['actual_hour']);
            $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, $value['no_of_pages']);
            $objPHPExcel->getActiveSheet()->setCellValue('S' . $row, $value['deliv_date_n']);
            $objPHPExcel->getActiveSheet()->setCellValue('T' . $row, $value['invoice_month']);               // PLP//
            $objPHPExcel->getActiveSheet()->setCellValue('U' . $row, $value['url_rpm']);
            $objPHPExcel->getActiveSheet()->setCellValue('V' . $row, $value['comments']);
            $objPHPExcel->getActiveSheet()->setCellValue('W' . $row, $value['remark']);
            $row++;
            $sr_no++;
        }
        $date_time = date("d-m-Y-G-i-s", time());
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RPM_Excel_Report-' . $date_time . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    
    /* -- for test purpose   */
/*
    function get_reports_between_dates_rpm($post) {
        $array['list'] = $this->Mdl_report->get_reports_between_dates_rpm($emp_id);
        return $array['list'];
    }
*/
}

//PHP Socket and Network Programming with Signals