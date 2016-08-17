<?php 
    /*

<div class="banner-slide">
    <div class="hb-content">

        <div class="touchslider">
            <div class="touchslider-viewport" style="width:320px; height: 160px;overflow:hidden">
                <div>
                    <?php 
                    foreach ($slide as $val){
                    ?>
                    <a href="/game-detail/<?php echo $val['id_game']?>-<?php echo utf8_to_ascii($val['full_name'])?>.html">
                        <div class="touchslider-item">
                            <img src="<?php echo $val['home_image_wap']?>" width="320px"/>
                            <div class="caption-slide">
                                <img class="pr-img" src="<?php echo $val['logo_game']?>" height="20px"/>
                                <span class="slide-name-game"><?php echo $val['full_name']?></span><br>
                                <span class="slide-name-user"><?php echo number_format($val['number_of_users'])?> người chơi</span>
                            </div>
                        </div>
                    </a>
                    <?php 
                    }
                    ?>
                  </div>
            </div>

            <div class="slide-page">
                <span class="touchslider-nav-item touchslider-nav-item-current"></span>
                <span class="touchslider-nav-item"></span>
                <span class="touchslider-nav-item"></span>
            </div>
        </div>


    </div>
    
</div>


     * 
     */

?>
<?php 
    $controllerName = $this->router->fetch_class();
    $actionName = $this->router->fetch_method();
    $ca = $controllerName.'-'.$actionName;
    if($ca=="newsevent-index"){
        $slide=$this->m_news->get_slide();
        if(empty($slide) === FALSE){
        ?>
            <div style="opacity: 1; display: block; max-width: 640px; margin: 0 auto" id="owl-demo" class="owl-carousel owl-theme">
                <?php foreach ($slide as $key => $val){
                        $target="";
                        if(empty($val['url_news'])===TRUE || $val['url_news']=='')
                            $link = base_url().'news-event-detail/'.$val['id_news'].'-'.utf8_to_ascii($val['title']).'.html';
                        else{
                            $link = $val['url_news'];
                            $target="blank";
                        }
                ?>
                        <div class="owl-item" style="position: relative">
                            <a target="<?php echo $target?>" href="<?php echo $link?>"><img src="<?php echo $val['image_banner']?>" style='width: 100%'></a>
                                <div class="title-slide-home">
                                    <span><a target="<?php echo $target?>" href="<?php echo $link?>"><?php echo ellipsize($val['title'],30)?></a></span>
                                    <a class="news-event" href="<?php echo $link?>" target="<?php echo $target?>">
                                       XEM <img src="/frontend/assets/wap/image/news-banner-arrow.png" width="" style=""/>
                                    </a>
                                </div>
                        </div>
                <?php }?>
            </div>
        <?php   }
    }
    elseif($ca=="newsevent-lists"){
        $arr_id=explode("-", $this->uri->segment(2));
        $id_category = $arr_id[0];
        $slide=$this->m_news->get_news_category($id_category);
        if(empty($slide) === FALSE){
            $sl = $slide['news'];
        ?>
            <div style="opacity: 1; display: block; max-width: 640px; margin: 0 auto" id="owl-demo" class="owl-carousel owl-theme">
                <?php foreach ($sl as $key => $val){ 
                        $target="";
                        if(empty($val['url_news'])===TRUE || $val['url_news']=='')
                            $link = base_url().'news-event-detail/'.$val['id_news'].'-'.utf8_to_ascii($val['title']).'.html';
                        else{
                            $link = $val['url_news'];
                            $target="blank";
                        }
                ?>
                        <div class="owl-item" style="position: relative">
                            <a target="<?php echo $target?>" href="<?php echo $link?>"><img src="<?php echo $val['image_banner']?>" style='width: 100%'></a>
                                <div class="title-slide-home">
                                    <span><a target="<?php echo $target?>" href="<?php echo $link?>"><?php echo ellipsize($val['title'],30)?></a></span>
                                    <a class="news-event" href="<?php echo $link?>" target="<?php echo $target?>">
                                       XEM <img src="/frontend/assets/wap/image/news-banner-arrow.png" width="" style=""/>
                                    </a>
                                </div>
                        </div>
                <?php }?>
            </div>
        <?php   }
    }else if($ca=="newsevent-detail"){
        $arr_id=explode("-", $this->uri->segment(2));
        $id= $arr_id[0];
        $detail=$this->m_news->get_news_id($id);
    ?>
        <div style="opacity: 1; display: block; max-width: 640px; margin: 0 auto" id="owl-demo" class="owl-carousel owl-theme">
            <div class="owl-item" style="position: relative">
                  <img src="<?php echo $detail[0]['image_banner']?>" style='width: 100%'>
            </div>
        </div>
    <?php
    }  else {
            if(empty($slide) === FALSE){

            ?>
            <div style="opacity: 1; display: block; max-width: 640px; margin: 0 auto" id="owl-demo" class="owl-carousel owl-theme">
                    <?php
                        foreach ($slide as $key => $val){ 
                        if($val['home_image_wap'] != ''){
                    ?>
                            <div class="owl-item" style="position: relative">
                                <a href="/game-detail/<?php echo $val['id_game']?>-<?php echo utf8_to_ascii($val['full_name'])?>.html"><img src="<?php echo $val['home_image_wap']?>" style='width: 100%'></a>
                                <div class="title-slide-home">
                                    <a href="/game-detail/<?php echo $val['id_game']?>-<?php echo utf8_to_ascii($val['full_name'])?>.html"><img src="<?php echo $val['logo_game']?>" width="6%" style="margin: 0% 2%; float: left; vertical-align: top"/></a>
                                    <div style="float: left; width: 50%">
                                        <a href="/game-detail/<?php echo $val['id_game']?>-<?php echo utf8_to_ascii($val['full_name'])?>.html"><h3><?php echo strip_tags(word_limiter($val['full_name'],5))?></h3></a>
                                    <?php echo number_format($val['number_of_users'],0,',','.')?> người chơi
                                    </div>
                                    <a href="<?php echo $val['url_download']?>"><img src="/frontend/assets/wap/image/slide-home-download.png" width="35%" style="float: right; vertical-align: middle; margin: 1% 2% 0% 0%; width: 112px;"/></a>
                                </div>
                            </div>
                        <?php } } ?>
            </div>
<?php 
        } 
    }
?>
<script>
    $(function() {
        $('#owl-demo').owlCarousel({
                autoPlay : 3000,
                navigation : false, 
                pagination: false,
                items : 1,
                
                itemsDesktopSmall : [1366, 1],
                itemsTablet : [720, 1], // itemsMobile disabled - inherit from itemsTablet option
                itemsMobile : [640, 1] // itemsMobile disabled - inherit from itemsTablet option
                

                 // Most important owl features
                /*
                items : 5,
                itemsCustom : false,
                itemsDesktop : [1199,4],
                itemsDesktopSmall : [980,3],
                itemsTablet: [768,3],
                itemsTabletSmall: false,
                itemsMobile : [479,3],
                singleItem : false,
                itemsScaleUp : false,

                //Basic Speeds
                slideSpeed : 200,
                paginationSpeed : 800,
                rewindSpeed : 1000,

                //Autoplay
                autoPlay : 3000,
                stopOnHover : false,

                // Navigation
                navigation : false,
                navigationText : ["prev","next"],
                rewindNav : true,
                scrollPerPage : false,
                */

        });
        
         

});

</script>
