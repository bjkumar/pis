<span id="take_pg_content" class="take_pg_content"> 
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>QC List</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <select class="form-control" style="margin-top: 12%;display:none;"   name="emp_report" id="emp_report" onchange="GetInDiViDeveloperReportRPM(this.value);">
                                         <option value="">Download Report</option> 
                                     </select> 
                                </li>
                                <li style="max-width: 509px;">
                                    <form id="Date_Bet_Report_frm" name="Date_Bet_Report_frm"  action="<?php echo SITE_URL; ?>Ctl_reports/get_reports_between_dates"  method="POST">
                                  <div class="col-md-5">
                                        <div class="form-group"><label class="form-control-label" for="from_date_report">From:(D/M/Y)*</label>
                                            <div class="input-group date" id="from_date_report">
                                                <input class="form-control"  id="frm_date_report" type="text">
                                                <span class="input-group-addon" style="">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div> 
                                        </div>
                                    </div> 
                                    <div class="col-md-5">
                                        <div class="form-group"><label class="form-control-label" for="to_date_report">To:(D/M/Y)*</label>
                                            <div class="input-group date" id="to_date_report">
                                                <input class="form-control"  id="t_date_report" type="text">
                                                <span class="input-group-addon" style="">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                              </div> 
                                        </div>
                                    </div> 
                                         <input type="hidden" name="from_date_val" id="from_date_val"> 
                                         <input type="hidden" name="to_date_val" id="to_date_val">
                                         <input type="hidden" name="category" value="RPM">
                                    <div class="col-md-2" style="margin-top: 5%;">
                                        <span class="input-group-addon" style="" onclick="GetReportsBetweenDates('RPM')">
                                                    GO
                                       </span>
                                    </div>
                                   </form>
                                </li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-download"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo SITE_URL; ?>Ctl_reports/excel_rpm_all">Download Excel File</a></li>
                                        <li><a href="<?php echo SITE_URL; ?>Ctl_reports/excel_rpm_developer">Download Developer Excel File</a></li>
                                        <li><a onclick="PutEmployeeForReport();" style="cursor:pointer;">Individual Developer Report</a>
                                        </li>  

                                    </ul>

                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Build Description</th>
                                        <th>Tgram ID</th>
                                        <th>Received</th>
                                        <th>Delivered Date </th>
                                        <th>Added on Date Time</th>
                                        <th>QC By</th>
                                        <th>QC Time</th>
                                        <th></th>
                                    </tr>
                                </thead>


                                <tbody>

                                    <?php
                                    $incr = 1;
                                    foreach ($list as $row) {
                                        $qc_time = '';
                                        if ($row['qc_time'] != '0000-00-00 00:00:00') {
                                            $qc_time = $row['qc_time'];
                                        }
                                        if ($row['qc_done_by'] > 0) {
                                            $e_view = 'edit_viewed';
                                        } else {
                                            $e_view = 'edit_non_viewed';
                                        }
                                         $row_id = $row['id'];
                                         $DeleteRow = "'".$row_id.":tbl_rpm'" ;
                                        $val_url = "'" . SITE_URL . 'Ctl_common/view_rpm/' . $row['id'] . "'";
                                        echo '<tr role="row" class="' . $e_view . '" id="rowid'.$row_id.'" style="cursor:pointer;">
                                    <td> <i class="fa fa-trash" onclick="DeleteRow('.$DeleteRow.');"></i>' . $incr . '</td>
                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                    <td>' . $row['account_name'] . '</td>
                                    <td>' . $row['tgram_id'] . '</td>
                                    <td>' . $row['received_date'] . '</td> 
                                    <td>' . $row['delivered_on'] . '</td> 
                                    <td>' . $row['submit_time'] . '</td>
                                    <td>' . $row['qc_fname'] . ' ' . $row['qc_lname'] . '</td>
                                    <td>' . $qc_time . '</td>
                                    <td><a onclick="httpPageGet(' . $val_url . ')" style="cursor:pointer;">View</a></td>
                                    
                                </tr>';
                                        $incr++;
                                    }
                                    ?>




                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- Datatables -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').dataTable({
                "order": [],
            });
        });
    </script>
    <?php include 'data_table_js_footer.php'; ?>	
</span> 
