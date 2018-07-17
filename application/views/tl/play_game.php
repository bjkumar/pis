<span id="take_pg_content" class="take_pg_content">
    <style>
        canvas {
            border:1px solid #d3d3d3;
            background-color: #f1f1f1;
        }
        .push_button{
            width: 82px; height: 82px; border-radius: 47%;background: #394051; color: white;border: none;display:none;
        }
        .load_game{
            width: 82px; height: 82px; border-radius: 47%;background: red; color: white;border: none;font-size: 9px;margin-left: 28%;display:none;
        }
        .start_game{
            width: 82px; height: 82px; border-radius: 47%;background: #475060; color: white;border: none;
        }
        .your_score_btn{
            width: 65px; height: 65px; border-radius: 47%;background: #680A6B; color: white;border: none; 
        }
        .top_score_btn{
            width: 65px; height: 65px; border-radius: 47%;background: #E9B04D; color: white;border: none; 
        }

        .second_score_btn{
            width: 52px; height: 52px; border-radius: 47%;background: #D4D5C9; color: white;border: none; margin-left: 3.1%;
        }

        .third_score_btn{
            width: 40px; height: 40px; border-radius: 47%;background: #C55C24; color: white;border: none; margin-left: 6%;
        }
        #hscore_text {
            color:green;
            font-size:15px;
            font-weight: bold;
            margin-top:15%;
        }
        #played_three_time {
   color: red;
font-weight: bold;}
    </style>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="x_panel">
                        <div class="x_title">

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <input type="hidden" id="score_value">
                            <span id="add_canvas" style="width: 634px; height:229px;"></span>
                            <br>

                            <button onmousedown="accelerate(-0.2)" onmouseup="accelerate(0.05)" class="push_button" id="push_button">PUSH</button>
                            <button  onclick="StartAgain();"  class="start_game" id="start_game">START</button>
                            <button  onclick="location.reload();" class="load_game" id="load_game">LOAD GAME</button>
                            <p>Use the PUSH button to stay in the air</p>
                            <p>How long can you stay alive?</p>
                            <p>Only three time u can play in a day</p>



                        </div>
                    </div>
                </div>



                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="x_panel">

                        <div class="x_content">

                            <div class="col-md-6">  
                                <span id="my_score_id"><button  class="your_score_btn">0</button></span> My Heighest Score  

                                <div class="try_again"></div>
                                <div id="hscore_text"></div>
                                <div id="played_three_time"></div>
                            </div>
   

                            <div class="col-md-6"> 
                                <h1>Top Scorer</h1>
                                <span id="top_score_btn_id"></span>  <br/>
                                <span id="second_score_btn_id"></span><br/>
                                <span id="third_score_btn_id"></span>
                            </div>




                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- /page content -->


<script>
    var myGamePiece;
    var myObstacles = [];
    var myScore;

    function StartAgain() {
        $('#push_button').show();
       // $('#load_game').show();
        $('#start_game').hide();
        startGame();
    }

    $(document).ready(function () {
        LoadHeighestScorer();
    });

    var myGameArea = {
        canvas: document.createElement("canvas"),
        start: function () {
            this.canvas.width = 580;
            this.canvas.height = 270;
            this.context = this.canvas.getContext("2d");
            $('#add_canvas').html(this.canvas);
            // document.body.insertBefore(this.canvas, document.body.childNodes[0]);
            this.frameNo = 0;
            this.interval = setInterval(updateGameArea, 20);
        },
        clear: function () {
            this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
        }
    }


    function startGame() {
        myGamePiece = new component(30, 30, "red", 230, 120);
        myGamePiece.gravity = 0.05;
        myScore = new component("30px", "Consolas", "black", 280, 40, "text");
        myGameArea.start();
    }



    function component(width, height, color, x, y, type) {
        // color = 'green';
        this.type = type;
        this.score = 0;
        this.width = width;
        this.height = height;
        this.speedX = 0;
        this.speedY = 0;
        this.x = x;
        this.y = y;
        this.gravity = 0;
        this.gravitySpeed = 0;
        this.update = function () {
            ctx = myGameArea.context;
            if (this.type == "text") {
                ctx.font = this.width + " " + this.height;
                ctx.radius = '100';
                ctx.fillStyle = color;
                ctx.fillText(this.text, this.x, this.y);
            } else {
                ctx.fillStyle = color;
                ctx.fillRect(this.x, this.y, this.width, this.height);
            }
        }
        this.newPos = function () {
            this.gravitySpeed += this.gravity;
            this.x += this.speedX;
            this.y += this.speedY + this.gravitySpeed;
            this.hitBottom();
        }
        this.hitBottom = function () {
            var rockbottom = myGameArea.canvas.height - this.height;
            if (this.y > rockbottom) {
                this.y = rockbottom;
                this.gravitySpeed = 0;
            }
        }
        this.crashWith = function (otherobj) {
            var myleft = this.x;
            var myright = this.x + (this.width);
            var mytop = this.y;
            var mybottom = this.y + (this.height);
            var otherleft = otherobj.x;
            var otherright = otherobj.x + (otherobj.width);
            var othertop = otherobj.y;
            var otherbottom = otherobj.y + (otherobj.height);
            var crash = true;
            if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
                crash = false;
            }

            return crash;
        }
    }



    function updateGameArea() {
        var x, height, gap, minHeight, maxHeight, minGap, maxGap;
        for (i = 0; i < myObstacles.length; i += 1) {
            if (myGamePiece.crashWith(myObstacles[i])) {
                SaveScore();
                return;
            }
        }
        myGameArea.clear();
        myGameArea.frameNo += 1;
        if (myGameArea.frameNo == 1 || everyinterval(150)) {
            x = myGameArea.canvas.width;
            minHeight = 20;
            maxHeight = 200;
            height = Math.floor(Math.random() * (maxHeight - minHeight + 1) + minHeight);
            minGap = 50;
            maxGap = 200;
            gap = Math.floor(Math.random() * (maxGap - minGap + 1) + minGap);
            myObstacles.push(new component(10, height, "green", x, 0));
            myObstacles.push(new component(10, x - height - gap, "green", x, height + gap));
        }
        for (i = 0; i < myObstacles.length; i += 1) {
            myObstacles[i].x += -1;
            myObstacles[i].update();
        }
        myScore.text = "SCORE: " + myGameArea.frameNo;
        myScore.update();
        myGamePiece.newPos();
        myGamePiece.update();
        $("#score_value").val(myGameArea.frameNo);
    }

    function everyinterval(n) {
        if ((myGameArea.frameNo / n) % 1 == 0) {
            return true;
        }
        return false;
    }

    function accelerate(n) {
        myGamePiece.gravity = n;
    }


    /******** Save Score ******/
    var count_no = 1;
    function SaveScore() {
        $('#push_button').hide();
       
        
        if (count_no == 1) {
            var score_val = $("#score_value").val();
            //alert(score_val);
            $.post(SITE_URL + "Ctl_common/save_score", {score: score_val}, function (result) {
                // alert(result);
                if(result == 1){
                      $("#hscore_text").text('Wish You For Your First Score');   // first entry //
                }else if(result == 0){
                      $("#hscore_text").text('Try Again For Gain Highest Score');   // not a maximum score //
                }else{
                     $("#hscore_text").text('Congratulations! You Have Highest Score');      // maximum score // highest credit score
                }
                LoadHeighestScorer();
                setTimeout(function () {
                    $('#hscore_text').text('');
                }, 7000);
                
            });

        }
        count_no = 2;

    }


    function LoadHeighestScorer() {
        $.ajax({
            url: SITE_URL + 'Ctl_common/get_three_max_scorer', type: 'GET', dataType: 'json',
            success: function (data) {

                var obj = JSON.parse(JSON.stringify(data));
                $.each(obj, function (i, item) {    
                    if (i == 0) {
                        $("#top_score_btn_id").html('<button class="top_score_btn">'+item.max_score+'</button>  '+item.fname+' <img src="'+SITE_URL+'asset/images/gold_price.jpg">');
                    }
                    if (i == 1) {
                        $("#second_score_btn_id").html('<button class="second_score_btn">'+item.max_score+'</button>  '+item.fname+' <img src="'+SITE_URL+'asset/images/silver.jpg">' );
                    }
                    if (i == 2) {
                        $("#third_score_btn_id").html('<button class="third_score_btn">'+item.max_score+'</button>  '+item.fname+' <img src="'+SITE_URL+'asset/images/bronze.jpg">');
                    }
                     if (i == 3) {     
                        $("#my_score_id").html('<button  class="your_score_btn">'+item.my_max_score+'</button>');
                         if(item.play_times > 2){
                           $("#start_game").hide();    $("#push_button").hide();   $("#load_game").hide();
                           $("#played_three_time").html('You Played Three Time Today! Try Again Tomorrow');
                         }else{
                              $("#load_game").show();
                         }
                    }
                    
                    
                });
            }
        });
    }
</script>  

 </span>