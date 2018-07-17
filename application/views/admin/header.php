<?php
if ($this->session->userdata('admin_id') == '') {
    redirect(SITE_URL . 'admin');
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
        <title>Admin TEPL Portal</title>
        <script>
            var SITE_URL = '<?php echo SITE_URL; ?>';
        </script>
        <link href="<?php echo SITE_URL; ?>asset/css/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/nprogress/nprogress.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/common.css" rel="stylesheet">
        <script src="<?php echo SITE_URL; ?>asset/js/jquery.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/javascript/common_function.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/javascript/validate.js"></script>
    </head>

 
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo SITE_URL; ?>admin/Ctl_admin/home" class="site_title" style="background: #edededf2;"><img src="<?php echo SITE_URL; ?>asset/images/logo.png" style="width: 200px;"></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <!--                        <div class="profile_pic">
                                                    <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                                                </div>-->
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php
                                echo $this->session->userdata('name');
                                echo "&nbsp;";
                                echo $this->session->userdata('last_name');
                                ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <!--<h3>General</h3>-->
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> User <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/register">Registration</a></li>
                                        <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/user_list">User List</a></li>
                                        <!--                                        <li><a href="index2.html">Dashboard2</a></li>
                                                                                <li><a href="index3.html">Dashboard3</a></li>-->
                                    </ul>
                                </li>
                                <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/tgrams"><i class="fa fa-outdent"></i> TGRAMS</a></li>
                                <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/account_type"><i class="fa fa-sticky-note-o"></i> Account Type</a></li>
                                <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/pm"><i class="fa fa-hourglass-start"></i> PM</a></li>
                                <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/account_type_plp"><i class="fa fa-steam"></i> Account Type PLP</a></li>
                                <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/program_rpm"><i class="fa fa-rub"></i> Program RPM</a></li>
                                <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/requester_rpm"><i class="fa fa-bug"></i> Requester RPM</a></li> 
                                <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/request_type_rpm"><i class="fa fa-gift"></i> Request Type RPM</a></li> 
                                <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/leave_dates"><i class="fa fa-calendar-times-o"></i> Leave Dates</a></li>
                                <li><a href="<?php echo SITE_URL; ?>Ctl_common/edit_list"><i class="fa fa-bars"></i> Edit List 
                                        <span class="clgrn" id="ed_total_list" title="Total">0</span> <span class="clyel" id="ed_unrd_list" title="Unread">0</span></a></li>
                                        
                                <li><a href="<?php echo SITE_URL; ?>Ctl_common/plp_list"><i class="fa fa-bars"></i>PLP List
                                        <span class="clgrn" id="plp_total_list" title="Total">0</span> <span class="clyel" id="plp_unrd_list" title="Unread">0</span> </a></li>

                                <li><a href="<?php echo SITE_URL; ?>Ctl_common/rpm_list"><i class="fa fa-bars"></i>RPM List
                                        <span class="clgrn" id="rpm_total_list" title="Total">0</span> <span class="clyel" id="rpm_unrd_list" title="Unread">0</span> </a></li>

                            </ul>
                        </div>


                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <!--                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                                                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                </a>
                                                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                                                </a>
                                                <a data-toggle="tooltip" data-placement="top" title="Lock">
                                                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                                </a>-->
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo SITE_URL; ?>admin/Ctl_admin/admin_logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Hi, <?php echo $this->session->userdata('name'); ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <!--                                    <li><a href="javascript:;"> Profile</a></li>
                                                                        <li>
                                                                            <a href="javascript:;">
                                                                                <span class="badge bg-red pull-right">50%</span>
                                                                                <span>Settings</span>
                                                                            </a>
                                                                        </li>
                                                                        <li><a href="javascript:;">Help</a></li>-->
                                    <li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/admin_logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <!--                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-envelope-o"></i>
                                                                    <span class="badge bg-green">6</span>
                                                                </a>-->

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->