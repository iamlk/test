<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<title>登录 - 四海网</title>
<meta name="robots" content="nofollow" />
<link rel="stylesheet" type="text/css" href="/css/base.css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<style type="text/css">
body{background:#FFF;min-width:inherit;}
.login1{padding:15px;}
.login1 h2{font-size:14px;font-weight:bold;border-bottom:1px dashed #DBDBDB;line-height:25px;}
.login-form{padding:8px 0 0 50px;overflow:hidden;}
.login-form p{padding:5px 0;overflow:hidden;}
.login-form p label{display:inline-block;width:40px;color:#666;}
.login-form p.nolabel{padding-left:40px;}
.login-form .zyxbtn3{width:60px;}
#username,#password{width:170px;}
.error{color:#F00;margin-left:15px;}
</style>
</head>

<body>
<form action="<?php echo $this->createUrl('site/popLogin') ?>" name="poplogin" id="poplogin" method="post">
<div class="login1">
	<h2>快速登录</h2>
	<div class="login-form">
		<p>
			<label for="username">账户：</label><input type="text" name="username" id="username" class="zyx-ipt" data-default="请输入账户" />
		</p>
		<p>
			<label for="password">密码：</label><input type="password" name="password" id="password" class="zyx-ipt" />
		</p>
		<p class="nolabel">
            <input id="login" type="submit" value="登录" class="zyxbtn3" />
			<span class="error" id="error"><?php echo $error ?></span>
		</p>
		<p class="nolabel">
			<a href="<?php echo $this->createUrl('findpwd/index') ?>" target="_blank">忘记密码？</a> |
			<a href="<?php echo $this->createUrl('site/signup') ?>" target="_blank">新用户注册</a>
		</p>
	</div>
</div>
</form>
<script type="text/javascript">
$(function(){
	var u = $('#username');
	var p = $('#password');
	var err = $('#error');

	var ck_u = $.cookie('username');
	if(ck_u){
		u.val(ck_u);
		p.focus();
	}else{
		u.focus();
	}
	$('#poplogin').submit(function(){
		if($.trim(u.val()) == ''){
			err.html('请输入账户');
			u.focus();
			return false;
		}
		if($.trim(p.val()) == ''){
			err.html('请输入密码');
			p.focus();
			return false;
		}
		$.cookie('username' , u.val() , {expires:365});
	});
});
</script>
</body>
</html>
