<script type="text/javascript">
    setActiveMenu('tab');
    setActiveSubMenu('backend-tab-add');
</script>
<!--<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>-->
<script type="text/javascript" src="/admin/assets/js/plugins/colorpicker.js"></script>
<script type="text/javascript" src="/admin/assets/js/backend/backend.tab.input.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery.jgrowl.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery.alerts.js"></script>
<script type="text/javascript" src="/admin/assets/js/custom/elements.js"></script>
<style>
.fileinput .thumbnail > img {
    display: block;
}
.thumbnail > img {
    display: block;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    max-width: 100%;
}
div.uploader {
    cursor: default;
    left: 260px;
    overflow: hidden;
    position: absolute;
    top: -50px;
}
</style>
<div class="pageheader notab">
	<h1 class="pagetitle">Add TAB</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<form class="stdform stdform2" id="frm-add-tab" role="form" action="" method="POST" enctype="multipart/form-data">
				
		<p>
			<label for="Tên Tab">Title <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" required="required" placeholder="" id="title" name="full_name" class="mediuminput" value="<?php echo @$data['full_name']?>">
			</span>
		</p>
                
                
               <p> 
                <div style="border: #ddd solid 1px">
			<label for="URL">APP <span style="color:#ff0000">(*)</span></label>
			<span class="field">
                                <div id="jqxDropdownlistApp" name="id_app"></div>
                                <div id="game_name" style="color: #ff0000"></div>
			</span>
		</div>
            </p>
                <p>
			<label for="URL">URL <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" required="required" placeholder="" id="title" name="url" class="mediuminput" value="<?php echo @$data['url']?>">
			</span>
		</p>
		<p>
                    <label for="color">Color</label>
                    <span class="field">
                            <input type="text" placeholder="" id="colorpicker2" name="color" class="smallinput" value="<?php echo @$data['style']['color']?>">
                            <span class="colorselector" id="colorSelector">
                                	<span style="background-color: rgb(110, 75, 101);"></span>
                             </span>
                    </span>
		</p>	
		<p>
            <label for="color">Background Tab</label>
            <span class="field">
            <input type="text" placeholder="" id="colorbgtab" name="bgtab" class="smallinput" value="<?php echo @$data['style']['bgtab']?>">
            <span class="colorselector" id="bgtab">
            <span style="background-color: rgb(110, 75, 101);"></span>
            </span>
            </span>
        </p>   	
		<p>
            <label for="color">Background Tab Active</label>
            <span class="field">
            <input type="text" placeholder="" id="colorbgtabactive" name="bgtabactive" class="smallinput" value="<?php echo @$data['style']['bgtabactive']?>">
            <span class="colorselector" id="bgtabactive">
            <span style="background-color: rgb(110, 75, 101);"></span>
            </span>
            </span>
        </p>		
		<p>
                    <label for="color">Color Header</label>
                    <span class="field">
                            <input type="text" placeholder="" id="colorpicker2header" name="header" class="smallinput" value="<?php echo @$data['style']['header']?>">
                            <span class="colorselector" id="colorSelectorHeader">
                                	<span style="background-color: rgb(110, 75, 101);"></span>
                             </span>
                    </span>
		</p>		
		<p>
                    <label for="color">Color Tab Active</label>
                    <span class="field">
                            <input type="text" placeholder="" id="colorpicker2Active" name="color_tab_active" class="smallinput" value="<?php echo @$data['style']['color_tab_active']?>">
                            <span class="colorselector" id="colorSelectorActive">
                                	<span style="background-color: rgb(110, 75, 101);"></span>
                             </span>
                    </span>
		</p>		
		
		<p>
                    <label for="icon">Icon <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                        <input type="text" required="required" placeholder="Click vào để chọn hình" id="icon" name="icon" class="mediuminput" value="<?php echo @$data['icon']?>" onclick="openKCFinderByPath('#icon', 'images')" readonly>
                    </span>
		</p>
		<p>
                    <label for="icon">Icon Tab Active <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                        <input type="text" required="required" placeholder="Click vào để chọn hình" id="icon_tab_active" name="icon_tab_active" class="mediuminput" value="<?php echo @$data['icon_tab_active']?>" onclick="openKCFinderByPath('#icon_tab_active', 'images')" readonly>
                    </span>
		</p>
		<p>
			<label for="order">Order</label>
			<span class="field">
				<input type="text" placeholder="" id="title" name="order" class="mediuminput" value="<?php echo @$data['order']?>">
			</span>
		</p>		
		<p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_tab']?>" name="id">
                        <button class="submit radius2" type="submit" name="submit">Add</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
		</p>
		
	</form>				
</div><!--contentwrapper-->

<script>
    var List_app = <?php echo json_encode(@$list_app)?>;
    var APP = '<?php echo @$name_app?>';
</script>