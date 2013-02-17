<?php /* Smarty version 2.6.18, created on 2013-01-23 09:55:14
         compiled from menu.htm */ ?>
<html>
<head>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['staticUrl']; ?>
js/jquery-1.6.1.min.js"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['staticUrl']; ?>
css/menu.css" />
<style type="text/css">
body{font:'Courier New',Arial,sans-serif;font-size:13px;}
#leftmenu{font:'Courier New',Arial,sans-serif;font-size:14px;}
</style>
</head>
<body>
<div id="leftmenu">
	<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menuList']):
?>
	<div class="menue">
		<div class="menutit"><?php echo $this->_tpl_vars['menuList']['menuName']; ?>
</div>
		<?php if (! empty ( $this->_tpl_vars['menuList']['childCate'] )): ?>
		<div class="menulist">
			<ul>
				<?php $_from = $this->_tpl_vars['menuList']['childCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menuChild']):
?>
				<?php $this->assign('menuChildModule', $this->_tpl_vars['menuChild']['module']); ?>
				<?php $this->assign('menuChildAction', $this->_tpl_vars['menuChild']['action']); ?>
				<li><a href="<?php echo $this->_tpl_vars['admin_url']; ?>
?module=<?php echo $this->_tpl_vars['menuChildModule']; ?>
&action=<?php echo $this->_tpl_vars['menuChildAction']; ?>
" target="main"><?php echo $this->_tpl_vars['menuChild']['name']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<?php endforeach; endif; unset($_from); ?>
</div>
</body>
</html>