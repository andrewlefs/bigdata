<script type="text/javascript">
    setActiveMenu('game');
    setActiveSubMenu('backend-game-add');
</script>

<!--<script type="text/javascript" src="/admin/assets/js/backend/backend.game.input.js"></script>
<script type="text/javascript" src="/admin/assets/js/custom/forms.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery.alerts.js"></script>

<script type="text/javascript" src="/admin/assets/js/custom/elements.js"></script>-->



<style type="text/css">
    .csButton {
        /*background-color:#fe1a00;*/
        background-color:#ccc;
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ddd), color-stop(1, #ccc));
        background:-moz-linear-gradient(center top, #ddd 5%, #ccc 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100');
        -webkit-border-radius:5px;
        -moz-border-radius:5px;
        border-radius:5px;
        text-indent:0;
        border:1px solid #c6c6c6;
        display:inline-block;
        color:#555;
        font-family:Arial;
        font-size:14px;
        font-weight:normal;
        height:32px;
        line-height:32px;
        padding: 0px 10px;
        /*width:130px;*/
        text-decoration:none;
        text-align:center;
        text-shadow:1px 1px 0px #eee;

        -moz-box-shadow:inset 0px 1px 0px 0px #eee;
        -webkit-box-shadow:inset 0px 1px 0px 0px #eee;
        box-shadow:inset 0px 1px 0px 0px #eee;
    }
    .csButton:hover {
        /*color: #8fc800;*/
        background-color:#ce0100;
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ccc), color-stop(1, #ddd) );
        background:-moz-linear-gradient( center top, #ccc 5%, #ddd 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ccc', endColorstr='#ddd');
    }
    .csButton:active {
        position:relative;
        top:1px;
    }

    #image-list > div{
        margin: 20px 0px;
    }
    #image-list-wap > div{
        margin: 20px 0px;
    }
</style>


<div class="pageheader notab" style="border-bottom: none">
    <h1 class="pagetitle">Add/Edit -  APP</h1>
    <span class="pagedesc"></span>

</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
    <div id="info-game" class="subcontent" style="display: block">
        <form class="stdform stdform2" id="frm-add-game" role="form" action="" method="POST" enctype="multipart/form-data">

            <p>
                <label for="Title">Tên APP <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" required="required" placeholder="" id="title" name="name_app" class="mediuminput" value="<?php echo $app[0]['name_app'] . $name_app ?>">
                </span>
            </p>
            <p>
                <label for="code">Mã App <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" required="required" placeholder="" id="title" name="alias_app" class="mediuminput" value="<?php echo $app[0]['alias_app'] ?>">
                </span>
            </p>
			<p>
                <label for="code">Packed Name(Android) <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" required="required" placeholder="" id="title" name="package_name_android" class="mediuminput" value="<?php echo $app[0]['package_name_android'] ?>">
                </span>
            </p>
            <p>
                <label for="code">Link(Android) <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" required="required" placeholder="" id="title" name="dl_android" class="mediuminput" value="<?php echo $app[0]['dl_android'] ?>">
                </span>
            </p>
            <p>
                <label for="code">Packed Name(IOS) <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" required="required" placeholder="" id="title" name="package_name_ios" class="mediuminput" value="<?php echo $app[0]['package_name_ios'] ?>">
                </span>
            </p>
            <p>
                <label for="code">Link(IOS) <span style="color:#ff0000">(*)</span></label>
                <span class="field">
                    <input type="text" required="required" placeholder="" id="title" name="dl_ios" class="mediuminput" value="<?php echo $app[0]['dl_ios'] ?>">
                </span>
            </p>
			<p>
                    <label for="icon">Icon <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                        <input type="text" required="required" placeholder="Click vào để chọn hình" id="icon" name="icon" class="mediuminput" value="<?php echo $app[0]['icon']?>" onclick="openKCFinderByPath('#icon', 'images')" readonly>
                    </span>
			</p>
            <p class="stdformbutton">
                <input id="txt_id" type="hidden" value="<?php echo @$app[0]['id_app'] ?>" name="id">
                <button class="submit radius2" type="submit" id="frm-add-game" name="submit">Add</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
            </p>
        </form>
    </div>



</div>
<script>

    $('#checkAll').on('click', function() {

        $('.selectedId').attr('checked', $(this).is(":checked"));
        if ($(this).is(":checked")) {
            $('.selectedId').parent().addClass('checked');
        } else {
            $('.selectedId').parent().removeClass('checked');
        }
    });

    $('#checkA').on('click', function() {

        $('.selectedI').attr('checked', $(this).is(":checked"));
        if ($(this).is(":checked")) {
            $('.selectedI').parent().addClass('checked');
        } else {
            $('.selectedI').parent().removeClass('checked');
        }
    });
</script>