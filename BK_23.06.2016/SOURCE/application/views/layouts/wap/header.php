<?php 
    $controllerName = $this->router->fetch_class();
    $actionName = $this->router->fetch_method();
    $ca = $controllerName.'-'.$actionName;
?>

<script>
    $(document).ready(function() {
            $.get("/loadgamehot?page=0&offset=100").done(function(data) {
            
            var html = '';
            var arr = JSON.parse(data);
            var d = arr.data;
            if(d.length > 0){
                for(var i=0; i < d.length; i++){
                    html +=     '<div class="class="item"><a href="/game-detail/' + d[i].id_game + '-' + Alias(d[i].full_name) + '.html">' +
                                    '<img class="pr-img" src="' + d[i].logo_game + '" height="25px"/>' +
                                    '<span>' +
                                    d[i].full_name +
                                    '<img class="pr-hot-icon" src="/frontend/assets/wap/image/hot-icon.png" style="float: none; vertical-align: top" />' +
                                    '</span>' +
                                '</a></div>';
                }
            }
            
           
            $("#cross-sale-wap").html(html);
            
            $("#cross-sale-wap").owlCarousel({
                autoPlay : 6000,
                navigation : false, // Show next and prev buttons
                pagination: false,
                slideSpeed : 500,
                paginationSpeed : 400,
                singleItem:true
             });            
           
        });
    });
    
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
<div class="header-bar">
    <?php 
    if($controllerName == 'game' || $controllerName == 'forum'){
    ?>
    <style>
        .header-bar .line-hd {
            border-left: 1px solid #D5D5D5;
            width: 3px;
            height: 100%;
            margin-left: 122px;
            float: left;
            }
    </style>
    <a href="javascript:void(0)" onclick="gamemenu()" style="color: #f26202; font-weight: bold; display: block; position: absolute; top: 11px; left: 5px">Mobo Game <img src="/frontend/assets/wap/image/icon-menu-game.png" height="20px" style="vertical-align:middle"/></a>
    <?php 
    }else{
    ?>
    <a href="/">
        <img class="logo-hd" src="/frontend/assets/wap/image/logo-mobo.png" height="20px"/>
    </a>
    <?php 
    }
    ?>
    <div class="line-hd"></div>
    <div class="pr" id="cross-sale-wap" style="width: 180px">

    </div>
</div>