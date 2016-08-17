<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="description" content="Admin Panel" />
<meta name="author" content="mecorp.vn" />
<title>Me | AdminCP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Me | AdminCP</title>

<link rel="stylesheet" href="/admin/assets/css/style.default.css" type="text/css" />
<script type="text/javascript" src="/admin/assets/js/plugins/jquery-1.8.3.min.js"></script>

<!--<script type="text/javascript" src="/layout/backend/assets/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>-->
<script type="text/javascript" src="/admin/assets/js/custom/general.js"></script>

<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="../../../css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<link rel="stylesheet" href="/admin/assets/css/custom.css">
<link rel="stylesheet" href="/admin/assets/libraries/ui/themes/base/jquery.ui.theme.css" type="text/css" />

<script src="/admin/assets/js/backend/backend.jquery.1.1.9.js"></script>

<!-- Jqwidget----------->

<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqx-all.js"></script>
<script type="text/javascript" src="/admin/assets/libraries/jqwidgets/jqx.language.js"></script>
<link rel="stylesheet" href="/admin/assets/libraries/jqwidgets/styles/jqx.base.css" type="text/css" />
<!--<link rel="stylesheet" href="/templates/backend/assets/libraries/jqwidgets/styles/jqx.summer.css" type="text/css" />-->
<link rel="stylesheet" href="/admin/assets/libraries/jqwidgets/styles/jqx.office.css" type="text/css" />
<!--<link rel="stylesheet" href="/layout/backend/assets/libraries/jqwidgets/styles/jqx.metro.css" type="text/css" />-->


<link rel="stylesheet" href="/admin/assets/libraries/ui/themes/base/jquery.ui.theme.css" type="text/css" />

<!--
<link rel="stylesheet" href='/layout/backend/assets/css/reveal.css'>
<script type="text/javascript" src="/layout/backend/assets/js/jquery.reveal.js"></script>
-->


<script type="text/javascript">
    base_url = "{base_url}";
    PENDING = false;
    THEME = 'metro';
	
	function reload(){
		if (typeof BACKEND.resetGrid == 'function') { 
			setTimeout(function(){
			BACKEND.resetGrid();
			},500);
		}		
	}
</script>


</head>

<body class="withvernav">

<div class="bodywrapper">
    <div class="topheader">
	<?php echo $breakcrumb; ?>
    </div><!--topheader-->
    
    
    <div class="header">      
    </div><!--header-->
    
    <div class="vernav2 iconmenu">
	<?php echo $leftmenu;?>
    	
    </div><!--leftmenu-->
        
    <div class="centercontent">
	<?php echo $content; ?>
    </div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>
</html>
