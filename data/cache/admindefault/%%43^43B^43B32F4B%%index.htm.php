<?php /* Smarty version 2.6.18, created on 2013-01-22 16:48:26
         compiled from index.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['staticUrl']; ?>
js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['staticUrl']; ?>
js/jquery.ui.all.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['staticUrl']; ?>
js/jquery.layout.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['staticUrl']; ?>
js/main.js"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['staticUrl']; ?>
css/default.css" />
<style type="text/css">
body{font:'Courier New',Arial,sans-serif;font-size:13px;}
#leftmenu{font:'Courier New',Arial,sans-serif;font-size:14px;}
</style>
</head>
<body style="overflow: hidden; position: relative; height: 100%; margin: 0px; padding: 0px; border: none;" scroll="no">
<!-- 顶部 -->
<div class="ui-layout-north">
<iframe frameborder="0" id="header" name="header" src="<?php echo $this->_tpl_vars['admin_url']; ?>
?module=index&action=header" scrolling="no" style="height: 45px; visibility: inherit; width: 100%; z-index: 1;"></iframe>
</div>

<!-- 左边 -->
<div class="ui-layout-west">
<iframe frameborder="0" id="menu" name="menu" src="<?php echo $this->_tpl_vars['admin_url']; ?>
?module=index&action=menu" scrolling="auto" style="height: 100%; visibility: inherit; width: 193px; z-index: 1;"></iframe>
</div>

<!-- 右边 -->
<div class="ui-layout-center">
<iframe frameborder="0" id="main" name="main" src="<?php echo $this->_tpl_vars['admin_url']; ?>
?module=index&action=main" scrolling="auto" style="height: 100%; visibility: inherit; width: 100%; z-index: 1;"></iframe></td>
</div>
</body>
</html>