
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-touch-fullscreen" content="yes"/> 
        <link rel="stylesheet" href="/assets/css/reset.css">
        <script type="text/javascript" src="/admin/assets/js/plugins/jquery-1.8.3.min.js"></script>
        <title></title>
        <style>
            body{
                background: #9C9C9C;
                font-family: Tahoma;
            }
            a{
                text-decoration: none;
            }
            .content{
                max-width: 600px;
                background-color: #fff;
                margin: auto;
            }
            .info-number{
                max-width: 600px;
                padding-bottom: 15px;
                margin-top: -2px;
                padding: 15px;
            }
            .info-number img{
                float: left;
                margin-bottom: 18px;
                width: 57px;
                margin-right: 10px;
                position: absolute;
            }
            .info-number span#title{
                display: block;
                font-weight: bold;
                color: #CE171F;
                font-size: 14px;
                /*                overflow: hidden;
                                white-space: nowrap;
                                text-overflow: ellipsis;
                                line-height: 16px;*/
                width: 100%;
                margin-top: 8px;
            }
            .info-number span#day{
                display: block;
                padding: 10px 0 5px;
                color: #333333;
                font-size: 12px;
                font-weight: bold;
            }
            .info-number button{
                float: right;
                margin-top: -8%;
                margin-right: 3%;
                color: #fff;
                background-color: #CE171F;
                border: none;
                border-bottom: 4px solid #9C2729;
                padding: 11px 20px 11px 20px;
                border-radius: 4px;
                width: 103px;
                cursor: pointer;
            }
            hr{
                margin-top: 20px;
                margin-bottom: -5px;
            }

            .input-phone-login{
                text-align: center;
                max-width: 390px;
                background-color: #fff;
                padding: 1% 2% 1% 2%;
                border-radius: 10px;
                border: 1px solid #9E9E9E;
                margin: auto;
                padding-bottom: 17px;
                margin-top: 3%;
                position: relative;
                z-index: 101;
            }
            .input-phone-login span{
                font-family: "UTM-Facebook";
                color: #8a140c;
                font-size: 20px;
                margin-top: 1%;
                display: block;
                margin-bottom: 10px;
            }
            .input-phone-login input[name=phone]{
                border-radius: 5px;
                border: 1px solid #738191;
                padding: 10px;
                text-align: center;
                color: #738191;
                height: 20px;
                width: 250px;
                margin-top: 5px;
            }
            .input-phone-login input[name=submit]{
                background-color: #560708;
                border: none;
                width: 145px;
                height: 40px;
                border-radius: 5px;
                margin-top: 15px;
                color: #fff;
                font-size: 20px;
                font-weight: bold;
                cursor: pointer;

            }
            .input-phone-login input[name=submit]:hover{
                opacity: 0.9;
            }

            .shadow{
                background: #333333;
                position: fixed;
                width: 100%;
                height: 100%;
                z-index: 100;
            }
            .space{
                width: 100%;
                height: 70px;
            }
            .end{
                width: 100%;
                text-align: center;
                line-height: 200px;
                color: red;
                font-weight: bold;
                font-size: 20px;
            }
            .info-number-content{
                /*width: 52%;*/
                margin-left: 65px;
            }
            .info-number-button{
                float: right;
                width: 21%;
                margin-top: -22px;
            }
            .info-number-title{
                width: 60%;
            }
            .gift-code{
                margin-left: 10px;
                margin-top: 10px;
                font-size: 16px;
                color: #CE171F;
                font-weight: bold;
            }
            .copy{
                cursor: pointer;
                background: #9C2729;
                color: #fff;
                border: none;
                border-radius: 2px;
                padding: 2px 5px;
            }
            #day i{
                font-weight: normal;
            }
            @media (max-width: 327px) {
                .input-phone-login span{
                    font-size: 17px;
                }
                .input-phone-login input[name=phone]{
                    width: 72%;
                }
            }
            @media (max-width: 435px) {
                .info-number button{
                    padding: 5px 5px 5px 6px;
                    width: 80px;
                    margin-top: -15px;
                }

            }
            @media (max-width: 600px) {
                .info-number-button{
                    position: absolute;
                    right: 13px;
                }

            }
            #day{
                display: none !important;
            }    
            .popup{
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
            .popup img{
                width: 80%;
            }
        </style>
        <script lang="text/javascript">
            $(function() {
                $(".input-phone-login").hide();
                $(".shadow").hide();
                $(".pupop").click(function() {
                    $(".input-phone-login").css("opacity", 1);
                    $(".input-phone-login").fadeIn();
                    $(".shadow").fadeIn();
                    $('.content').hide();
                });
                $(".shadow").click(function() {
                    $(".input-phone-login").animate({
                        opacity: '0'
                    }, 200, function() {
                        $(".input-phone-login").hide();
                        $(".shadow").fadeOut();
                        $('.content').fadeIn();
                    });
                })
                $("input[name=phone]").click(function() {
                    $(this).val("");
                })
                  
    

            });
                function isNumberKey(evt)
            {
        var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
            return true;
            }
        </script>
        <script>
            function myCopy(code) {
                window.external.notify("action=copy&value=" + code);
            }

            function WPCallback(json) {
                window.external.notify(json);
            }
        </script>
    </head>
    <body>     
        <?php
@require_once APPPATH . '/libraries/LikeShare.php';
$LikeShare = new LikeShare;
?>  
        <div class="shadow">
        </div>
        <div style="width: 100%; height: 1px;z-index: 101 "></div>
        <div class="input-phone-login">
            <span>Đăng Nhập SĐT Nhận 100,000 VNĐ</span>
            <form action="" method="post">
                <input type="number" name="phone" value="Nhập số điện thoại" onKeyPress="return isNumberKey(event)"/><br/>
                <input type="submit" name="submit" value="ĐĂNG KÝ" />
            </form>

        </div>
        <div class="content">      
	<!--
            <div class="info-number">
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">500 Nhẫn giả đầu tiền gửi SMS nhận Siêu Code Hokage</span>
                        <span id="day"><i>30/1/2015</i></span>
                    </div>
                    <div class="info-number-button" >
                        <?php
                        $arrayjson = array("number" => "7565", "content" => "NarutoKO HOKAGE");
                        ?>
                        <a href="urlscheme://action=sms&number=<?php echo $arrayjson['number']; ?>&content=<?php echo $arrayjson['content']; ?>">
                            <button class="input-phone">Send SMS</button>
                        </a>
                    </div>
                </div>

            </div>      

            <a href="#"><img width="100%" src="/assets/images/naruto/sendsmssancodehokage.jpg" /></a>            
	-->
            <div class="info-number">

                <img  src="/assets/images/icon-gift.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Đăng Nhập SĐT Nhận 100,000 VNĐ</span>
                        <span id="day"><i>08/12/2014</i></span>
                    </div>
                    <?php if (empty($phone)) { ?>
                        <div class="info-number-button" >
                            <button class="input-phone pupop">Nhập SĐT</button>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/images/naruto/dangnhap.jpg" /></a>
            <div class="gift-code">
                Code: <?php
                if (!empty($phone))
                    echo $LikeShare->my_Copy($phone['gift_code']);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <hr>

            <div class="info-number">
                <img  src="/assets/images/like.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Like "Naruto Ko" nhận 200,000 VNĐ</span>
                        <span id="day"><i>08/12/2014</i></span>
                    </div>
                    <?php if (empty($like)) { ?>
                        <div class="info-number-button" >
                            <!--<a href="urlscheme://action=like&page_id=663051787132743">
                                <button class="input-phone">Like</button>
                            </a>-->
                            <?php echo $LikeShare->my_like("663051787132743") ?>
                        </div>
                    <?php } ?>
                </div>

            </div>

            <a href="#"><img width="100%" src="/assets/images/naruto/likenaruto.jpg" /></a>
            <div class="gift-code">
                Code: <?php
                if (!empty($like))
                    echo $LikeShare->my_Copy($like['gift_code']);
                else
                    echo "Chưa Nhận";
                ?> 
            </div>
            <hr>

            <div class="info-number">
                <img  src="/assets/images/share.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Share "Naruto Ko" nhận 300,000 VNĐ</span>
                        <span id="day"><i>08/12/2014</i></span>
                    </div>
                    <?php if (empty($game)) { ?>
                        <div class="info-number-button" >
                           <!-- <a href="urlscheme://action=share&url=http%3A%2F%2Fnaruto.mobo.vn&image=http%3A%2F%2Fm-app.mobo.vn%2Fassets%2Fimages%2Fnaruto%2Fsharenaruto.jpg&message=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!&name=Naruto%20KO&caption=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!&description=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!.Fan%20c%E1%BB%A7a%20Naruto%20kh%C3%B4ng%20th%E1%BB%83%20b%E1%BB%8F%20qua%20-%20Game%20nh%E1%BA%ADp%20vai%20chi%E1%BA%BFn%20thu%E1%BA%ADt%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20s%E1%BB%91%201%20tr%C3%AAn%20smartphone%2C%20c%C3%B3%20c%E1%BB%91t%20truy%E1%BB%87n%20100%25%20theo%20nguy%C3%AAn%20t%C3%A1c%20manga%20Naruto&event_share_id=game">
                                <button class="input-phone">Share</button>
                            </a>-->
                            <?php echo $LikeShare->my_share("http://naruto.mobo.vn", 
                                         "http://m-app.mobo.vn/assets/images/naruto/sharenaruto.jpg", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!", 
                                         "Naruto KO", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!.Fan của Naruto không thể bỏ qua - Game nhập vai chiến thuật đối kháng số 1 trên smartphone, có cốt truyện 100% theo nguyên tác manga Naruto", 
                                         "game") ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <a href="#"><img width="100%" src="/assets/images/naruto/sharenaruto.jpg" /></a>
            <div class="gift-code">
                Code: <?php
                      if (!empty($game))
                          echo $LikeShare->my_Copy($game);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <hr>

            <div class="info-number">
                <img  src="/assets/images/send.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Mời đồng đội nhận 200,000 VNĐ</span>
                        <span id="day"><i>08/12/2014</i></span>
                    </div>
                    <?php if (empty($invate)) { ?>
                        <div class="info-number-button" >
                            <!--<a href="urlscheme://action=invate"><button class="input-phone">Tặng</button></a>-->
                            <?php echo $LikeShare->my_invite() ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/images/naruto/invitefriend.jpg" /></a>
            <div class="gift-code">
               Code: <?php
                if (!empty($invate))
                    echo $LikeShare->my_Copy($invate['gift_code']);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <hr>

            <div class="info-number">
                <img  src="/assets/images/share-trailer.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Share Trailer  nhận 300,000 VNĐ</span>
                        <span id="day"><i>18/12/2014</i></span>
                    </div>
                    <?php if (empty($trailer)) { ?>
                        <div class="info-number-button" >
                           <!-- <a href="urlscheme://action=share&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3Dulm_zS6Wh9c&image=http://m-app.mobo.vn/assets/images/naruto/sharetrailer.jpg&message=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!&name=Naruto%20KO&caption=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!&description=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!.Fan%20c%E1%BB%A7a%20Naruto%20kh%C3%B4ng%20th%E1%BB%83%20b%E1%BB%8F%20qua%20-%20Game%20nh%E1%BA%ADp%20vai%20chi%E1%BA%BFn%20thu%E1%BA%ADt%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20s%E1%BB%91%201%20tr%C3%AAn%20smartphone%2C%20c%C3%B3%20c%E1%BB%91t%20truy%E1%BB%87n%20100%25%20theo%20nguy%C3%AAn%20t%C3%A1c%20manga%20Naruto&event_share_id=trailer">
                                <button class="input-phone share-trailer">Share</button>
                            </a>-->
                             <?php echo $LikeShare->my_share("https://www.youtube.com/watch?v=ulm_zS6Wh9c", 
                                         "http://m-app.mobo.vn/assets/images/naruto/sharetrailer.jpg", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!", 
                                         "Naruto KO", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!.Fan của Naruto không thể bỏ qua - Game nhập vai chiến thuật đối kháng số 1 trên smartphone, có cốt truyện 100% theo nguyên tác manga Naruto", 
                                         "trailer") ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/images/naruto/sharetrailer.jpg" /></a>
            <div class="gift-code">
                Code: <?php
                            if (!empty($trailer))
                                echo $LikeShare->my_Copy($trailer);
                    else
                        echo "Chưa Nhận";
                    ?>
            </div>
            <hr>

            <div class="info-number">
                <img  src="/assets/images/share-teaser.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Share Teaser độc nhận 300,000 VNĐ</span>
                        <span id="day"><i>18/12/2014</i></span>
                    </div>
                    <?php if (empty($teaser)) { ?>
                        <div class="info-number-button" >
                            <!--<a href="urlscheme://action=share&url=http%3A%2F%2Fnaruto.mobo.vn%2F&image=http%3A%2F%2Fm-app.mobo.vn%2Fassets%2Fimages%2Fnaruto%2Fshareteaser.jpg&message=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!&name=Naruto%20KO&caption=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!&description=Naruto%20KO%20-%20game%20SLG%20%C4%91%E1%BB%91i%20kh%C3%A1ng%20duy%20nh%E1%BA%A5t%20t%E1%BA%A1i%20vi%E1%BB%87t%20nam!.Game%20c%C3%B3%20c%E1%BB%91t%20truy%E1%BB%87n%20100%25%20theo%20nguy%C3%AAn%20t%C3%A1c%20manga%20Naruto.%20C%C3%A0i%20game%20nh%E1%BA%ADn%20ngay%20iPhone%206%20Plus%20v%C3%A0%20h%E1%BB%93i%20sinh%20c%C3%A1c%20nh%E1%BA%ABn%20gi%E1%BA%A3%20b%E1%BA%A1n%20y%C3%AAu%20th%C3%ADch%20%C4%91%E1%BB%83%20c%C3%B9ng%20tham%20gia%20%C4%90%E1%BA%A5u%20tr%C6%B0%E1%BB%9Dng%20sinh%20t%E1%BB%AD%20chi%E1%BA%BFn%2C%20khi%C3%AAu%20chi%E1%BA%BFn%20to%C3%A0n%20server%20trong%20Naruto%20KO%20ngay%20h%C3%B4m%20nay.&event_share_id=teaser">
                                <button class="input-phone share-teaser">Share</button>
                            </a>-->
                             <?php echo $LikeShare->my_share("http://naruto.mobo.vn/", 
                                         "http://m-app.mobo.vn/assets/images/naruto/shareteaser.jpg", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!", 
                                         "Naruto KO", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!", 
                                         "Naruto KO - game SLG đối kháng duy nhất tại việt nam!.Game có cốt truyện 100% theo nguyên tác manga Naruto. Cài game nhận ngay iPhone 6 Plus và hồi sinh các nhẫn giả bạn yêu thích để cùng tham gia Đấu trường sinh tử chiến, khiêu chiến toàn server trong Naruto KO ngay hôm nay.", 
                                         "teaser") ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/images/naruto/shareteaser.jpg" /></a>
            <div class="gift-code">
                Code: <?php
                      if (!empty($teaser))
                          echo $LikeShare->my_Copy($teaser);
                    else
                        echo "Chưa Nhận";
                    ?>
            </div>
            <hr>
<?php if($_GET["platform"] != "wp") { ?>
            <div class="info-number">
                <img  src="/assets/images/setup.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Cài Naruto KO nhận 500,000 VNĐ</span>
                        <span id="day"><i>25/12/2014</i></span>
                    </div>
                    <?php if (empty($setup)) { ?>
                        <div class="info-number-button" >
                            <a href="<?php echo $link_download ?>" id="install">
                                <button class="input-phone setup-game">Cài đặt</button>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/images/naruto/installnaruto.jpg" /></a>
            <div class="gift-code">
                Code: <?php
                      if (!empty($setup))
                          echo $LikeShare->my_Copy($setup['gift_code']);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
<?php } ?>
            <div class="space"></div>

        </div>
    </body>
</html>
