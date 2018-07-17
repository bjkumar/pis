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
                        <h2>User List</h2>
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

                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Dept.</th>
                                    <th>Status / Edit</th>

                                </tr>
                            </thead>


                            <tbody>

                                <?php
                                foreach ($list as $row) {
                                    $id = $row['id'];
                                    $d_active = "'0:$id'";
                                    $active = "'1:$id'";
                                    $status = '<i class="fa fa-ban text-danger" style="cursor: pointer;" title="D-Active" onclick="StatusChange(' . $d_active . ');"></i>';
                                    if ($row['status'] == '1') {
                                        $status = '<i class="fa fa-check text-success" style="cursor: pointer;" title="Active" onclick="StatusChange(' . $active . ');"></i>';
                                    }
                                    echo '<tr>
                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['mobile'] . '</td>
                                    <td>' . $row['dept'] . '</td>
                                    <td>' . $status . ' / <a href="update_user/' . $id . '"> <i class="fa fa-pencil-square-o" aria-hidden="true" title="Edit"></i></a></td> 
                                </tr>';
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
<?php include 'data_table_js_footer.php'; ?>	
<?php include 'footer.php'; ?>	



<!-- / footer -->