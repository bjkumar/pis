<?php
if ($this->session->userdata('user_id_qc') == '') {
    redirect(SITE_URL . 'qc_login');
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
        <title>User TEPL Portal</title>
        <script>
            var SITE_URL = '<?php echo SITE_URL; ?>';
            var myid = '<?php echo $this->session->userdata('user_id_tl'); ?>';
        </script> 
        <link href="<?php echo SITE_URL; ?>asset/css/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/nprogress/nprogress.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL; ?>asset/css/common.css" rel="stylesheet">
        <script src="<?php echo SITE_URL; ?>asset/js/jquery.min.js"></script>
        <!-- chat file -->
        <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/javascript/group_chat.js"></script> 
        <link href="<?php echo SITE_URL; ?>asset/emoji/css/emoji.css" rel="stylesheet">
        <!-- chat file -->
        <script src="<?php echo SITE_URL; ?>asset/javascript/common_function.js"></script> 
        <script src="<?php echo SITE_URL; ?>asset/javascript/validate_tl.js"></script> 
        <script src="<?php echo SITE_URL; ?>asset/javascript/edit_account.js"></script>
        <link href="<?php echo SITE_URL; ?>asset/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>asset/css/hierarchy-select.min.css">

    </head>


    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo SITE_URL; ?>tl/Ctl_user/home" class="site_title" style="background: #edededf2;"><img src="<?php echo SITE_URL; ?>asset/images/logo.png" style="width: 200px;"></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <?php
                                if ($this->session->userdata('pro_image_tl') != '') {
                                    echo '<img src="' . SITE_URL . 'asset/images/profile_pic/' . $this->session->userdata('pro_image_tl') . '" alt="..." class="img-circle profile_img" id="pro_img">';
                                } else {
                                    echo '<img src="' . SITE_URL . 'asset/images/profile_pic/user.png" alt="..." class="img-circle profile_img" id="pro_img">';
                                }
                                ?>
                                <!--<img src="<?php echo SITE_URL; ?>asset/images/profile_pic/img.jpg" alt="..." class="img-circle profile_img" id="pro_img">-->


                                <input type="file" name="pro_image" id="pro_image">
                            </div> 
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php
                                    echo $this->session->userdata('fname_tl');
                                    echo "&nbsp;";
                                    echo $this->session->userdata('lname_tl');
                                    ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />
                        <a href="../../controllers/Ctl_common.php"></a>

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <!--<h3>General</h3>-->
                                <ul class="nav side-menu">
                                  <!--  <li><a><i class="fa fa-home"></i> User <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a data-toggle="modal" data-target=".bs-example-modal-sm">Change Password</a></li>
                                            <li><a onclick='httpPageGet("<?php echo SITE_URL; ?>tl/Ctl_user/user_profile")'>My profile</a></li>
                                             <!--<li><a href="<?php echo SITE_URL; ?>admin/Ctl_admin/user_list">User List</a></li>-->
                                            <!--                                        <li><a href="index2.html">Dashboard2</a></li>
                                                                                    <li><a href="index3.html">Dashboard3</a></li>-->
                                    <!--    </ul>
                                    </li>
                                    <li> <a onclick='httpPageGet("<?php echo SITE_URL; ?>tl/Ctl_user/add_account")'><i class="fa fa-plus-square-o"></i>  Add New Account </a></li> 
                                    <li><a onclick='httpPageGet("<?php echo SITE_URL; ?>Ctl_common/edit_list")'><i class="fa fa-bars"></i> Edit List</a></li>
                                    <li><a onclick='httpPageGet("<?php echo SITE_URL; ?>Ctl_common/plp_list")'><i class="fa fa-bars"></i> PLP List</a></li> -->
                                    <li><a onclick='httpPageGet("<?php echo SITE_URL; ?>Ctl_common/rpm_list")'><i class="fa fa-bars"></i> RPM List</a></li>
                                    <li><a onclick='httpPageGet("<?php echo SITE_URL; ?>Ctl_common/qc_rpm_list")'><i class="fa fa-bars"></i> QC List</a></li>
                                  <!--  <li><a onclick='httpPageGet("<?php echo SITE_URL; ?>Ctl_common/my_organization/tl")'><i class="fa fa-sun-o" aria-hidden="true"></i> My Organization</a></li> 
                                    <li><a onclick='httpPageGet("<?php echo SITE_URL; ?>tl/Ctl_user/home")'><i class="fa fa-bar-chart" aria-hidden="true"></i> Data Analysis</a></li> -->

                                </ul>
                            </div>
                            <!-- right chat box-->
                            <div id="chat-box" class="add-chat-list-user"> </div>


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
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo SITE_URL; ?>tl/Ctl_user/qc_user_logout">
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
                                        Hi, <?php echo $this->session->userdata('fname_tl'); ?>
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
                                        <li><a href="<?php echo SITE_URL; ?>tl/Ctl_user/qc_user_logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>



                                <!-- message start -->
                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green" id="add_total_no_pro">0</span>
                                    </a>
                                    <ul id="menu1_edit_list" class="dropdown-menu list-unstyled msg_list" role="menu">

                                        <!--                                    <li>
                                                                                <a style="cursor: inherit;" href="<?php echo SITE_URL; ?>tl/Ctl_user/view_edit/4">
                                                                                    <span class="image"><img src="http://localhost/tepl/asset/images/profile_pic/1523861778.jpeg" alt="Profile Image" style="width: 31px;height: 31px;"></span>
                                                                                    <span>
                                                                                        <span>Binod Yadav</span>
                                                                                        <span class="time">21/10/2018 12:12</span>
                                                                                    </span>
                                                                                    <span class="message">
                                                                                         <strong>Edit: </strong> Account Name 3122132
                                                                                    </span>
                                                                                </a>
                                                                            </li>-->



                                        <li>
                                            <div class="text-center">
                                                <a href="<?php echo SITE_URL; ?>tl/Ctl_user/edit_list" >
                                                    <strong>See List</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li> 
                                    </ul>
                                </li>
                                <!-- message start end -->

                                <!-- birthday -->
                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                        <span class="badge bg-green" id="add_total_no_birthday">0</span>
                                    </a>
                                    <ul id="menu1_birthday_list" class="dropdown-menu list-unstyled msg_list" role="menu"> <li>
                                            <div class="text-center">
                                                <a href="#">
                                                    <strong>See All List</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li> 
                                    </ul>
                                </li>
                                <!-- birthday end -->
                                <!-- Chat Message Start -->
                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number rmv_red_cnt_ind" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-weixin" aria-hidden="true"></i>
                                        <span class="badge bg-green" id="add_count_chat_noti">0</span>
                                    </a>
                                    <ul id="menu_chat_notification" class="dropdown-menu list-unstyled msg_noti_list" role="menu"> 
                                        <span id="Put_Chat_Noti_Header">
                                            <!--                                                                                <li>
                                                                                                                            <a href="" class="upper_chat_box">
                                                                                                                                <div><span class="image"><img src="http://localhost:8080/tpis/asset/images/profile_pic/1523438592.jpg" style="width: 31px;height: 31px;"></span></div>
                                                                                                                                <div>
                                                                                                                                    <span><strong>Binod: </strong><span class="time"> 14:40:59</span><br>
                                                                                                                                    <span class="message"> Hello amit How are you and what..</span></span></div> </a>
                                                                                                                        </li> 
                                                                                                                        <li>
                                                                                                                            <a href="" class="upper_chat_box">
                                                                                                                                <div><span class="image"><img src="http://localhost:8080/tpis/asset/images/profile_pic/1523438592.jpg" style="width: 31px;height: 31px;"></span></div>
                                                                                                                                <div>
                                                                                                                                    <span><strong>Binod: </strong><span class="time"> 14:40:59</span><br>
                                                                                                                                    <span class="message"> Hello amit How are you and what..</span></span></div> </a>
                                                                                                                        </li> -->
                                        </span> </ul>
                                </li>
                                <!-- Chat Message Start -->
                                <li role="presentation" class="dropdown" title="Relax in 2 minutes">
                                    <a href="<?php echo SITE_URL; ?>Ctl_common/play_game" title="Relax in 2 minutes">
                                        <i class="fa fa-futbol-o" aria-hidden="true"></i> 
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!--change password modal popup -->

                <div class="modal fade bs-example-modal-sm" id="Change_pass_Modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel2">Change Password</h4>
                            </div>
                            <div class="modal-body">


                                <form name="change_password" id="change_password">


                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="oldpassword">Old Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="password" name="oldpassword" required="required" class="form-control col-md-7 col-xs-12">
                                            <span id="msgpassN"></span>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="member_password">New Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="password" name="member_password" id="member_password" required="required" class="form-control col-md-7 col-xs-12">
                                            <span id="msgpass2"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="confirnmpassword">Re-Enter Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="password" name="confirnmpassword" id="confirnmpassword" required="required" class="form-control col-md-7 col-xs-12">
                                            <span id="msgpass3"></span>
                                        </div>
                                    </div>

                                </form>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="return ChangePasswordUser(event);" style="width: 174px;">Update</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- modal popup end-->


                <!-- content start -->

                <span id="put_page_content">
                    <?php $this->load->view($middle); ?>
                </span>  

                <!-- content start -->


                <!-- Please wait area show  -->
                <div class="please_wait">
                    <p>
                        <span id="please_wait_text">Please Wait</span><img src="<?php echo SITE_URL; ?>asset/images/loading.gif" id="please_wait_image"/><br/>
                    <div class="loading" id="show_message_text">Please Wait..</div>
                    </p>
                </div> <!-- Please wait area end  -->    

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        technosoft Admin  by <a href="https://www.technosofteng.com/">technosoft engg.</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>

        </div>


        <!-- jQuery -->

        <script src="<?php echo SITE_URL; ?>asset/js/bootstrap.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/js/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>  
        <script src="<?php echo SITE_URL; ?>asset/js/parsleyjs/dist/parsley.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/js/custom.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/javascript/footer_script.js"></script>

        <script src="<?php echo SITE_URL; ?>asset/js/hierarchy-select.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/js/moment/moment.min.js"></script>
        <script src="<?php echo SITE_URL; ?>asset/js/bootstrap-datetimepicker.min.js"></script>

        <!-- imoji -->
        <span id="imojijs"></span>
        <!-- imoji -->

        <script type="text/javascript">
                                    $('#myDatepicker').datetimepicker({
                                        format: 'YYYY/MM/DD'
                                    });


                                    function httpPageGet(theUrl)
                                    {
                                        $('.please_wait').show();
                                        $("#show_message_text").html('<span style="color:green;">Loading..</span>');

                                        if (window.XMLHttpRequest)
                                        {// code for IE7+, Firefox, Chrome, Opera, Safari
                                            xmlhttp = new XMLHttpRequest();
                                        } else
                                        {// code for IE6, IE5
                                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                        }
                                        xmlhttp.onreadystatechange = function ()
                                        {
                                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                                            {
                                                $(xmlhttp.responseText).find('span.take_pg_content').each(function () {
                                                    $("#put_page_content").html($(this).html());
                                                });
                                                PutPagePathOnUrl(theUrl);
                                            }
                                        }
                                        xmlhttp.open("GET", theUrl, true);
                                        xmlhttp.send();

                                    }




                                    function PutPagePathOnUrl(theUrl)
                                    {
                                        var url = document.createElement('a');
                                        url.href = theUrl;
                                        mysitePath = url.pathname; // find path like:  tpisv2/Ctl_common/edit_list
                                        window.history.pushState("object or string", "Title", "" + mysitePath);
                                        //window.history.pushState("object or string", "Title", "/" + mysitefolderurl);
                                        GoPageInitialize(mysitePath);
                                    }


                                    function GoPageInitialize(mysitePath) {     
                                        $("#imojijs").empty();
                                         $('#example').dataTable({
                                                "order": [],
                                            });
                                        if (PathFromControler(mysitePath) == 'Ctl_common/edit_list' || PathFromControler(mysitePath) == 'Ctl_common/plp_list' || PathFromControler(mysitePath) == 'Ctl_common/rpm_list') {
                                           /* $('#example').dataTable({
                                                "order": [],
                                            });  */
                                           
                                        } else if (window.location.href.indexOf("Ctl_group_chat/index") > -1) {
                                            $('<script />', {type: 'text/javascript', src: SITE_URL + 'asset/emoji/js/config.js'}).appendTo('#imojijs');
                                            $('<script />', {type: 'text/javascript', src: SITE_URL + 'asset/emoji/js/util.js'}).appendTo('#imojijs');
                                            $('<script />', {type: 'text/javascript', src: SITE_URL + 'asset/emoji/js/jquery.emojiarea.js'}).appendTo('#imojijs');
                                            $('<script />', {type: 'text/javascript', src: SITE_URL + 'asset/emoji/js/emoji-picker.js'}).appendTo('#imojijs');
                                            window.emojiPicker = new EmojiPicker({emojiable_selector: '[data-emojiable=true]', assetsPath: SITE_URL + 'asset/emoji/img/', popupButtonClasses: 'fa fa-smile-o'});
                                            window.emojiPicker.discover();

                                            var timeline_url = document.URL;
                                            var chat_url_id = timeline_url.substr(timeline_url.lastIndexOf('/') + 1);
                                            GetUserInfoByIdForChat(chat_url_id);
                                            $.post(SITE_URL + "Ctl_common/send_read_chat", {sender_id: chat_url_id});
                                        } else if (window.location.href.indexOf("view_edit") > -1 || window.location.href.indexOf("view_plp") > -1 || window.location.href.indexOf("view_rpm") > -1) {
                                            /*********************************** Start Edit Account Js *********************************************************************************************************** */

                                            ViewEditRpmPlpJs();
                                            /*********************************** End Edit Account Js *************************************** */

                                        } else if (window.location.href.indexOf("add_account") > -1) {
                                            $("#imojijs").empty();
                                            /*********************************** Start Edit Account Js *********************************************************************************************************** */
                                            AddAccountFooterJs();

                                            /*********************************** End Edit Account Js *************************************** */

                                        } else {



                                        }
 

                                        $('.please_wait').hide();
                                        $('.read_only').attr('readonly', 'true');
                                        $(".OnlyNum").keydown(function (e) {
                                            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                                                return;
                                            }
                                            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                                e.preventDefault();
                                            }
                                        });
                                        
                                        
                                        $("#from_date_report").datetimepicker({ format: 'DD/MM/YYYY HH:mm' }); 
                                        $("#to_date_report").datetimepicker({ format: 'DD/MM/YYYY HH:mm' });
                                    }

                                    function PathFromControler(mysitePath) {
                                        mysitePath = mysitePath.substr(mysitePath.indexOf("/") + 1);
                                        mysitePath = mysitePath.substr(mysitePath.indexOf("/") + 1);
                                        return mysitePath;
                                    }
                                    
                                     $("#from_date_report").datetimepicker({ format: 'DD/MM/YYYY HH:mm' }); 
                                        $("#to_date_report").datetimepicker({ format: 'DD/MM/YYYY HH:mm' });
        </script>
        	
    </body>
</html>
