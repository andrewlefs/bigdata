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
                z-index: 1;
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
                z-index: 0;
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
                margin-top: -36px;
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
            .coming_soon{
                background-color: #8E8080 !important;
                border: none;
                border-bottom: 4px solid #736869 !important;
            }
        </style>
        <script lang="text/javascript">
            $(function () {
                $(".input-phone-login").hide();
                $(".shadow").hide();
                $(".pupop").click(function () {
                    $(".input-phone-login").css("opacity", 1);
                    $(".input-phone-login").fadeIn();
                    $(".shadow").fadeIn();
                    $('.content').hide();
                });
                $(".shadow").click(function () {
                    $(".input-phone-login").animate({
                        opacity: '0'
                    }, 200, function () {
                        $(".input-phone-login").hide();
                        $(".shadow").fadeOut();
                        $('.content').fadeIn();
                    });
                })
                $("input[name=phone]").click(function () {
                    $(this).val("");
                })
                //$(".setup-game").addClass('coming_soon').parent().attr('href','#');

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
        <?php

        function my_copy($gift_code) {
            if ($_GET["platform"] == "wp") {
                return '<a href="#" onclick="myCopy(\'' . $gift_code . '\')"><button class="copy">Copy</button></a>';
            } else {
                return '<a href="urlscheme://action=copy&value=' . $gift_code . '"><button class="copy">Copy</button></a>';
            }
        }
        ?>
    </head>
    <body>
        <?php
@require_once APPPATH . '/libraries/LikeShare.php';
$LikeShare = new LikeShare;
?>
        <div class="shadow">

        </div>
        <div style="width: 100%; height: 1px"></div>
        <div class="input-phone-login">
            <span>ĐĂNG KÝ SĐT NHẬN GIFT CODE</span>
            <form action="" method="post">
                <input type="number" name="phone" value="Nhập số điện thoại" onKeyPress="return isNumberKey(event)"/><br/>
                <input type="submit" name="submit" value="ĐĂNG KÝ" />
            </form>

        </div>
        <div class="content">
            <!--
                                    <div class="info-number">
                            <img  src="/assets/images/share.jpg"/>
                            <div class="info-number-content">
                                <div class="info-number-title">
                                    <span id="title">Share nhận Giftcode tri ân.</span>
                                    <span id="day"><i>24/04/2015</i></span>
                                </div>
            <?php if (empty($game)) { ?>
                                    <div class="info-number-button" >
                                        <a href="urlscheme://action=share&url=http%3A%2F%2Fmong.mobo.vn%2Flandingpage&image=http%3A%2F%2Fm-app.mobo.vn%2Fassets%2Fmgh%2Fshare-facebook.png&message=M%E1%BB%99ng%20Giang%20H%E1%BB%93%20-%20Tuy%E1%BB%87t%20%C4%91%E1%BB%89nh%20ki%E1%BA%BFm%20ki%E1%BB%87p%20Kim%20Dung%20tr%C3%AAn%20mobile!&name=M%E1%BB%99ng%20Giang%20H%E1%BB%93%20-%20Tuy%E1%BB%87t%20%C4%91%E1%BB%89nh%20ki%E1%BA%BFm%20ki%E1%BB%87p%20Kim%20Dung%20tr%C3%AAn%20mobile!&caption=M%E1%BB%99ng%20Giang%20H%E1%BB%93&description=M%E1%BB%99ng%20Giang%20H%E1%BB%93%20(MGH)%20%E2%80%93%20Tuy%E1%BB%87t%20%C4%91%E1%BB%89nh%20ki%E1%BA%BFm%20hi%E1%BB%87p%20h%C3%A0ng%20%C4%91%E1%BA%A7u%20HOT%20nh%E1%BA%A5t%202015.%20M%E1%BB%99t%20th%E1%BB%83%20lo%E1%BA%A1i%20game%20nh%E1%BA%ADp%20vai%20(RPG)%20-%20chi%E1%BA%BFn%20thu%E1%BA%ADt%20(Strategy)%20ch%C6%A1i%20ngay%20tr%C3%AAn%20mobile%20v%E1%BB%9Bi%20l%E1%BB%91i%20ch%C6%A1i%20%C4%91%E1%BA%B7c%20bi%E1%BB%87t%20v%C3%A0%20%C4%91%E1%BB%99c%20nh%E1%BA%A5t%20VN%20hi%E1%BB%87n%20nay.&event_share_id=game">
                                            <button class="input-phone share-trailer">Share</button>
                                        </a>
                                    </div>
            <?php } ?>
                            </div>
                        </div>
            
                        <a href="#"><img width="100%" src="/assets/mgh/share-facebook.png" /></a>
                        <div class="gift-code">
                            Code: <?php if (!empty($game)) echo '<span>' . $game . '</span> <a href="urlscheme://action=copy&value=' . $game . '"><button class="copy">Copy</button></a>';
            else echo "Chưa Nhận"; ?>
                        </div>
                        <hr>
            -->
            <div class="info-number">

                <img  src="/assets/images/icon-gift.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Nhập số điện thoại nhận Giftcode trị giá 100K</span>
                        <span id="day"><i>15/04/2015</i></span>
                    </div>
<?php if (empty($phone)) { ?>
                        <div class="info-number-button" >
                            <button class="input-phone pupop">Nhập SĐT</button>
                        </div>
<?php } ?>
                </div>
            </div>
            <a href="#"><img width="100%" src="/assets/mgh/login-phone.png" /></a>
            <div class="gift-code">
                Code: <?php
                if (!empty($phone))
                    echo $LikeShare->my_Copy($phone['gift_code']);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <hr>
            <!--<div class="info-number">
                <img  src="/assets/images/share-trailer.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Share Teaser Đại Hội Võ Lâm</span>
                        <span id="day"><i>30/05/2015</i></span>
                    </div>
                    <?php if (empty($congressmartial)) { ?>
                            <div class="info-number-button" >                           
                               <?php echo $LikeShare->my_share("http://mong.mobo.vn/daihoivolam", 
                                         "http://m-app.mobo.vn/assets/mgh/20150529/daihoivolam.jpg", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ", 
                                         "Mộng Giang Hồ (MGH) – Tuyệt đỉnh kiếm hiệp hàng đầu HOT nhất 2015. Một thể loại game nhập vai (RPG) - chiến thuật (Strategy) chơi ngay trên mobile với lối chơi đặc biệt và độc nhất VN hiện nay.", 
                                         "congressmartial") ?>
                            </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/mgh/20150529/daihoivolam.jpg" /></a>
            <div class="gift-code">
                Code: <?php
                      if (!empty($congressmartial))
                          echo $LikeShare->my_Copy($congressmartial);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <hr>
-->
            <div class="info-number">
                <img  src="/assets/images/like.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Like Fanpage nhận Giftcode</span>
                        <span id="day"><i>15/04/2015</i></span>
                    </div>
                    <?php if (empty($like)) { ?>
                            <div class="info-number-button" >
                                <!--<a href="urlscheme://action=like&page_id=665726200221998">
                                    <button class="input-phone">Like</button>
                                </a>-->
                                <?php echo $LikeShare->my_like("665726200221998") ?>
                            </div>
                    <?php } ?>
                </div>

            </div>

            <a href="#"><img width="100%" src="/assets/mgh/like.png" /></a>
            <div class="gift-code">
                Code: <?php
                if (!empty($like))
                    echo $LikeShare->my_Copy($like['gift_code']);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <hr>
 <!--<div class="info-number">
                <img  src="/assets/images/share-trailer.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Vote app nhận Giftcode</span>
                        <span id="day"><i>15/04/2015</i></span>
                    </div>
                    <?php if (empty($game)) { ?>
                            <div class="info-number-button" >                           
                               <?php echo $LikeShare->my_share("http://mong.mobo.vn", 
                                         "http://m-app.mobo.vn/assets/mgh/mgh_share.jpg", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ", 
                                         "Mộng Giang Hồ (MGH) – Tuyệt đỉnh kiếm hiệp hàng đầu HOT nhất 2015. Một thể loại game nhập vai (RPG) - chiến thuật (Strategy) chơi ngay trên mobile với lối chơi đặc biệt và độc nhất VN hiện nay.", 
                                         "game") ?>
                            </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/mgh/mgh_share.jpg" /></a>
            <div class="gift-code">
                Code: <?php
                      if (!empty($game))
                          echo $LikeShare->my_Copy($game);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <hr>
			-->
<!--

			<div class="info-number">
                    <img  src="/assets/images/share-teaser.jpg"/>
                    <div class="info-number-content">
                        <div class="info-number-title">
                            <span id="title">Nhận Giftcode Khảo Sát</span>
                            <span id="day"><i>22/05/2015</i></span>
                        </div>
                        <?php if (empty($examin)) { ?>
                                <div class="info-number-button" >
                                    <?php echo $LikeShare->my_share("http://mong.mobo.vn", 
                                         "http://m-app.mobo.vn/assets/mgh/20150522/codekhaosat.jpg", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ", 
                                         "Mộng Giang Hồ (MGH) – Tuyệt đỉnh kiếm hiệp hàng đầu HOT nhất 2015. Một thể loại game nhập vai (RPG) - chiến thuật (Strategy) chơi ngay trên mobile với lối chơi đặc biệt và độc nhất VN hiện nay.", 
                                         "examin") ?>
                                </div>
                        <?php } ?>
                    </div>
                </div>

                <a href="#"><img width="100%" src="/assets/mgh/20150522/codekhaosat.jpg" /></a>
                <div class="gift-code">
                    Code: <?php
                      if (!empty($examin))
                          echo $LikeShare->my_Copy($examin);
                else
                    echo "Chưa Nhận";
                ?>
                </div>
                <hr>
-->
<?php //if(!empty($game)){  ?>
            <div class="info-number">
                <img  src="/assets/images/share-trailer.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Share teaser (lần 1) - Giftcode trị giá 100K</span>
                        <span id="day"><i>15/04/2015</i></span>
                    </div>
                    <?php if (empty($teaser)) { ?>
                            <div class="info-number-button" >                           
                               <?php echo $LikeShare->my_share("http://mong.mobo.vn", 
                                         "http://m-app.mobo.vn/assets/mgh/share-teaser-bg.png", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ", 
                                         "Mộng Giang Hồ (MGH) – Tuyệt đỉnh kiếm hiệp hàng đầu HOT nhất 2015. Một thể loại game nhập vai (RPG) - chiến thuật (Strategy) chơi ngay trên mobile với lối chơi đặc biệt và độc nhất VN hiện nay.", 
                                         "teaser") ?>
                            </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/mgh/share-teaser-bg.png" /></a>
            <div class="gift-code">
                Code: <?php
                      if (!empty($teaser))
                          echo $LikeShare->my_Copy($teaser);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <hr>
<?php //}  ?>


                

<?php if (!empty($teaser)) { ?>
                <div class="info-number">
                    <img  src="/assets/images/share-teaser.jpg"/>
                    <div class="info-number-content">
                        <div class="info-number-title">
                            <span id="title">Share trailer (lần 2)- Nhận Giftcode trị giá 200K</span>
                            <span id="day"><i>15/04/2015</i></span>
                        </div>
                        <?php if (empty($trailer)) { ?>
                                <div class="info-number-button" >
                                    <?php echo $LikeShare->my_share("https://youtu.be/IdwkwGKiOrY", 
                                         "http://m-app.mobo.vn/assets/mgh/monggianho.jpg", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ - Tuyệt đỉnh kiếm kiệp Kim Dung trên mobile!", 
                                         "Mộng Giang Hồ", 
                                         "Mộng Giang Hồ (MGH) – Tuyệt đỉnh kiếm hiệp hàng đầu HOT nhất 2015. Một thể loại game nhập vai (RPG) - chiến thuật (Strategy) chơi ngay trên mobile với lối chơi đặc biệt và độc nhất VN hiện nayMộng Giang Hồ (MGH) – Tuyệt đỉnh kiếm hiệp hàng đầu HOT nhất 2015. Một thể loại game nhập vai (RPG) - chiến thuật (Strategy) chơi ngay trên mobile với lối chơi đặc biệt và độc nhất VN hiện nay", 
                                         "trailer") ?>
                                </div>
                        <?php } ?>
                    </div>
                </div>

                <a href="#"><img width="100%" src="/assets/mgh/share-trailer-bg.png" /></a>
                <div class="gift-code">
                    Code: <?php
                      if (!empty($trailer))
                          echo $LikeShare->my_Copy($trailer);
                else
                    echo "Chưa Nhận";
                ?>
                </div>
                <hr>
<?php } ?>



            <div class="info-number">
                <img  src="/assets/images/send.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Mời 20 bạn nhận Giftcode trị giá 500k</span>
                        <span id="day"><i>15/04/2015</i></span>
                    </div>
                    <?php if (empty($invate)) { ?>
                            <div class="info-number-button" >
                                <!--<a href="urlscheme://action=invate"><button class="input-phone">Tặng</button></a>-->
                                <?php echo $LikeShare->my_invite() ?>
                            </div>
                    <?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/mgh/send-bg.png" /></a>
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
                <img  src="/assets/images/setup.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Cài MGH nhận giftcode MOBO</span>
                        <span id="day"><i>Coming soon</i></span>
                    </div>
                    <?php if (empty($setup)) { ?>
                        <div class="info-number-button" >
<!--                            <a href="<?php echo $link_download ?>">
                                <button class="input-phone setup-game">Cài đặt</button>
                            </a>-->
                           <?php echo LikeShare::my_install($link_download); ?>
                        </div>
<?php } ?>
                </div>
            </div>

            <a href="#"><img width="100%" src="/assets/mgh/setup-bg.png" /></a>
            <div class="gift-code">
                Code: <?php
                      if (!empty($setup))
                          echo $LikeShare->my_Copy($setup['gift_code']);
                else
                    echo "Chưa Nhận";
                ?>
            </div>
            <div class="space"></div>

        </div>
    </body>
</html>
