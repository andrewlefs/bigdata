<?php 
    $controllerName = $this->router->fetch_class();
    $actionName = $this->router->fetch_method();
    $ca = $controllerName.'-'.$actionName;
?>

<div class="row">
    <div class="col-xs-12" style='width: 248px; padding-left: 11px'>
        <?php 
            if($controllerName=='newsevent'){
                $methodName = $this->router->fetch_method();
                if($methodName=='detail'){
                    $idnews = explode("-", $this->uri->segment(2));
                    $id_news = $idnews[0];
                    $detail = $this->m_news->get_news_id($id_news);
        ?>
                    <div class="details-news-qr" align="center">
                        <div class="detail-game-info" align="left">
                            <img src="<?php echo $detail[0]['logo_game']?>" width='70px'>
                            <a href="<?php echo base_url().'game-detail/'.$detail[0]['id_game'].'-'.utf8_to_ascii($detail[0]['full_name']).'.html'?>"><?php echo $detail[0]['full_name']?></a>
                            <div class="detail-game-playnum"><?php echo number_format($detail[0]['number_of_users'], 0, ',', '.')?> người chơi</div>
                         </div>
                        <div style="width: 219px; height: 219px; border: #dbdbdb solid 1px; position: relative; overflow: hidden">
                         <img src="http://chart.apis.google.com/chart?chs=280x280&cht=qr&chl=<?php echo urlencode($detail[0]['url_download'])?>" style='border: #dbdbdb solid 1px; border-radius: 5px; position: absolute; top: -33px;left: -33px;'>     
                        </div>
                         <div class="detail-qr-code">Bạn có thể tải bằng QR Code</div>
                         <a href='<?php echo $detail[0]['url_download']?>' class='button-download-detail-2'></a>
                    </div>
        <?php 
                } 
            }
        ?>
        <div class='hot-line'>
            19006611
            <p>Để được hỗ trợ nhanh 24/24</p>
        </div>
        
        <?php 
        if($ca == 'game-detail' || $ca == 'forum-index'){
        ?>
        
        <div class='right-box-event'>
            <h3>TOP GAME HOT</h3>
            
            <?php
            if(empty($top_game_hot) === FALSE){
            ?>
            <?php
            foreach($top_game_hot as $val){
            ?>
            <div class="box-item-event" style='padding-bottom: 10px'>
                <div class="col-xs-4" style='padding-left: 10px'>
                    <a href='/game-detail/<?php echo $val['id_game']?>-<?php echo utf8_to_ascii($val['full_name'])?>.html' class='event-game'><img src="<?php echo $val['logo_game']?>" width='70px'></a>
                </div>
                <div class="col-xs-8" style='padding: 0px; margin-bottom: 5px;'>
                    <a href='/game-detail/<?php echo $val['id_game']?>-<?php echo utf8_to_ascii($val['full_name'])?>.html' class='event-game'><?php echo $val['full_name']?></a>
                    <p><?php echo number_format($val['number_of_users'], 0, ',', '.')?> người chơi</p>
                </div>
                <div style='clear: both'></div>
            </div>
            
            <?php
            }
            ?>
            
            <?php
            }
            ?>
                       
            
        </div>
            
        <?php 
        }else{  
        ?>
        <div class='right-box-event'>
            <h3>TIN TỨC SỰ KIỆN</h3>
            
            <?php
            if(empty($news) === FALSE){
            ?>
            <?php
            foreach($news as $val){
            ?>
            <div class="box-item-event">
                <div class="col-xs-2 rm-img-news">
                   <img src="<?php echo $val['logo_game']?>" width='16px'>
                </div>
                <div class="col-xs-10" style='padding: 0px; margin-bottom: 5px;'>
                    <a href='/news-event-detail/<?php echo $val['id_news']?>-<?php echo utf8_to_ascii($val['title'])?>.html' class='event-title'><?php echo ucfirst($val['title'])?></a>
                    <p><?php echo $val['create_time']?> - <a href='/game-detail/<?php echo $val['id_game']?>-<?php echo utf8_to_ascii($val['full_name'])?>.html' class='event-game'><?php echo $val['full_name']?></a></p> 
                </div>
                <div style='clear: both'></div>
            </div>
            
            <?php
            }
            ?>
            
            <?php
            }
            ?>
                       
            
        </div>
        <?php 
        }
        ?>
        
        
        <div class='ads-image'><a href=''><img src="/frontend/assets/images/ads-image.png" width='100%'></a></div>
        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fmobo.vn&amp;width=248&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=902809546403284" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:290px; width: 248px; margin-top: 20px" allowTransparency="true"></iframe>
    </div>
</div>