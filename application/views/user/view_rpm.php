<span id="take_pg_content" class="take_pg_content"> 
    <script>
        var helper_id = '<?php echo $list['helper_id']; ?>';
    </script>
    <?php
    if ($list['qc_done_by'] > 0) {
        $disabled = 'disabled';
    } else {
        $disabled = '';
    }
    ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class=""> 
            <div class="clearfix"></div>
            <!-- EDIT Form -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>RPM</h2> 
                            <div class="clearfix"></div>
                        </div> 

                        <div class="x_content">
                            <br />
                            <form name="rpm_form" id="rpm_form" data-parsley-validate="" class="mbr-form" novalidate="">
                                <!--  <form class="mbr-form" name="edit_form" id="edit_form" data-parsley-validate> -->
                                <!-- row strat -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_request_type">Request Type <span class="required">*</span></label>
                                            <select class="form-control rpm_request_type"  name="rpm_request_type" onchange="Put_R_Type_id_days(this.value);" <?php echo $disabled; ?>> 
                                                <option value="">-- Select --</option> 
                                                <?php foreach ($account_type as $row) { ?>
                                                    <option value="<?php echo $row['id'] . ':' . $row['late_days']; ?>" <?php
                                                            if ($row['id'] == $list['request_type_id']) {
                                                                echo 'selected';
                                                            }
                                                            ?>><?php echo $row['request_type'] ?></option>
<?php } ?>
                                            </select>
                                            <input type="hidden" name="r_typ_id_rpm" id="r_typ_id_rpm">
                                            <input type="hidden" name="r_typ_late_daye_rpm" id="r_typ_late_daye_rpm"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="rpm_received_date">Received Date: (DD/MM/YY) <span class="required">*</span></label>
                                            <div class="input-group date" id="myDatepicker_rpm">
                                                <input type="text" class="form-control" name="rpm_received_date" id="rpm_received_date" value="<?php echo $list['received_date']; ?>" <?php echo $disabled; ?>>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            <div id="ed_msgpass1" class="red_text_alert"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="tgram_id">Search TGRAM/Build Description</label>


                                            <div class="btn-group hierarchy-select" data-resize="auto" id="select-tgram-id" style="display: inherit;">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;" <?php echo $disabled; ?>>
                                                    <span class="selected-label pull-left" id="ed_tgm_id">&nbsp;</span>
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu open">
                                                    <div class="hs-searchbox">
                                                        <input type="text" class="form-control" autocomplete="off">
                                                    </div>
                                                    <ul class="dropdown-menu inner" role="menu">
                                                        <li>
                                                            <a href="#">-- Select --</a>
                                                        </li>
                                                        <?php
                                                        foreach ($tgram as $row) {
                                                            $st_tgram = $row['tgram'] . ':' . $row['account_name'] . ':' . $row['id'];
                                                            ?>
                                                            <li <?php
                                                                if ($row['id'] == $list['tgrmid']) {
                                                                    echo 'data-value="" data-default-selected=""';
                                                                }
                                                                ?>><a href="#" onclick="GetAccountName('<?php echo $st_tgram; ?>', '1')"><?php echo $row['tgram'] . ' ' . $row['account_name']; ?></a></li>
<?php } ?> 

                                                    </ul>
                                                </div>
                                                <input  class="hidden hidden-field" name="tgram_hidden_value" readonly="readonly" aria-hidden="true" type="text"/>
                                            </div>



                                            <div id="ed_msgpass0" class="red_select_alert"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_t_id"> TGRAM Id<span class="required">*</span></label>
                                            <input class="form-control" name="ed_t_id" id="t_id1" type="text" value="<?php echo $list['tgram_id']; ?>" maxlength="8" <?php echo $disabled; ?>>
                                            <input class="form-control" name="ed_tgmid" id="tgmid1" type="hidden" value="<?php echo $list['tgrmid']; ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_name">Build Description<span class="required">*</span></label>
                                            <input class="form-control" name="account_name" id="account_name1" type="text" value="<?php echo $list['account_name']; ?>" <?php echo $disabled; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="cid_rpm">CID<span class="required">*</span></label> 
                                            <input class="form-control OnlyNum" name="cid_rpm" id="cid_rpm" type="text" maxlength="5" value="<?php echo $list['cid']; ?>" <?php echo $disabled; ?>>
                                        </div>
                                    </div>







                                </div>

                                <!-- row start -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="program_rpm">Program <span class="required">*</span></label>
                                            <select class="form-control" name="program_rpm" id="program_rpm" required="" <?php echo $disabled; ?>>
                                                <option value="">-- Select --</option> 
                                                <?php foreach ($program_rpm as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>" <?php
                                                            if ($row['id'] == $list['program_id']) {
                                                                echo 'selected';
                                                            }
                                                            ?>><?php echo $row['program_rpm'] ?></option>
<?php } ?>
                                            </select>
                                            <div id="rpm_msgpass04" class="red_select_alert"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"> 
                                            <label class="form-control-label" for="requester">Requester <span class="required">*</span>
                                                <a style="cursor:pointer;margin-left:106px;" title="Show Dropdown" id="re_req_Box" onclick="PutRQDropdownTL();"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </label>
                                            <input class="form-control"  style="display:none;" name="requtr_manually" id="requtr_manually" type="text" value="<?php echo $list['requester_id']; ?>">
                                            <select class="form-control" name="requester" id="requester" required="" <?php echo $disabled; ?>>
                                                <option value="">-- Select --</option>
                                                <option value="" onclick="HideRQDropdownTL();" style="color: #0c0cc8;">Enter Manually</option>
                                                <?php foreach ($pmlist as $row) { ?>
                                                    <option value="<?php echo $row['pm']; ?>" <?php
                                                            if ($row['pm'] == $list['requester_id']) {
                                                                echo 'selected style="font-weight: bold;"';
                                                            }
                                                            ?>><?php echo $row['pm'] ?></option>
<?php } ?>
                                            </select> 
                                            <div id="rpm_msgpass05" class="red_select_alert"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="queries">Queries<span class="required">*</span></label>
                                            <select class="form-control" name="queries" onchange="CheckResolutionDate(this.value);" <?php echo $disabled; ?>>
                                                <option value="">-- Select --</option>
                                                <option value="Yes" <?php
                                                        if ('Yes' == $list['queries']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Yes</option>
                                                <option value="No" <?php
                                                        if ('No' == $list['queries']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>No</option>
                                            </select> 
                                            <div id="rpm_msgpass06" class="red_select_alert"></div>
                                        </div>
                                    </div>

                                    <?php
                                    if ($list['queries'] == 'Yes') {
                                        $res_dt_show = '';
                                    } else {
                                        $res_dt_show = 'style="display:none;"';
                                    }
                                    ?>

                                    <div class="col-md-2 resol_date" <?php echo $res_dt_show; ?>>
                                        <div class="form-group"><label class="form-control-label" for="rpm_resolution_date">Resolution Date: (DD/MM/YY) *</label>
                                            <div class="input-group date" id="resolution_date">
                                                <input type="text" class="form-control" name="rpm_resolution_date" id="rpm_resolution_date" value="<?php echo $list['resolution_date']; ?>" <?php echo $disabled; ?>>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="no_of_pages">No. of Pages<span class="required">*</span></label>
                                            <input class="form-control OnlyNum" name="no_of_pages" type="number" required="required" value="<?php echo $list['no_of_pages']; ?>" maxlength="3" <?php echo $disabled; ?>>
                                        </div>
                                    </div>

                                    <!--                                <div class="col-md-2">
                                                                        <div class="form-group"><label class="form-control-label" for="rpm_due_date">Due Date Given: (DD/MM/YY) <span class="required">*</span></label>
                                                                            <div class="input-group date" id="Datepicker_due_date">
                                                                                <input type="text" class="form-control" name="rpm_due_date" id="rpm_due_date" value="<?php echo $list['due_date'] ?>">
                                                                                <span class="input-group-addon">
                                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                                </span>
                                                                            </div> 
                                                                        </div>
                                  
    
                                </div>-->
                                </div>
                                <!-- row start -->
                                <div class="row">

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="billing_hour_rpm">Working hour<span class="required">*</span></label>
                                            <input class="form-control OnlyNum" name="billing_hour_rpm" id="billing_hour_rpm" type="text" required="required" value="<?php echo $list['billing_hour']; ?>" maxlength="5" <?php echo $disabled; ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="qc_hour_rpm">QC hour<span class="required">*</span></label>
                                            <input class="form-control OnlyNum read_only" name="qc_hour_rpm" id="qc_hour_rpm" type="text" required="required" value="<?php echo $list['qc_hour']; ?>" maxlength="4" >
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="total_hour_rpm">Total Hour<span class="required">*</span></label>
                                            <input class="form-control read_only" name="total_hour_rpm" id="total_hour_rpm" type="text" required="required" value="<?php echo $list['total_hour']; ?>">
                                        </div>
                                    </div> 

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="actual_hour_rpm">Billing Hour<span class="required">*</span></label>
                                            <input class="form-control OnlyNum" name="actual_hour_rpm" id="actual_hour_rpm" type="text" required="required" value="<?php echo $list['actual_hour']; ?>" maxlength="6" <?php echo $disabled; ?>>
                                        </div>
                                    </div> 

                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="rpm_start_date">Start Date: (DD/MM/YY) *</label>
                                            <div class="input-group date" id="rpm_start_datepicker">
                                                <input class="form-control" name="rpm_start_date" id="rpm_start_date" onkeydown="event.preventDefault()" type="text" value="<?php echo $list['start_date']; ?>" <?php echo $disabled; ?>>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="delivered">Date Delivered: (DD/MM/YY)<span class="required">*</span></label>
                                            <div class="input-group date" id="rpm_datepicker">
                                                <input type="text" class="form-control" name="rpm_date_delivered" id="rpm_date_delivered" value="<?php echo $list['delivered_on']; ?>" <?php echo $disabled; ?>>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_days">Days</label>
                                            <input class="form-control read_only" name="rpm_days" id="rpm_days" type="text" value="<?php echo $list['days']; ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_late">Late</label>
                                            <input class="form-control read_only" name="rpm_late" id="rpm_late" type="text" value="<?php echo $list['late']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_invoice_months">Invoice Month</label>
                                            <input class="form-control read_only" name="rpm_invoice_months" id="rpm_invoice_months" type="text" value="<?php echo $list['invoice_month']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_inv_date">Inv Date</label>
                                            <input class="form-control read_only" name="rpm_inv_date" id="rpm_inv_date" type="text" value="<?php echo $list['inv_date']; ?>">

                                            <input   name="ed_hours" id="ed_hours" type="hidden" value="<?php echo $list['hours']; ?>">
                                            <input   name="ed_min_seconds" id="ed_min_seconds" type="hidden" value="<?php echo $list['hhmmss']; ?>">

                                            <input  name="ed_late" id="ed_late" type="hidden" value="<?php echo $list['late']; ?>">
                                        </div>
                                    </div>
                                    <!--                                
                                                                    <div class="col-md-1">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label" for="ed_hours">Hours</label>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label" for="ed_min_seconds">HH:MM:SS</label>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label" for="ed_late">Late</label>
                                                                            
                                                                        </div>
                                                                    </div> 
                                                                </div>-->
                                </div>
                                <!-- row start -->
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label class="form-control-label" for="url">URL<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="url" id="url" value="<?php echo $list['url_rpm']; ?>" <?php echo $disabled; ?>>
                                            <input name="rpm_id" id="rpm_id" type="hidden" value="<?php echo $list['id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="remark">Remark</label>
                                            <input class="form-control" name="remark" id="remark" type="text" value="<?php echo $list['remark']; ?>" <?php echo $disabled; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="comments">Comments</label>
                                            <textarea class="form-control" name="comments" id="comments" height="20" <?php echo $disabled; ?>><?php echo $list['comments']; ?></textarea> 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="final_qc_score">QC (in %) *</label>
                                            <input class="form-control OnlyNum" maxlength="5" name="qc_score" id="qc_score" type="text" value="<?php echo $list['qc_score']; ?>" disabled> 
                                         </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    $check_uncheck = '';
                                                    $style_hide = 'style="display: none;"';
                                                    if ($list['helper_id'] > 0) {
                                                        $check_uncheck = 'checked="checked"';
                                                        $style_hide = 'checked="checked"';
                                                    }
                                                    ?>
                                                    <input type="checkbox" <?php echo $check_uncheck; ?> class="form-control-label help_checkbox" value="1" <?php echo $disabled; ?>> 
                                                    Additional Development Time
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="helper_div" <?php echo $style_hide; ?>>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label" for="emp_id">Employee Name *</label>

                                                <select class="form-control" name="emp_id" <?php echo $disabled; ?>>
                                                    <option value="">-- Select --</option>
                                                    <?php
                                                    foreach ($employee as $emp) {
                                                        if ($emp['id'] == $list['helper_id']) {
                                                            $selectd_emp = 'selected';
                                                        } else {
                                                            $selectd_emp = '';
                                                        }
                                                        echo '<option value="' . $emp['id'] . '" ' . $selectd_emp . '>' . $emp['fname'] . ' ' . $emp['lname'] . '</option>';
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label" for="emp_hour">Hours *</label>
                                                <input type="text" class="form-control OnlyNum" name="emp_hour" id="emp_hour" value="<?php echo $list['helper_hour']; ?>" maxlength="3" <?php echo $disabled; ?>>
                                            </div>
                                        </div> 

                                    </span>
                                </div>

                                <!--                            <div class="row">
                                 <div class="col-md-1">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="ed_no_of_edits">No. Of Edits</label>
                                                                        <input class="form-control" name="ed_no_of_edits" id="ed_no_of_edits" type="text" value="<?php echo $list['no_of_edits']; ?>">
                                                                    </div>
                                                                </div>
                                
                                                                <div class="col-md-1">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="ed_no_of_errors">No. Of Errors</label>
                                                                        <input class="form-control" name="ed_no_of_errors" id="ed_no_of_errors" type="text" value="<?php echo $list['no_of_errors']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="ed_qc_score">QC Score</label>
                                                                        <input class="form-control" name="ed_qc_score" id="ed_qc_score" type="text" value="<?php echo $list['qc_score']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>-->
                                <?php if ($list['qc_done_by'] < 1) { ?>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-form display-4" onclick="UpdateRPMDetailsUser(event);">Update</button>
                                    </span> 
<?php } ?>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- EDIT Form End-->

        </div>
    </div>
    <!-- /page content -->

    <!-- footer -->


    <script type="text/javascript">
        $(document).ready(function () {

            ViewEditRpmPlpJs();
        });


    </script> 	  
    <!-- / footer -->

</span> 
