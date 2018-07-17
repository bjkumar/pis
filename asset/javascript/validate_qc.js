// JavaScript Document
var xmlHttp, str, str1, str2, str3, str4, str5, str6, str7, str8, str9, str10;
 

 
/************ password matching end **************************/

function ChkMemloginQC(e)
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

        url: SITE_URL + 'tl/Ctl_user/qc_login_check', // form action url

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
            } else if (data == 10)
            {
                window.location.href = SITE_URL + "tl/Ctl_user/qc_home";
            } else {
                alert(data);
            }

            //form.trigger('reset'); // reset form

            submit.val('login_frm'); // reset submit button text


        },

        error: function (e) {

            console.log(e)

        }

    });

}
     


