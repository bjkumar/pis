 <span id="take_pg_content" class="take_pg_content"> 
<!-- Begin emoji-picker Stylesheets --> 

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
                        <i style="cursor:pointer;" onclick='httpPageGet("<?php echo SITE_URL; ?>Ctl_common/my_organization/employee")' class="fa fa-mail-reply-all" aria-hidden="true"></i> 
                        <span class="recvr_img_chat" id="recvr_image"></span>&nbsp;&nbsp;
                        <span class="z1c1kl" id="recvr_name"></span> 
                         
                        <!--<span class="z1c1kl" id="last_seen_time" ></span>--> 

<!--<span class="z1c1kl" id="online_status"></span>--> 
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

<!--                                        <p class="lead emoji-picker-container">
    <textarea style="background-color: #fcfeff;" class="form-control textarea-control" name="chat_message" id="chat_message"  rows="3" placeholder="Chat Here with emoji Unicode input" data-emojiable="true" data-emoji-input="unicode"></textarea>
</p>-->
                                            <!--<button type="button" class="btn btn-primary" onclick="return SaveChatMessage(event);">Send</button>-->
                                            <button type="button" class="btn btn-primary" onclick="Send_Message();">Send</button>

                                            <input type="hidden" name="receiver_id" id="receiver_id">
                                            <input type="hidden" name="sender_id" id="sender_id" value="<?php echo $this->session->userdata('user_id_tl'); ?>">
                                            <input type="hidden" name="sender_name" id="sender_name" value="<?php echo $this->session->userdata('fname_tl'); ?>">
                                            <input type="hidden" name="sender_img" id="sender_img" value="<?php echo $this->session->userdata('pro_image_tl'); ?>">

                                            <input type="hidden" name="last_chat_row_id" id="last_chat_row_id" value="">
                                        <p> 

                                    </form>

                                    <!--<a onclick="SendChatRequest('4','5');"> Go </a>--> 
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
 </span> 

 <script type="text/javascript" src="<?php echo SITE_URL; ?>asset/emoji/js/config.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>asset/emoji/js/util.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>asset/emoji/js/jquery.emojiarea.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>asset/emoji/js/emoji-picker.js"></script>
    <script>
    window.emojiPicker = new EmojiPicker({emojiable_selector: '[data-emojiable=true]', assetsPath: SITE_URL + 'asset/emoji/img/', popupButtonClasses: 'fa fa-smile-o'});
                                        window.emojiPicker.discover();</script>



