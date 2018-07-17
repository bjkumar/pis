// JavaScript Document
var xmlHttp, str, str1, str2, str3, str4, str5, str6, str7, str8, str9, str10;
$(document).ready(function () {

    GetCountAllList();
});

function GetCountAllList() {

    $.ajax({
        url: SITE_URL + 'admin/Ctl_admin/get_Count_all_list/',
        type: 'GET',
        dataType: 'json',
        // async: false,
        beforeSend: function () {
            //alert('before');
        },
        success: function (data) {
            $("#ed_total_list").html(data['Edit']);
             $("#ed_unrd_list").html(data['Edit_unrd']);
            $("#plp_total_list").html(data['PLP']);
            $("#plp_unrd_list").html(data['PLP_unrd']);
            $("#rpm_total_list").html(data['RPM']);
            $("#rpm_unrd_list").html(data['RPM_unrd']);


        }
    });
}

function ChkMemlogin(e)
{
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.adminlogin_frm;
    //var x = document.adminlogin_frm.member_email.value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var phoneno = /^[\d-+]{8,13}$/;
    var form = $('#adminlogin_frm'); // contact form
    // var submit = $('#submit');


    if (frm.name.value == "")
    {
        counter = counter + 1;
        document.getElementById("logbox1").style.display = "";
        document.getElementById("logbox1").innerHTML = "* Name field cannot be blank."; //alert("email field cannot be blank");
        if (counter == '1')
        {
            frm.name.focus();
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

    m_data.append('name', $('input[name=name]').val());
    m_data.append('password', $('input[name=password]').val());

    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'admin/Ctl_admin/login_check', // form action url

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
            // return false;

            if (data == 0)
            {
                $("#show_message_text").html('Enter Registered User name');
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
                window.location.href = SITE_URL + "admin/Ctl_admin/home";
            }

            //form.trigger('reset'); // reset form

            submit.val('adminlogin_frm'); // reset submit button text


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
    //var x = document.adminlogin_frm.member_email.value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var phoneno = /^[\d-+]{8,13}$/;
    var form = $('#user_reg'); // contact form
    var submit = $('#user_reg');


    if (document.getElementById("cat_posi1").checked != true && document.getElementById("cat_posi2").checked != true) {

        $("#sel-cat-alert").html('<span style="color:red;">Select Category <span class="required">*</span></span>');
        setTimeout(function () {
            $("#sel-cat-alert").html('<span style="color:#73879C;">Category</span><span class="required">*</span>');
        }, 3500);
        return false;
    } else if (document.getElementById("cat_posi1").checked == true) {

        var identity = frm.optionsRadios.value;
    } else if (document.getElementById("cat_posi2").checked == true) {

        var identity = frm.optionsRadios.value;
    }

    //alert(identity); return false;

    if (frm.first_name.value == "" || frm.last_name.value == "" || frm.email.value == "" || frm.mobile.value == "")
    {
        // alert('fields are blank!');
        counter = 1;
        return false;
    }


    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();

    m_data.append('first_name', $('input[name=first_name]').val());
    m_data.append('last_name', $('input[name=last_name]').val());
    m_data.append('email', $('input[name=email]').val());
    m_data.append('mobile', $('input[name=mobile]').val());
    m_data.append('password', $('input[name=password]').val());
    m_data.append('identity', identity);
    m_data.append('department', $('select[name=dept]').val());
    //  alert($('select[name=dept]').val());
    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'admin/Ctl_admin/save_user', // form action url

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
              
            if (data == 1)
            {
                $("#show_message_text").html('<span style="color:red;">Email id Already Exists</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2500);
                return false;
            } else if (data == 2)
            {
                $("#show_message_text").html('<span style="color:green;">Registration Successfull</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2000);
                form.trigger('reset');
            } else if (data == 3)
            {
                $("#show_message_text").html('Details Updated');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2000);
                window.location.href = SITE_URL + "admin/Ctl_admin/user_list";
            } else { 
                $("#show_message_text").html('<span style="color:red;">Something Wrong!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2000); alert(data);
                return false;
            }

        },

        error: function (e) {

            console.log(e)

        }

    });
}


function StatusChangeStandard(Strval) {
    var splitString = Strval.split(':');
    var status = splitString[0];
    var id = splitString[1];
    var table_name = splitString[2];
    //  alert(table_name);
//return false;

    var m_data = new FormData();

    m_data.append('status', status);
    m_data.append('id', id);
    m_data.append('table_name', table_name);

    $.ajax({

        url: SITE_URL + 'admin/Ctl_admin/update_status_standard', // form action url

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
            location.reload();
        },

    });
}

function StatusChange(Strval) {
    var splitString = Strval.split(':');
    var status = splitString[0];
    var id = splitString[1];


    var m_data = new FormData();

    m_data.append('status', status);
    m_data.append('id', id);

    $.ajax({

        url: SITE_URL + 'admin/Ctl_admin/update_status', // form action url

        type: 'POST', // form submit method get/post

        dataType: 'html',

        data: m_data, // serialize form data 

        processData: false,

        contentType: false,

        beforeSend: function () {
            $('.please_wait').show();
            $("#show_message_text").html('Please Wait..');
            // alert("yes check");
        },

        success: function (data) {
            //alert(data);
            location.reload();
        },

    });
}

function DeleteStandard(Strval)
{
    var splitString = Strval.split(':');
    var id = splitString[0];
    var table_name = splitString[1];
    // alert(Strval);
    var agree = confirm("Alert! are you sure to delete this?");
    if (agree)
    {
        xmlHttp = GetXmlHttpObject();
        if (xmlHttp == null)
        {
            alert("Your browser does not support AJAX!");
            return;
        }
        var url = SITE_URL + "admin/Ctl_admin/delete_standard/" + Strval;
        xmlHttp.onreadystatechange = LoadPageAfterDel;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
    } else
    {
        return false;
    }
}

function LoadPageAfterDel()
{
    if (xmlHttp.readyState == 4)
    {
        location.reload();
    }
}



function Upload_Csv_Tgram(e)
{
    var counter = 0;
    var frm = document.csv_import;
    var form = $('#csv_import');

    if (frm.csv_file.value == "")
    {
        alert('browse your file');
        return false;
    }

    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();
    m_data.append('file', $('input[name=csv_file]')[0].files[0]);
    e.preventDefault();
    $.ajax({

        url: SITE_URL + 'Ctl_common/csv_upload_tgram', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: m_data, // serialize form data 
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('.please_wait').show();
            $("#show_message_text").html('Please Wait..');
        },

        success: function (data) { //alert(data);
            if (data == 2)
            {
                $("#show_message_text").html('<span style="color:red;">Select valid file</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 2000);
                return false;
            } else {
                $("#show_message_text").html('<span style="color:green;">File Successfully Uploaded</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/tgrams";
                }, 1000);

            }
            submit.val('csv_import'); // reset submit button text


        },

        error: function (e) {

            console.log(e)

        }

    });

}
function UpdateTgrams(e) {
    var counter = 0;
    var frm = document.update_frm;
    var form = $('#update_frm'); // contact form

    if (frm.tgrams_upd.value == "" || frm.account_name_upd.value == "")
    {
        alert('Both fields are required!');
        counter = 1;
        return false;
    }


    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();

    m_data.append('id', frm.id_upd.value);
    m_data.append('tgram', frm.tgrams_upd.value);
    m_data.append('account_name', frm.account_name_upd.value);

    $.ajax({
        url: SITE_URL + 'admin/Ctl_admin/update_Tgrams',
        type: 'POST',
        dataType: 'html',
        data: m_data,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('.please_wait').show();
            $("#show_message_text").html('Please wait..');
        },
        success: function (data) {
            if (data == 2) {
                $("#show_message_text").html('<span style="color:green">Row Updated</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/tgrams";
                }, 1200);

            } else {
                $('.please_wait').hide();
                alert('something wrong! contact to developer');
            }

        },

    });
}

function UpdateAccountType(e) {
    var counter = 0;
    var frm = document.update_frm;
    var form = $('#update_frm'); // contact form

    if (frm.actype_upd.value == "")
    {
        alert('field is required!');
        counter = 1;
        return false;
    }


    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();

    m_data.append('id', frm.id_upd.value);
    m_data.append('account_type', frm.actype_upd.value);

    $.ajax({
        url: SITE_URL + 'admin/Ctl_admin/update_account_type',
        type: 'POST',
        dataType: 'html',
        data: m_data,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('.please_wait').show();
            $("#show_message_text").html('Please wait..');
        },
        success: function (data) {
            if (data == 2) {
                $("#show_message_text").html('<span style="color:green">Row Updated</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/account_type";
                }, 1200);

            } else {
                $('.please_wait').hide();
                alert('something wrong! contact to developer');
            }

        },

    });
}

function UpdatePM(e) {
    var counter = 0;
    var frm = document.update_frm;
    var form = $('#update_frm'); // contact form

    if (frm.pm_upd.value == "")
    {
        alert('field is required!');
        counter = 1;
        return false;
    }


    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();

    m_data.append('id', frm.id_upd.value);
    m_data.append('pm', frm.pm_upd.value);

    $.ajax({
        url: SITE_URL + 'admin/Ctl_admin/update_pm',
        type: 'POST',
        dataType: 'html',
        data: m_data,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('.please_wait').show();
            $("#show_message_text").html('Please wait..');
        },
        success: function (data) {
            if (data == 2) {
                $("#show_message_text").html('<span style="color:green">Row Updated</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/pm";
                }, 1200);

            } else {
                $('.please_wait').hide();
                alert('something wrong! contact to developer');
            }

        },

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



