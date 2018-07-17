<span id="take_pg_content" class="take_pg_content"> 
    
     <?php if ($list['tl_id'] > 0) {   
        $disabled = 'disabled'; 
     }else{
        $disabled = ''; 
     }
     ?>
    
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
                            <h2>Update Edit</h2> 
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
                                            <label class="form-control-label" for="tgram_id">Search TGRAM/Account Name </label>


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

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_t_id"> TGRAM Id *</label>
                                            <input class="form-control OnlyNum" name="ed_t_id" id="t_id1" type="text" value="<?php echo $list['tgram_id']; ?>" <?php echo $disabled; ?>>
                                            <input class="form-control" name="ed_tgmid" id="tgmid1" type="hidden" value="<?php echo $list['tgrmid']; ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_name">Account Name *</label>
                                            <input class="form-control" name="account_name" id="account_name1" type="text" value="<?php echo $list['account_name']; ?>" <?php echo $disabled; ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="received_date">Received Date: (DD/MM/YY H:M) *</label>
                                            <div class="input-group date" id="myDatepicker_standerd">
                                                <input type="text" class="form-control" name="received_date" id="received_date" value="<?php echo $list['received_date']; ?>" <?php echo $disabled; ?>>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            <div id="ed_msgpass1" class="red_text_alert"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="revision">Revision *</label>
                                            <select class="form-control" name="revision" required="" <?php echo $disabled; ?>>
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
                                            <label class="form-control-label" for="account_type">Account Type *</label>
                                            <select class="form-control"  name="account_type" id="ed_account_type"   required <?php echo $disabled; ?>>
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
                                            <label class="form-control-label" for="return_policy">PM  *

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
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;" <?php echo $disabled; ?>>
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
                                            <label class="form-control-label" for="return_policy">Return </label>
                                            <select class="form-control" name="return_policy" required="" onchange="CheckNARevision(this.value);" disabled>
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
                                        <div class="form-group"><label class="form-control-label" for="re_assign_date">Re-Assigned: (DD/MM/YY H:M) </label>
                                            <div class="input-group date" id="myDatepicker_re_assign">
                                                <input type="text" class="form-control future_date" name="re_assign_date" id="re_assign_date" value="<?php echo $list['re_assigned_date']; ?>" disabled>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="pages_worked">Pages Worked *</label>
                                            <select class="form-control" name="pages_worked" required="" <?php echo $disabled; ?>>
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
                                            <label class="form-control-label" for="billing_hour">Working hour *</label>
                                            <input class="form-control OnlyNum" name="billing_hour" id="billing_hour" type="text" required="required" value="<?php echo $list['billing_hour']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="qc_hour">QC hour </label>
                                            <input class="form-control OnlyNum read_only"  name="qc_hour" id="qc_hour" type="text" required="required" value="<?php echo $list['qc_hour']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="total_hour">Total Hour *</label>
                                            <input class="form-control read_only" name="total_hour" id="total_hour" type="text" required="required" value="<?php echo $list['total_hour']; ?>">
                                        </div>
                                    </div> 

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="total_hour">Billing Hour *</label>
                                            <input class="form-control OnlyNum" disabled name="actual_hour" id="actual_hour" type="text" required="required" value="<?php echo $list['actual_hour']; ?>">
                                        </div>
                                    </div> 

                                </div>

                                <!-- row start -->
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="push_live">Push to Live </label>
                                            <select class="form-control" name="push_live" required="" disabled>
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
                                            <label class="form-control-label" for="ed_status">Status </label>
                                            <select class="form-control" name="ed_status" required="" disabled>
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
                                            <label class="form-control-label" for="delivered">Delivered On: (DD/MM/YY H:M) </label>
                                            <div class="input-group date myDatepicker_delivered" id="myDatepicker_delivered">
                                                <input type="text" class="form-control" name="delivered" id="delivered" value="<?php echo $list['delivered_on']; ?>" disabled>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_days">Days </label>
                                            <input class="form-control read_only" name="ed_days" id="ed_days" type="text" value="<?php echo $list['days']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_invoice_months">Invoice Month </label>
                                            <input class="form-control read_only" name="ed_invoice_months" id="ed_invoice_months" type="text" value="<?php echo $list['invoice_month']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_inv_date">Inv Date </label>
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
                                            <label class="form-control-label" for="m_c_details">Maintenance Contract Details </label>
                                            <textarea disabled class="form-control" name="m_c_details" id="m_c_details" height="20"><?php echo $list['m_c_details']; ?></textarea> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="comments">Comments</label>
                                            <textarea class="form-control" name="comments" id="comments" height="20" <?php echo $disabled; ?>><?php echo $list['comments']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="a_t_status">Account Type Status </label>
                                            <select class="form-control" name="a_t_status" required="" disabled>
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
                                            <input class="form-control OnlyNum read_only" disabled name="ed_no_of_edits" id="ed_no_of_edits" type="text" value="<?php echo $list['no_of_edits']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_no_of_errors">No. Of Errors</label>
                                            <input class="form-control OnlyNum read_only" disabled name="ed_no_of_errors" id="ed_no_of_errors" type="text" value="<?php echo $list['no_of_errors']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_qc_score">QC Score</label>
                                            <input class="form-control read_only" disabled name="ed_qc_score" id="ed_qc_score" type="text" value="<?php echo $list['qc_score']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label">PLP <span class="required">*</span></label>
                                            <select class="form-control" name="ed_plp" required="" onchange="CheckPLPExist(this.value);" disabled>
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
                                                <label class="form-control-label" for="cid_plp">CID  </label>
                                                <input type="text" class="form-control" name="cid_plp" value="<?php echo $Plist['cid']; ?>" <?php echo $disabled; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label">PLP Account Type *</label>
                                                <select class="form-control"  name="plp_account_type" required <?php echo $disabled; ?>> 
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
                                                <label class="form-control-label">Working hour  *</label>
                                                <input class="form-control OnlyNum" name="plp_billing_hour" id="plp_billing_hour" type="text"  value="<?php echo $Plist['billing_hour']; ?>" <?php echo $disabled; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">QC hour  </label>
                                                <input class="form-control OnlyNum read_only" disabled name="plp_qc_hour" id="plp_qc_hour" type="text"  value="<?php echo $Plist['qc_hour']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Total Hour  </label>
                                                <input class="form-control read_only" disabled name="plp_total_hour" id="plp_total_hour" type="text" required="required" value="<?php echo $Plist['total_hour']; ?>">
                                            </div>
                                        </div> 

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label">Billing Hour </label>
                                                <input class="form-control OnlyNum read_only" disabled name="plp_actual_hour" id="plp_actual_hour" type="text" required="required" value="<?php echo $Plist['actual_hour']; ?>">
                                            </div>
                                        </div> 

                                    </div>


                                    <!-- row start -->
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label class="form-control-label">Comments</label>
                                                <textarea class="form-control" name="plp_comments" id="plp_comments" height="20" <?php echo $disabled; ?>><?php echo $Plist['comments']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-control-label">Error Details</label>
                                                <input disabled class="form-control" name="error_details_plp" id="error_details_plp" type="text" value="<?php echo $Plist['error_details_plp']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <input name="plp_ed_id" id="plp_ed_id" type="hidden" value="<?php echo $Plist['id']; ?>">
                                    </div>



                                <?php } ?>
                                <!-- if plp yes form end -->


                                <?php if ($list['tl_id'] < 1) { ?>
                                    <span class="input-group-btn">
                                        <input name="ed_id" id="ed_id" type="hidden" value="<?php echo $list['id']; ?>">
                                        <button type="button" class="btn btn-primary btn-form display-4" onclick="UpdateEditDetailsUser(event);">Update</button>
                                    </span> 
                                <?php } ?>


                            </form>




                        </div>
                    </div> </div>
            </div>
            <!-- EDIT Form End-->

        </div>
    </div>
    <!-- Please wait area show  -->

    <!-- select search dropdown js -->
    <script src="<?php echo SITE_URL; ?>asset/js/hierarchy-select.min.js"></script>
    <!-- date picker js -->
    <script src="<?php echo SITE_URL; ?>asset/js/moment/moment.min.js"></script>
    <script src="<?php echo SITE_URL; ?>asset/js/bootstrap-datetimepicker.min.js"></script>


    <script type="text/javascript">
                                        ViewEditRpmPlpJs();

                                        /*     $(document).ready(function () {
                                         
                                         $('#select-tgram-id').hierarchySelect({
                                         hierarchy: false,
                                         width: 223
                                         });
                                         
                                         $('#select-pm').hierarchySelect({
                                         hierarchy: false,
                                         });
                                         
                                         //  $('#myDatepicker').datetimepicker(); for 12 hour
                                         $('#myDatepicker').datetimepicker({
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
                                         }); */
    </script>
</span> 	 


