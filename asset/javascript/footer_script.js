$(document).ready(function () {

    

    /***********  Get Unread message ************************/
    $.ajax({
        url: SITE_URL + 'Ctl_common/get_unread_message', type: 'GET', dataType: 'json',
        success: function (data1) {
            var obj = JSON.parse(JSON.stringify(data1));
            $.each(obj, function (i, data) {
                $("#Put_Chat_Noti_Header").append('<li><a href="' + SITE_URL + 'Ctl_group_chat/index/' + data.sender_id + '" class="upper_chat_box"><div><span class="image"><img src="' + SITE_URL + 'asset/images/profile_pic/' + data.sender_img + '" style="width: 31px;height: 31px;"></span></div> <div> <span><strong>' + data.sender_name + ': </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data.send_time.slice(11, 22) + '<br><span class="message">' + data.chat_message.slice(0, 24) + '...</span></span></div></a></li>');
            });

            var chat_count = $(".upper_chat_box").length;
            $('#add_count_chat_noti').html(chat_count);
            if (chat_count > 0) {
                $("#add_count_chat_noti").removeClass("badge bg-green").addClass("badge bg-red");
            }
        }
    });
    /***********  Get Unread message End************************/
    
    
    /***********  send read tag 1 ************************/
//    if (window.location.href.indexOf("Ctl_group_chat") > -1) {
//        chat_url_for_id = document.URL; alert('Hello');
//        var url_user_id = chat_url_for_id.substr(chat_url_for_id.lastIndexOf('/') + 1);
//       $.post(SITE_URL + "Ctl_common/send_read_chat", {sender_id: url_user_id});
//     }
    /***********  send read tag 1 End************************/

});

function httpGet(theUrl)
{
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
           $("#put_clicked_page_content").html(xmlhttp.responseText);  
        }
    }
    xmlhttp.open("GET", theUrl, false );
    xmlhttp.send();    
}