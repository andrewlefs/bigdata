<script type="text/javascript">
    $(function(){
        if("<?php echo $this->router->fetch_class()?>"=="newsevent"){
            $(".tab-menu").find("a").attr("id"," ");
            $(".tab-menu").eq(1).find("a").attr("id","active");
        }
    });
</script>
<div class="menu-bar">
    <div class="menu-box">
        <div class="tab-menu">
            <a id="active" href="<?php echo base_url()?>">CỔNG GAME</a>
        </div>
        <div class="tab-menu border-left-right">
            <a href="/news-event">TIN TỨC</a>
        </div>
        <div class="tab-menu">
            <a href="/forum">DIỄN ĐÀN</a>
        </div>
    </div>
</div>