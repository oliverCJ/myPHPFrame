<?php /* Smarty version 2.6.18, created on 2013-01-22 15:31:57
         compiled from header.htm */ ?>
<html>
<head>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['staticUrl']; ?>
js/jquery-1.6.1.min.js"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['staticUrl']; ?>
css/header.css" />
<style type="text/css">
body{font:'Courier New',Arial,sans-serif;font-size:13px;}
#leftmenu{font:'Courier New',Arial,sans-serif;font-size:14px;}
</style>
</head>
<body>
<div id="logo">
后台LOGO
</div>
<div id="centermenu">
	<div>
	<?php echo $this->_tpl_vars['funnyWords']; ?>

	</div>
</div>

<div id="rightmenu">
	<div id="about">
	<a id="aboutmem" href="javascript:;">food v1.0.12</a>
	</div>
	<div id="logout">
	<a id="logout" href='javascript:;' onclick="jumpUrl('<?php echo $this->_tpl_vars['admin_url']; ?>
?module=index&action=login&menuType=loginout')">登出</a>
	</div>
	<div id="showuser">
		<?php echo $this->_tpl_vars['loginName']; ?>

	</div>
</div>
<script type="text/javascript">
function jumpUrl(url){
	top.location.href=url;
}
$(document).ready(function(){
	
});
</script>
</body>
</html>