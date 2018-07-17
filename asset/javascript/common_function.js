var xmlHttp;
$(document).ready(function () {
    GetBirthdayNotification();

    $('.read_only').attr('readonly', 'true');
    $(".OnlyNum").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

    //********** Helper div show hide by check box ***********// 
    $(".help_checkbox").click(function () {
        var checkedVals = $('.help_checkbox:checkbox:checked').map(function () {
            return this.value;
        }).get();
        if (checkedVals == 1) {
            $(".helper_div").show();
        } else {
            $(".helper_div").hide();
        }
    });
});



function Put_R_Type_id_days(val) {
    spval = val.split(':');
    $("#r_typ_id_rpm").val(spval[0]);
    $("#r_typ_late_daye_rpm").val(spval[1]);
}
function CheckResolutionDate(val) {
    if (val == 'Yes') {
        $('.resol_date').show();
    } else {
        $('.resol_date').hide();
        $('#rpm_resolution_date').val('');
    }
}



function GetDaysBetDatesRPM(date2, DateVal) {
    if (DateVal == 'Deliver') {
        var date1 = $("#rpm_start_date").val();
        if (date1 == "") {
            alert('Select Start Date First!');
            $('#rpm_date_delivered').val('');
        } else {
            GetDaysBetDatesRPMCal(date2, date1);
        }
    }

    if (DateVal == 'StartRPM') {
        date1 = date2;
        var date2 = $("#rpm_date_delivered").val();
        if (date2 != "") {
            GetDaysBetDatesRPMCal(date2, date1);
        }
    }


}

function GetDaysBetDatesRPMCal(date2, date1) {



    // var ActualLateHour = GetActualHourForLate(date1, date2); 
    // $("#ed_ac_late_hour").val(ActualLateHour);



    //var date1 = '20/12/2012  18:41';
    date1 = date1.split(' ');
    date1 = date1[0].split('/');

    date2 = date2.split(' ');
    date2 = date2[0].split('/');
    // alert(date2);
    var make_date1 = date1[2] + '/' + date1[1] + '/' + date1[0];
    var make_date2 = date2[2] + '/' + date2[1] + '/' + date2[0];


    date1 = new Date(date1[2], date1[1], date1[0]);
    date2 = new Date(date2[2], date2[1], date2[0]);

    // get invoice date from delivered date //
    $("#rpm_invoice_months").val(Get_Month_Year(date2));
    $("#rpm_inv_date").val(Get_Date_Month_Year(date2));



    date1_unixtime = parseInt(date1.getTime() / 1000);
    date2_unixtime = parseInt(date2.getTime() / 1000);
    var timeDifference = date2_unixtime - date1_unixtime;
    var timeDifferenceInHours = timeDifference / 60 / 60;
    var timeDifferenceInDays = timeDifferenceInHours / 24;
    timeDifferenceInDays = timeDifferenceInDays + 1;
    $("#rpm_days").val(timeDifferenceInDays);

    // check leave from database through ajax//
    // Check_Leave_Days(make_date1, make_date2, timeDifferenceInDays);
    // alert(make_date1); return false;

    var m_data = new FormData();
    m_data.append('startdate', make_date1);
    m_data.append('end_date', make_date2);
    $.ajax({url: SITE_URL + 'user/Ctl_user/get_leave_days', type: 'POST', dataType: 'html',
        data: m_data, processData: false, contentType: false,
        beforeSend: function () { },
        success: function (data) {
            if (data != 0) {
                timeDifferenceInDays = parseFloat(timeDifferenceInDays) - parseFloat(data);  //alert(timeDifferenceInDays);
                $("#rpm_days").val(timeDifferenceInDays);
            } else {
                $("#rpm_days").val(timeDifferenceInDays);
            }

            if (timeDifferenceInDays > $('input[name=r_typ_late_daye_rpm]').val()) {
                $("#rpm_late").val('Late');
            } else {
                $("#rpm_late").val('SLA');
            }



        }, });
}
function GetBirthdayNotification() {

    $.ajax({
        url: SITE_URL + 'Ctl_common/get_birthday_list_noti/',
        type: 'GET',
        dataType: 'json',
        // async: false,
        beforeSend: function () {
            //alert('before');
        },
        success: function (data) { //alert(data);

            var obj = JSON.parse(JSON.stringify(data));
            $.each(obj, function (i, item) {
                if (i == 'emp_bday') {

                    var inc = 0;
                    $.each(item, function (j, fdata) {
                        //alert(fdata.birthday);
                        var birth_month_date = Get_Date_Month(fdata.birthday);
                        if (fdata.pro_image == '') {
                            fdata.pro_image = 'user.png';
                        }
                        if (myid != fdata.id) {
                            cht_url = SITE_URL + 'Ctl_group_chat/index/' + fdata.id;
                        } else {
                            cht_url = '#';
                        }


                        $('#menu1_birthday_list li:first').before('<li class="remove_cls"><a href="' + cht_url + '"><span class="image"><img src="' + SITE_URL + 'asset/images/profile_pic/' + fdata.pro_image + '" alt="Profile Image" style="width: 31px;height: 31px;"></span><span><span>' + fdata.fname + ' ' + fdata.lname + '  <i class="fa fa-weixin" aria-hidden="true"></i></span><span class="time"><strong>' + birth_month_date + '</strong></span></span><span class="message">' + fdata.position + '</span></a></li>');
                        inc++;
                    });

                    $("#add_total_no_birthday").html(inc);
                }


//                if (i == 'second_table') {
//                    $.each(item, function (j, test_second) {
//                        ArraySelected = test_second.capability.split(",");
//                    });
//                }
            });
        }
    });
}

function DateTimeYearDBFormat(date_time) {

    //var date_time = "14/04/2013 15:00";
    date_time = date_time.split(' ');
    var date = date_time[0];
    var time = date_time[1];

    date1 = date.split('/');

    //alert(date); alert(time);
    var make_date1 = date1[2] + '-' + date1[1] + '-' + date1[0] + ' ' + time;
    return make_date1;
    //alert(make_date1);
}

function Get_Date_Month(full_date) {
    full_date = full_date.split('-');
    var full_date = new Date(full_date[0], full_date[1], full_date[2]);
    var months = ['December', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November'];
    var dd = full_date.getDate();
    var year = full_date.getFullYear();
    var month = months[full_date.getMonth()];
    var myddd = month + "-" + year;
    var year_last2_words = myddd.slice(-2);
    var month_year = month + "-" + year_last2_words;
    var date_month = dd + "-" + month;
    // alert(date_month_year);
    return date_month;
}


function Save_Tgram(e)
{
    var counter = 0;
    var frm = document.tgram_frm;
    var form = $('#tgram_frm');

    if (frm.account_name.value == "" || frm.tgram.value == "")
    {
        alert('Both input fields are required');
        return false;
    }

    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();
    m_data.append('account_name', $('input[name=account_name]').val());
    m_data.append('tgram', $('input[name=tgram]').val());
    e.preventDefault();
    $.ajax({

        url: SITE_URL + 'Ctl_common/save_tgram', // form action url
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
            //alert(data);
            if (data == 1)
            {
                $("#show_message_text").html('<span style="color:green;">Tgram Successfully saved!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/tgrams";
                }, 2000);
            } else if (data == 2)
            {
                $("#show_message_text").html('<span style="color:red;">Tgram Already Exists!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/tgrams";
                }, 1000);
            } else {
                $("#show_message_text").html('<span style="color:red;">Something wrong, contact to developer</span>');
                $('.please_wait').hide();
            }
            // submit.val('tgram_frm'); // reset submit button text


        },

        error: function (e) {

            console.log(e)

        }

    });

}




function Save_PM(e)
{
    var counter = 0;
    var frm = document.pm_frm;
    var form = $('#pm_frm');

    if (frm.pm_name.value == "")
    {
        alert('input field is required');
        return false;
    }

    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();
    m_data.append('pm', $('input[name=pm_name]').val());
    e.preventDefault();
    $.ajax({

        url: SITE_URL + 'Ctl_common/save_pm', // form action url
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
            //alert(data);
            if (data == 1)
            {
                $("#show_message_text").html('<span style="color:green;">PM Successfully saved!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/pm";
                }, 2000);
            } else if (data == 2)
            {
                $("#show_message_text").html('<span style="color:red;">PM Name Already Exists!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 1000);
            } else {
                $("#show_message_text").html('<span style="color:red;">Something wrong, contact to developer</span>');
                $('.please_wait').hide();
            }
            submit.val('pm_frm'); // reset submit button text


        },

        error: function (e) {

            console.log(e)

        }

    });

}


function Save_Account_Type(e)
{
    var counter = 0;
    var frm = document.atype_frm;
    var form = $('#atype_frm');

    if (frm.at_name.value == "")
    {
        alert('input field is required');
        return false;
    }

    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();
    m_data.append('account_type', $('input[name=at_name]').val());
    e.preventDefault();
    $.ajax({

        url: SITE_URL + 'Ctl_common/save_account_type', // form action url
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
            //alert(data);
            if (data == 1)
            {
                $("#show_message_text").html('<span style="color:green;">Account Type Successfully saved!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/account_type";
                }, 2000);
            } else if (data == 2)
            {
                $("#show_message_text").html('<span style="color:red;">Account Type Already Exists!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                }, 1000);
            } else {
                $("#show_message_text").html('<span style="color:red;">Something wrong, contact to developer</span>');
                $('.please_wait').hide();
            }
            submit.val('atype_frm'); // reset submit button text


        },

        error: function (e) {

            console.log(e)

        }

    });

}


function Save_Leave(e)
{
    var counter = 0;
    var frm = document.tgram_frm;
    var form = $('#tgram_frm');

    if (frm.leave_date.value == "" || frm.title.value == "")
    {
        alert('Both input fields are required');
        return false;
    }

    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();
    m_data.append('leave_date', $('input[name=leave_date]').val());
    m_data.append('title', $('input[name=title]').val());
    e.preventDefault();
    $.ajax({

        url: SITE_URL + 'Ctl_common/save_leaves', // form action url
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
                $("#show_message_text").html('<span style="color:green;">Leave Date Successfully saved!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/leave_dates";
                }, 2000);
            } else if (data == 2)
            {
                $("#show_message_text").html('<span style="color:red;">Leave Date Already Exists!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    window.location.href = SITE_URL + "admin/Ctl_admin/leave_dates";
                }, 1000);
            } else {
                $("#show_message_text").html('<span style="color:red;">Something wrong, contact to developer</span>');
                $('.please_wait').hide();
            }
            // submit.val('tgram_frm'); // reset submit button text


        },

    });

}

function UpdateLeave(e) {
    var counter = 0;
    var frm = document.update_frm;
    var form = $('#update_frm'); // contact form


    if (frm.pm_upd.value == "" || frm.pm_title.value == "")
    {
        alert('Both input fields are required');
        return false;
    }

    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();

    m_data.append('id', frm.id_upd.value);
    m_data.append('leave_date', frm.pm_upd.value);
    m_data.append('title', frm.pm_title.value);

    $.ajax({
        url: SITE_URL + 'admin/Ctl_admin/update_leaves',
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
                    window.location.href = SITE_URL + "admin/Ctl_admin/leave_dates";
                }, 1200);

            } else {
                $('.please_wait').hide();
                alert('something wrong! contact to developer');
            }

        },

    });
}




function PutRQDropdown() {
    $(".requester").show();
    $("#re_req_Box").hide();
    $("#requtr_manually").hide();
    $("#requtr_manually").val('');
}

function HideRQDropdown(val) {
    if (val == 0) {
        $(".requester").hide();
        $("#re_req_Box").show();
        $("#requtr_manually").show();
    }

}


function AddTGramSearchCommon(numb) {
    var obj = JSON.parse(JSON.stringify(GetTGramList_db));
    $.each(obj, function (i, item) {
        var st_tgram = item.tgram + ':' + item.account_name + ':' + item.id;
        var st_tgram_show = item.tgram + '  ' + item.account_name;
        st_tgram = "'" + st_tgram + "'";
        $('#add_tgram' + numb + ' li:first').after('<li><a href="#" onclick="GetAccountName(' + st_tgram + ',' + numb + ');">' + st_tgram_show + '</a></li>');
    });

    // $('#add_pmlist'+numb ).remove();  
    $('#add_pmlist' + numb + ' li:not(:first)').remove();
    var objpm = JSON.parse(JSON.stringify(LoadPM_db));
    $.each(objpm, function (i, item) {
        var pmid = "'" + item.id + "'";
        $('#add_pmlist' + numb + ' li:first').after('<li><a href="#" onclick="GetPMIdInTextBox(' + pmid + ');">' + item.pm + '</a></li>');
    });
    $('#add_pmlist' + numb + ' li:last').after('<li><a href="#" onclick="PutPMManully(' + numb + ');" style="color:black;font-weight: bold;">Enter Manually</a></li>');
}



function SaveEditDetails(e)
{
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.edit_form;
    var form = $('#edit_form');
    var submit = $('#edit_form');

    if (frm.t_id2.value == "" || frm.account_name2.value == "" || frm.received_date_edit.value == "" || frm.revision.value == "" || frm.account_type.value == "" || frm.pages_worked.value == "" || frm.ed_plp.value == "" || frm.billing_hour.value == "")
    {
        alert('Please fill all required fileds');
        return false;

    }

    var ed_pm = $.trim($('#ed_pm2').text());
    if (ed_pm == "-- Select --" && frm.select_pm_manually2.value == "")
    {
        counter = counter + 1;
        document.getElementById("ed_msgpasspm2").style.display = "";
        document.getElementById("ed_msgpasspm2").innerHTML = "PM field required";

    } else
    {
        document.getElementById("ed_msgpasspm2").innerHTML = "";
        document.getElementById("ed_msgpasspm2").style.display = 'none';
    }

    if (frm.select_pm_manually2.value != '') {
        ed_pm = frm.select_pm_manually2.value;
    }


    if ((frm.ed_plp.value == 'Yes') && (frm.plp_account_type.value == "" || frm.billing_hour_ed_plp.value == "")) {
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

    m_data.append('tgrmid', $('input[name=tgmid2]').val());
    m_data.append('tgram_id', $('input[name=t_id2]').val());
    m_data.append('account_name', $('input[name=account_name2]').val());
    m_data.append('received_date', DateTimeYearDBFormat($('input[name=received_date_edit]').val()));
    m_data.append('revision', $('select[name=revision]').val());
    m_data.append('account_type_id', $('select[name=account_type]').val());
    m_data.append('pm_id', ed_pm);
    m_data.append('pages_worked', $('select[name=pages_worked]').val());
    m_data.append('plp', $('select[name=ed_plp]').val());
    m_data.append('billing_hour', $('input[name=billing_hour]').val());
    m_data.append('comments', $('textarea[name=comments]').val());
    m_data.append('user_id', myid);

    if ($('select[name=ed_plp]').val() == 'Yes') {
        m_data.append('cid', $('input[name=cid_ed_plp]').val());
        m_data.append('plp_account_type', $('select[name=plp_account_type]').val());
        m_data.append('billing_hour_plp', $('input[name=billing_hour_ed_plp]').val());
        m_data.append('error_details_plp', $('input[name=error_details_ed_plp]').val());
        m_data.append('comments_plp', $('textarea[name=comments_ed_plp]').val());
    }


    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'user/Ctl_user/save_edit_details', // form action url
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
        success: function (data) {  //alert(data);
            if (data == 1) {
                $("#show_message_text").html('<span style="color:green;">Details Successfully Submitted!</span>');
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


function SavePLPDetails(e)
{
    // alert("came");
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.plp_form;
    var form = $('#plp_form');
    var submit = $('#plp_form');

    if (frm.t_id1.value == "" || frm.account_name1.value == "" || frm.received_date_plp.value == "" || frm.plp_account_type.value == "" || frm.billing_hour_plp.value == "") {
        alert('Please fill all required fields');
        return false;
    }


    var ed_pm = $.trim($('#ed_pm1').text());
    if (ed_pm == "-- Select --" && frm.select_pm_manually1.value == "")
    {
        counter = counter + 1;
        document.getElementById("ed_msgpasspm1").style.display = "";
        document.getElementById("ed_msgpasspm1").innerHTML = "PM field required";

    } else
    {
        document.getElementById("ed_msgpasspm1").innerHTML = "";
        document.getElementById("ed_msgpasspm1").style.display = 'none';
    }

    if (frm.select_pm_manually1.value != '') {
        ed_pm = frm.select_pm_manually1.value;
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

    m_data.append('tgrmid', $('input[name=tgmid1]').val());
    m_data.append('tgram_id', $('input[name=t_id1]').val());
    m_data.append('account_name', $('input[name=account_name1]').val());
    m_data.append('cid', $('input[name=cid_plp]').val());
    m_data.append('error_details_plp', $('input[name=error_details_plp]').val());
    m_data.append('received_date', DateTimeYearDBFormat($('input[name=received_date_plp]').val()));
    m_data.append('account_type_id', $('select[name=plp_account_type]').val());
    m_data.append('pm_id', ed_pm);
    m_data.append('billing_hour', $('input[name=billing_hour_plp]').val());
    m_data.append('comments', $('textarea[name=comments_plp]').val());
    m_data.append('user_id', myid);
    e.preventDefault();

    $.ajax({

        url: SITE_URL + 'user/Ctl_user/save_plp_details', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: m_data, // serialize form data 
        processData: false,
        contentType: false,
        beforeSend: function () {
            // alert('before send');
            $('.please_wait').show();
            $("#show_message_text").html('Please wait..');
        },
        success: function (data) {
            if (data == 1) {
                $("#show_message_text").html('<span style="color:green;">Details Successfully Submitted!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    httpPageGet(SITE_URL + 'Ctl_common/plp_list/');
                    //location.href = SITE_URL + 'Ctl_common/plp_list/';
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


function SaveRPMDetails(e)
{

    // alert("came");
    var gofocus;
    var foc;
    var counter = 0;
    var frm = document.rpm_form;
    var form = $('#rpm_form');
    var submit = $('#rpm_form');


    if ((frm.request_type.value == "" || frm.rpm_received_date.value == "" || frm.t_id3.value == "" || frm.account_name3.value == "" || frm.program_rpm.value == "" || frm.requester.value == "" || frm.queries.value == "" || frm.no_of_pages.value == "" || frm.billing_hour_rpm.value == "" || frm.rpm_date_delivered.value == "" || frm.url_rpm.value == "") || (frm.requtr_manually.value == "" && frm.requester.value == "0") || (frm.requtr_manually.value == "" && frm.requester.value == ""))
    {
        alert('please fill out all required fields');
        return false;
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
//        else if (frm.emp_hour.value > frm.billing_hour_rpm.value) {
//            alert('Additional development hour should not be greater than working hour');
//            return false;
//        }
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

    m_data.append('tgrmid', $('input[name=tgmid3]').val());
    m_data.append('tgram_id', $('input[name=t_id3]').val());
    m_data.append('account_name', $('input[name=account_name3]').val());
    m_data.append('cid', $('input[name=cid_rpm]').val());
    m_data.append('received_date', DateTimeYearDBFormat($('input[name=rpm_received_date]').val()));
    m_data.append('request_type_id', $('input[name=r_typ_id_rpm]').val());
    m_data.append('program_id', $('select[name=program_rpm]').val());
    if ($('select[name=requester]').val() != "" && $('select[name=requester]').val() != "0") {
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
    // m_data.append('due_date', DateTimeYearDBFormat($('input[name=rpm_due_date]').val()));
    m_data.append('no_of_pages', $('input[name=no_of_pages]').val());
    m_data.append('billing_hour', $('input[name=billing_hour_rpm]').val()); // Working hour
    m_data.append('qc_hour', $('input[name=qc_hour_rpm]').val());
    m_data.append('total_hour', $('input[name=total_hour_rpm]').val());
    m_data.append('actual_hour', $('input[name=actual_hour_rpm]').val());
    m_data.append('start_date', DateTimeYearDBFormat($('input[name=rpm_start_date]').val()));
    m_data.append('delivered_on', DateTimeYearDBFormat($('input[name=rpm_date_delivered]').val()));

    m_data.append('days', $('input[name=rpm_days]').val());
    m_data.append('late', $('input[name=rpm_late]').val());
    m_data.append('invoice_month', $('input[name=rpm_invoice_months]').val());
    m_data.append('inv_date', $('input[name=rpm_inv_date]').val());

    m_data.append('url_rpm', $('input[name=url_rpm]').val());
    m_data.append('comments', $('textarea[name=comments_rpm]').val());
    m_data.append('remark', $('textarea[name=remark]').val());

    if (checkedVals == 1) {
        m_data.append('helper_id', $('select[name=emp_id]').val());
        m_data.append('helper_hour', $('input[name=emp_hour]').val());
        m_data.append('user_hour', (($('input[name=billing_hour_rpm]').val()) - ($('input[name=emp_hour]').val())));
    } else {
        m_data.append('helper_id', '0');
        m_data.append('helper_hour', '0');
        m_data.append('user_hour', '0');
    }
    m_data.append('user_id', myid);
    e.preventDefault();

    $.ajax({
        url: SITE_URL + 'user/Ctl_user/save_rpm_details', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: m_data, // serialize form data 
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('.please_wait').show();
           $("#show_message_text").html('Please wait..');
        },
        success: function (data) {  
            if (data == 1) {
                $("#show_message_text").html('<span style="color:green;">Details Successfully Submitted!</span>');
                setTimeout(function () {
                    $('.please_wait').hide();
                    httpPageGet(SITE_URL + 'Ctl_common/rpm_list/');
                    //location.href = SITE_URL + 'Ctl_common/rpm_list/';
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

function GetStadardDateFormat(Indate) {
    Indate = Indate.split(' ');   // If time coming //
    Indate = Indate[0].split('/');  // Give ==> DD//MM//YY// 

    var statdard_date = Indate[1] + '/' + Indate[0] + '/' + Indate[2];
    return statdard_date;  // ==> MM/DD/YY//
}

function AddAccountFooterJs() {

    $(".date").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY HH:mm');
        date2 = date2.trim();
        var id = $(this).children("input").attr("id");
        FutureDateValidation(date2, id);
    });

    $('#myDatepicker').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
        maxDate: new Date()
    });

    $('#myDatepicker_standerd').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });

    $('#myDatepicker_re_assign').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });

    $("#myDatepicker_delivered").datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });

    $("#myDatepicker_delivered").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY HH:mm');
        date2 = date2.trim();
        GetDaysBetDates(date2);
    });

    $('#myDatepicker_plp').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
        maxDate: new Date()
    });

    $("#myDatepicker_rpm").datetimepicker({
        format: 'DD/MM/YYYY' 
    });

    $("#resolution_date").datetimepicker({
        format: 'DD/MM/YYYY',
        maxDate: new Date()
    });

    $("#resolution_date").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY');
        CheckDateValidationResolution(date2);
        if ($('input[name=rpm_date_delivered]').val() != "") {
            //  GetDaysBetDatesRPM($('input[name=rpm_date_delivered]').val()); // => validate_user.js
        }
    });

    $("#Datepicker_due_date").datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $("#rpm_start_datepicker").datetimepicker({
        format: 'DD/MM/YYYY' 
    });
    $("#rpm_start_datepicker").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY');
        CheckDateValidationStartDate(date2);
        GetDaysBetDatesRPM(date2, 'StartRPM');
    });

    $("#rpm_datepicker").datetimepicker({
        format: 'DD/MM/YYYY' 
    });
    $("#rpm_datepicker").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY');
        CheckDateValidationDelivered(date2);
        date2 = date2.trim();
        GetDaysBetDatesRPM(date2, 'Deliver'); // => validate_user.js
    });

    $("select[name^=job_type]").change(function () {
        if ($(this).val() != '') {
            var job_type = $(this).val();
            //alert(job_type);
            $('#show_form1').hide();
            $('#show_form2').hide();
            $('#show_form3').hide();
            $('#show_form' + job_type).show();
            AddTGramSearchCommon(job_type);

            if (job_type == 1) {
                $(".account_type_plp").html(LoadAccountTypePLP_db);
            }
            if (job_type == 2) {
                $(".account_type").html(LoadAccountType_db);
                $(".account_type_ed_plp").html(LoadAccountTypePLP_db);
            }
            if (job_type == 3) {
                LoadRequestTypeByJosn();
                LoadRequesterTypeByJosn();
                LoadProgramByJosn();
                LoadEmployeeByJosn();
            }

        }
    });
    $(".help_checkbox").click(function () {
        var checkedVals = $('.help_checkbox:checkbox:checked').map(function () {
            return this.value;
        }).get();
        if (checkedVals == 1) {
            $(".helper_div").show();
        } else {
            $(".helper_div").hide();
        }
    });
    //********** Delivery date Div Show Hide ***********//
    $(".form-control").click(function () {
        if ($('input[name=rpm_received_date]').val() != "" && $('select[name=request_type]').val() != "" && $('select[name=queries]').val() != "") {
            $('.active_dl').show();
            $('.Inactive_dl').hide();
        } else {
            $('.active_dl').hide();
            $('.Inactive_dl').show();
        }
    });
    //********** Delivery date before fileds fill alert ***********//
    $(".alert_dt_dl").click(function () {
        $('.please_wait').show();
        $("#show_message_text").html('Received Date, Request Type, Queries fields must be fill bofore');
        setTimeout(function () {
            $('.please_wait').hide();
        }, 3000);
    });

    $("#emp_hour").keyup(CheckTotalHour_rpm);
    $("#billing_hour").keyup(CheckTotalHour);
    $("#qc_hour").keyup(CheckTotalHour);
    $("#billing_hour_rpm").keyup(CheckTotalHour_rpm);
    $("#qc_hour_rpm").keyup(CheckTotalHour_rpm);


    $('#select-tgram-id').hierarchySelect({hierarchy: false, //width: 200  
    });

    $('#select-tgram-id1').hierarchySelect({hierarchy: false});
    $('#select-tgram-id2').hierarchySelect({hierarchy: false});
    $('#select-tgram-id3').hierarchySelect({hierarchy: false});
    $('#select-pm1').hierarchySelect({hierarchy: false});
    $('#select-pm2').hierarchySelect({hierarchy: false});

    $('.read_only').attr('readonly', 'true');
    $(".OnlyNum").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

}

function ViewEditRpmPlpJs() {
    
    $('#select-tgram-id').hierarchySelect({
        hierarchy: false,
        /* width: 223*/
    });

    $('#select-pm1').hierarchySelect({
        hierarchy: false,
    });
    
    $('#select-pm').hierarchySelect({
        hierarchy: false,
    });

    $('#myDatepicker_standerd').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });

    $('#myDatepicker_re_assign').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });

    $("#myDatepicker_re_assign").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY HH:mm');
        date2 = date2.trim();
        BeforeDateSelectValidation($('#received_date').val(), date2, 're_assign_date', 'Re-Assigned Date Should Be larger than Received Date');
        GetDaysBetDatesPLP_Re_Assign(date2);
    });

    $(".date").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY HH:mm');
        date2 = date2.trim();
        var id = $(this).children("input").attr("id");
        FutureDateValidation(date2, id);
    });

    $("#myDatepicker_delivered").datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });

    $("#myDatepicker_delivered").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY HH:mm');
        date2 = date2.trim();
        if ($('#re_assign_date').val() == "" || $('select[name=return_policy]').val() == "") {
            alert('Select Return and Re-Assigned Fileds Properly!');
            $('#delivered').val('');
        }

        BeforeDateSelectValidation($('#re_assign_date').val(), date2, 'delivered', 'Delivered On Date Should Be larger than Received Date or Re-Assigned Date');
        GetDaysBetDates(date2);
    });

    $('#plp_myDatepicker_re_assign').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });

    $('#plp_myDatepicker_delivered').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });

    $("#plp_myDatepicker_delivered").on("dp.change", function (e) {
        var date2 = e.date.format('DD/MM/YYYY HH:mm');
        date2 = date2.trim();
        GetDaysBetDatesEdPLP(date2);
    });
    /****** only rpm function start *****/
    if (window.location.href.indexOf("view_rpm") > -1) {

        $("#rpm_datepicker").datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $("#rpm_datepicker").on("dp.change", function (e) {
            var date2 = e.date.format('DD/MM/YYYY');
            date2 = date2.trim();
            CheckDateValidationDelivered(date2);
            GetDaysBetDatesRPM(date2, 'Deliver');// => validate_user.js
        });

        $('#myDatepicker_rpm').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $("#rpm_start_datepicker").datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $("#rpm_start_datepicker").on("dp.change", function (e) {
            var date2 = e.date.format('DD/MM/YYYY');
            CheckDateValidationStartDate(date2);
            GetDaysBetDatesRPM(date2, 'StartRPM');
        });

        $("#resolution_date").datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $("#resolution_date").on("dp.change", function (e) {
            var date2 = e.date.format('DD/MM/YYYY');
            CheckDateValidationResolution(date2);
            if ($('input[name=rpm_date_delivered]').val() != "") {
                //   GetDaysBetDatesRPM($('input[name=rpm_date_delivered]').val()); // => validate_user.js
            }
        });

        setTimeout(function () {
            $("div.put_employee select").val(helper_id);
            reqtyp = $('.rpm_request_type').val().split(':');
            $("#r_typ_id_rpm").val(reqtyp[0]);
            $("#r_typ_late_daye_rpm").val(reqtyp[1]);
        }, 1000);
    }
    /****** only rpm function end *****/

    $("#ed_no_of_errors").keyup(QCScore);
    $("#ed_no_of_edits").keyup(QCScore);
    $("#emp_hour").keyup(CheckTotalHour_rpm);
    $("#billing_hour").keyup(CheckTotalHour);
    $("#qc_hour").keyup(CheckTotalHour);
    $("#billing_hour_rpm").keyup(CheckTotalHour_rpm);
    $("#qc_hour_rpm").keyup(CheckTotalHour_rpm);
    $("#plp_billing_hour").keyup(GetTotalHourEdPlp);
    $("#plp_qc_hour").keyup(GetTotalHourEdPlp);
    $(".help_checkbox").click(function () {
        var checkedVals = $('.help_checkbox:checkbox:checked').map(function () {
            return this.value;
        }).get();
        if (checkedVals == 1) {
            $(".helper_div").show();
        } else {
            $(".helper_div").hide();
        }
    });

    $(".future_date").change(function () {
        alert("Handler for .change() called.");
    });
}


function CheckPLPExist(val) {
    if (val == 'Yes') {
        $(".ed_plp_yes").show();
    } else {
        $(".ed_plp_yes").hide();
    }
}

function FutureDateValidation(date2, id) {
    selected_date = Date.parse(GetStadardDateFormat(date2));
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    //  var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
    //  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var time = today.getHours() + ":" + today.getMinutes();
    var dateTime = date + ' ' + time;
    curent_datetime = Date.parse(GetStadardDateFormat(dateTime));

    if (curent_datetime < selected_date) {
        alert('Can Not Select Future Date Time!');
        $('#' + id).val('');
    }
}

/*** **************Excel Report employee start********* ***/

function PutEmployeeForReport() {
    $('#emp_report').show();
    $('#emp_report').html('');
    var option = '<option value="">-- Select Developer --</option>';
    var obj = JSON.parse(JSON.stringify(LoadEmployee_db));
    $.each(obj, function (i, item) {
        option += '<option value="' + item.id + '">' + item.fname + ' ' + item.lname + '</option>';
    });
    $('#emp_report').append(option);

}

function GetInDiViDeveloperReportRPM(id) {
    if (id) {
        location.href = SITE_URL + 'Ctl_reports/excel_indi_rpm_developer/' + id;
    }

}


function GetInDiViDeveloperReportEdit(id) {
    if (id) {
        location.href = SITE_URL + 'Ctl_reports/excel_indi_edit_developer/' + id;
    }

}

function GetInDiViDeveloperReportPlp(id) {
    if (id) {
        location.href = SITE_URL + 'Ctl_reports/excel_indi_plp_developer/' + id;
    }

}

function GetReportsBetweenDates(category) {

    if ($("#frm_date_report").val() == "" || $("#t_date_report").val() == "") {
        alert('Select Valid Dates');
        return false;
    }

    frm_date = Date.parse(GetStadardDateFormat($("#frm_date_report").val()));
    to_date = Date.parse(GetStadardDateFormat($("#t_date_report").val()));

    if (frm_date > to_date) {
        setTimeout(function () {
            $('#t_date_report').val('');
        }, 1000);
        alert('From Date Should Be Greater');
        return false;
    }

    $("#from_date_val").val(DateTimeYearDBFormat($("#frm_date_report").val()));
    $("#to_date_val").val(DateTimeYearDBFormat($("#t_date_report").val()));
    //return false;
    $('#Date_Bet_Report_frm').submit();

}

function DeleteRow(val) {
    var agree = confirm("Alert! are you sure to delete this?");
    if (!agree) {
        return false;
    }
    $.post(SITE_URL + 'admin/Ctl_admin/delete_standard/' + val);
    val = val.split(':');
    id = val[0];
    var table = $('#example').DataTable();
    table.row('#rowid' + id).remove().draw(false);
}

function QCScore() {
    var no_of_edits = $("#ed_no_of_edits").val();
    var no_of_errors = $("#ed_no_of_errors").val();
    //  var total = Math.round(100 - ((no_of_errors / no_of_edits) * 100)); //coming value in minus //
    var total = Math.round(((no_of_errors / no_of_edits) * 100) - 100);
    $("#ed_qc_score").val(total);
}

function HideRQDropdownTL() {
    $("#requester").hide();
    $("#re_req_Box").show();
    $("#requtr_manually").show();
    $("#requtr_manually").val('');
}
function PutRQDropdownTL() {
    $("#requester").show();
    $("#re_req_Box").hide();
    $("#requtr_manually").hide();
    $("#requtr_manually").val('');
} 