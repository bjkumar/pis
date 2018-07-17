// JavaScript Document
var xmlHttp, str, str1, str2, str3, str4, str5, str6, str7, str8, str9, str10;
$(document).ready(function () {

    $("#confirnmpassword").keyup(checkPasswordMatch);
    $("input[name^=oldpassword]").keydown(function () {
        if ($(this).val() != '') {
            $('#msgpassN').hide();
        } else {
            $('#msgpassN').show();
        }
    });

    $("input[name^=member_password]").keydown(function () {
        if ($(this).val() != '') {
            $('#msgpass2').hide();
        } else {
            $('#msgpass2').show();
        }

    });

    /* image change profile */
    $("#pro_image").change(function () {
        Profile_Image_Change(this);
    });

});




/************ password matching Start **************************/
function checkPasswordMatch() {
    var m_password = $("#member_password").val();
    var c_Password = $("#confirnmpassword").val();

    if (m_password != c_Password) {
        $("#msgpass3").show();
        $("#msgpass3").html("Passwords do not match!");
    } else {
        $("#msgpass3").show();
        $("#msgpass3").html("Passwords match.");
    }
}
/************ password matching end **************************/

function ChkMemlogin(e)
{
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.login_frm;
    //var x = document.adminlogin_frm.member_email.value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var phoneno = /^[\d-+]{8,13}$/;
    var form = $('#login_frm'); // contact form
    // var submit = $('#submit');


    if (frm.email.value == "")
    {
        counter = counter + 1;
        document.getElementById("logbox1").style.display = "";
        document.getElementById("logbox1").innerHTML = "* Email field cannot be blank."; //alert("email field cannot be blank");
        if (counter == '1')
        {
            frm.email.focus();
        }
    } else
    {
        document.getElementById("logbox1").innerHTML = "";
        document.getElementById("logbox1").style.display = 'none';
    }



    if (frm.password.value == "")
    {
        counter = counter + 1;
        document.getElementById("logbox2").style.display = "";
        document.getElementById("logbox2").innerHTML = "* Password field cannot be blank.";  //alert("Password field cannot be blank");

        if (counter == '1')
        {
            frm.password.focus();
        }

    } else
    {
        document.getElementById("logbox2").innerHTML = "";
        document.getElementById("logbox2").style.display = 'none'; //alert("data came");
    }

    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();

    m_data.append('email', $('input[name=email]').val());
    m_data.append('password', $('input[name=password]').val());

    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'user/Ctl_user/login_check', // form action url

        type: 'POST', // form submit method get/post

        dataType: 'html',

        data: m_data, // serialize form data 

        processData: false,

        contentType: false,

        beforeSend: function () {
            $('.please_wait').show();
            $("#show_message_text").html('Please Wait..');
        },

        success: function (data) {
            // alert(data); 
            if (data == 0)
            {
                $("#show_message_text").html('Enter Registered Email id');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2000);
                return false;
            } else if (data == 1)
            {
                $("#show_message_text").html('Invalid Credentials');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2000);
                return false;
            } else
                (data == 10)
            {
                window.location.href = SITE_URL + "user/Ctl_user/user_profile";
            }

            //form.trigger('reset'); // reset form

            submit.val('login_frm'); // reset submit button text


        },

        error: function (e) {

            console.log(e)

        }

    });

}
function ChangePasswordUser(e)
{
    //alert("came");
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.change_password;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var phoneno = /^[\d-+]{8,13}$/;
    var form = $('#change_password'); // contact form
    var submit = $('#submit');

    if (frm.oldpassword.value == "")
    {
        counter = counter + 1;
        document.getElementById("msgpassN").style.display = "";
        document.getElementById("msgpassN").innerHTML = "* Old password field cannot be blank."; //alert("Old password field cannot be blank");
        if (counter == '1')
        {
            frm.oldpassword.focus();
        }
    } else if (frm.oldpassword.value.length < 5)
    {
        counter = counter + 1;
        document.getElementById("msgpassN").style.display = "";
        document.getElementById("msgpassN").innerHTML = "* New password should be minimum 5 characters."; //alert("old 2 5 charector");
        if (counter == '1')
        {
            frm.oldpassword.focus();
        }
    } else
    {
        document.getElementById("msgpassN").innerHTML = "";
        document.getElementById("msgpassN").style.display = 'none';
    }

    if (frm.member_password.value == "")
    {
        counter = counter + 1;
        document.getElementById("msgpass2").style.display = "";
        document.getElementById("msgpass2").innerHTML = "* Password field cannot be blank.";
        if (counter == '1')
        {
            frm.member_password.focus();
        }
    } else if (frm.member_password.value.length < 5)
    {
        counter = counter + 1;
        document.getElementById("msgpass2").style.display = "";
        document.getElementById("msgpass2").innerHTML = "* Password should be minimum 5 characters.";
        if (counter == '1')
        {
            frm.member_password.focus();
        }
    } else
    {
        document.getElementById("msgpass2").innerHTML = "";
        document.getElementById("msgpass2").style.display = 'none';
    }

    if (frm.confirnmpassword.value == "")
    {
        counter = counter + 1;
        document.getElementById("msgpass3").style.display = "";
        document.getElementById("msgpass3").innerHTML = "* Confirm password field cannot be blank.";
        if (counter == '1')
        {
            frm.confirnmpassword.focus();
        }
    } else if (frm.member_password.value != "" && frm.confirnmpassword.value != "" && frm.member_password.value != frm.confirnmpassword.value)
    {
        counter = counter + 1;
        document.getElementById("msgpass3").style.display = "";
        document.getElementById("msgpass3").innerHTML = "* Password and Confirm password do not match.";
        if (counter == '1')
        {
            frm.confirnmpassword.focus();
        }
    } else
    {
        document.getElementById("msgpass3").innerHTML = "";
        document.getElementById("msgpass3").style.display = 'none';
    }



    if (counter > 0)
    {
        return false;
    }

    e.preventDefault();
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/password_change', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: $('#change_password').serialize(), // serialize form data 
        processData: false,
        beforeSend: function () {
            //  alert("before send");
            $('.please_wait').show();
        },
        success: function (data) {
            // alert(data);

            if (data == 0)
            {
                $("#show_message_text").html('old password does not match');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2000);
                return false;
            } else {
                $('#change_password').trigger("reset");
                $('#Change_pass_Modal').modal('hide');
                $("#show_message_text").html('password changed successfully');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 3000);

            }



        },
        error: function (e) {
            console.log(e)
        }
    });
}


function Profile_Image_Change(input) {

    var file = input.files[0];
    var fileType = file["type"];
    var ValidImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
    if ($.inArray(fileType, ValidImageTypes) < 0) {
        $('.please_wait').show();
        $("#show_message_text").html('Please select valid image file');
        setTimeout(function () {
            $('.please_wait').hide();
        }, 2000);
        //alert('invalid file');      // invalid file type code goes here.
    } else {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#pro_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

        // ajax image store //

        var m_data = new FormData();
        m_data.append('pro_image', $('input[name=pro_image]')[0].files[0]);

        $.ajax({

            url: SITE_URL + 'user/Ctl_user/profile_image_change', // form action url
            type: 'POST', // form submit method get/post
            dataType: 'html',
            data: m_data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('.please_wait').show();
                $("#show_message_text").html('Image Uploading');
            },
            success: function (data) {
                $('.please_wait').hide();
            },

        });

        // ajax image store end //
    }
}




function UpdateProfile(e)
{
    //alert("came");
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.update_profile_frm;
    var phoneno = /^[\d-+]{8,13}$/;
    var form = $('#update_profile_frm'); // contact form 

    if (frm.pr_fname.value == "")
    {
        counter = counter + 1;
        document.getElementById("upmsgpass0").style.display = "";
        document.getElementById("upmsgpass0").innerHTML = "field cannot be blank."; //alert("Old password field cannot be blank");
        if (counter == '1')
        {
            frm.pr_fname.focus();
        }
    } else
    {
        document.getElementById("upmsgpass0").innerHTML = "";
        document.getElementById("upmsgpass0").style.display = 'none';
    }

    if (frm.pr_lname.value == "")
    {
        counter = counter + 1;
        document.getElementById("upmsgpass1").style.display = "";
        document.getElementById("upmsgpass1").innerHTML = "field cannot be blank."; //alert("Old password field cannot be blank");
        if (counter == '1')
        {
            frm.pr_lname.focus();
        }
    } else
    {
        document.getElementById("upmsgpass1").innerHTML = "";
        document.getElementById("upmsgpass1").style.display = 'none';
    }



    if (counter > 0)
    {
        return false;
    }

    e.preventDefault();
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/update_profile_details', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: $('#update_profile_frm').serialize(), // serialize form data 
        processData: false,
        beforeSend: function () {
            // alert("before send");
            $('.please_wait').show();
            // $("#show_message_text").html('Details Successfully Updated');
        },
        success: function (data) {

            if (data == 1)
            {
                $("#show_message_text").html('<span style="color:green;">Details Successfully Updated</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    location.href = SITE_URL + 'user/Ctl_user/user_profile';
                }, 2000);
                return false;
            } else {
                alert('Something wrong! contact to developer');

            }



        },
        error: function (e) {
            console.log(e)
        }
    });
}



function Save_User(e) {

    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.user_reg;
    var x = document.user_reg.email_reg.value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var phoneno = /^[\d-+]{8,13}$/;
    var form = $('#user_reg'); // contact form
    var submit = $('#user_reg');

    if (frm.first_name.value == "" || frm.last_name.value == "" || frm.email_reg.value == "" || frm.password_reg.value == "" || frm.re_password.value == "" || frm.dept.value == "")
    {
        alert('all fields are required!');
        counter = 1;
        return false;
    }

    if (!(filter.test(x)) && frm.email_reg.value != "")
    {
        counter = counter + 1;
        document.getElementById("alert_reg_0").style.display = "";
        document.getElementById("alert_reg_0").innerHTML = "* Invalid email address.";
    } else
    {
        document.getElementById("alert_reg_0").innerHTML = "";
        document.getElementById("alert_reg_0").style.display = 'none';
    }

    if (frm.password_reg.value != "" && frm.re_password.value != "" && frm.password_reg.value != frm.re_password.value)
    {
        counter = counter + 1;
        document.getElementById("alert_reg_1").style.display = "";
        document.getElementById("alert_reg_1").innerHTML = "* Password and Confirm password do not match.";
        if (counter == '1')
        {
            frm.member_cpassword.focus();
        }
    } else
    {
        document.getElementById("alert_reg_1").innerHTML = "";
        document.getElementById("alert_reg_1").style.display = 'none';
    }



    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();

    m_data.append('first_name', $('input[name=first_name]').val());
    m_data.append('last_name', $('input[name=last_name]').val());
    m_data.append('email', $('input[name=email_reg]').val());
    m_data.append('password', $('input[name=password_reg]').val());
    m_data.append('department', $('select[name=dept]').val());

    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'admin/Ctl_admin/save_user_self', // form action url

        type: 'POST', // form submit method get/post

        dataType: 'html',

        data: m_data, // serialize form data 

        processData: false,

        contentType: false,

        beforeSend: function () {
            $('.please_wait').show();
            $("#show_message_text").html('Please Wait..');
        },

        success: function (data) {
            // alert(data);
            if (data == 1)
            {
                $("#show_message_text").html('<span style="color:red;">Email id Already Exists</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 1500);
                return false;
            } else if (data == 2)
            {
                $("#show_message_text").html('<span style="color:green;">Congratulations Your Registration Was Successful</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2000);
                form.trigger('reset');
                $('.bs-example-modal-sm').modal('hide');

            } else {
                $("#show_message_text").html('<span style="color:red;">Something Wrong!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 1000);
                return false;
            }

        },

        error: function (e) {

            console.log(e)

        }

    });
}



function GetXmlHttpObject()

{

    var xmlHttp = null;

    try

    {

        // Firefox, Opera 8.0+, Safari

        xmlHttp = new XMLHttpRequest();

    } catch (e)

    {

        // Internet Explorer

        try

        {

            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

        } catch (e)

        {

            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

        }

    }

    return xmlHttp;

}



//Validation for field which can allow only alphabets



function IsNumeric(strString)

        //  check for valid numeric strings	

        {

            var strValidChars = "1234567890";

            var strChar;

            var blnResult = true;





            //  test strString consists of valid characters listed above

            for (i = 0; i < strString.length && blnResult == true; i++)

            {

                strChar = strString.charAt(i);

                if (strValidChars.indexOf(strChar) == -1)

                {

                    blnResult = false;

                }

            }

            return blnResult;

        }



function hasOnlyAlphabets(fieldvalue)

{

    var str = fieldvalue.replace(/\s/g, '');

    i = 0;

    while (i < str.length)

    {

        if (!(((str.charAt(i) >= 'a') && (str.charAt(i) <= 'z')) || ((str.charAt(i) >= 'A') && (str.charAt(i) <= 'Z'))))

        {

            //alert(fieldname+' can contain only alphabets\n\nValid Characters: (A to Z),(a to z) ');

            return false;

        }

        i++;

    }

    return true;



}

function UpdateEditDetailsUser(e)
{
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.edit_form;
    var form = $('#edit_form');
    var submit = $('#edit_form');

    if (frm.ed_t_id.value == "" || frm.account_name.value == "" || frm.received_date.value == "" || frm.revision.value == "" || frm.account_type.value == "" || frm.pages_worked.value == "" || frm.ed_plp.value == "" || frm.billing_hour.value == "")
    {
        alert('Please fill all required fileds');
        return false;

    }

    var ed_pm = $.trim($('#ed_pm').text());
    if ((ed_pm == "-- Select --" || ed_pm == "Enter Manually" || ed_pm == "") && (frm.select_pm_manually.value == ""))
    {
        counter = counter + 1;
        document.getElementById("ed_msgpasspm1").style.display = "";
        document.getElementById("ed_msgpasspm1").innerHTML = "PM field required";

    } else
    {
        document.getElementById("ed_msgpasspm1").innerHTML = "";
        document.getElementById("ed_msgpasspm1").style.display = 'none';
    }

    if (frm.select_pm_manually.value != '') {
        ed_pm = frm.select_pm_manually.value;
    }


    if ((frm.ed_plp.value == 'Yes') && (frm.plp_account_type.value == "" || frm.plp_billing_hour.value == "")) {
        alert('Please fill all required PLP fileds');
        return false;
    }

    if (counter > 0)
    {
        return false;
    }
    var agree = confirm("Are you sure to save this!");
    if (agree == false)
    {
        return false;
    }

    var m_data = new FormData();

    m_data.append('tgrmid', $('input[name=ed_tgmid]').val());
    m_data.append('tgram_id', $('input[name=ed_t_id]').val());
    m_data.append('account_name', $('input[name=account_name]').val());
    m_data.append('received_date', DateTimeYearDBFormat($('input[name=received_date]').val()));
    m_data.append('revision', $('select[name=revision]').val());
    m_data.append('account_type_id', $('select[name=account_type]').val());
    m_data.append('pm_id', ed_pm);
    m_data.append('pages_worked', $('select[name=pages_worked]').val());
    m_data.append('plp', $('select[name=ed_plp]').val());
    m_data.append('billing_hour', $('input[name=billing_hour]').val());
    m_data.append('comments', $('textarea[name=comments]').val());
    m_data.append('user_id', myid);
    m_data.append('edit_id', $('input[name=ed_id]').val());

    if ($('select[name=ed_plp]').val() == 'Yes') {
        m_data.append('cid', $('input[name=cid_plp]').val());
        m_data.append('plp_account_type', $('select[name=plp_account_type]').val());
        m_data.append('billing_hour_plp', $('input[name=plp_billing_hour]').val());
        m_data.append('error_details_plp', $('input[name=error_details_plp]').val());
        m_data.append('comments_plp', $('textarea[name=plp_comments]').val());
        m_data.append('plp_id', $('input[name=plp_ed_id]').val());
    }


    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'user/Ctl_user/update_edit_details_by_user', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: m_data, // serialize form data 
        processData: false,
        contentType: false,
        beforeSend: function () {
            //alert('before send');
            $('.please_wait').show();
            $("#show_message_text").html('Please wait..');
        },
        success: function (data) {
            if (data == 1) {
                $("#show_message_text").html('<span style="color:green;">Details Updated Submitted!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    httpPageGet(SITE_URL + 'Ctl_common/edit_list/');
                    // location.href = SITE_URL + 'Ctl_common/edit_list/';
                }, 2000);
            } else {
                alert('Something wrong! please contact to developer');
            }
        },
        error: function (e) {
            console.log(e)
        }

    });
}



/*** -- function is same for tl and user  *******  */
function UpdateRPMDetailsUser(e)
{
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.rpm_form;
    var form = $('#rpm_form');
    var submit = $('#rpm_form');
//

    var ed_tgm_id = $.trim($('#ed_tgm_id').text());


    if (ed_tgm_id == "-- Select --")
    {
        counter = counter + 1;
        document.getElementById("ed_msgpass0").style.display = "";
        document.getElementById("ed_msgpass0").innerHTML = "Select by dropdown";

    } else
    {
        document.getElementById("ed_msgpass0").innerHTML = "";
        document.getElementById("ed_msgpass0").style.display = 'none';
    }

    if (frm.rpm_received_date.value == "")
    {
        counter = counter + 1;
        document.getElementById("ed_msgpass1").style.display = "";
        document.getElementById("ed_msgpass1").innerHTML = "Select received date";

    } else
    {
        document.getElementById("ed_msgpass1").innerHTML = "";
        document.getElementById("ed_msgpass1").style.display = 'none';
    }

    if ((frm.rpm_request_type.value == "") || (frm.program_rpm.value == "") || (frm.queries.value == "") || (frm.no_of_pages.value == "") || (frm.billing_hour_rpm.value == "") || (frm.rpm_date_delivered.value == "") || (frm.url.value == "") || (frm.requtr_manually.value == "" && frm.requester.value == ""))
    {
        counter = 1;
        alert("Select all require fields");
    }

    if ($('select[name=queries]').val() == 'Yes' && $('input[name=rpm_resolution_date]').val() == "") {
        alert('Resolution Date is required');
        return false;
    }

    var checkedVals = $('.help_checkbox:checkbox:checked').map(function () {
        return this.value;
    }).get();
    if (checkedVals == 1) {
        if (frm.emp_id.value == "" || frm.emp_hour.value == "" || frm.emp_hour.value == "0") {
            alert('Employee Name and Hours are Required field');
            return false;
        }
//        else if (frm.emp_hour.value > frm.billing_hour.value) {
//            alert('Additional development hour should not be greater than working hour');
//            return false;
//        }
    }

    if (counter > 0)
    {
        return false;
    }


    var m_data = new FormData();

    m_data.append('tgrmid', $('input[name=ed_tgmid]').val());
    m_data.append('tgram_id', $('input[name=ed_t_id]').val());
    m_data.append('account_name', $('input[name=account_name]').val());
    m_data.append('cid', $('input[name=cid_rpm]').val());
    m_data.append('received_date', DateTimeYearDBFormat($('input[name=rpm_received_date]').val()));
    m_data.append('request_type_id', $('input[name=r_typ_id_rpm]').val());
    m_data.append('program_id', $('select[name=program_rpm]').val());
    if ($('select[name=requester]').val() != "") {
        m_data.append('pm_id', $('select[name=requester]').val());
    } else {
        m_data.append('pm_id', $('input[name=requtr_manually]').val());
    }

    m_data.append('queries', $('select[name=queries]').val());
    if ($('select[name=queries]').val() == 'Yes') {
        m_data.append('resolution_date', DateTimeYearDBFormat($('input[name=rpm_resolution_date]').val()));
    } else {
        m_data.append('resolution_date', '');
    }
    m_data.append('no_of_pages', $('input[name=no_of_pages]').val());

    m_data.append('billing_hour', $('input[name=billing_hour_rpm]').val());
    m_data.append('qc_hour', $('input[name=qc_hour_rpm]').val());
    m_data.append('total_hour', $('input[name=total_hour_rpm]').val());
    m_data.append('actual_hour', $('input[name=actual_hour_rpm]').val());
    m_data.append('start_date', DateTimeYearDBFormat($('input[name=rpm_start_date]').val()));
    m_data.append('delivered_on', DateTimeYearDBFormat($('input[name=rpm_date_delivered]').val()));
    m_data.append('days', $('input[name=rpm_days]').val());
    m_data.append('late', $('input[name=rpm_late]').val());
    m_data.append('invoice_month', $('input[name=rpm_invoice_months]').val());
    m_data.append('inv_date', $('input[name=rpm_inv_date]').val());
    m_data.append('url_rpm', $('input[name=url]').val());
    m_data.append('remark', $('input[name=remark]').val());
    m_data.append('comments', $('textarea[name=comments]').val());
    m_data.append('id', $('input[name=rpm_id]').val());
    if (checkedVals == 1) {
        m_data.append('helper_id', $('select[name=emp_id]').val());
        m_data.append('helper_hour', $('input[name=emp_hour]').val());
        m_data.append('user_hour', (($('input[name=billing_hour]').val()) - ($('input[name=emp_hour]').val())));
    } else {
        m_data.append('helper_id', '0');
        m_data.append('helper_hour', '0');
        m_data.append('user_hour', '0');
    }

    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'tl/Ctl_user/update_rpm_details', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: m_data, // serialize form data 
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('.please_wait').show();
            $("#show_message_text").html('Please Wait..');
        },
        success: function (data) {  // alert(data); //return false;
            if (data == 1) {
                $("#show_message_text").html('<span style="color:green;">Details Successfully Updated!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    httpPageGet(SITE_URL + 'Ctl_common/rpm_list/');
                    //  location.href = SITE_URL + 'Ctl_common/rpm_list/';
                    //var page_id = $('input[name=ed_id]').val();
                    // location.href = SITE_URL + 'Ctl_common/view_plp/' + page_id;
                }, 1100);
            } else {
                $('.please_wait').hide();
                httpPageGet(SITE_URL + 'Ctl_common/rpm_list/');
                // alert('Something wrong! please contact to developer');
            }
            // location.reload();
        },
        error: function (e) {
            console.log(e)
        }

    });
}

/* ********************************  Update PLP By User *******************************  */

function UpdatePLPDetailsUser(e)
{
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.edit_form;
    var form = $('#edit_form');
    var submit = $('#edit_form');
//

    var ed_tgm_id = $.trim($('#ed_tgm_id').text());


    if (ed_tgm_id == "-- Select --")
    {
        counter = counter + 1;
        document.getElementById("ed_msgpass0").style.display = "";
        document.getElementById("ed_msgpass0").innerHTML = "Select by dropdown";

    } else
    {
        document.getElementById("ed_msgpass0").innerHTML = "";
        document.getElementById("ed_msgpass0").style.display = 'none';
    }

    if (frm.received_date.value == "")
    {
        counter = counter + 1;
        document.getElementById("ed_msgpass1").style.display = "";
        document.getElementById("ed_msgpass1").innerHTML = "Select received date";
        if (counter == '1')
        {
            frm.received_date.focus();
        }
    } else
    {
        document.getElementById("ed_msgpass1").innerHTML = "";
        document.getElementById("ed_msgpass1").style.display = 'none';
    }

    var ed_pm = $.trim($('#ed_pm').text());
    if ((ed_pm == "-- Select --" || ed_pm == "Enter Manually" || ed_pm == "") && (frm.select_pm_manually.value == ""))
    {
        counter = counter + 1;
        document.getElementById("ed_msgpasspm1").style.display = "";
        document.getElementById("ed_msgpasspm1").innerHTML = "PM field required";

    } else
    {
        document.getElementById("ed_msgpasspm1").innerHTML = "";
        document.getElementById("ed_msgpasspm1").style.display = 'none';
    }

    if (frm.select_pm_manually.value != '') {
        ed_pm = frm.select_pm_manually.value;
    }


    if ((frm.ed_t_id.value == "") || (frm.account_name.value == "") || (frm.received_date.value == "") || (frm.billing_hour.value == "") || (frm.account_type.value == ""))
    {
        counter = 1;
        alert("fill all require fields");
    }



    if (counter > 0)
    {
        return false;
    }


    var m_data = new FormData();

    m_data.append('tgrmid', $('input[name=ed_tgmid]').val());
    m_data.append('tgram_id', $('input[name=ed_t_id]').val());
    m_data.append('account_name', $('input[name=account_name]').val());
    m_data.append('cid', $('input[name=cid_plp]').val());
    m_data.append('received_date', DateTimeYearDBFormat($('input[name=received_date]').val()));
    m_data.append('account_type_id', $('select[name=account_type]').val());
    m_data.append('pm_id', ed_pm);
    m_data.append('billing_hour', $('input[name=billing_hour]').val());
    m_data.append('comments', $('textarea[name=comments]').val());
    m_data.append('error_details_plp', $('input[name=error_details_plp]').val());
    m_data.append('user_id', myid);
    m_data.append('plp_id', $('input[name=ed_id]').val());

    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'user/Ctl_user/update_plp_details_by_user', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: m_data, // serialize form data 
        processData: false,
        contentType: false,
        beforeSend: function () {
           $('.please_wait').show();
          $("#show_message_text").html('Please Wait..');
        },
        success: function (data) { 
            if (data == 1) {
                $("#show_message_text").html('<span style="color:green;">Details Successfully Updated!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    httpPageGet(SITE_URL + 'Ctl_common/plp_list/'); 
                }, 1200);
            } else {
                alert('Something wrong! please contact to developer');
            } 
        },
        error: function (e) {
            console.log(e)
        }

    });
}