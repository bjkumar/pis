var guest_name;
$(document).ready(function () {
    GetChatById();
    //href = 'http://localhost/tepl/Ctl_common/timeline/10';
    timeline_url = document.URL;
    var chat_url_id = timeline_url.substr(timeline_url.lastIndexOf('/') + 1);
    GetUserInfoByIdForChat(chat_url_id);
});
 var myVar = setInterval(GetChatById, 1000);
function GetUserInfoByIdForChat(chat_url_id) {
    //alert(chat_url_id);
    var m_data = new FormData();
    m_data.append('id', chat_url_id);
    $.ajax({
        url: SITE_URL + 'Ctl_common/get_user_info_for_chat', type: 'POST', dataType: 'html', data: m_data, processData: false, contentType: false,
        beforeSend: function () { }, success: function (data) {
            var obj = JSON.parse(JSON.stringify(data));
            $.each(obj, function (i, item) {
                if(item.pro_image == ''){
                   recvr_img = '<img src="'+SITE_URL+'asset/images/profile_pic/user.png" style="width:33px;height:35px;">';
                }else{
                    recvr_img = '<img src="'+SITE_URL+'asset/images/profile_pic/'+item.pro_image+'" style="width:33px;height:35px;">';
                }
                
                  $("#recvr_image").html(recvr_img);
                  $("#recvr_name").html(item.fname);
                  $("#receiver_id").val(item.id);
                  guest_name = item.fname;
                  
            });
        }, dataType: "json"});
}

function SaveChatMessage(e)
{
    var counter = 0;
    var frm = document.chat_frm;
    var form = $('#chat_frm');

    if (frm.chat_message.value == "")
    {
        alert('Fields are required');
        return false;
    }

    if (counter > 0)
    {
        return false;
    }

    var m_data = new FormData();
    m_data.append('chat_message', $('textarea[name=chat_message]').val());
    m_data.append('receiver_id', $('input[name=receiver_id]').val());  
    m_data.append('sender_id', $('input[name=sender_id]').val());
    e.preventDefault();
    $.ajax({

        url: SITE_URL + 'Ctl_common/save_timeline', // form action url
        type: 'POST', // form submit method get/post
        dataType: 'html',
        data: m_data, // serialize form data 
        processData: false,
        contentType: false,
        beforeSend: function () {
            //alert('going');
        },

        success: function (data) {
            // alert(data);
            // submit.val('chat_frm'); // reset submit button text

            $(".emoji-wysiwyg-editor").html('');
        },

        error: function (e) {

            console.log(e)

        }

    });

}


function GetChatById()
{

    var receiver_id = $("#receiver_id").val();
    var sender_id = $("#sender_id").val();
    var last_id = $("#last_chat_row_id").val();
    // alert(receiver_id);
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
                 if(i == 'timeline'){
                  $.each(item, function(j, item1){
                     check_last_val = item1;
                     if(check_last_val !='0'){
                if (sender_id == item1.sender_id) {
                    chat_box += '<div class="row" id="chat_div' + item1.id + '"><div class="sms_right"><span class="badge bg-green" style="float: right;" id="add_total_no_birthday">me</span>' + item1.message + '&nbsp;&nbsp;</div></div>';
                    //chat_box += '<div class="row" id="chat_div'+item.id+'"><div class="sms_left"> <strong style="float: left;">Guest:&nbsp;&nbsp;&nbsp;&nbsp; </strong>'+item.message+'</div></div>';  
                } else {
                    chat_box += '<div class="row" id="chat_div' + item1.id + '"><div class="sms_left"> <strong style="float: left;">'+guest_name+':&nbsp; </strong>' + item1.message + '</div></div>';

                }

                last_id = item1.id;
            }
                });
                if(check_last_val !='0') {
           // $("#add_chat_details").html(chat_box);
            $( "#add_chat_details" ).append(chat_box);
            //$("#online_status").val(online_status);
            $("#last_chat_row_id").val(last_id);
            $(".chat_box_div").animate({scrollTop: $("#chat_div" + last_id).offset().top}, 1000);
        }
                }
                
                 var status_val = '0';
                 var last_seen;
                 
                 if(i == 'online_status'){
                  $.each(item, function(j, item2){
                     status_val = item2.active;
                     last_seen = item2.last_seen;
                      
                }); 
                if(status_val =='1') {  //alert(status_val);
                $("#online_status").html('Online <span class="online_green">&nbsp;&nbsp;</span>'); 
                $("#last_seen_time").html('');
        }else{
            $("#last_seen_time").html('Last Seen Time: '+last_seen);
            $("#online_status").html('Offline <span class="online_yellow">&nbsp;&nbsp;</span>');  
        }
                } 
            });  }, dataType: "json"

    });

}