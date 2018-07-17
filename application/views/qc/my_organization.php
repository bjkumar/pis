<span id="take_pg_content" class="take_pg_content">  
    <style>
        .thumbnail .image { height: 152px;
                            overflow: hidden;
                            width: 155px;
                            border: 1px solid;
                            border-radius: 50%;
                            margin-left: 11%;}

        .thumbnail {
            height: 258px; 
        }

        .thumbnail .caption {
            text-align: center;
            height: 96px;
        }
    </style>
    <div class="right_col" role="main">
        <div class="">
            <!--                        <div class="page-title">
                                        <div class="title_left">
                                            <h3>Register</h3>
                                        </div>
            
                                        <div class="title_right">
                                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search for...">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button">Go!</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
            <div class="clearfix"></div>
            <!-- EDIT Form -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Employee</h2> 
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <div class="row"> 

                                <?php
                                foreach ($employee as $row) {
                                    ?>     

                                    <div class="col-md-2">
                                        <div class="thumbnail">
                                            <div class="image view view-first">
                                                <?php
                                                if ($row['pro_image'] != '') {
                                                    echo '<img style="width: 100%; display: block;" src="' . SITE_URL . 'asset/images/profile_pic/' . $row['pro_image'] . '" alt="image">';
                                                } else {
                                                    echo '<img style="width: 100%; display: block;" src="' . SITE_URL . 'asset/images/profile_pic/user.png" alt="image">';
                                                }
                                                ?>

                                                <div class="mask">
                                                    <p>Say Hi!</p>
                                                    <div class="tools tools-bottom">
                                                        <a onclick='httpPageGet("<?php echo SITE_URL; ?>Ctl_group_chat/index/<?php echo $row['id']; ?>")'><i class="fa fa-weixin" aria-hidden="true"></i></a>  
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="caption">
                                                <p> <?php echo $row['fname'] . ' ' . $row['lname']; ?></p>
                                                <p><?php echo $row['email']; ?></p>
                                                <p><?php echo $row['position']; ?></p>
                                                <p><?php echo $row['dept']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <!--                      <div class="col-md-2">
                                                        <div class="thumbnail">
                                                          <div class="image view view-first">
                                                             <img style="width: 100%; display: block;" src="'.SITE_URL.'asset/images/profile_pic/user.png" alt="image">
                                                              
                                                            <div class="mask">
                                                              <p>Your Text</p>
                                                              <div class="tools tools-bottom">
                                                                <a href="#"><i class="fa fa-link"></i></a>
                                                                <a href="#"><i class="fa fa-pencil"></i></a> 
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="caption">
                                                            <p>Binod Kumar Yadav</p>
                                                            <p>bjkumar@technosofteng.in</p>
                                                            <p>Software Developer</p>
                                                            <p>Web Department</p>
                                                          </div>
                                                        </div>
                                                      </div>-->









                            </div>


                        </div>
                    </div> 

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>TL</h2> 
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <div class="row"> 

                                <?php
                                foreach ($tl as $row) {
                                    ?>     

                                    <div class="col-md-2">
                                        <div class="thumbnail">
                                            <div class="image view view-first">
                                                <?php
                                                if ($row['pro_image'] != '') {
                                                    echo '<img style="width: 100%; display: block;" src="' . SITE_URL . 'asset/images/profile_pic/' . $row['pro_image'] . '" alt="image">';
                                                } else {
                                                    echo '<img style="width: 100%; display: block;" src="' . SITE_URL . 'asset/images/profile_pic/user.png" alt="image">';
                                                }
                                                ?>
                                                <?php if ($this->session->userdata('user_id_tl') != $row['id']) { ?>
                                                    <div class="mask">
                                                        <p>Say Hi!</p>
                                                        <div class="tools tools-bottom">
                                                            <a onclick='httpPageGet("<?php echo SITE_URL; ?>Ctl_group_chat/index/<?php echo $row['id']; ?>")'><i class="fa fa-weixin" aria-hidden="true"></i></a>  
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="caption">
                                                <p> <?php echo $row['fname'] . ' ' . $row['lname']; ?></p>
                                                <p><?php echo $row['email']; ?></p>
                                                <p><?php echo $row['position']; ?></p>
                                                <p><?php echo $row['dept']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EDIT Form End-->

        </div>
    </div>
    <!-- /page content -->
</span> 

