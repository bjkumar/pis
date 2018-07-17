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
                        <h2>Request Type RPM</h2>
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

                        <form name="atype_frm"  id="atype_frm" class="form-horizontal" >
                            <!--<form name="edit_form" id="edit_form" data-parsley-validate="" class="mbr-form" novalidate="">-->
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-2" for="at_name">Request Type RPM:
                                </label>
                                <div class="col-xs-2">
                                    <input type="text" name="field_val" required="required" class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">
                                    <input type="hidden" name="field_name" value="request_type">
                                    <input type="hidden" name="table_name" value="request_type">
                                </div>
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="at_name">Max Time:
                                </label>
                                <div class="col-xs-1">
                                    <input type="number" name="max_time" required="required" class="control-label col-md-12 col-sm-12 col-xs-12 OnlyNum" style="text-align: left;"> 
                                </div>
                                <div class="col-xs-3">
                                    <button type="button" class="btn btn-success" onclick="Standerd_Save(event);">Save</button> 
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                    </div>
                    <div class="x_content">

                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Requester</th>
                                    <th>Max Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>

                                <?php
                                $incr = 1;
                                foreach ($list as $row) {
                                    $account_type = $row['request_type'];
                                    $id = $row['id'];
                                    $late_days = $row['late_days'];
                                    $update_values = "'$id:$account_type:$late_days'";
                                    echo '<tr>
                                    <td>' . $incr . '</td>
                                    <td>' . $row['request_type'] . '</td>
                                   <td>' . $row['late_days'] . '</td>
                                    <td><a  onclick="DeleteAccount(' . $row['id'] . ');" style="cursor:pointer;"> <i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a> / 
                                  <a onclick="ShowModelUpdate(' . $update_values . ')"; style="cursor:pointer;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a></td> 
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
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="actype_upd">Request Type<span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="field_val_up" id="field_val_up" class="form-control col-md-7 col-xs-12">
                            <input type="hidden" name="field_name_up" id="field_name_up" value="request_type">
                            <input type="hidden" name="table_name_up" value="request_type">
                            <input type="hidden" id="row_id" name="row_id">
                        </div> 
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="actype_upd">Max Time<span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="number" name="field_max_time" id="field_max_time" class="form-control col-md-7 col-xs-12 OnlyNum"> 
                        </div> 
                    </div> 

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="return Standerd_Update(event);">Update</button>
            </div>

        </div>
    </div>
</div>
<script>
    function ShowModelUpdate(update_values) {
        // alert(update_values);
        var splitString = update_values.split(':');
        var id = splitString[0];
        var actype_upd = splitString[1];
        var field_max_time = splitString[2];

        $('#update_modal').modal('show');
        $('#field_val_up').val(actype_upd);
        $('#row_id').val(id);
        $('#field_max_time').val(field_max_time);
    }


    function DeleteAccount(id) {
        var agree = confirm("Alert! are you sure to delete this?");
        if (agree)
        {
            window.location.href = SITE_URL + "admin/Ctl_admin/request_type_rpm/" + id;
        } else {
            return false;
        }

    }

    function Standerd_Save(e) {
        var counter = 0;
        var frm = document.atype_frm;
        var form = $('#atype_frm'); // contact form

        if (frm.field_val.value == "")
        {
            alert('field is required!');
            counter = 1;
            return false;
        }

        if (counter > 0)
        {
            return false;
        }

        var m_data = new FormData();
        m_data.append('field_val', frm.field_val.value);
        m_data.append('field_name', frm.field_name.value);
        m_data.append('table_name', frm.table_name.value);
        m_data.append('late_days', frm.max_time.value);


        $.ajax({
            url: SITE_URL + 'Ctl_common/Standerd_Save',
            type: 'POST',
            dataType: 'html',
            data: m_data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('.please_wait').show();
                $("#show_message_text").html('Please wait..');
            },
            success: function (data) {
                if (data == 1) {
                    $("#show_message_text").html('<span style="color:green">Value Inserted</span>');
                    setTimeout(function () {
                        $('.please_wait').hide();
                        window.location.href = SITE_URL + "admin/Ctl_admin/request_type_rpm";
                    }, 1200);

                } else {
                    $('.please_wait').hide();
                    alert('something wrong! contact to developer');
                }

            },

        });
    }

    function Standerd_Update(e) {
        var counter = 0;
        var frm = document.update_frm;
        var form = $('#update_frm'); // contact form

        if (frm.field_val_up.value == "")
        {
            alert('field is required!');
            counter = 1;
            return false;
        }


        if (counter > 0)
        {
            return false;
        }

        var m_data = new FormData();

        m_data.append('field_val', frm.field_val_up.value);
        m_data.append('field_name', frm.field_name_up.value);
        m_data.append('table_name', frm.table_name_up.value);
        m_data.append('id', frm.row_id.value);
         m_data.append('late_days', frm.field_max_time.value);

        $.ajax({
            url: SITE_URL + 'Ctl_common/Standerd_Update',
            type: 'POST',
            dataType: 'html',
            data: m_data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('.please_wait').show();
                $("#show_message_text").html('Please wait..');
            },
            success: function (data) {
                if (data == 1) {
                    $("#show_message_text").html('<span style="color:green">Row Updated</span>');
                    setTimeout(function () {
                        $('.please_wait').hide();
                        window.location.href = SITE_URL + "admin/Ctl_admin/request_type_rpm";
                    }, 1200);

                } else {
                    $('.please_wait').hide();
                    alert('something wrong! contact to developer');
                }

            },

        });
    }


</script>
<!-- footer -->
<!-- Datatables -->
<?php include 'data_table_js_footer.php'; ?>	
<?php include 'footer.php'; ?>	
<!-- / footer -->