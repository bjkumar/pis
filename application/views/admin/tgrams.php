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
                        <h2>TGRAMS List</h2>
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
                        <form name="csv_import"  id="csv_import" class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first_name">TGram File (csv,xlsx,xls):
                                </label>
                                <div class="col-xs-3">
                                    <input class="control-label col-md-12 col-sm-12 col-xs-12" type="file" name="csv_file" id="csv_file">
                                </div>
                                <div class="col-xs-3">
                                    <button type="button" class="btn btn-success" onclick="Upload_Csv_Tgram(event);">Upload File</button> 
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                    </div>

                    <div class="x_content">

                        <form name="tgram_frm"  id="tgram_frm" class="form-horizontal" >
                            <!--<form name="edit_form" id="edit_form" data-parsley-validate="" class="mbr-form" novalidate="">-->
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="account_name">Account Name:
                                </label>
                                <div class="col-xs-3">
                                    <input class="control-label col-md-12 col-sm-12 col-xs-12" type="text" name="account_name" style="text-align: left;">
                                </div>
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="tgram">AZ / TGRAM:
                                </label>
                                <div class="col-xs-3">
                                    <input class="control-label col-md-12 col-sm-12 col-xs-12" type="text" name="tgram" style="text-align: left;">
                                </div>
                                <div class="col-xs-3">
                                    <button type="button" class="btn btn-success" onclick="Save_Tgram(event);">Save Tgram</button> 
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
                                    <th>SR.</th>
                                    <th>TGRAMS</th>
                                    <th>Account Name</th> 
                                    <th>Status / Edit</th>

                                </tr>
                            </thead>


                            <tbody>

                                <?php
                                $incre = 1;
                                foreach ($list as $row) {
                                    $id = $row['id'];
                                    $tgram = $row['tgram'];
                                    $account_name = $row['account_name'];
                                    $update_values = "'$id:$tgram:$account_name'";
                                    $delete_row = "'$id:tgram'";
                                    $d_active = "'1:$id:tgram'";
                                    $active = "'0:$id:tgram'";
                                    $status = '<i class="fa fa-ban text-danger" style="cursor: pointer;" title="D-Active" onclick="StatusChangeStandard(' . $d_active . ');"></i>';
                                    if ($row['status'] == '1') {
                                        $status = '<i class="fa fa-check text-success" style="cursor: pointer;" title="Active" onclick="StatusChangeStandard(' . $active . ');"></i>';
                                    }
                                    echo '<tr>
                                        <td>' . $incre . '</td>
                                    <td>' . $row['tgram'] . '</td>
                                    <td>' . $row['account_name'] . '</td>
                                    <td>' . $status . ' /  <a onclick="ShowModelUpdate(' . $update_values . ')"; style="cursor:pointer;"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 </a> / <a onclick="DeleteStandard(' . $delete_row . ');" style="cursor:pointer;">Delete</a> </td> 
                                </tr>';
                                    $incre++;
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
<!--change password modal popup -->

<div class="modal fade bs-update-form" tabindex="-1" id="update_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Update Row</h4>
            </div>
            <div class="modal-body">


                <form name="update_frm" id="update_frm">


                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="tgrams_upd">TGRAMS <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="tgrams_upd" id="tgrams_upd" required="required" class="form-control col-md-7 col-xs-12">
                            <span id="msgupdate_1"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="account_name_upd">Account Name <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="account_name_upd" id="account_name_upd" required="required" class="form-control col-md-7 col-xs-12">
                            <input type="hidden" name="id_upd" id="id_upd" required="required">
                            <span id="msgupdate_2"></span>
                        </div>
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="return UpdateTgrams(event);">Update</button>
            </div>

        </div>
    </div>
</div>
<!-- modal popup end-->
<script>
    function ShowModelUpdate(update_values) {
        // alert(update_values);
        var splitString = update_values.split(':');
        var id = splitString[0];
        var tgram = splitString[1];
        var account_name = splitString[2];

        $('#update_modal').modal('show');
        
       $('#account_name_upd').val(account_name);
       $('#tgrams_upd').val(tgram);
       $('#id_upd').val(id);

    }

    


</script>
<!-- footer -->
<!-- Datatables -->
<?php include 'data_table_js_footer.php'; ?>	
<?php include 'footer.php'; ?>	



<!-- / footer -->