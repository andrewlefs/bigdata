<?php
    $controllerName = $this->router->fetch_class();
    $actionName = $this->router->fetch_method();
    $ca = $controllerName.'-'.$actionName;
    
    
    $arrMenu = array();

    $arrMenu['home']['link'] = '/';
    $arrMenu['home']['name'] = 'Trang chủ';

    $arrMenu['forum']['link'] = '/forum';
    $arrMenu['forum']['name'] = 'Diễn đàn';

    $arrMenu['newsevent']['link'] = '/news-event';
    $arrMenu['newsevent']['name'] = 'Tin tức';
?>

<script>
    //$(document).ready(function() {
            $.get("/loadgamehot?page=0&offset=100").done(function(data) {
            
            var html = '';
            var arr = JSON.parse(data);
            var d = arr.data;
            if(d.length > 0){
                for(var i=0; i < d.length; i++){
                    html += '<div class="item"><a href="/game-detail/' + d[i].id_game + '-' + Alias(d[i].full_name) + '.html"><img src="' + d[i].logo_game + '" width="20px">&nbsp;' + d[i].full_name + '</a></div>';
                }
            }
            
            $("#cross-sale").html(html);
            
             $("#cross-sale").owlCarousel({
                autoPlay : 6000,
                navigation : false, // Show next and prev buttons
                pagination: false,
                slideSpeed : 500,
                paginationSpeed : 400,
                singleItem:true
             });            
           
        });
    //});
    
    
     function Alias(aa){
			as = aa.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ.+/g,"e");
			as= as.replace(/%/g,""); 
			as = as.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ.+/g,"a");
			as = as.replace(/ì|í|ị|ỉ|ĩ/g,"i");
			as = as.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ.+/g,"o");
			as = as.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
			as = as.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
			as = as.replace(/đ/g,"d");
			as = as.replace(/ /g,"-");
			as = as.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ.+/g,"e");
			as = as.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ.+/g,"a");
			as = as.replace(/Ì|Í|Ị|Ỉ|Ĩ/g,"i");
			as = as.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ.+/g,"o");
			as = as.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g,"u");
			as = as.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g,"y");
			as = as.replace(/Đ/g,"d");
			as = as.replace(/^\A-Z/g,"d");

       /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
		   as= as.replace(/-+-/g,""); //thay thế 2- thành 1- 
		   as= as.replace(/^\-+|\-+$/g,""); 
		   as= as.replace(/%/g,""); 
		   as = as.toLowerCase();
		   
		   return as;
	}

    
</script>

<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container" style="padding: 0px !important">
       
        <div class="navbar-collapse collapse">
          <?php 
          if(($controllerName == 'game' and $actionName != "index") || $controllerName == 'forum'){
          ?>
          <a href="/" class="top-logo"><img src="/frontend/assets/images/top-logo.png"></a>
          <?php 
          }
          ?>
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">DANH SÁCH GAME <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php
                foreach($all_game as $val){
                ?>
                <li><a href="/game-detail/<?php echo $val['id_game']?>-<?php echo utf8_to_ascii($val['full_name'])?>.html"><img src="<?php echo $val['logo_game']?>" width='20px' onerror="this.src='/frontend/assets/images/no-logo.png';">&nbsp;<?php echo $val['full_name']?></a></li>
                <?php
                }
                ?>
                
              </ul>
            </li>
          </ul>
          <i class='munu-top-line'></i>
          <div id="cross-sale" class="owl-carousel owl-theme"></div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="https://id.mobo.vn/step1.html">Đăng ký</a></li>
            <li><a href="/">Đăng nhập</a></li>
            <!--<li><a href="/authorize?act=login">Đăng nhập</a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    <?php
    if($ca == 'game-detail'){
    ?>
    
    <div style='height: 300px'></div>

    <?php 
    }else if($ca == 'forum-index'){
    ?>
    <div class="container" style="padding: 0 0 18px !important; width: 1060px;">
    <a href="/forum"><img src="/frontend/assets/images/forum-logo.png"></a>
    
    <div class="ads-forum"><a href="/"><img src="/frontend/assets/images/ads-forum.png"></a></div>
        
    </div>
    <?php
    }else{
    ?>
    <div class="container header-menu">
        <div class="col-xs-2"><a href='/'><img src="/frontend/assets/images/logo-home.png"></a></div>
        <div class="col-xs-6">
        <ul class='menu'>
                     
            <?php 
                foreach ($arrMenu as $key => $val){
                    if($key == $controllerName){
                        $cls = 'active';
                    }  else {
                        $cls = '';
                    }
            ?>
                <li><a href='<?php echo $val['link']?>' class='<?php echo $cls?>'><?php echo $val['name']?></a></li>
            <?php 
            }
            ?>
            
        </ul>
        </div>
        <div class="col-xs-4">
            <input type='text' name='search' id="search" value="<?php echo htmlspecialchars(@$_GET['p'])?>" onkeypress="clickEnter(event);" placeholder='Bạn muốn tìm...' class='txt-search'>
            <div class='button-search' onclick="search()"></div>
        </div>
        <div style='clear: both'></div>
            
    </div>
    <script>
        function search(){
            var v = $('#search').val();
            window.location.href = '/tim-kiem.html?p='+v;
        }
        function clickEnter(e){
		var entertext = (e.which) ? e.which : e.keyCode
		if (entertext == 13)
		{
                    e.preventDefault();
                    $( ".button-search" ).focus();
                    search()
		}
	}
    </script>

    <?php
    if($controllerName == 'game' || $controllerName == 'newsevent' || $controllerName == 'policy'){            
    ?>
    <div class="container">
    <hr style='margin: 0px'>
    </div>
    <?php
    }
    ?>

    <?php } ?>


    