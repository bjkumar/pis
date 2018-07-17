<span id="take_pg_content" class="take_pg_content"> 
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>QC List</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                 
                                 
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                        <th>Build Description</th>
                                        <th>Tgram ID</th>
                                        <th>Received</th>
                                        <th>Delivered Date </th>
                                        <th>Added on Date Time</th>
                                        <th>QC By</th>
                                        <th>QC Time</th>
                                        <th></th>
                                    </tr>
                                </thead>


                                <tbody>

                                    <?php
                                    $incr = 1;
                                    foreach ($list as $row) {
                                        $qc_time = '';
                                        if ($row['qc_time'] != '0000-00-00 00:00:00') {
                                            $qc_time = $row['qc_time'];
                                        }
                                        if ($row['qc_done_by'] > 0) {
                                            $e_view = 'edit_viewed';
                                        } else {
                                            $e_view = 'edit_non_viewed';
                                        }
                                        $val_url = "'" . SITE_URL . 'Ctl_common/view_rpm/' . $row['id'] . "'";
                                        echo '<tr class="' . $e_view . '">
                                    <td>' . $incr . '</td>
                                    <td>' . $row['fname'] . ' ' . $row['lname'] . '</td>
                                    <td>' . $row['account_name'] . '</td>
                                    <td>' . $row['tgram_id'] . '</td>
                                    <td>' . $row['received_date'] . '</td> 
                                    <td>' . $row['delivered_on'] . '</td> 
                                    <td>' . $row['submit_time'] . '</td>
                                    <td>' . $row['qc_fname'] . ' ' . $row['qc_lname'] . '</td>
                                    <td>' . $qc_time . '</td>
                                    <td><a onclick="httpPageGet(' . $val_url . ')" style="cursor:pointer;">View</a></td>
                                    
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

    <!-- Datatables -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').dataTable({
                "order": [],
            });
        });
    </script>
    <?php include 'data_table_js_footer.php'; ?>	
</span> 
