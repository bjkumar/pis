var xmlHttp, GetTGramList_db, LoadPM_db, LoadEmployee_db, LoadAccountType_db, LoadAccountTypePLP_db, LoadRequestType_db, LoadRequester_db, LoadProgram_db;
$(document).ready(function () {
    LoadEmployee();
    LoadAccountType();
    LoadAccountTypePLP();
    LoadRequestType();
    LoadRequester();
    GetTGramList();
    LoadPM();
    LoadProgram();

    $("#emp_hour").keyup(CheckTotalHour_rpm);
    $("#billing_hour").keyup(CheckTotalHour);
    $("#qc_hour").keyup(CheckTotalHour);
    $("#billing_hour_rpm").keyup(CheckTotalHour_rpm);
    $("#qc_hour_rpm").keyup(CheckTotalHour_rpm);

});
function LoadEmployee() {
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/get_employee',
        type: 'GET',
        dataType: 'json',
    }).done(function (html) {
        LoadEmployee_db = html;
        //$(".put_employee").html(html);
    });
}

function LoadEmployeeByJosn() {
    $('#emp_id').html('');
    var option = '<option value="">-- Select --</option>';
    var obj = JSON.parse(JSON.stringify(LoadEmployee_db));
    $.each(obj, function (i, item) {
        option += '<option value="' + item.id + '">' + item.fname + ' ' + item.lname + '</option>';
    });
    $('#emp_id').append(option);
}

function CheckTotalHour_rpm() {
    total_hour = +$("#billing_hour_rpm").val() + +$("#qc_hour_rpm").val() + +$("#emp_hour").val();
    $("#total_hour_rpm").val(total_hour);
    $("#actual_hour_rpm").val(total_hour);
}

function CheckTotalHour() {
    var billing_hour = $("#billing_hour").val();
    var qc_hour = $("#qc_hour").val();
    var total_hour = '';
    total_hour = +billing_hour + +qc_hour;
    $("#total_hour").val(total_hour);
    $("#actual_hour").val(total_hour)
}

function GetTotalHourEdPlp() {
    var billing_hour = $("#plp_billing_hour").val();
    var qc_hour = $("#plp_qc_hour").val();
    var total_hour = '';
    total_hour = +billing_hour + +qc_hour;
    $("#plp_total_hour").val(total_hour);
    $("#plp_actual_hour").val(total_hour)
}




function LoadAccountType() {
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/get_account_type',
        type: 'GET'
    }).done(function (html) {
        LoadAccountType_db = html;
        //$(".account_type").html(html);
    });
}

function LoadAccountTypePLP() {
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/get_account_type_plp',
        type: 'GET'
    }).done(function (html) {
        LoadAccountTypePLP_db = html;
        // $(".account_type_plp").html(html);
    });
}

function LoadRequestType() {
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/get_request_type',
        type: 'GET',
        dataType: 'json',
    }).done(function (html) {
        LoadRequestType_db = html;
    });
}

function LoadRequestTypeByJosn() {
    $('#request_type').html('');
    var option = '<option value="">-- Select --</option>';
    var obj = JSON.parse(JSON.stringify(LoadRequestType_db));
    $.each(obj, function (i, item) {
        val = item.id + ':' + item.late_days;
        option += '<option value="' + val + '">' + item.request_type + '</option>';
    });
    $('#request_type').append(option);
}

function LoadRequester() {
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/get_requester',
        type: 'GET',
        dataType: 'json',
    }).done(function (html) {
        LoadRequester_db = html;
    });
}

function LoadRequesterTypeByJosn() {
    $('#requester').html('');
    var option = '<option value="">-- Select --</option>';
    option += '<option value="0" style="color: #0c0cc8;">Enter Manually</option>';
    var obj = JSON.parse(JSON.stringify(LoadRequester_db));
    $.each(obj, function (i, item) {
        option += '<option value="' + item.requester + '">' + item.requester + '</option>';
    });
    $('#requester').append(option);
}

function LoadProgram() {
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/get_program_rpm',
        type: 'GET',
        dataType: 'json',
    }).done(function (html) {
        LoadProgram_db = html;
    });
}

function LoadProgramByJosn() {
    $('#program_rpm').html('');
    var option = '<option value="">-- Select --</option>';
    var obj = JSON.parse(JSON.stringify(LoadProgram_db));
    $.each(obj, function (i, item) {
        option += '<option value="' + item.id + '">' + item.program_rpm + '</option>';
    });
    $('#program_rpm').append(option);
}

function LoadPM() {
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/get_pm_list', type: 'GET', dataType: 'json',
        success: function (data) {
            LoadPM_db = data;
        }
    });
}

function PutPMManully(num) {
    $("#select-pm" + num).hide();
    $("#select_pm_manually" + num).show();
    $("#re_Pm_Box" + num).show();
    $("#ed_msgpasspm2" + num).hide();
    $("#select_pm_manually" + num).val('');
}

function PutPMDropdown(num) {
    $("#select-pm" + num).show();
    $("#select_pm_manually" + num).hide();
    $("#re_Pm_Box" + num).hide();
    $("#select_pm_manually" + num).val('');
}

function GetPMIdInTextBox(id) {
    $("#ed_pmid").val(id);
}

function GetTGramList() {
    $.ajax({
        url: SITE_URL + 'user/Ctl_user/get_tgram_id', type: 'GET', dataType: 'json',
        success: function (data) {
            GetTGramList_db = data;

            /*  var obj = JSON.parse(JSON.stringify(data));
             $.each(obj, function (i, item) {
             var st_tgram = item.tgram + ':' + item.account_name + ':' + item.id;
             var st_tgram_show = item.tgram + '  ' + item.account_name;
             st_tgram = "'" + st_tgram + "'";
             $('#add_tgram li:first').after('<li><a href="#" onclick="GetAccountName(' + st_tgram + ');">' + st_tgram_show + '</a></li>');
             }); */
        }


    });
}

function GetAccountName(st_tgram, num) {

    var tgram = st_tgram.split(':');
    var tgram_id = tgram[0];
    var account_name = tgram[1];
    $("#t_id" + num).val(tgram_id);
    $("#account_name" + num).val(account_name);
    $("#tgmid" + num).val(tgram[2]);
    //alert(account_name);
}

function CheckNARevision(r_val) {
    if (r_val == 'No') {
        var received_date = $("#received_date").val();
        $("#re_assign_date").val(received_date);
    } else {
        $("#re_assign_date").val('');
    }
}

function CheckPlpNARevision(r_val) {
    if (r_val == 'No') {
        var received_date = $("#received_date").val();
        $("#plp_re_assign_date").val(received_date);
    } else {
        $("#plp_re_assign_date").val('');
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
            // return false;

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

function GetDaysBetDates(date2) {

    var date1 = $("#received_date").val();
    var HhMmSs = ConvertHoursMinuteSeconds(date2, date1);
    $("#ed_min_seconds").val(HhMmSs);
    var HourTime = GetHourFromDateTime(date1, date2);
    HourTime = HourTime.toFixed(1);
    $("#ed_hours").val(HourTime);

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
    $("#ed_invoice_months").val(Get_Month_Year(date2));
    $("#ed_inv_date").val(Get_Date_Month_Year(date2));



    date1_unixtime = parseInt(date1.getTime() / 1000);
    date2_unixtime = parseInt(date2.getTime() / 1000);
    var timeDifference = date2_unixtime - date1_unixtime;
    var timeDifferenceInHours = timeDifference / 60 / 60;
    var timeDifferenceInDays = timeDifferenceInHours / 24;
    // $("#ed_days").val(timeDifferenceInDays);

    // check leave from database through ajax//
    Check_Leave_Days(make_date1, make_date2, timeDifferenceInDays, HourTime);
    // alert(make_date1); return false;
}

function Check_Leave_Days(startdate, end_date, cal_days, HourTime)
{
    var m_data = new FormData();
    m_data.append('startdate', startdate);
    m_data.append('end_date', end_date);
    $.ajax({url: SITE_URL + 'user/Ctl_user/get_leave_days', type: 'POST', dataType: 'html',
        data: m_data, processData: false, contentType: false,
        beforeSend: function () { },
        success: function (data) { //alert(data);
            if (data != 0) {
                var timeDifferenceInDays = cal_days - data;
                $("#ed_days").val(timeDifferenceInDays);
                HourTime = HourTime - (24 * data);
                HourTime = HourTime.toFixed(1);
                $("#ed_ac_late_hour").val(HourTime);
            } else {
                $("#ed_days").val(cal_days);
                $("#ed_ac_late_hour").val(HourTime);
            }

            if (HourTime > 48) {
                $("#ed_late").val('Late');
            } else {
                $("#ed_late").val('SLA');
            }



        }, });
}

function Get_Month_Year(full_date) {
    var months = ['Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'];
    var year = full_date.getFullYear();
    var month = months[full_date.getMonth()];
    var myddd = month + "-" + year;
    var year_last2_words = myddd.slice(-2);
    var month_year = month + "-" + year_last2_words;
    return month_year;
}

function Get_Date_Month_Year(full_date) {
    var months = ['Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'];
    var dd = full_date.getDate();
    var year = full_date.getFullYear();
    var month = months[full_date.getMonth()];
    var myddd = month + "-" + year;
    var year_last2_words = myddd.slice(-2);
    var month_year = month + "-" + year_last2_words;
    var date_month_year = dd + "-" + month + "-" + year_last2_words;
    return date_month_year;
}

function GetHourFromDateTime(beforetime, aftertime) {
    // var beforetime = "22/09/2013 15:00";
    // var aftertime = "22/09/2013 15:30";
    beforetime = ChangeDateTimeYearFormat(beforetime);
    aftertime = ChangeDateTimeYearFormat(aftertime);
    //var diff = new Date("Aug 08 2012 9:20") - new Date("Aug 08 2012 8:30");
    //  var  diff = diff/(60*60*1000);

    fromDate = parseInt(new Date(beforetime).getTime() / 1000);
    toDate = parseInt(new Date(aftertime).getTime() / 1000);
    var timeDiff = (toDate - fromDate) / 3600;
    return timeDiff;
    //  var diff = (new Date("1970-1-1 11:40") - new Date("1970-1-1 10:30")) / 1000 / 60 / 60;
    //    alert(timeDiff);
}

function ConvertHoursMinuteSeconds(beforetime, aftertime) {
    // var beforetime = "04/14/2013 15:00";
    //  var aftertime = "13/04/2018 16:17";
    beforetime = ChangeDateTimeYearFormat(beforetime);
    aftertime = ChangeDateTimeYearFormat(aftertime);
    var t1 = new Date(beforetime);
    //alert(beforetime); 
    //alert(t1);
    var t2 = new Date(aftertime);
    // alert(aftertime); 
    // alert(t2);
    // return false;
    //  var t1 = beforetime;
    // var t2 = aftertime;

    var dif = t1.getTime() - t2.getTime();

    var Seconds_from_T1_to_T2 = dif / 1000;
    var Seconds_Between_Dates = Math.abs(Seconds_from_T1_to_T2);
//alert(Seconds_Between_Dates);

    var dscsdcds = Seconds_Between_Dates;
    var sec_num = parseInt(dscsdcds, 10); // don't forget the second param
    var hours = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
    }
    var kjfe = hours + ':' + minutes + ':' + seconds;
    return kjfe;
    // alert(kjfe);
}

function ChangeDateTimeYearFormat(date_time) {

    //var date_time = "14/04/2013 15:00";
    date_time = date_time.split(' ');
    var date = date_time[0];
    var time = date_time[1];

    date1 = date.split('/');

    //alert(date); alert(time);
    var make_date1 = date1[1] + '/' + date1[0] + '/' + date1[2] + ' ' + time;
    return make_date1;
    //alert(make_date1);
}

function CheckDateValidationResolution(resolution_date) {
    rpm_received_date = Date.parse(GetStadardDateFormat($('input[name=rpm_received_date]').val()));
    rpm_date_delivered = Date.parse(GetStadardDateFormat($('input[name=rpm_date_delivered]').val()));

    resolution_date = Date.parse(GetStadardDateFormat(resolution_date));
    if (rpm_received_date > resolution_date) {
        setTimeout(function () {
            $('#rpm_resolution_date').val('');
        }, 1000);
        alert('Resolution date should not be smaller than received date! Select Again Resolution Date');
        // $('#rpm_received_date').val('');
    }


    if (rpm_date_delivered < resolution_date) {
        setTimeout(function () {
            $('#rpm_resolution_date').val('');
        }, 1000);
        alert('Delivered date should not be smaller than Resolution date ! Select Valid Resolution Date');
        // $('#rpm_received_date').val('');
    }
}

function CheckDateValidationDelivered(delivered_date) {
    rpm_received_date = Date.parse(GetStadardDateFormat($('input[name=rpm_received_date]').val()));
    rpm_start_date = Date.parse(GetStadardDateFormat($('input[name=rpm_start_date]').val()));
    delivered_date = Date.parse(GetStadardDateFormat(delivered_date));

    if (delivered_date < rpm_start_date) {
        setTimeout(function () {
            $('#rpm_date_delivered').val('');
        }, 1000);
        alert('Delivered date should not be smaller than Start date! Select Again Delivered Date');
        // $('#rpm_resolution_date').val('');
    }


    if (rpm_received_date > delivered_date) {
        setTimeout(function () {
            $('#rpm_date_delivered').val('');
        }, 1000);
        alert('Delivered date should not be smaller than Received date! ! Select Again Delivered Date');
        // $('#rpm_received_date').val('');
    }
}

function CheckDateValidationStartDate(start_date) {
    start_date = Date.parse(GetStadardDateFormat(start_date));
    rpm_received_date = Date.parse(GetStadardDateFormat($('input[name=rpm_received_date]').val()));

    if ($('input[name=rpm_date_delivered]').val() != "") {
        delivered_date = Date.parse(GetStadardDateFormat($('input[name=rpm_date_delivered]').val()));
        if (delivered_date < start_date) {
            setTimeout(function () {
                $('#rpm_start_date').val('');
            }, 1000);
            alert('Start date should not be greater than Delivered date! Select Again Start Date');
            // $('#rpm_resolution_date').val('');
        }
    }

    if (rpm_received_date > start_date) {
        setTimeout(function () {
            $('#rpm_start_date').val('');
        }, 1000);
        alert('Start date should not be smaller than Received date! ! Select Again Start Date');
        // $('#rpm_received_date').val('');
    }
}

function GetDaysBetDatesEdPLP(date2) {
    var date1 = $("#received_date").val();
    if ($('select[name=plp_return_policy]').val() == 'Yes') {
        var date1 = $("#plp_re_assign_date").val();
        if (date1 == "") {
            alert('Select Re-Assigned Date!');
            return false;
        }
    }
    var myreturn = GetDaysBetDates_EdPLP(date2, date1);
   // alert(myreturn);

}

function GetDaysBetDates_EdPLP(date2, date1) {
    // var ActualLateHour = GetActualHourForLate(date1, date2); 
    // $("#ed_ac_late_hour").val(ActualLateHour);
    var HhMmSs = ConvertHoursMinuteSeconds(date2, date1);
    $("#plp_ed_min_seconds").val(HhMmSs);

    var HourTime = GetHourFromDateTime(date1, date2);
    HourTime = HourTime.toFixed(1);
    $("#plp_ed_hours").val(HourTime);
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
    $("#plp_ed_invoice_months").val(Get_Month_Year(date2));
    $("#plp_ed_inv_date").val(Get_Date_Month_Year(date2));



    date1_unixtime = parseInt(date1.getTime() / 1000);
    date2_unixtime = parseInt(date2.getTime() / 1000);
    var timeDifference = date2_unixtime - date1_unixtime;
    var timeDifferenceInHours = timeDifference / 60 / 60;
    var timeDifferenceInDays = timeDifferenceInHours / 24;
    timeDifferenceInDays = timeDifferenceInDays + 1;
    $("#plp_ed_days").val(timeDifferenceInDays);

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
                $("#plp_ed_days").val(timeDifferenceInDays);
                var HourTime = GetHHMMFromSubstractDays(parseFloat(data), HourTime);
                $("#plp_ed_hours").val(HourTime);
                var HhMmSs = GetHHMMSSFromSubstractDays(data, HhMmSs);
                $("#plp_ed_min_seconds").val(HhMmSs);


            } else {
                $("#plp_ed_days").val(timeDifferenceInDays);
                $("#plp_ed_min_seconds").val(HhMmSs);
                $("#plp_ed_hours").val(HourTime);

            }

            if (timeDifferenceInDays > 7) {
                Late_Val = 'Late';
                $("#plp_ed_late").val('Late');
            } else {
                Late_Val = 'SLA';
                $("#plp_ed_late").val('SLA');
            }



        }, });

   // allval = timeDifferenceInDays + ',' + Get_Month_Year(date2) + ',' + Get_Date_Month_Year(date2) + ',' + HourTime+ ',' + HhMmSs + ','+Late_Val;
         //   return 2;
}

function GetHHMMSSFromSubstractDays(days, HhMmSs) {
    hourbydays = days * 24;
    HhMmSs = HhMmSs.split(':');
    hour = HhMmSs[0] - hourbydays;
    HhMmSs = hour + ':' + HhMmSs[1] + ':' + HhMmSs[2];
    return HhMmSs;
}

function GetHHMMFromSubstractDays(days, HhMm) {
    hourbydays = days * 24;
    HhMm = HhMm.split('.');
    hour = HhMm[0] - hourbydays;
    HhMm = hour + '.' + HhMm[1];
    return HhMm;
}
