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
                /*height: 170px;*/
                text-align: center;
                padding-bottom: 15px;
                background-color: #f2f1f1;
                margin-top: -2px;
            }
            .info-number span{
                font-family: "UTM-Facebook";
                color: #8a140c;
                font-size: 20px;
                line-height: 40px;
            }
            .info-number input[name=phone]{
                border-radius: 5px;
                border: 1px solid #738191;
                padding: 10px;
                text-align: center;
                color: #738191;
                height: 20px;
                width: 250px;
                margin-top: 5px;
                font-size: 20px;
            }
            .info-number input[name=submit]{
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
            .info-number input[name=submit]:hover{
                opacity: 0.9;
            }
            .text-content{
                text-align: justify;
                padding: 10px;
                font-family: Tahoma;
                line-height: 30px;
                padding-top: 10px;
                background: #fff;
                padding-bottom: 10px;
            }
        </style>
        <script lang="text/javascript">
            $(function() {
                $("input[name=phone]").focus(function() {
                    $(this).val("");
                })
                $("input[name=phone]").focusout(function() {
                    $val = $(this).val();
                    if ($val == "")
                        $(this).val("Nhập số điện thoại");
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
    </head>
    <body>
        <div class="content">
            <img width="100%" src="/assets/images/icon/images/banner.jpg" />
            <?php if (empty($phone)) { ?>
                <div class="info-number">
                    <span>ĐĂNG KÝ SĐT NHẬN GIFT CODE</span>
                    <form action="" method="post">
                        <input type="number" name="phone" value="Nhập số điện thoại" onKeyPress="return isNumberKey(event)" /><br/>
                        <input type="submit" name="submit" value="ĐĂNG KÝ"  />
                    </form>
                </div>
            <?php } ?>
            <div class="text-content">
                <p>Holy War (Thánh chiến) là một thể loại game nhập vai hành động chặt chém MMO-ARPG có kỹ năng PK QTE độc đáo, đặc biệt dành cho gamer yêu thích PK. Trò chơi phát triển trên nền đồ họa 2.5D với hình ảnh sống động đầy thu hút, dung lượng khá nhẹ và phù hợp với hầu hết cấu hình máy.</p>
                <p>
                    Holy War là tựa game phương Tây, lấy cốt truyện về cuộc thánh chiến giữa thần bóng tối Dakelon và thần lửa sáng tạo thế giới Sidmund cùng với hậu duệ của hai thế lực của đại lục, cuộc chiến nảy lửa giữa hai thế lực này tạo nên nhiều huyền thoại mà bất cứ ai cũng ao ước trải nghiệm.</p>
            </div>
        </div>
    </body>
</html>
