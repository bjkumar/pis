<span id="take_pg_content" class="take_pg_content">
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
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add New</h2> 
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <div class="form-group">
                                <label for="job_type" class="control-label col-md-3 col-sm-3 col-xs-12">Job Type<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="job_type" id="job_type">
                                        <option value="">Job Type</option>
                                        <?php
                                        foreach ($job_type as $jtype) {
                                            ?>
                                            <option value="<?php echo $jtype['id']; ?>"><?php echo $jtype['job_type']; ?>  </option>
                                        <?php }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- PLP Form -->
            <div class="row div_hide" id="show_form1">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>PLP</h2> 
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form name="plp_form" id="plp_form" data-parsley-validate="" class="mbr-form" novalidate="">
                                <!--  <form class="mbr-form" name="edit_form" id="edit_form" data-parsley-validate> -->
                                <!-- row strat -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="tgram_id">Search TGRAM/Account Name <span class="required">*</span></label>

                                            <div class="btn-group hierarchy-select" data-resize="auto" id="select-tgram-id1" style="display: inherit;">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
                                                    <span class="selected-label pull-left" id="ed_tgm_id1">&nbsp;</span>
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu open">
                                                    <div class="hs-searchbox">
                                                        <input type="text" class="form-control" autocomplete="off">
                                                    </div>
                                                    <ul class="dropdown-menu inner" role="menu" id="add_tgram1">
                                                        <li data-value="" data-default-selected="">
                                                            <a href="#">-- Select --</a>
                                                        </li> 
                                                    </ul>
                                                </div>
                                                <input  class="hidden hidden-field" name="tgram_hidden_value1" readonly="readonly" aria-hidden="true" type="text"/>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_t_id"> TGRAM Id*</label>
                                            <input class="form-control" name="t_id1" id="t_id1" type="text" maxlength="8">
                                            <input class="form-control" name="tgmid1" id="tgmid1" type="hidden">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_name">Account Name*</label>
                                            <input class="form-control" name="account_name1" id="account_name1" type="text"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="cid_plp">CID</label>
                                            <input type="text" class="form-control" name="cid_plp" maxlength="8">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="received_date_plp">Received Date: (DD/MM/YY H:M)*</label>
                                            <div class="input-group date" id="myDatepicker_plp">
                                                <input type="text" class="form-control" name="received_date_plp" id="received_date_plp">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div> 
                                        </div>
                                    </div>



                                </div>

                                <!-- row start -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="plp_account_type">Account Type <span class="required">*</span></label>
                                            <span class="account_type_plp"></span>
                                            <div id="ed_msgpass03_plp" class="red_select_alert"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="return_policy">PM*
                                                <a style="cursor: pointer; margin-left: 170px; display: none;" title="Show Dropdown" id="re_Pm_Box1" onclick="PutPMDropdown('1');">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </label>
                                            <div class="btn-group hierarchy-select" data-resize="auto" id="select-pm1" style="display: inherit;">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
                                                    <span class="selected-label pull-left" id="ed_pm1">&nbsp;</span>
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu open">
                                                    <div class="hs-searchbox">
                                                        <input type="text" class="form-control" autocomplete="off">
                                                    </div>
                                                    <ul class="dropdown-menu inner" role="menu" id="add_pmlist1">
                                                        <li data-value="" data-default-selected="">
                                                            <a href="#">-- Select --</a>
                                                        </li> 
                                                    </ul>
                                                </div>
                                                <input  class="hidden hidden-field" name="pm_hidden_value1" readonly="readonly" aria-hidden="true" type="text"/>

                                            </div>
                                            <input class="form-control" name="select_pm_manually1" id="select_pm_manually1" type="text" style="display:none;"> 
                                            <div id="ed_msgpasspm1" class="red_select_alert1"></div>
                                            <input type="hidden" name="ed_pmid1" id="ed_pmid1">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="billing_hour_plp">Working hour*</label>
                                            <input class="form-control OnlyNum" name="billing_hour_plp" id="billing_hour_plp" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="error_details_plp">Error Details</label>
                                            <input class="form-control" name="error_details_plp" id="error_details_plp" type="text">
                                        </div>
                                    </div>
                                </div>

                                <!-- row start -->
                                <div class="row">
                                </div>

                                <!-- row start -->
                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="comments_plp">Comments</label>
                                            <textarea class="form-control" name="comments_plp" id="comments_plp" height="20"></textarea>
                                        </div>
                                    </div>
                                </div>



                                <span class="input-group-btn">

                                    <button type="button" class="btn btn-primary btn-form display-4" onclick="SavePLPDetails(event);">Submit</button>
                                </span> 
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- PLP Form End-->

            <!-- EDIT Form -->
            <div class="row div_hide" id="show_form2">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="tgram_id">Search TGRAM/Account Name </label>

                                            <div class="btn-group hierarchy-select" data-resize="auto" id="select-tgram-id2" style="display: inherit;">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
                                                    <span class="selected-label pull-left" id="ed_tgm_id2">&nbsp;</span>
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu open">
                                                    <div class="hs-searchbox">
                                                        <input type="text" class="form-control" autocomplete="off">
                                                    </div>
                                                    <ul class="dropdown-menu inner" role="menu" id="add_tgram2">
                                                        <li data-value="" data-default-selected="">
                                                            <a href="#">-- Select --</a>
                                                        </li> 
                                                    </ul>
                                                </div>
                                                <input  class="hidden hidden-field" name="tgram_hidden_value2" readonly="readonly" aria-hidden="true" type="text"/>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_t_id"> TGRAM Id*</label>
                                            <input class="form-control" name="t_id2" id="t_id2" type="text" maxlength="8">
                                            <input class="form-control" name="tgmid2" id="tgmid2" type="hidden">
                                            <div id="ed_msgpass0" class="red_select_alert"></div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_name">Account Name*</label>
                                            <input class="form-control" name="account_name2" id="account_name2" type="text"> 
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="received_date_edit">Received Date: (DD/MM/YY H:M)* </label>
                                            <div class="input-group date" id="myDatepicker_standerd">
                                                <input type="text" class="form-control" name="received_date_edit" id="received_date_edit">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="revision">Revision* <span class="required">*</span></label>
                                            <select class="form-control" name="revision" required="">
                                                <option value="">-- Select --</option>
                                                <option value="NA">NA</option>
                                                <?php
                                                for ($i = 1; $i <= 50; $i++) {
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                                ?> 
                                            </select> 
                                            <div id="ed_msgpass02" class="red_select_alert"></div>

                                        </div>
                                    </div>




                                </div>

                                <!-- row start -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_type">Account Type* <span class="required">*</span></label>
                                            <span class="account_type"></span>
                                            <div id="ed_msgpass03" class="red_select_alert"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" id="pm_select_div_2">
                                            <label class="form-control-label" for="return_policy">PM*
                                                <a style="display: none;cursor:pointer;margin-left:170px;" title="Show Dropdown" id="re_Pm_Box2" onclick="PutPMDropdown('2');">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </label>
                                            <div class="btn-group hierarchy-select" data-resize="auto" id="select-pm2" style="display: inherit;">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
                                                    <span class="selected-label pull-left" id="ed_pm2">&nbsp;</span>
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu open">
                                                    <div class="hs-searchbox">
                                                        <input type="text" class="form-control" autocomplete="off">
                                                    </div>
                                                    <ul class="dropdown-menu inner" role="menu" id="add_pmlist2">
                                                        <li data-value="" data-default-selected="">
                                                            <a href="#">-- Select --</a>
                                                        </li> 
                                                    </ul>
                                                </div>
                                                <input  class="hidden hidden-field" name="pm_hidden_value2" readonly="readonly" aria-hidden="true" type="text"/>

                                            </div>
                                            <input class="form-control" name="select_pm_manually2" id="select_pm_manually2" type="text" style="display:none;"> 
                                            <div id="ed_msgpasspm2" class="red_select_alert1"></div>
                                            <input type="hidden" name="ed_pmid2" id="ed_pmid2">
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="pages_worked">Pages Worked*</label>
                                            <select class="form-control" name="pages_worked" required="">
                                                <option value="">-- No. of pages --</option>
                                                <?php
                                                for ($i = 1; $i <= 30; $i++) {
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                                ?>   
                                            </select> 
                                            <div id="ed_msgpass04" class="red_select_alert"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_plp">PLP<span class="required">*</span></label>
                                            <select class="form-control" name="ed_plp" required="" onchange="CheckPLPExist(this.value);">
                                                <option value="">-- Select --</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select> 
                                            <div id="ed_msgpass05" class="red_select_alert"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="billing_hour">Working hour*</label>
                                            <input class="form-control OnlyNum" name="billing_hour" id="billing_hour" type="text">
                                        </div>
                                    </div>
                                </div>

                                <!-- row start -->
                                <div class="row">
                                </div>

                                <!-- row start -->
                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="comments">Comments</label>
                                            <textarea class="form-control" name="comments" id="comments" height="20"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- if plp yes -->
                                <div class="row ed_plp_yes div_hide">
                                    <div class="col-md-2">
                                        <div class="form-group"> <!-- name = plp_account_type -->
                                            <label class="form-control-label">PLP CID <span class="required">*</span></label>
                                            <input class="form-control OnlyNum" name="cid_ed_plp" id="cid_ed_plp" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"> <!-- name = plp_account_type -->
                                            <label class="form-control-label">PLP Account Type <span class="required">*</span></label>
                                            <span class="account_type_ed_plp"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="billing_hour_ed_plp">PLP Working hour *</label>
                                            <input class="form-control OnlyNum" name="billing_hour_ed_plp" id="billing_hour_ed_plp" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="error_details_ed_plp">PLP Error Details</label>
                                            <input class="form-control" name="error_details_ed_plp" id="error_details_ed_plp" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="comments_ed_plp">PLP Comments</label>
                                            <textarea class="form-control" name="comments_ed_plp" id="comments_ed_plp" height="20"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- if plp yes form end -->






                                <span class="input-group-btn">

                                    <button type="button" class="btn btn-primary btn-form display-4" onclick="SaveEditDetails(event);">Submit</button>
                                </span> 
                            </form>

                        </div>




                    </div>
                </div>
            </div>
            <!-- EDIT Form End-->

            <!-- RPM Form -->
            <div class="row div_hide" id="show_form3"> 
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
                                            <label class="form-control-label" for="request_type">Request Type <span class="required">*</span></label>
                                            <!--<span class="request_type"></span>-->
                                            <select class="form-control"  name="request_type" id="request_type" onchange="Put_R_Type_id_days(this.value);">
                                            </select>
                                            <input type="hidden" name="r_typ_id_rpm" id="r_typ_id_rpm">
                                            <input type="hidden" name="r_typ_late_daye_rpm" id="r_typ_late_daye_rpm"> 
                                            <div id="rpm_msgpass03" class="red_select_alert"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="rpm_received_date">Received Date: (DD/MM/YY) *  </label>
                                            <div class="input-group date" id="myDatepicker_rpm">
                                                <input type="text" class="form-control" name="rpm_received_date" id="rpm_received_date" onkeydown="event.preventDefault()">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="tgram_id">Search TGRAM/Account Name </label>
                                            <div class="btn-group hierarchy-select" data-resize="auto" id="select-tgram-id3" style="display: inherit;">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
                                                    <span class="selected-label pull-left" id="ed_tgm_id3">&nbsp;</span>
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu open">
                                                    <div class="hs-searchbox">
                                                        <input type="text" class="form-control" autocomplete="off">
                                                    </div>
                                                    <ul class="dropdown-menu inner" role="menu" id="add_tgram3">
                                                        <li data-value="" data-default-selected="">
                                                            <a href="#">-- Select --</a>
                                                        </li> 
                                                    </ul>
                                                </div>
                                                <input  class="hidden hidden-field" name="tgram_hidden_value3" readonly="readonly" aria-hidden="true" type="text"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ed_t_id"> TGRAM Id<span class="required">*</span></label>
                                            <input class="form-control" name="t_id3" id="t_id3" type="text" maxlength="8">
                                            <input class="form-control" name="tgmid3" id="tgmid3" type="hidden">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_name">Account Name<span class="required">*</span></label>
                                            <input class="form-control" name="account_name3" id="account_name3" type="text">


                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="cid_rpm">CID</label> 
                                            <input class="form-control OnlyNum" name="cid_rpm" id="cid_rpm" type="text" maxlength="5">
                                        </div>
                                    </div>




                                </div>

                                <!-- row start -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="program_rpm">Program <span class="required">*</span></label>
                                            <select class="form-control" name="program_rpm" id="program_rpm" required></select>
                                            <span class="rpm_program"></span>
                                            <div id="rpm_msgpass04" class="red_select_alert"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"> 
                                            <label class="form-control-label" for="requester">Requester <span class="required">*</span>
                                                <a style="display: none;cursor:pointer;margin-left:106px;" title="Show Dropdown" id="re_req_Box" onclick="PutRQDropdown();"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                            </label>
                                            <select class="form-control requester"  name="requester" id="requester" onchange="HideRQDropdown(this.value);">
                                            </select> 
                                            <input class="form-control" name="requtr_manually" id="requtr_manually" type="text" style="display:none;">
                                            <div id="rpm_msgpass05" class="red_select_alert"></div>

                                        </div>
                                    </div>
                                    <!--                            <div class="col-md-2">
                                                                    <div class="form-group" id="pm_select_div_3"></div>
                                                                </div>-->


                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="queries">Queries<span class="required">*</span></label>
                                            <select class="form-control" name="queries" required="" onchange="CheckResolutionDate(this.value);">
                                                <option value="">-- Select --</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select> 
                                            <div id="rpm_msgpass06" class="red_select_alert"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 resol_date" style="display:none;">
                                        <div class="form-group"><label class="form-control-label" for="rpm_resolution_date">Resolution Date: (DD/MM/YY) *</label>
                                            <div class="input-group date" id="resolution_date">
                                                <input type="text" class="form-control" name="rpm_resolution_date" id="rpm_resolution_date" onkeydown="event.preventDefault()">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div> 
                                        </div>
                                    </div>

                                    <!--                            <div class="col-md-2">
                                                                    <div class="form-group"><label class="form-control-label" for="rpm_due_date">Due Date Given: (DD/MM/YY) </label>
                                                                        <div class="input-group date" id="Datepicker_due_date">
                                                                            <input type="text" class="form-control" name="rpm_due_date" id="rpm_due_date">
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </span>
                                                                        </div> 
                                                                    </div>
                                                                </div>-->

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="no_of_pages">No. of Pages *</label>
                                            <input class="form-control OnlyNum" name="no_of_pages" type="number" required="required" maxlength="5">
                                        </div>
                                    </div>


                                </div>

                                <!-- row start -->
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_billing_hour">Working hour*</label>
                                            <input class="form-control OnlyNum" name="billing_hour_rpm" id="billing_hour_rpm" type="text" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="qc_hour">QC hour</label>
                                            <input class="form-control OnlyNum read_only" name="qc_hour_rpm" id="qc_hour_rpm" type="text" required="required" maxlength="5">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="total_hour">Total Hour<span class="required">*</span></label>
                                            <input class="form-control OnlyNum read_only" name="total_hour_rpm" id="total_hour_rpm" type="text" required="required">
                                        </div>
                                    </div> 

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="total_hour">Billing Hour<span class="required">*</span></label>
                                            <input class="form-control cl_yellow OnlyNum" name="actual_hour_rpm" id="actual_hour_rpm" type="text" required="required" maxlength="5">
                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                        <div class="form-group"><label class="form-control-label" for="rpm_start_date">Start Date: (DD/MM/YY) *</label>
                                            <div class="input-group date" id="rpm_start_datepicker">
                                                <input type="text" class="form-control" name="rpm_start_date" id="rpm_start_date" onkeydown="event.preventDefault()">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group"><label class="form-control-label" for="rpm_date_delivered">Delivered Date: (DD/MM/YY) *</label>

                                            <span class="active_dl" style="display:none;">
                                                <div class="input-group date" id="rpm_datepicker">
                                                    <input type="text" class="form-control" name="rpm_date_delivered" id="rpm_date_delivered" onkeydown="event.preventDefault()">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </span>
                                            <span class="Inactive_dl">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar alert_dt_dl"></span>
                                                    </span>
                                                </div>
                                            </span>


                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_days">Days</label>
                                            <input class="form-control read_only" name="rpm_days" id="rpm_days" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_late">Late</label>
                                            <input class="form-control read_only" name="rpm_late" id="rpm_late" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_invoice_months">Invoice Month</label>
                                            <input class="form-control read_only" name="rpm_invoice_months" id="rpm_invoice_months" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rpm_inv_date">Inv Date</label>
                                            <input class="form-control read_only" name="rpm_inv_date" id="rpm_inv_date" type="text">

                                            <input name="ed_ac_late_hour" id="ed_ac_late_hour"  type="hidden"> 
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label class="form-control-label" for="url_rpm">URL<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="url_rpm">
                                        </div>
                                    </div>
                                </div>

                                <!-- row start -->
                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="comments_rpm">Comments</label>
                                            <textarea class="form-control" name="comments_rpm" id="comments_rpm" height="20"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="remark">Remark</label>
                                            <textarea class="form-control" name="remark" id="remark" height="20"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="form-control-label help_checkbox" value="1"> Additional Development Time</label>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="helper_div" style="display: none;">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label" for="emp_id">Employee Name *</label>
                                                <select class="form-control" name="emp_id" id="emp_id"></select>
                                                <!--<span class="put_employee"></span>--> 
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-control-label" for="emp_hour">Hours *</label>
                                                <input type="text" class="form-control OnlyNum" name="emp_hour" id="emp_hour">
                                            </div>
                                        </div>
                                    </span>
                                </div> 

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-form display-4" onclick="SaveRPMDetails(event);">Submit</button>
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

    <?php
    $MonthAgo = date("d/m/Y", strtotime("-1 month"));
    ?>
</span>
<script type="text/javascript">
    $(document).ready(function () {
        AddAccountFooterJs();

    });


</script>