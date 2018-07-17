<!--header start-->
<?php include 'header.php'; ?>
<script src="<?php echo SITE_URL; ?>asset/javascript/chat.js"></script>
<style>

    .sms_right {
        float: right;
        background: #f3fcf8;
        max-width: 80%;
        border-radius: 5px;
        padding: 2px 10px;
        margin: 5px;
    }
    .sms_left {
        float: left;
        background: #f8f8f8;
        max-width: 80%;
        border-radius: 5px;
        padding: 2px 10px;
        margin: 5px;
    }
    .badge {
        padding: 1px 1px 2px 2px;}
    .row.chat_box_div {
        height: 100%;
        max-height: 570px;
        min-height: 200px;
        max-width: 715px;
        /* overflow-y: auto; */
        overflow-y: scroll; 
        border: 1px solid #e4e4e4; 
    } 
    
    .x_title span {
   color: #076905;
}
.recvr_img_chat{
    width:33px;
    height:35px;
    border-radius: 20px;
    border: 1px solid rgba(52,73,94,.44);
   /*padding: 6px 0px 8px 1px;*/
    background: #c3c3c3;
    display: inline-block;
    overflow: hidden;
    box-sizing:border-box;
    vertical-align: middle;
}
.recvr_img_chat > img{
    display: block;
    max-width:100%;
}
.x_title {
    padding: 1px 5px 11px;
}
.emoji-wysiwyg-editor{
       background: #9e9e9e12; 
}
.btn-primary {
    color: #3a3535;
    background-color: #d2d3d4;
    border-color: #c5c5c5;
    width: 715px;
}
.online_green {
    color: #f0f8ff00;
background: green;
padding: 1px;
border-radius: 17px;
padding-left: 3px;
padding-right: 8px;
}
.online_yellow {
    color: #f0f8ff00;
background: #d6e30a;
padding: 1px;
border-radius: 17px;
padding-left: 3px;
padding-right: 8px;
}
#online_status{
    margin-left: 12%;
}
#last_seen_time {
 margin-left: 10%;   
 width: 241px;
} 
</style>
<!-- Begin emoji-picker Stylesheets --> 
<link href="<?php echo SITE_URL; ?>asset/emoji/css/emoji.css" rel="stylesheet">
<!-- End emoji-picker Stylesheets -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <!-- EDIT Form -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <!--<h2>Chat : </h2>--> 
                        <span class="recvr_img_chat" id="recvr_image"></span>&nbsp;&nbsp;
                         <span class="z1c1kl" id="recvr_name"></span> 
                         <span class="z1c1kl" id="last_seen_time" ></span> 
                          <span class="z1c1kl" id="online_status"></span> 
                        <div class="clearfix"></div>
                    </div>

                    <!-- chat box  start -->
                    <div class="x_content" style="margin-left: 10px;padding: 0px 5px 0px;">
                        <div class="row chat_box_div"> 
                            <div class="col-md-12 col-sm-12 col-xs-12" id="add_chat_details">
                                <!--                                <div class="row"> 
                                                                    <div class="sms_left">
                                                                        <strong style="float: left;">Guest:&nbsp;&nbsp;&nbsp;&nbsp; </strong> Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1
                                                                        Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1
                                                                    </div>
                                                                </div>
                                                                <div class="row"> 
                                                                    <div class="sms_right"><span class="badge bg-green" style="float: right;" id="add_total_no_birthday">me</span>Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2
                                                                        Hello2 Hello2 Hello2 Hello2
                                                                    </div>
                                                                </div>
                                                                <div class="row"> 
                                                                    <div class="sms_left">
                                                                        <strong style="float: left;">Guest:&nbsp;&nbsp;&nbsp;&nbsp; </strong> Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1
                                                                        Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1 Hello1
                                                                    </div>
                                                                </div>
                                                                <div class="row"> 
                                                                    <div class="sms_right"><span class="badge bg-green" style="float: right;" id="add_total_no_birthday">me</span>Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2 Hello2
                                                                        Hello2 Hello2 Hello2 Hello2
                                                                    </div>
                                                                </div>-->

                            </div>
                        </div>
                    </div>
                    <!-- chat box  end -->  



                    <!-- chat form start -->  
                    <div class="x_content" style="margin-top:0px;padding-top: 0px;">  
                        <div class="row"> 
                            <div class="col-md-6 col-sm-6 col-xs-6" style="max-width: 735px;">
                                <div class="text-left"> 
                                    <form name="chat_frm" id="chat_frm">
                                        <p class="lead emoji-picker-container">
                                            <textarea class="form-control textarea-control" name="chat_message" id="chat_message"  rows="3" placeholder="Chat Here with emoji Unicode input" data-emojiable="true" data-emoji-input="unicode"></textarea>
                                        </p>
<!--                                        <p class="lead emoji-picker-container">
                                            <textarea style="background-color: #fcfeff;" class="form-control textarea-control" name="chat_message" id="chat_message"  rows="3" placeholder="Chat Here with emoji Unicode input" data-emojiable="true" data-emoji-input="unicode"></textarea>
                                        </p>-->
                                        <p> <button type="button" class="btn btn-primary" onclick="return SaveChatMessage(event);">Send</button>
                                            <input type="hidden" name="receiver_id" id="receiver_id">
                                            <input type="hidden" name="sender_id" id="sender_id" value="<?php echo $this->session->userdata('user_id_tl'); ?>">
                                            <input type="hidden" name="last_chat_row_id" id="last_chat_row_id" value="">
                                        <p> 

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- chat form end -->  
                </div> 
            </div>
        </div>
        <!-- EDIT Form End-->

    </div>
</div>
<!-- Please wait area show  -->
<div class="please_wait">
    <p>
        <span id="please_wait_text">Please Wait</span><img src="<?php echo SITE_URL; ?>asset/images/loading.gif" id="please_wait_image"/><br/>
    <div class="loading" id="show_message_text">Please Wait..</div>
</p>
</div> <!-- Please wait area end  --> 

<!-- footer --> 
<?php include 'footer.php'; ?>		  
<!-- / footer -->

<!-- Begin emoji-picker JavaScript -->
<script src="<?php echo SITE_URL; ?>asset/emoji/js/config.js"></script>
<script src="<?php echo SITE_URL; ?>asset/emoji/js/util.js"></script>
<script src="<?php echo SITE_URL; ?>asset/emoji/js/jquery.emojiarea.js"></script>
<script src="<?php echo SITE_URL; ?>asset/emoji/js/emoji-picker.js"></script>
<!-- End emoji-picker JavaScript -->
<!-- /page content -->
<script>
    $(function () {
    // Initializes and creates emoji set from sprite sheet
    window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: '<?php echo SITE_URL; ?>asset/emoji/img/',
        popupButtonClasses: 'fa fa-smile-o'
    });
    // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
    // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
    // It can be called as many times as necessary; previously converted input fields will not be converted again
    window.emojiPicker.discover();
});   
 
</script>


