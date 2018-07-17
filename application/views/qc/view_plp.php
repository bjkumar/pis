<span id="take_pg_content" class="take_pg_content">
    <!-- page content -->
    <div class="right_col" role="main">
        <div class=""> 
            <div class="clearfix"></div>
            <!-- EDIT Form -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>PLP</h2> 
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <br />
                            <form name="edit_form" id="edit_form" data-parsley-validate="" class="mbr-form" novalidate="">
                                <!--  <form class="mbr-form" name="edit_form" id="edit_form" data-parsley-validate> -->
                                <!-- row strat -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="tgram_id">Search TGRAM/Account Name <span class="required">*</span></label>


                                            <div class="btn-group hierarchy-select" data-resize="auto" id="select-tgram-id" style="display: inherit;">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
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

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_t_id"> TGRAM Id</label>
                                            <input class="form-control OnlyNum" name="ed_t_id" id="t_id1" type="text" value="<?php echo $list['tgram_id']; ?>">
                                            <input class="form-control" name="ed_tgmid" id="tgmid1" type="hidden" value="<?php echo $list['tgrmid']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_name">Account Name</label>
                                            <input class="form-control" name="account_name" id="account_name1" type="text" value="<?php echo $list['account_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="cid_plp">CID</label>
                                            <input type="text" class="form-control OnlyNum" name="cid_plp" value="<?php echo $list['cid']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="received_date">Received Date: (DD/MM/YY H:M) <span class="required">*</span></label>
                                            <div class="input-group date" id="myDatepicker_standerd">
                                                <input type="text" class="form-control" name="received_date" id="received_date" value="<?php echo $list['received_date']; ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            <div id="ed_msgpass1" class="red_text_alert"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_type">Account Type <span class="required">*</span></label>
                                            <select class="form-control"  name="account_type" id="ed_account_type"   required>
                                                <option value="">-- Select --</option> 
                                                <?php foreach ($account_type as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>" <?php
                                                    if ($row['id'] == $list['account_type_id']) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?php echo $row['account_type'] ?></option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <!-- row start -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="return_policy">PM 

                                                <?php
                                                if ($list['pm'] != '') {
                                                    echo '<a style="display: none;cursor:pointer;margin-left:170px;" title="Show Dropdown" id="re_Pm_Box1" onclick="PutPMDropdown(1);"><i class="fa fa-refresh" aria-hidden="true"></i></a>';
                                                } else {
                                                    echo '<a style="cursor:pointer;margin-left:170px;" title="Show Dropdown" id="re_Pm_Box1" onclick="PutPMDropdown(1);"><i class="fa fa-refresh" aria-hidden="true"></i></a>';
                                                }
                                                ?>
                                            </label>

                                            <?php
                                            $cls_pm = 'div_hide';
                                            if ($list['pm'] != '') {
                                                $cls_pm = 'div_inherit';
                                                echo '<input style="display:none;" class="form-control" name="select_pm_manually" id="select_pm_manually1" type="text">';
                                            } else {
                                                echo '<input class="form-control" name="select_pm_manually" id="select_pm_manually1" type="text"  value="' . $list['pm_id'] . '">';
                                            }
                                            ?>

                                            <div class="btn-group hierarchy-select <?php echo $cls_pm; ?>" data-resize="auto" id="select-pm1">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
                                                    <span class="selected-label pull-left" id="ed_pm">&nbsp;</span>
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu open">
                                                    <div class="hs-searchbox">
                                                        <input type="text" class="form-control" autocomplete="off">
                                                    </div>
                                                    <ul class="dropdown-menu inner" role="menu">
                                                        <li><a href="#" onclick="PutPMManully('1');" style="color:black;font-weight: bold;">Enter Manually</a></li>
                                                        <?php foreach ($pmlist as $row) { ?>
                                                            <li <?php
                                                            if ($row['pm'] == $list['pm']) {
                                                                echo 'data-value="" data-default-selected=""';
                                                            }
                                                            ?>><a href="#" onclick="GetPMIdInTextBox('<?php echo $row['id']; ?>');"><?php echo $row['pm']; ?></a></li>
                                                            <?php } ?> 



                                                    </ul>
                                                </div>
                                                <input  class="hidden hidden-field" name="pm_hidden_value" readonly="readonly" aria-hidden="true" type="text"/>

                                            </div>

                                            <div id="ed_msgpasspm1" class="red_select_alert"></div>
                                            <input type="hidden" name="ed_pmid" id="ed_pmid1" value="<?php echo $list['pm_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="return_policy">Return<span class="required">*</span></label>
                                            <select class="form-control" name="return_policy" required="" onchange="CheckNARevision(this.value);">
                                                <option value="">-- Select --</option>
                                                <option value="Yes" <?php
                                                if ('Yes' == $list['return_e']) {
                                                    echo 'selected';
                                                }
                                                ?>>Yes</option>
                                                <option value="No" <?php
                                                if ('No' == $list['return_e']) {
                                                    echo 'selected';
                                                }
                                                ?>>No</option>
                                            </select> 
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="re_assign_date">Re-Assigned: (DD/MM/YY H:M) <span class="required">*</span></label>
                                            <div class="input-group date" id="myDatepicker_re_assign">
                                                <input type="text" class="form-control" name="re_assign_date" id="re_assign_date" value="<?php echo $list['re_assigned_date']; ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="billing_hour">Working hour<span class="required">*</span></label>
                                            <input class="form-control OnlyNum" name="billing_hour" id="billing_hour" type="text" required="required" value="<?php echo $list['billing_hour']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="qc_hour">QC hour<span class="required">*</span></label>
                                            <input class="form-control OnlyNum" name="qc_hour" id="qc_hour" type="text" required="required" value="<?php echo $list['qc_hour']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="total_hour">Total Hour<span class="required">*</span></label>
                                            <input class="form-control read_only" name="total_hour" id="total_hour" type="text" required="required" value="<?php echo $list['total_hour']; ?>">
                                        </div>
                                    </div> 

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="total_hour">Billing Hour<span class="required">*</span></label>
                                            <input class="form-control OnlyNum" name="actual_hour" id="actual_hour" type="text" required="required" value="<?php echo $list['actual_hour']; ?>">
                                        </div>
                                    </div> 

                                </div>

                                <!-- row start -->
                                <div class="row">


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_status">Status<span class="required">*</span></label>
                                            <select class="form-control" name="ed_status" required="">
                                                <option value="">-- Select --</option>
                                                <option value="Delivered" <?php
                                                if ('Delivered' == $list['status']) {
                                                    echo 'selected';
                                                }
                                                ?>>Delivered</option>
                                                <option value="Cancelled" <?php
                                                if ('Cancelled' == $list['status']) {
                                                    echo 'selected';
                                                }
                                                ?>>Cancelled</option>
                                                <option value="Returned" <?php
                                                if ('Returned' == $list['status']) {
                                                    echo 'selected';
                                                }
                                                ?>>Returned</option>
                                                <option value="On Hold" <?php
                                                if ('On Hold' == $list['status']) {
                                                    echo 'selected';
                                                }
                                                ?>>On Hold</option>
                                            </select> 
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="delivered">Delivered On: (DD/MM/YY H:M) *</label>
                                            <div class="input-group date myDatepicker_delivered" id="myDatepicker_delivered">
                                                <input type="text" class="form-control" name="delivered" id="delivered" value="<?php echo $list['delivered_on']; ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_days">Days *</label>
                                            <input class="form-control read_only" name="ed_days" id="ed_days" type="text" value="<?php echo $list['days']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_invoice_months">Invoice Month</label>
                                            <input class="form-control read_only" name="ed_invoice_months" id="ed_invoice_months" type="text" value="<?php echo $list['invoice_month']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_inv_date">Inv Date</label>
                                            <input class="form-control read_only" name="ed_inv_date" id="ed_inv_date" type="text" value="<?php echo $list['inv_date']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_hours">Hours</label>
                                            <input class="form-control read_only" name="ed_hours" id="ed_hours" type="text" value="<?php echo $list['hours']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_min_seconds">HH:MM:SS</label>
                                            <input class="form-control read_only" name="ed_min_seconds" id="ed_min_seconds" type="text" value="<?php echo $list['hhmmss']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_late">Late</label>
                                            <input name="ed_ac_late_hour" id="ed_ac_late_hour" type="hidden" value="<?php echo $list['ac_late_hour']; ?>">
                                            <input class="form-control read_only" name="ed_late" id="ed_late" type="text" value="<?php echo $list['late']; ?>">
                                        </div>
                                    </div> 
                                </div>

                                <!-- row start -->
                                <div class="row">

                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label class="form-control-label" for="comments">Comments</label>
                                            <textarea class="form-control" name="comments" id="comments" height="20"><?php echo $list['comments']; ?></textarea>
                                            <input name="ed_id" id="ed_id" type="hidden" value="<?php echo $list['id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="error_details_plp">Error Details</label>
                                            <input class="form-control" name="error_details_plp" id="error_details_plp" type="text" value="<?php echo $list['error_details_plp']; ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_no_of_edits">No. Of Edits</label>
                                            <input class="form-control OnlyNum" name="ed_no_of_edits" id="ed_no_of_edits" type="text" value="<?php echo $list['no_of_edits']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_no_of_errors">No. Of Errors</label>
                                            <input class="form-control OnlyNum" name="ed_no_of_errors" id="ed_no_of_errors" type="text" value="<?php echo $list['no_of_errors']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_qc_score">QC Score</label>
                                            <input class="form-control read_only" name="ed_qc_score" id="ed_qc_score" type="text" value="<?php echo $list['qc_score']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-form display-4" onclick="UpdatePLPDetails(event);">Update</button>
                                </span> 
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- EDIT Form End-->

        </div>
    </div>


    <!-- /page content -->


    <script type="text/javascript">

        $(document).ready(function () {

            $('#select-tgram-id').hierarchySelect({
                hierarchy: false,
                width: 223
            });

            $('#select-pm1').hierarchySelect({
                hierarchy: false,
            });

            $('#myDatepicker_standerd').datetimepicker({
                format: 'DD/MM/YYYY HH:mm'
            });

            $('#myDatepicker_re_assign').datetimepicker({
                format: 'DD/MM/YYYY HH:mm'
            });

            $("#myDatepicker_re_assign").on("dp.change", function (e) {
                var date2 = e.date.format('DD/MM/YYYY HH:mm');
                date2 = date2.trim();
                BeforeDateSelectValidation($('#received_date').val(), date2, 're_assign_date', 'Re-Assigned Date smaller Be larger than Received Date');
                GetDaysBetDatesPLP_Re_Assign(date2);
            });

            $("#myDatepicker_delivered").datetimepicker({
                format: 'DD/MM/YYYY HH:mm'
            });

            $("#myDatepicker_delivered").on("dp.change", function (e) {
                var date2 = e.date.format('DD/MM/YYYY HH:mm');
                date2 = date2.trim();

                if ($('#re_assign_date').val() == "" || $('select[name=return_policy]').val() == "") {
                    alert('Select Return and Re-Assigned Fileds Properly!');
                    $('#delivered').val('');
                }
                BeforeDateSelectValidation($('#re_assign_date').val(), date2, 'delivered', 'Delivered On Date Should Be larger than Received Date or Re-Assigned Date');
                GetDaysBetDates(date2);
            });
            $(".date").on("dp.change", function (e) {
                var date2 = e.date.format('DD/MM/YYYY HH:mm');
                date2 = date2.trim();
                var id = $(this).children("input").attr("id");
                FutureDateValidation(date2, id);
            });

        });








    </script>
</span>

