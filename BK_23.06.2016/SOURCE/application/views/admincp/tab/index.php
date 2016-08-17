<script type="text/javascript" src="/admin/assets/js/backend/backend.tab.js"></script>


<div class="pageheader notab">
    <h1 class="pagetitle">Danh sách Tab<?php if(!empty($name_app)) echo " của ".$name_app; ?></h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<div id="jqxgrid"></div>				
</div><!--contentwrapper-->
<script type="text/javascript">
	setActiveMenu('tab');
        setActiveSubMenu('backend-tab-index');
        
        var users = <?php echo json_encode($users)?>;
</script>
