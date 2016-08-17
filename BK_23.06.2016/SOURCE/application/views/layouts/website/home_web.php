<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta name="description" content="Mobo Portal" />
        <meta name="author" content="mecorp.vn" />
        <title>Mobo Portal</title>

        <link rel="stylesheet" href="/frontend/assets/bootstrap/css/bootstrap.min.css" type="text/css" />
        <script type="text/javascript" src="/frontend/assets/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/frontend/assets/bootstrap/js/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="/frontend/assets/bootstrap/js/bootstrap-hover-dropdown.js"></script>
        <link rel="stylesheet" href="/frontend/assets/bootstrap/css/non-responsive.css" type="text/css" />

        <link rel="stylesheet" href="/frontend/assets/css/style.css" type="text/css" />

        
          <!--- slide------------------->
          <!-- Important Owl stylesheet -->
          <link rel="stylesheet" href="/frontend/assets/js/owl-carousel/owl.carousel.css">
          <!-- Default Theme -->
          <link rel="stylesheet" href="/frontend/assets/js/owl-carousel/owl.theme.css">
          <!-- Include js plugin -->
          <script src="/frontend/assets/js/owl-carousel/owl.carousel.js"></script>
        
          

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


        <!--[if IE 9]>
            <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
        <![endif]-->
        <!--[if IE 8]>
            <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
        <![endif]-->
        <!--[if lt IE 9]>
                <script src="../../../css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

    </head>

    <body>
        <div id='header'><?php echo $header_home_web; ?></div>
        <div id='banner'><?php echo $banner_web; ?></div>
        <div id='content'>
            <div class="container">
                <div class="row fix-row">
                    <div class="col-xs-9"><?php echo $content; ?></div>
                    <div class="col-xs-3"><?php echo $rightmenu; ?></div>
                </div>


            </div>
        </div>

        <div id='footer'><?php echo $footer_web; ?></div>


    </body>
</html>
