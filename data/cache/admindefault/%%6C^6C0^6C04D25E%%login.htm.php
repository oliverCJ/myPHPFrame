<?php /* Smarty version 2.6.18, created on 2013-01-17 14:24:49
         compiled from login.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['staticUrl']; ?>
css/login.css" />
<title>WELCOME TO 米兰订餐系统</title>
</head>
<body>
<div class="boxCenter">
	<div class="loginBoxTop">
	<h1>订餐后台</h1>
	</div>
    <div class="loginBox">
    	<form action="" method="post">
    	<?php if ($this->_tpl_vars['msg']): ?>
    		<div id="notice" class="notice">
    			<div>
    			<?php echo $this->_tpl_vars['msg']; ?>

    			<?php if ($this->_tpl_vars['balanceWrongTime']): ?>
    				你还有<?php echo $this->_tpl_vars['balanceWrongTime']; ?>
次登陆机会！
    			<?php endif; ?>
    			</div>
    		</div>
    	<?php endif; ?>
    		<p>
    		<label>用户名：</label>
    		<input type="text" name="username" />
    		</p>
    		<div class="clear"></div>
    		<p>
    		<label>密码：</label>
    		<input type="password" name="password" />
    		</p>
    		<div class="clear"></div>
    		<?php if ($this->_tpl_vars['isVerify']): ?>
    		<p id="verifyCode">
    		<label>验证码：</label>
    		<img src="<?php echo $this->_tpl_vars['admin_url']; ?>
index.php?module=index&action=Verifycode" />
    		<input type="text" name="verifyCode" />
    		</p>
    		<?php endif; ?>
    		<div class="clear"></div>
    		<p id="remberMe">
    			<input type="checkbox" name="remberme" />
    			记住帐号
    		</p>
    		<div class="clear"></div>
    		<p>
    			<input type="hidden" name="menuType" value="login" />
    			<input class="button" type="submit" value="登&nbsp&nbsp录" />
    		</p>
    	</form>
    </div>
</div>
<div class="boxBottom"></div>
</body>
</html>