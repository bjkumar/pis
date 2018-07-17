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
                        <h2>Edit List</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-download"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo SITE_URL; ?>Ctl_common/excel_edit_all">Download Excel File</a>
                                    </li>
                                    <li><a onclick="ShowFilterForDownload();" style="cursor:pointer;">Show Filter For Download</a>
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
                                    <th>Account Name</th>
                                    <th>Tgram ID</th>
                                    <th>Received Date Time</th>
                                    <th>Submit Date Time</th>
                                    <th>TL</th>
                                    <th>Review Time</th> 

                            <a href="../user/edit_list.php"></a>
                                </tr>
                            </thead>


                            <tbody>

                                <?php
                                $incr = 1;
                                foreach ($list as $row) {
                                    $update_time = '';
                                    if ($row['update_time'] != '0000-00-00 00:00:00') {
                                        $update_time = $row['update_time'];
                                    }
                                    if ($row['tl_id'] > 0) {
                                        $e_view = 'edit_viewed';
                                    } else {
                                        $e_view = 'edit_non_viewed';
                                    }

                                    echo '<tr class="' . $e_view . '">
                                    <td>' . $incr . '</td>
                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                    <td>' . $row['account_name'] . '</td>
                                    <td>' . $row['tgram_id'] . '</td>
                                    <td>' . $row['received_date'] . '</td> 
                                    <td>' . $row['submit_time'] . '</td>
                                    <td>' . $row['tl_fname'] . ' ' . $row['tl_lname'] . '</td>
                                    <td>' . $update_time . '</td> 
                                    
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
<!-- footer -->
<!-- Datatables -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').dataTable({
            "order": [],
        });
    });
</script>
<?php include 'data_table_js_footer.php'; ?>	
<?php include 'footer.php'; ?>	
<!-- / footer -->
