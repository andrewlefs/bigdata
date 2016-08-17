<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head><meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>

        <meta content="Mobo Game" name="author"/>
        <meta content="Mobo Game" name="generator"/>
        <meta content="index,follow" name="robots"/>
        <!--//for facebook-->
        <meta content="Mobo Game" property="og:site_name"/>
        <meta content="game" property="og:type"/>
        <meta content="Mobo Game | Cổng thông tin cập nhật game online, game cho iphone" property="og:title"/>
        <meta property="og:description" content="Mobogame là đơn vị phát hành game online, game mobile, game cho iphone với các game hay như game thien than truyen, game manh thu, game ai tam quoc, tay du ky, khat vong san co, iwin"/>
        <meta property="og:image" content="http://game.mobo.vn"/>
        <meta property="og:url" content="http://game.mobo.vn"/>

        <meta name="author" content="Mobo Game"/>
        <title>Mobo Game | Cổng thông tin cập nhật game online, game cho iphone</title>
        <meta content="Mobogame là đơn vị phát hành game online, game mobile, game cho iphone với các game hay như game thien than truyen, game manh thu, game ai tam quoc, tay du ky, khat vong san co, iwin" name="description"/>
        <meta content="game online, game mobile, game cho iphone, game hay iphone, game iwin, game thien than truyen, manh thu, ai tam quoc, tay du ky,khat vong san co" name="keywords"/>

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <link rel="stylesheet" href="/frontend/assets/wap/css/style_wap_mobogame.css?v=300" type="text/css" />
        <script type="text/javascript" src="/frontend/assets/wap/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/frontend/assets/wap/js/jquery.touchslider.js"></script>
        
        
        <!--- slide------------------->
        <!-- Important Owl stylesheet -->
        <link rel="stylesheet" href="/frontend/assets/js/owl-carousel/owl.carousel.css">
        <!-- Default Theme -->
        <link rel="stylesheet" href="/frontend/assets/js/owl-carousel/owl.theme.css">
        <!-- Include js plugin -->
        <script src="/frontend/assets/js/owl-carousel/owl.carousel.js"></script>
        
    </head>

    <script type="text/javascript">
        /*
        $(function() {
            $(".touchslider").touchSlider({
                container: this,
                duration: 350,
                delay: 3000,
                mouseTouch: true,
                namespace: "touchslider",
                currentClass: "touchslider-nav-item-current",
                pagination: ".touchslider-nav-item",
                autoplay: true,
            });
        });
        */
    </script>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-54802465-1', 'auto');
        ga('send', 'pageview');

    </script>

    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=557276284364492&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <body >
        <div id="fb-root"></div>
        
        <?php echo $menugame; ?>
        
        <div class="wapper" id="wapper" style="position: relative">
            <h1 class="seo" style="visibility:visible;overflow:hidden">MOBO Game | Cổng thông tin cập nhật GAME</h1>

            
            <?php echo $header; ?>
            

            
            <?php echo $banner; ?>
                
            <?php echo $menu; ?>
            

            <div class="container" id="container">
                <?php echo $content; ?>
            </div>
            
            <div class="clear-box"></div>
            
            <div class="footer">
                 <?php echo $footer; ?>
            </div>

        </div>
    </body>
</html>