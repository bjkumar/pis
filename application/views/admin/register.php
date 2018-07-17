<!--header start-->
<?php include 'header.php'; ?>
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
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <?php
                        $fname = null;
                        $lname = null;
                        $email = null;
                        $mobile = null;
                        $id = '';
                        $department = '';
                        $submit_button = 'Submit';
                        if ($list) {
                            echo '<h2>Update User</h2>';
                            foreach ($list as $row) {
                                $id = $row['id'];
                                $fname = $row['fname'];
                                $lname = $row['lname'];
                                $email = $row['email'];
                                $mobile = $row['mobile'];
                                $department = $row['department'];
                                $submit_button = 'Update';
                            }
                        } else {
                            echo '<h2>Register New User</h2>';
                        }
                        ?> 

                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <!--                                            <li class="dropdown">
                                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><a href="#">Settings 1</a>
                                                                                </li>
                                                                                <li><a href="#">Settings 2</a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>-->
                            <!--                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                                        </li>-->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form  name="user_reg" id="user_reg" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">First Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first_name" name="first_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $fname; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Last Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="last_name" name="last_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $lname; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12"  value="<?php echo $email; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile  </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="mobile" id="mobile" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $mobile; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="password" id="password" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dept" class="control-label col-md-3 col-sm-3 col-xs-12">Department<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="dept">
                                        <?php
                                        foreach ($dept as $dep) {
                                            ?>
                                            <option value="<?php echo $dep['id']; ?>" <?php if ($department == $dep['id']) {
                                            echo 'selected';
                                        } ?> ><?php echo $dep['department']; ?>  </option>
<?php }
?>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dept" class="control-label col-md-3 col-sm-3 col-xs-12" id="sel-cat-alert">Category<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input  value="TL" id="cat_posi1" name="optionsRadios" type="radio"> TL
                                        </label>
                                        <label style="padding-left: 55px;">
                                            <input  value="emp" id="cat_posi2" name="optionsRadios" type="radio"> Employee
                                        </label>
                                    </div>

                                </div>
                            </div>










                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success" onclick="Save_User(event);"><?php echo $submit_button; ?></button>
<?php if ($fname == null) {
    echo '<button class="btn btn-primary" type="reset">Reset</button>';
} ?>  
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Please wait area show  -->
<div class="please_wait">
    <p>
        <span id="please_wait_text">Please Wait</span><img src="<?php echo SITE_URL; ?>asset/images/loading.gif" id="please_wait_image"/><br/>
    <div class="loading" id="show_message_text">Please Wait..</div>
</p>
</div> <!-- Please wait area end  --> 

<!-- /page content -->

<!-- footer -->
<?php include 'footer.php'; ?>		  
<!-- / footer -->


