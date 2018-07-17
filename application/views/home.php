<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Page |  Technosoft Engineering Projects Ltd. </title>
        <script>
            var SITE_URL = '<?php echo SITE_URL; ?>';
        </script>
        <link href="<?php echo SITE_URL; ?>asset/css/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">


        <style>
            .box > .icon { text-align: center; position: relative; }
            .box > .icon > .image { position: relative; z-index: 2; margin: auto; width: 88px; height: 88px; border: 8px solid white; line-height: 88px; border-radius: 50%; background: #3F3B3B; vertical-align: middle; }
            .box > .icon:hover > .image { background: #071560 ; }
            .box > .icon > .image > i { font-size: 36px !important; color: #fff !important; }
            .box > .icon:hover > .image > i { color: white !important; }
            .box > .icon > .info { margin-top: -24px; background: rgba(0, 0, 0, 0.04); border: 1px solid #2d2727; padding: 15px 0 10px 0; }
            .box > .icon:hover > .info { background: rgba(0, 0, 0, 0.04); border-color: #e0e0e0; color: white; }
            .box > .icon > .info > h3.title { font-family: "Roboto",sans-serif !important; font-size: 16px; color: #222; font-weight: 500; }
            .box > .icon > .info > p { font-family: "Roboto",sans-serif !important; font-size: 13px; color: #666; line-height: 1.5em; margin: 20px;}
            .box > .icon:hover > .info > h3.title, .box > .icon:hover > .info > p, .box > .icon:hover > .info > .more > a { color: #222; }
            .box > .icon > .info > .more a { font-family: "Roboto",sans-serif !important; font-size: 12px; color: #222; line-height: 12px; text-transform: uppercase; text-decoration: none; }
            .box > .icon:hover > .info > .more > a { color: #fff; padding: 6px 8px; background-color: #071560; }
            .box .space { height: 30px; }
        </style>
    </head>
    <body style="background-color: #f2f2f2;">
        <div class="container" style="margin-top: 5%;">
            <div class="row">
                <!-- Boxes de Acoes -->
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="box">							
                        <div class="icon">
                            <div class="image">
                                <!--<i class="fa fa-thumbs-o-up"></i>-->
                                 <img src="<?php echo SITE_URL; ?>asset/images/employee.png" style="padding-bottom: 18px;"> 
                            </div>
                            <div class="info"><br/>
                                <h3 class="title">Developer Login</h3>
                                <br/>
                                <div class="more">
                                    <a href="<?php echo SITE_URL; ?>login" title="Title Link"> 
                                        Go <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div> 
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-4">

                </div>
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="box">							
                        <div class="icon">
                            <div class="image">
                                 <img src="<?php echo SITE_URL; ?>asset/images/tl.png" style="padding-bottom: 18px;"> 
                                <!--<i class="fa fa-thumbs-o-up"></i>-->
                            </div>
                            <div class="info"> <br/>
                                <h3 class="title">TL Login</h3>
                                <br/>
                                <div class="more">
                                    <a href="<?php echo SITE_URL; ?>tl_login" title="Title Link">
                                        Go <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div> 
                </div>





                <!-- /Boxes de Acoes -->
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-lg-4">

                </div>
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="box">							

                        <div>
                            <h1 style="text-align:center;"><img src="<?php echo SITE_URL; ?>asset/images/logo.png" style="width: 222px;"></h1>
                            <p style="text-align:center;">&copy; All Rights Reserved. Technosoft Engineering Projects Ltd. Privacy and Terms</p>
                        </div>	 
                    </div> 
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-4">

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="box">							
                        <div class="icon">
                            <div class="image"><img src="<?php echo SITE_URL; ?>asset/images/admin.png" style="padding-bottom: 18px;"> </div>
                            <div class="info"> <br/>
                                <h3 class="title">Admin Login</h3>
                                <br/>
                                <div class="more">
                                    <a href="<?php echo SITE_URL; ?>admin_login" title="Title Link">
                                        Go <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div> 
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-4">

                </div>
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="box">							
                        <div class="icon">
                            <div class="image"><img src="<?php echo SITE_URL; ?>asset/images/debug.png" style="padding-bottom: 18px;"></div>
                            <div class="info"> <br/>
                                <h3 class="title">QC Login</h3>
                                <br/>
                                <div class="more">
                                    <a href="<?php echo SITE_URL; ?>qc_login" title="Title Link">
                                        Go <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div> 
                </div>
            </div>

        </div>








    </body>
</div>
</html>
