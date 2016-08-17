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
            }
            .content{
                max-width: 600px;
                background-color: #fff;
                margin: auto;
            }
            .info-number{
                width: 100%;
                text-align: center;
                background-color: #fff;
            }

            .info-number:first-child{
                padding-top: 25px;
            }
            .space{
                width: 100%;
                height: 70px;
            }
            .check{

            }
            .shadow{
                background: #333333;
                position: fixed;
                width: 100%;
                height: 100%;
                z-index: 0;
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
            .input-phone-login input[name=gift]{
                border-radius: 5px;
                border: 1px solid #738191;
                padding: 10px;
                text-align: center;
                color: #738191;
                height: 20px;
                width: 250px;
                margin-top: 5px;
            }
        </style>
        <script lang="text/javascript">
            $(function(){
                $(".input-phone-login").hide();
                $(".shadow").hide();
                $('.gift-code-content').click(function(){
                    gift_code = $(this).attr('gift');
                    title = $(this).attr('title');
                    $(".input-phone-login").css("opacity", 1);
                    $(".input-phone-login").fadeIn();
                    $(".shadow").fadeIn();
                    $('.content').hide();
                    $('input[name=gift]').val(gift_code);
                    $('input[name=gift]').click(function(){
                        $(this).select();
                    })
                    $(".input-phone-login span").html(title);
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
                
            })
            function not_edit(){
                return false;
            }
        </script>
    </head>
    <body>
        <div class="shadow">
            
        </div>
        <div style="width: 100%; height: 1px"></div>
        <div class="input-phone-login">
            <p>GIFT CODE SỰ KIỆN</p>
            <span></span>
            <input type="text" name="gift" value="" onKeyPress="return not_edit(event)"/><br/>
        </div>
        <div class="content">

            <div class="info-number">
                <?php
                if (empty($phone)) {
                    echo '<img src="/assets/images/1.jpg" width="100%"/>';
                }else
                    echo '<img src="/assets/images/1_c.jpg" width="100%" class="gift-code-content" title="Đăng nhập SĐT nhận code" gift="'.$phone['gift_code'].'"/>';
                    
                ?>
            </div>
            <div class="info-number">
                <?php
                if (empty($like)) {
                    echo '<img src="/assets/images/2.jpg" width="100%"/>';
                }else
                    echo '<img src="/assets/images/2_c.jpg" width="100%" class="gift-code-content" title="Like Holy War nhận code" gift="'.$like['gift_code'].'"/>';
                ?>
            </div>
            <div class="info-number">
                <?php
                if (empty($game)) {
                    echo '<img src="/assets/images/3.jpg" width="100%"/>';
                }else
                    echo '<img src="/assets/images/3_c.jpg" width="100%" class="gift-code-content" title="Share Holy War nhận code" gift="'.$game['gift_code'].'"/>';
                ?>
            </div>
            <div class="info-number">
                <?php
                if (empty($invate)) {
                    echo '<img src="/assets/images/4.jpg" width="100%"/>';
                }else
                    echo '<img src="/assets/images/4_c.jpg" width="100%" class="gift-code-content" title="Tặng chiến hữu nhận code" gift="'.$phone['gift_code'].'"/>';
                ?>
            </div>
            <div class="info-number">
                <?php
                if (empty($trailer)) {
                    echo '<img src="/assets/images/5.jpg" width="100%"/>';
                }else
                    echo '<img src="/assets/images/5_c.jpg" width="100%" class="gift-code-content" title="Share Trailer nhận code" gift="'.$phone['gift_code'].'"/>';
                ?>
            </div>
            <div class="info-number">
                <?php
                if (empty($teaser)) {
                    echo '<img src="/assets/images/6.jpg" width="100%"/>';
                }else
                    echo '<img src="/assets/images/6_c.jpg" width="100%" class="gift-code-content" title="Share Teaser nhận code" gift="'.$phone['gift_code'].'"/>';
                ?>
            </div>
            <div class="info-number">
                <?php
                if (empty($setup)) {
                    echo '<img src="/assets/images/7.jpg" width="100%"/>';
                }else
                    echo '<img src="/assets/images/7_c.jpg" width="100%" class="gift-code-content" title="Cài Holy War nhận code" gift="'.$phone['gift_code'].'"/>';
                ?>
            </div>
            <div class="space"></div>
        </div>
    </body>
</html>
