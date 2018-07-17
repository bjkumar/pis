var guest_name, guest_id, msg_page_title;
page_title_position = 0;
$(document).ready(function () {
     
    if (window.location.href.indexOf("Ctl_group_chat") > -1) {
        timeline_url = document.URL;
        var chat_url_id = timeline_url.substr(timeline_url.lastIndexOf('/') + 1);
        GetUserInfoByIdForChat(chat_url_id);
        $.post(SITE_URL + "Ctl_common/send_read_chat", {sender_id: chat_url_id});
    }
   
    /***********  send read tag 1 ************************/
    
    /***********  send read tag 1 End************************/
    $('.rmv_red_cnt_ind').click(function () {
        //$('#add_count_chat_noti').html('0');
        //$("#add_count_chat_noti").removeClass("badge bg-red").addClass("badge bg-green");
        msg_page_title = '';
        page_title_position = '';
        scrolltitle();
        $(document).attr("title", "TPIS PORTAL");
        document.title = 'TPIS PORTAL';
    });

});




//************** Pusher code start **********************//
$(document).ready(function () {
 
    //**** For Personal one to one Chat ***//
   // Pusher.logToConsole = true;
    var pusher = new Pusher('127a9e8e9fb64bacfebc', { 
        cluster: 'ap2',
        encrypted: true
    });
    var mychanel = pusher.subscribe('MyChannel' + myid);
    mychanel.bind('event-request', function (data) { //alert(data);
       // console.log(data.chat_message);
        if (data.chat_message != "") {

            /*-- chat message box and header notification -- */
            if ($(".chat_box_div").length > 0) {
                $("#add_chat_details").append('<div class="row" id="chat_div"><div class="sms_left"> <strong style="float: left;">' + data.sender_name + ':&nbsp; </strong>' + data.chat_message + '<span class="tm_hstry">' + data.send_time + '</span></div></div>');
                $(".chat_box_div").scrollTop($(".chat_box_div")[0].scrollHeight);
            } else {
                user_churl = "'"+SITE_URL + 'Ctl_group_chat/index/' + data.sender_id+"'";
               // $("#Put_Chat_Noti_Header").append('<li><a href="' + SITE_URL + 'Ctl_group_chat/index/' + data.sender_id + '" class="upper_chat_box"><div><span class="image"><img src="' + SITE_URL + 'asset/images/profile_pic/' + data.sender_img + '" style="width: 31px;height: 31px;"></span></div> <div> <span><strong>' + data.sender_name + ': </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data.send_time.slice(11, 22) + '<br><span class="message">' + data.chat_message.slice(0, 24) + '...</span></span></div></a></li>');
               $("#Put_Chat_Noti_Header").append('<li><a  onclick="httpPageGet('+user_churl+')" class="upper_chat_box"><div><span class="image"><img src="' + SITE_URL + 'asset/images/profile_pic/' + data.sender_img + '" style="width: 31px;height: 31px;"></span></div> <div> <span><strong>' + data.sender_name + ': </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data.send_time.slice(11, 22) + '<br><span class="message">' + data.chat_message.slice(0, 24) + '...</span></span></div></a></li>');
                var chat_count = $(".upper_chat_box").length;
                $('#add_count_chat_noti').html(chat_count);
                $("#add_count_chat_noti").removeClass("badge bg-green").addClass("badge bg-red");
                msg_page_title = '(' + chat_count + ') ' + data.sender_name + ' Message You: ' + data.chat_message + '...';
                scrolltitle();
                //$('#add_count_chat_noti').html('0');
                //  $("#add_count_chat_noti").removeClass("badge bg-red").addClass("badge bg-green");
            }
            /*-- chat message box and header notification end -- */

        }
    });

    //**** For Personal one to one chat End ***//







    // Online presence start//

    var pusher = new Pusher('127a9e8e9fb64bacfebc', {
        authEndpoint: SITE_URL + 'Ctl_group_chat/Auth_End_Point',
        cluster: 'ap2',
        encrypted: true,
        auth: {
            headers: {
                'X-CSRF-Token': "SOME_CSRF_TOKEN"
            }
        }
    });
    var presence = pusher.subscribe('presence-online');
    presence.bind('pusher:subscription_succeeded', function (members) {
        members.each(addUser);

    });

    presence.bind('pusher:member_added', addUser);
    presence.bind('pusher:member_removed', removeUser);

    function addUser(member) {
        usr_name = member.info.user_name;
        usr_id = member.info.id;
        usr_image = member.info.pro_image;
        if (myid != usr_id) {
            user_churl = "'"+SITE_URL + 'Ctl_group_chat/index/' + usr_id+"'";
            $(".add-chat-list-user").append('<a class="pr_cht" id="remv_indicate' + usr_id + '"  onclick="httpPageGet('+user_churl+');"><div class="chat-box-row"><span class="recvr_img_chat"><img src="' + SITE_URL + 'asset/images/profile_pic/' + usr_image + '" style="width:33px;height:35px;"></span><div>' + usr_name + '<span class="online_green">&nbsp;&nbsp;</span></div></div></a>');
        }
    }

    function removeUser(member) {
        usr_id = member.info.id;
        $("#remv_indicate" + usr_id).remove();
    }

    // Online presence end //  

});




function Send_Message() {  
    // set date time //
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var Time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

    // set date time end//
    if ($('textarea[name=chat_message]').val() == "")
    {
        alert('Fields are required');
        return false;
    }
    $("#add_chat_details").append('<div class="row" id="chat_div"><div class="sms_right"><span class="badge bg-green" style="float: right;" id="add_total_no_birthday">me</span>' + $('textarea[name=chat_message]').val() + '&nbsp;&nbsp;<span class="tm_hstryRyt">' + Time + '</span></div></div>');
    $(".chat_box_div").scrollTop($(".chat_box_div")[0].scrollHeight);
     $(".emoji-wysiwyg-editor").html('');
    var m_data = new FormData();
    m_data.append('chat_message', $('textarea[name=chat_message]').val());
    m_data.append('sender_id', $('input[name=sender_id]').val());
    m_data.append('receiver_id', $('input[name=receiver_id]').val());
    m_data.append('guest_name', guest_name);
    m_data.append('sender_name', $('input[name=sender_name]').val());
    m_data.append('sender_img', $('input[name=sender_img]').val());
    /* if user active set read 1 & check by id */
    recvr_id = $('input[name=receiver_id]').val();
    var is_usr_active = document.getElementById("remv_indicate" + recvr_id);
    if (is_usr_active == null) {
        m_data.append('read_chat', '0');
    } else {
        m_data.append('read_chat', '1');
    }

    $.ajax({

        url: SITE_URL + 'Ctl_group_chat/Send_Message',
        type: 'POST',
        dataType: 'html',
        data: m_data,
        processData: false,
        contentType: false,
        beforeSend: function () {
            // alert('no');
        },
        success: function (data) { // alert(data);
            $(".emoji-wysiwyg-editor").html('');
        }
    });

}

//************** Pusher code end **********************//






//*********** Chat code copied from old file *********************//


//var myVar = setInterval(GetChatById, 1000);
function GetUserInfoByIdForChat(chat_url_id) {
     var m_data = new FormData();
    m_data.append('id', chat_url_id);
    $.ajax({
        url: SITE_URL + 'Ctl_group_chat/get_user_info_for_chat', type: 'POST', dataType: 'html', data: m_data, processData: false, contentType: false,
        beforeSend: function () { }, success: function (data) {
            var obj = JSON.parse(JSON.stringify(data));
            $.each(obj, function (i, item) {
                if (item.pro_image == '') {
                    recvr_img = '<img src="' + SITE_URL + 'asset/images/profile_pic/user.png" style="width:33px;height:35px;">';
                } else {
                    recvr_img = '<img src="' + SITE_URL + 'asset/images/profile_pic/' + item.pro_image + '" style="width:33px;height:35px;">';
                }

                $("#recvr_image").html(recvr_img);
                $("#recvr_name").html(item.fname);
                $("#receiver_id").val(item.id);
                guest_name = item.fname;
                guest_id = item.id;

            });
            GetChatById(chat_url_id);
        }, dataType: "json"});
}



function GetChatById(receiver_id)
{

    var receiver_id = receiver_id;//$("#receiver_id").val();
    var sender_id = $("#sender_id").val();
    var last_id = $("#last_chat_row_id").val();
    var m_data = new FormData();
    m_data.append('receiver_id', receiver_id);
    m_data.append('last_id', last_id);

    $.ajax({

        url: SITE_URL + 'Ctl_common/get_timeline', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: m_data, // serialize form data 
        processData: false,
        contentType: false,
        beforeSend: function () {
            //alert('going');
        },

        success: function (data) {
            //alert(data); //return false;

            var obj = JSON.parse(JSON.stringify(data));
            $.each(obj, function (i, item) {  //alert(item);
                var last_id;
                var chat_box = '';
                var check_last_val;
                if (i == 'timeline') {
                    $.each(item, function (j, item1) {
                        check_last_val = item1;
                        if (check_last_val != '0') {
                            if (sender_id == item1.sender_id) {
                                chat_box += '<div class="row" id="chat_div' + item1.id + '"><div class="sms_right"><span class="badge bg-green" style="float: right;" id="add_total_no_birthday">me</span>' + item1.message + '&nbsp;&nbsp;<span class="tm_hstryRyt">' + item1.send_time + '</span></div></div>';
                                //chat_box += '<div class="row" id="chat_div'+item.id+'"><div class="sms_left"> <strong style="float: left;">Guest:&nbsp;&nbsp;&nbsp;&nbsp; </strong>'+item.message+'</div></div>';  
                            } else {
                                chat_box += '<div class="row" id="chat_div' + item1.id + '"><div class="sms_left"> <strong style="float: left;">' + guest_name + ':&nbsp; </strong>' + item1.message + '<span class="tm_hstry">' + item1.send_time + '</span></div></div>';

                            }

                            last_id = item1.id;
                        }
                    });


                    if (check_last_val != '0') {
                        $("#add_chat_details").append(chat_box);
                        //$("#online_status").val(online_status);
                        $("#last_chat_row_id").val(last_id);
                        //  $(".chat_box_div").animate({scrollTop: $("#chat_div" + last_id).offset().top}, 1000);
                    }
                    $(".chat_box_div").scrollTop($(".chat_box_div")[0].scrollHeight);
                }

                var status_val = '0';
                var last_seen;

                if (i == 'online_status') {
                    $.each(item, function (j, item2) {
                        status_val = item2.active;
                        last_seen = item2.last_seen;

                    });
                    if (status_val == '1') {  //alert(status_val);
                        $("#online_status").html('Online <span class="online_green">&nbsp;&nbsp;</span>');
                        $("#last_seen_time").html('');
                    } else {
                        $("#last_seen_time").html('Last Seen Time: ' + last_seen);
                        $("#online_status").html('Offline <span class="online_yellow">&nbsp;&nbsp;</span>');
                    }
                }
            });
        }, dataType: "json"

    });

}

function scrolltitle() {
    document.title = msg_page_title.substring(page_title_position, msg_page_title.length) + msg_page_title.substring(0, page_title_position);
    page_title_position++;
    if (page_title_position > msg_page_title.length)
        page_title_position = 0
    window.setTimeout("scrolltitle()", 170);
}