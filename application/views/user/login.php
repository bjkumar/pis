<?php
if ($this->session->userdata('user_id') != '') {
     redirect(SITE_URL . 'user/Ctl_user/user_profile');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Log in |  Technosoft Engineering Projects Ltd. </title>
        <script>
            var SITE_URL = '<?php echo SITE_URL; ?>';
        </script>
        <link href="<?php echo SITE_URL; ?>asset/css/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/nprogress/nprogress.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/common.css" rel="stylesheet">
        <script src="<?php echo SITE_URL; ?>asset/js/jquery.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/javascript/validate_user.js"></script>

    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form name="login_frm" id="login_frm">
                            <h1>Developer Login</h1>
                            <div>
                                <div id="logbox1" class="smallred"></div>
                                <input type="text" class="form-control" placeholder="User Email" name="email" required="" />

                            </div>
                            <div>
                                <div id="logbox2" class="smallred"></div>
                                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
                            </div>
                            <div>
                                <button class="btn btn-default submit" type="submit" value="Log in" name="" onclick="return ChkMemlogin(event);" tabindex="3">Login</button>
                                <!--<a class="btn btn-default submit" href="index.html" onclick="">Log in</a>--> 
                                <!--<a class="reset_pass" href="#">Lost your password?</a>-->
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                             <p class="change_link">New to site? 
                                 <a href="" data-toggle="modal" data-target=".bs-example-modal-sm"> Create Account </a>
                              </p> 

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><a href="<?php echo SITE_URL; ?>"><img src="<?php echo SITE_URL; ?>asset/images/logo.png" style="width: 222px;"></a></h1>
                                    <p>©2018 All Rights Reserved. Technosoft Engineering Projects Ltd. Privacy and Terms</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>


           


        </div>
         <!--change password modal popup -->

            <div class="modal fade bs-example-modal-sm" id="Change_pass_Modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="min-width: 520px;    margin-left: -133px;">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Register</h4>
                        </div>
                        <div class="modal-body">


                           <form name="user_reg" id="user_reg" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                                            <div class="form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first_name">First Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="first_name" required="required" class="form-control col-md-7 col-xs-12" value="" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last_name">Last Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="last_name" required="required" class="form-control col-md-7 col-xs-12" value="" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email_reg" class="control-label col-md-4 col-sm-3 col-xs-12">Email <span class="required">*</span> </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="email_reg" required="required" class="form-control col-md-7 col-xs-12" value="" type="text">
                                                    <div id="alert_reg_0" class="smallred"></div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="password_reg" class="control-label col-md-4 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="password_reg" required="required" class="form-control col-md-7 col-xs-12" type="password">
                                                </div>
                                            </div>
                               <div class="form-group">
                                                <label for="re_password" class="control-label col-md-4 col-sm-3 col-xs-12">Re-Enter Password <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="re_password" required="required" class="form-control col-md-7 col-xs-12" type="password">
                                                    <div id="alert_reg_1" class="smallred"></div>
                                                </div> 
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="dept" class="control-label col-md-4 col-sm-3 col-xs-12">Department<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md-7 col-xs-12" name="dept">   <option value="">-- Select --  </option>
                                                                                                                   <option value="1">Autocad  </option>
                                                                                                                   <option value="2">Web  </option>
                                                                                                                   <option value="3">Catalogue  </option>
                                                                                                                   <option value="4">Account  </option>
                                                                                                                   <option value="5">HR  </option>
                                                                                                            </select>
                                                     
                                                </div>
                                            </div>
                                             
                                               
                                        </form>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="Save_User(event);">Submit</button> 
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                            
                        </div>

                    </div>
                </div>
            </div>
            <!-- modal popup end-->
         <!-- Please wait area show  -->
           <div class="please_wait">
                <p>
                    <span id="please_wait_text">Please Wait</span><img src="<?php echo SITE_URL; ?>asset/images/loading.gif" id="please_wait_image"/><br/>
                    <div class="loading" id="show_message_text">Please Wait..</div>
                </p>
            </div>
        <!--  Please wait area end     -->
         <script src="<?php echo SITE_URL; ?>asset/js/bootstrap.min.js"></script>
    </body>
</html>
