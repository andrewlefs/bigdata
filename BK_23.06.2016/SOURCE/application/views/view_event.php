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


            <div class="info-number">

                <img  src="/assets/images/icon-gift.jpg"/>
                <div class="info-number-content">
                    <div class="info-number-title">
                        <span id="title">Đăng nhập SĐT nhận 50.000 VNĐ</span>
                        <span id="day"><i>08/12/2014</i></span>
                    </div>
                    <?php if(empty($phone)){ ?>
                    <div class="info-number-button" >
                        <button class="input-phone pupop">Nhập SĐT</button>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <a href="http://hw.mobo.vn/mini-app/swap/dang-nhap-so-dien-thoai-nhan-giftcode-n219"><img width="100%" src="/assets/images/login-phone.jpg" /></a>
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
                        <span id="title">Like "Holy War" nhận 100.000  VNĐ</span>
                        <span id="day"><i>08/12/2014</i></span>
                    </div>
                    <?php if(empty($like)){ ?>
                    <div class="info-number-button" >
                        <!--<a href="urlscheme://action=like&page_id=1479754208961224">
                            <button class="input-phone">Like</button>
                        </a>-->
                        <?php echo $LikeShare->my_like("1479754208961224") ?>
                    </div>
                    <?php } ?>
                </div>

            </div>

            <a href="http://hw.mobo.vn/mini-app/swap/like-holy-war-nhan-giftcode-n278"><img width="100%" src="/assets/images/like-bg.jpg" /></a>
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
                        <span id="title">Muốn 200.000 VNĐ share "Holy War"</span>
                        <span id="day"><i>08/12/2014</i></span>
                    </div>
                    <?php if(empty($game)){ ?>
                    <div class="info-number-button" >
                        <!--<a href="urlscheme://action=share&url=http%3A%2F%2Fhw.mobo.vn&image=http%3A%2F%2Fhw.mobo.vn%2Fassets%2Fbanner_holywar.jpg&message=Ch%C6%A1i+game+tr%C3%BAng+iPhone+6+plus%2C+ai+tham+gia+c%C3%B9ng+kh%C3%B4ng%3F&name=Holy+War+%E2%80%93+Ch%C6%A1i+Th%C3%A1nh+Chi%E1%BA%BFn+ngay+tr%C3%AAn+mobile&caption=Tham+gia+s%E1%BB%B1+ki%E1%BB%87n+c%C3%A0i+game+tr%C3%BAng+iphone+6+plus&description=Holy+war+-+S%E1%BB%B1+k%E1%BA%BFt+h%E1%BB%A3p+tuy%E1%BB%87t+v%E1%BB%9Di+gi%E1%BB%AFa+qu%E1%BA%A7n+chi%E1%BA%BFn+MoBa+v%E1%BB%9Bi+k%E1%BB%B9+n%C4%83ng+%C4%91%E1%BB%99c+%C4%91%C3%A1o+QTE.+Si%C3%AAu+ph%E1%BA%A9m+nh%E1%BA%ADp+vai+tr%C3%AAn+n%E1%BB%81n+gMO+s%E1%BA%BD+mang+t%E1%BB%9Bi+cho+c%C3%A1c+b%E1%BA%A1n+nh%E1%BB%AFng+tr%E1%BA%A3i+nghi%E1%BB%87m+tuy%E1%BB%87t+v%E1%BB%9Di+nh%E1%BA%A5t%21&event_share_id=game">
                            <button class="input-phone">Share</button>
                        </a>-->

                        <?php echo $LikeShare->my_share("http://hw.mobo.vn", 
                                         "http://hw.mobo.vn/assets/banner_holywar.jpg", 
                                         "Chơi game trúng iPhone 6 plus, ai tham gia cùng không?", 
                                         "Holy War – Chơi Thánh Chiến ngay trên mobile", 
                                         "Tham gia sự kiện cài game trúng iphone 6 plus", 
                                         "Holy war - Sự kết hợp tuyệt vời giữa quần chiến MoBa với kỹ năng độc đáo QTE. Siêu phẩm nhập vai trên nền gMO sẽ mang tới cho các bạn những trải nghiệm tuyệt vời nhất!", 
                                         "game") ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <a href="http://hw.mobo.vn/mini-app/swap/share-holy-war-lay-code-xin-n279"><img width="100%" src="/assets/images/share-bg.jpg" /></a>
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
                        <span id="title">300.000 VNĐ tặng chiến hữu</span>
                        <span id="day"><i>08/12/2014</i></span>
                    </div>
                    <?php if(empty($invate)){ ?>
                    <div class="info-number-button" >
                        <!--<a href="urlscheme://action=invate"><button class="input-phone">Tặng</button></a>-->
                        <?php echo $LikeShare->my_invite() ?>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <a href="http://hw.mobo.vn/mini-app/swap/tang-code-cho-chien-huu-n280"><img width="100%" src="/assets/images/send-bg.jpg" /></a>
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
                        <span id="title">Share trailer nhận 400.000 VND</span>
                        <span id="day"><i>18/12/2014</i></span>
                    </div>
                    <?php if(empty($trailer)){ ?>
                    <div class="info-number-button" >
                        <!--<a href="urlscheme://action=share&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DcXWEacJMkUg%26feature%3Dyoutu.be&image=http%3A%2F%2Fm-app.mobo.vn%2Fassets%2Fimages%2Ftrailer.png&message=Ch%C6%A1i+game+tr%C3%BAng+iPhone+6+plus%2C+ai+tham+gia+c%C3%B9ng+kh%C3%B4ng%3F&name=Holy+War+%E2%80%93+Ch%C6%A1i+Th%C3%A1nh+Chi%E1%BA%BFn+ngay+tr%C3%AAn+mobile&caption=Tham+gia+s%E1%BB%B1+ki%E1%BB%87n+c%C3%A0i+game+tr%C3%BAng+iphone+6+plus&description=Holy+war+-+S%E1%BB%B1+k%E1%BA%BFt+h%E1%BB%A3p+tuy%E1%BB%87t+v%E1%BB%9Di+gi%E1%BB%AFa+qu%E1%BA%A7n+chi%E1%BA%BFn+MoBa+v%E1%BB%9Bi+k%E1%BB%B9+n%C4%83ng+%C4%91%E1%BB%99c+%C4%91%C3%A1o+QTE.+Si%C3%AAu+ph%E1%BA%A9m+nh%E1%BA%ADp+vai+tr%C3%AAn+n%E1%BB%81n+gMO+s%E1%BA%BD+mang+t%E1%BB%9Bi+cho+c%C3%A1c+b%E1%BA%A1n+nh%E1%BB%AFng+tr%E1%BA%A3i+nghi%E1%BB%87m+tuy%E1%BB%87t+v%E1%BB%9Di+nh%E1%BA%A5t%21&event_share_id=trailer">
                            <button class="input-phone share-trailer">Share</button>
                        </a>-->
                        <?php echo $LikeShare->my_share("https://www.youtube.com/watch?v=cXWEacJMkUg", 
                                         "http://m-app.mobo.vn/assets/images/trailer.png", 
                                         "Chơi game trúng iPhone 6 plus, ai tham gia cùng không?", 
                                         "Holy War – Chơi Thánh Chiến ngay trên mobile", 
                                         "Tham gia sự kiện cài game trúng iphone 6 plus", 
                                         "Holy war - Sự kết hợp tuyệt vời giữa quần chiến MoBa với kỹ năng độc đáo QTE. Siêu phẩm nhập vai trên nền gMO sẽ mang tới cho các bạn những trải nghiệm tuyệt vời nhất!", 
                                         "trailer") ?>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <a href="http://hw.mobo.vn/mini-app/swap/share-trailer-nhan-giftcode-n281"><img width="100%" src="/assets/images/share-trailer-bg.jpg" /></a>
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
                        <span id="title">Share teaser đỉnh nhận 500.000 VNĐ</span>
                        <span id="day"><i>18/12/2014</i></span>
                    </div>
                    <?php if(empty($teaser)){ ?>
                    <div class="info-number-button" >
                        <!--<a href="urlscheme://action=share&url=http%3A%2F%2Fholywar.vn%2F&image=http%3A%2F%2Fhw.mobo.vn%2Fassets%2Fbanner_holywar.jpg&message=Ch%C6%A1i+game+tr%C3%BAng+iPhone+6+plus%2C+ai+tham+gia+c%C3%B9ng+kh%C3%B4ng%3F&name=Holy+War+%E2%80%93+Ch%C6%A1i+Th%C3%A1nh+Chi%E1%BA%BFn+ngay+tr%C3%AAn+mobile&caption=Tham+gia+s%E1%BB%B1+ki%E1%BB%87n+c%C3%A0i+game+tr%C3%BAng+iphone+6+plus&description=Holy+war+-+S%E1%BB%B1+k%E1%BA%BFt+h%E1%BB%A3p+tuy%E1%BB%87t+v%E1%BB%9Di+gi%E1%BB%AFa+qu%E1%BA%A7n+chi%E1%BA%BFn+MoBa+v%E1%BB%9Bi+k%E1%BB%B9+n%C4%83ng+%C4%91%E1%BB%99c+%C4%91%C3%A1o+QTE.+Si%C3%AAu+ph%E1%BA%A9m+nh%E1%BA%ADp+vai+tr%C3%AAn+n%E1%BB%81n+gMO+s%E1%BA%BD+mang+t%E1%BB%9Bi+cho+c%C3%A1c+b%E1%BA%A1n+nh%E1%BB%AFng+tr%E1%BA%A3i+nghi%E1%BB%87m+tuy%E1%BB%87t+v%E1%BB%9Di+nh%E1%BA%A5t%21&event_share_id=teaser">
                            <button class="input-phone share-teaser">Share</button>
                        </a>-->

                        <?php echo $LikeShare->my_share("http://holywar.vn/", 
                                         "http://hw.mobo.vn/assets/banner_holywar.jpg", 
                                         "Chơi game trúng iPhone 6 plus, ai tham gia cùng không?", 
                                         "Holy War – Chơi Thánh Chiến ngay trên mobile", 
                                         "Tham gia sự kiện cài game trúng iphone 6 plus", 
                                         "Holy war - Sự kết hợp tuyệt vời giữa quần chiến MoBa với kỹ năng độc đáo QTE. Siêu phẩm nhập vai trên nền gMO sẽ mang tới cho các bạn những trải nghiệm tuyệt vời nhất!", 
                                         "teaser") ?>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <a href="http://hw.mobo.vn/mini-app/swap/share-teaser-nhan-giftcode-n282"><img width="100%" src="/assets/images/share-teaser-bg.jpg" /></a>
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
                        <span id="title">Cài Holy War nhận ngay 600.000 VNĐ</span>
                        <span id="day"><i>25/12/2014</i></span>
                    </div>
                    <?php if(empty($setup)){ ?>
                    <div class="info-number-button" >
                        <a href="<?php echo $link_download ?>">
                            <button class="input-phone setup-game">Cài đặt</button>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <a href="http://hw.mobo.vn/mini-app/swap/cai-holy-war-nhan-giftcode-600k-n283"><img width="100%" src="/assets/images/setup-bg.jpg" /></a>
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
