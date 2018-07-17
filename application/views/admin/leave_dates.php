<!--header start-->
<?php include 'header.php'; ?>
<!--header end-->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">


        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Leave Dates</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form name="tgram_frm"  id="tgram_frm" class="form-horizontal" >
                            <!--<form name="edit_form" id="edit_form" data-parsley-validate="" class="mbr-form" novalidate="">-->
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-2" for="leave_date">Leave Date: YYYY-MM-DD
                                </label>
                                <div class="col-xs-2">
                                    <input class="control-label col-md-12 col-sm-12 col-xs-12" type="text" name="leave_date" style="text-align: left;" placeholder="YYYY-MM-DD">
                                </div>
                                
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="title">Title:
                                </label>
                                <div class="col-xs-2">
                                    <input class="control-label col-md-12 col-sm-12 col-xs-12" type="text" name="title" style="text-align: left;" placeholder="Like: sat, sun, holi, diwali">
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" class="btn btn-success" onclick="Save_Leave(event);">Save Leave Date</button> 
                                </div>

                            </div>
                             
 




                            <div class="ln_solid"></div>
                        </form>
                    </div>
                    <div class="x_content">

                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Leave Date: YYYY-MM-DD</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>

                                <?php
                                $incr = 1;
                                foreach ($list as $row) {
                                    $pm = $row['leave_date'];
                                    $title = $row['title'];
                                    $id = $row['id'];
                                    $update_values = "'$id:$pm:$title'";
                                    $delete_row = "'$id:leave_dates'";
                                    echo '<tr>
                                    <td>' . $incr . '</td>
                                    <td>' . $row['leave_date'] . '</td>
                                    <td>' . $row['title'] . '</td>
                                    <td><a  onclick="DeleteStandard(' . $delete_row . ');" style="cursor:pointer;"> <i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a> / 
                                      <a onclick="ShowModelUpdate(' . $update_values . ')"; style="cursor:pointer;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a></td>                                         
</td> 
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
<!-- Please wait area show  -->
<div class="please_wait">
    <p>
        <span id="please_wait_text">Please Wait</span><img src="<?php echo SITE_URL; ?>asset/images/loading.gif" id="please_wait_image"/><br/>
    <div class="loading" id="show_message_text">Please Wait..</div>
</p>
</div> <!-- Please wait area end  --> 

<!--Update modal popup -->
<div class="modal fade bs-update-form" tabindex="-1" id="update_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Update Row</h4>
            </div>
            <div class="modal-body">


                <form name="update_frm" id="update_frm">


                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="pm_upd">Leave Date <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="pm_upd" id="pm_upd" required="required" class="form-control col-md-7 col-xs-12">
                            <input type="hidden" name="id_upd" id="id_upd" required="required">
                            <span id="msgupdate_1"></span>
                        </div>



                    </div> 
                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="pm_title">Leave Title <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="pm_title" id="pm_title" required="required" class="form-control col-md-7 col-xs-12"> 
                        </div>
                    </div> 

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="return UpdateLeave(event);">Update</button>
            </div>

        </div>
    </div>
</div>

<!-- footer -->
<!-- Datatables -->
<?php include 'data_table_js_footer.php'; ?>	
<?php include 'footer.php'; ?>	
<script>
    function ShowModelUpdate(update_values) {
        // alert(update_values);
        var splitString = update_values.split(':');
        var id = splitString[0];
        var pm_upd = splitString[1];
        var title = splitString[2];

        $('#update_modal').modal('show');

        $('#pm_upd').val(pm_upd);
        $('#pm_title').val(title);
        $('#id_upd').val(id);

    }

    function DeletePm(id) {
        var agree = confirm("Alert! are you sure to delete this?");
        if (agree)
        {
            window.location.href = SITE_URL + "admin/Ctl_admin/pm/" + id;
        } else {
            return false;
        }

    }



</script>


<!-- / footer -->