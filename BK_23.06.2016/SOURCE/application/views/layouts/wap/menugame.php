<script src="/frontend/assets/js/jquery.formatCurrency-1.4.0.pack.js" type="text/javascript"></script>
<script src="/frontend/assets/js/jquery.formatCurrency.vi-VN.js" type="text/javascript"></script>
<script src="/frontend/assets/wap/js/script_game_menu.js"></script>
<script>
    function quaylai(){
        $('#game-menu').slideUp('slow');                
        $('#wapper').slideDown();
    }
    function gamemenu(){
        $('#wapper').slideUp('slow');                
        $('#game-menu').slideDown();
    }
     $.get("/loadgamemenu").done(function(d) {
           var da = JSON.parse(d);
           var data = da.data;
           var html = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">';
               for(var i = 0; i < data.length; i++){
                    var plat = $.parseJSON(data[i].platform);
                    var pla = '';
                    for(var j=0; j < plat.length; j++){
                        
                        pla += '<img src="/frontend/assets/images/suport-' + plat[j].toLowerCase() + '.png">&nbsp;';
                    }           
                     html += '<tr>'+
                                '<td width="75px" class="td-format"><a href="/game-detail/' + data[i].id_game + '-' + GAMEMENU.Alias(data[i].full_name) + '.html"><img src="'+data[i].logo_game+'" style="max-width: 100%"></a></td>'+
                                '<td class="td-format"><a href="/game-detail/' + data[i].id_game + '-' + GAMEMENU.Alias(data[i].full_name) + '.html" style="color: #585858">'+
                                    '<p class="name">'+GAMEMENU.trim_words(data[i].full_name,5)+'</p>'+
                                    '<p class="user"><spans class="format-number">'+data[i].number_of_users+'</spans> người chơi</p>'+
                                    '<p>'+
                                       pla +
                                    '</p>'+
                                '</a></td>'+
                                '<td width="80" class="td-format"><a href="'+data[i].url_download+'"><img src="'+data[i].play_img+'" width="70"></a></td>'+
                            '</tr>';
                   
                   
                   

                }
                
                html += '</table>';
                $('#all-game-menu').html(html);
                $('.format-number').formatCurrency({
                    roundToDecimalPlace: 0,
                    symbol: '',
                    positiveFormat: '%n',
                    negativeFormat: '-%n',
                    decimalSymbol: ',',
                    digitGroupSymbol: '.',
                    groupDigits: true
                });
            
          
           
        });
</script>
        
 <div id="game-menu" style="display: none">
        <div class="menu-game" style="position: relative">
            <a href="javascript:void(0)" onclick="quaylai()" class="quaylai"><img src="/frontend/assets/wap/image/back.png" width="9px" style="vertical-align: -2px">&nbsp;&nbsp;Quay lại</a>
            <a href="/" class="moboportal">Mobo Portal&nbsp;&nbsp;<img src="/frontend/assets/wap/image/next.png" width="9px" style="vertical-align: -2px"></a>
        </div>
        <div class="main">
            <div class="container-wapper" id="all-game-menu">
                
              
               
            </div>
        </div>
    </div>