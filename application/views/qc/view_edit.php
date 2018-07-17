<span id="take_pg_content" class="take_pg_content"> 
    <!--header end-->
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <!--                        <div class="page-title">
                                        <div class="title_left">
                                            <h3>Register</h3>
                                        </div>
            
                                        <div class="title_right">
                                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search for...">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button">Go!</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
            <div class="clearfix"></div>

            <!-- EDIT Form -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>EDIT</h2> 
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
                                            <label class="form-control-label" for="revision">Revision <span class="required">*</span></label>
                                            <select class="form-control" name="revision" required="">
                                                <option value="">-- Select --</option>
                                                <option value="NA">NA</option>
                                                <?php
                                                for ($i = 1; $i <= 50; $i++) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>" <?php
                                                    if ($i == $list['revision']) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?php echo $i; ?></option>
                                                        <?php }
                                                        ?> 
                                            </select> 

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_type">Account Type <span class="required">*</span></label>
                                            <select class="form-control"  name="account_type" id="ed_account_type"   required>';
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
                                                <input type="text" class="form-control future_date" name="re_assign_date" id="re_assign_date" value="<?php echo $list['re_assigned_date']; ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="pages_worked">Pages Worked<span class="required">*</span></label>
                                            <select class="form-control" name="pages_worked" required="">
                                                <option value="">-- No. of pages --</option>
                                                <?php
                                                for ($i = 1; $i <= 30; $i++) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>" <?php
                                                    if ($i == $list['pages_worked']) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?php echo $i; ?></option>
                                                        <?php }
                                                        ?>   
                                            </select> 
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
                                            <label class="form-control-label" for="push_live">Push to Live<span class="required">*</span></label>
                                            <select class="form-control" name="push_live" required="">
                                                <option value="">-- Select --</option>
                                                <option value="Yes" <?php
                                                if ('Yes' == $list['push_to_live']) {
                                                    echo 'selected';
                                                }
                                                ?>>Yes</option>
                                                <option value="No" <?php
                                                if ('No' == $list['push_to_live']) {
                                                    echo 'selected';
                                                }
                                                ?>>No</option>
                                            </select> 
                                        </div>
                                    </div>

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
                                            <label class="form-control-label" for="delivered">Delivered On: (DD/MM/YY H:M)</label>
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
                                            <label class="form-control-label" for="ed_invoice_months">Invoice Month*</label>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="m_c_details">Maintenance Contract Details<span class="required">*</span></label>
                                            <textarea class="form-control" name="m_c_details" id="m_c_details" height="20"><?php echo $list['m_c_details']; ?></textarea> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="comments">Comments</label>
                                            <textarea class="form-control" name="comments" id="comments" height="20"><?php echo $list['comments']; ?></textarea>
                                            <input name="ed_id" id="ed_id" type="hidden" value="<?php echo $list['id']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="a_t_status">Account Type Status<span class="required">*</span></label>
                                            <select class="form-control" name="a_t_status" required="">
                                                <option value="">-- Select --</option>
                                                <option value="Paid" <?php
                                                if ('Paid' == $list['a_t_status']) {
                                                    echo 'selected';
                                                }
                                                ?>>Paid</option>
                                                <option value="Free" <?php
                                                if ('Free' == $list['a_t_status']) {
                                                    echo 'selected';
                                                }
                                                ?>>Free</option>
                                                <option value="Not Clear" <?php
                                                if ('Not Clear' == $list['a_t_status']) {
                                                    echo 'selected';
                                                }
                                                ?>>Not Clear</option> 
                                            </select>
                                        </div>
                                    </div>

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
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label">PLP <span class="required">*</span></label>
                                            <select class="form-control" name="ed_plp" required="" onchange="CheckPLPExist(this.value);" disabled="">
                                                <option value="">-- Select --</option>
                                                 <option value="Yes" <?php
                                                    if ('Yes' == $list['plp']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>Yes</option>
                                                    <option value="No" <?php
                                                    if ('No' == $list['plp']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>No</option>
                                            </select>  
                                        </div>
                                    </div>


                                </div>

                                <!-- if plp yes -->
                                <?php if ($list['plp'] == 'Yes' && $list['plp_id'] > 1) { ?>

                      <div class="x_title">
                         </div>
                                <div class="x_title">
                            <h2>PLP</h2> 
                            <div class="clearfix"></div>
                        </div>
                                
                                    <!-- row strat -->
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label" for="cid_plp">CID</label>
                                                <input type="text" class="form-control" name="cid_plp" value="<?php echo $Plist['cid']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label">PLP Account Type <span class="required">*</span></label>
                                                <select class="form-control"  name="plp_account_type" required> 
                                                    <option value="">-- Select --</option> 
                                                    <?php foreach ($plp_account_type as $row) { ?>
                                                        <option value="<?php echo $row['id']; ?>" <?php
                                                        if ($row['id'] == $Plist['account_type_id']) {
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
                                      <!--  <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label">Return  *</label>
                                                <select class="form-control" name="plp_return_policy" onchange="CheckPlpNARevision(this.value);">
                                                    <option value="">-- Select --</option>
                                                    <option value="Yes" <?php
                                                    if ('Yes' == $Plist['return_e']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>Yes</option>
                                                    <option value="No" <?php
                                                    if ('No' == $Plist['return_e']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>No</option>
                                                </select> 
                                            </div>
                                        </div> -->

                                       <!-- <div class="col-md-2">
                                            <div class="form-group"><label class="form-control-label">Re-Assigned: (DD/MM/YY H:M) *</label>
                                                <div class="input-group date" id="plp_myDatepicker_re_assign">
                                                    <input type="text" class="form-control" name="plp_re_assign_date" id="plp_re_assign_date" value="<?php echo $Plist['re_assigned_date']; ?>">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Working hour * </label>
                                                <input class="form-control OnlyNum" name="plp_billing_hour" id="plp_billing_hour" type="text"  value="<?php echo $Plist['billing_hour']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">QC hour *</label>
                                                <input class="form-control OnlyNum" name="plp_qc_hour" id="plp_qc_hour" type="text"  value="<?php echo $Plist['qc_hour']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Total Hour  </label>
                                                <input class="form-control read_only" name="plp_total_hour" id="plp_total_hour" type="text" required="required" value="<?php echo $Plist['total_hour']; ?>">
                                            </div>
                                        </div> 

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Billing Hour </label>
                                                <input class="form-control OnlyNum" name="plp_actual_hour" id="plp_actual_hour" type="text" required="required" value="<?php echo $Plist['actual_hour']; ?>">
                                            </div>
                                        </div> 

                                    </div>

                                    <!-- row start -->
                                    <div class="row">
                                        <!--<div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label">Status *</label>
                                                <select class="form-control" name="plp_ed_status" required="">
                                                    <option value="">-- Select --</option>
                                                    <option value="Delivered" <?php
                                                    if ('Delivered' == $Plist['status']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>Delivered</option>
                                                    <option value="Cancelled" <?php
                                                    if ('Cancelled' == $Plist['status']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>Cancelled</option>
                                                    <option value="Returned" <?php
                                                    if ('Returned' == $Plist['status']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>Returned</option>
                                                    <option value="On Hold" <?php
                                                    if ('On Hold' == $Plist['status']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>On Hold</option>
                                                </select> 
                                            </div>
                                        </div>  

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label">Delivered On: (DD/MM/YY H:M) *</label>
                                                <div class="input-group date plp_myDatepicker_delivered" id="plp_myDatepicker_delivered">
                                                    <input type="text" class="form-control" name="plp_delivered" id="plp_delivered" value="<?php echo $Plist['delivered_on']; ?>">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Days *</label>
                                                <input class="form-control read_only" name="plp_ed_days" id="plp_ed_days" type="text" value="<?php echo $Plist['days']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Invoice Month</label>
                                                <input class="form-control read_only" name="plp_ed_invoice_months" id="plp_ed_invoice_months" type="text" value="<?php echo $Plist['invoice_month']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Inv Date</label>
                                                <input class="form-control read_only" name="plp_ed_inv_date" id="plp_ed_inv_date" type="text" value="<?php echo $Plist['inv_date']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Hours</label>
                                                <input class="form-control read_only" name="plp_ed_hours" id="plp_ed_hours" type="text" value="<?php echo $Plist['hours']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">HH:MM:SS</label>
                                                <input class="form-control read_only" name="plp_ed_min_seconds" id="plp_ed_min_seconds" type="text" value="<?php echo $Plist['hhmmss']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Late</label>
                                                <input name="plp_ed_ac_late_hour" id="plp_ed_ac_late_hour" type="hidden" value="<?php echo $Plist['ac_late_hour']; ?>">
                                                <input class="form-control read_only" name="plp_ed_late" id="plp_ed_late" type="text" value="<?php echo $Plist['late']; ?>">
                                            </div>
                                        </div> -->
                                    </div>

                                    <!-- row start -->
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label class="form-control-label">Comments</label>
                                                <textarea class="form-control" name="plp_comments" id="plp_comments" height="20"><?php echo $Plist['comments']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-control-label">Error Details</label>
                                                <input class="form-control" name="error_details_plp" id="error_details_plp" type="text" value="<?php echo $Plist['error_details_plp']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                      <!--  <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">No. Of Edits</label>
                                                <input class="form-control OnlyNum" name="plp_ed_no_of_edits" id="plp_ed_no_of_edits" type="text" value="<?php echo $Plist['no_of_edits']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">No. Of Errors</label>
                                                <input class="form-control OnlyNum" name="plp_ed_no_of_errors" id="plp_ed_no_of_errors" type="text" value="<?php echo $Plist['no_of_errors']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">QC Score</label>
                                                <input class="form-control read_only" name="plp_ed_qc_score" id="plp_ed_qc_score" type="text" value="<?php echo $Plist['qc_score']; ?>">
                                            </div>
                                        </div> -->
                                        <input name="plp_ed_id" id="plp_ed_id" type="hidden" value="<?php echo $Plist['id']; ?>">
                                    </div>



                                <?php } ?>
                                <!-- if plp yes form end -->

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-form display-4" onclick="UpdateEditDetails(event);">Update</button>
                                </span> 
                            </form>






                            <!-- Disintegrate table generate start   -->
                            <?php
                            $isintegrate = 'div_hide';
                            if ($list['qc_score']) {
                                $isintegrate = '';
                            }
                            ?>

                            <div class="row <?php echo $isintegrate; ?>" style="color: black;">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">
                                    <h2>  Disintegrate  </h2>          

                                    <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Company Name</th>
                                                <th><?php echo $list['account_name']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Revision No. </td>
                                                <td><?php echo $list['revision']; ?> </td>
                                            </tr> 
                                            <tr>
                                                <td>Date Assigned (EST) </td>
                                                <td><?php echo $list['received_date']; ?></td>
                                            </tr> 
                                            <tr>
                                                <td>Re-assigned On (if returned) </td>
                                                <td><?php echo $list['re_assigned_date']; ?> </td>
                                            </tr> 
                                            <tr>
                                                <td>Delivered On(EST)</td>
                                                <td><?php echo $list['delivered_on']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Turnaround time (Hours - excludes weekends)</td>
                                                <td><?php echo $list['ac_late_hour']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Actual Editing Time (Includes QC)</td>
                                                <td><?php echo $list['qc_hour']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>SLA Status</td>
                                                <td><?php echo $list['late']; ?> </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Disintegrate table generate end  -->
                        </div>
 
                    </div>
 
                </div>
            </div>
            <!-- EDIT Form End-->

        </div>
    </div>


    <!-- /page content --> 
    <!-- select search dropdown js -->
    <script src="<?php echo SITE_URL; ?>asset/js/hierarchy-select.min.js"></script>
    <!-- date picker js -->
    <script src="<?php echo SITE_URL; ?>asset/js/moment/moment.min.js"></script>
    <script src="<?php echo SITE_URL; ?>asset/js/bootstrap-datetimepicker.min.js"></script>

   
</span> 

 <script type="text/javascript">
     ViewEditRpmPlpJs();
                                        $(document).ready(function () {
 
                                       /*    $('#select-tgram-id').hierarchySelect({
                                                hierarchy: false,
                                                width: 223
                                            });

                                            $('#select-pm1').hierarchySelect({
                                                hierarchy: false,
                                            });

                                            //  $('#myDatepicker').datetimepicker(); for 12 hour
                                            $('#myDatepicker_standerd').datetimepicker({
                                                format: 'DD/MM/YYYY HH:mm'
                                            });

                                            $('#myDatepicker_re_assign').datetimepicker({
                                                format: 'DD/MM/YYYY HH:mm'
                                            });

                                            $("#myDatepicker_delivered").datetimepicker({
                                                format: 'DD/MM/YYYY HH:mm'
                                            });

                                            $("#myDatepicker_delivered").on("dp.change", function (e) {
                                                var date2 = e.date.format('DD/MM/YYYY HH:mm');
                                                date2 = date2.trim();
                                                GetDaysBetDates(date2);
                                            });

                                            $('#plp_myDatepicker_re_assign').datetimepicker({
                                                format: 'DD/MM/YYYY HH:mm'
                                            });
                                            
                                            $('#plp_myDatepicker_delivered').datetimepicker({
                                                format: 'DD/MM/YYYY HH:mm'
                                            }); */ 

                                        });








    </script>
