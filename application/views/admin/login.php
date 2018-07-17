<?php
if ($this->session->userdata('admin_id') != '') {
     redirect(SITE_URL . 'admin/Ctl_admin/user_list');
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
        <title> Admin Log in |  Technosoft Engineering Projects Ltd. </title>
        <script>
            var SITE_URL = '<?php echo SITE_URL; ?>';
        </script>
        <link href="<?php echo SITE_URL; ?>asset/css/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/nprogress/nprogress.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/common.css" rel="stylesheet">
        <script src="<?php echo SITE_URL; ?>asset/js/jquery.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/javascript/validate.js"></script>

    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form name="adminlogin_frm" id="adminlogin_frm">
                            <h1>Admin Login</h1>
                            <div>
                                <div id="logbox1" class="smallred"></div>
                                <input type="text" class="form-control" placeholder="Username" name="name" required="" />

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
              <!--                <p class="change_link">New to site?
                                <a href="#signup" class="to_register"> Create Account </a>
                              </p>-->

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
         <!-- Please wait area show  -->
           <div class="please_wait">
                <p>
                    <span id="please_wait_text">Please Wait</span><img src="<?php echo SITE_URL; ?>asset/images/loading.gif" id="please_wait_image"/><br/>
                    <div class="loading" id="show_message_text">Please Wait..</div>
                </p>
            </div>
        <!--  Please wait area end     -->
    </body>
</html>
