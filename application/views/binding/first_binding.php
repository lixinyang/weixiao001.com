<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>欢迎加入</title>
</head>
<body>
<h1>hi <?php echo $user->display_name; ?>! 欢迎加入微笑网！</h1>
<?php echo validation_errors(); ?>
<?php 
echo form_open('/binding/email/login');
echo form_label('Email地址','email');
echo form_input('email', 'email@example.com');
echo form_label('密码','passwd');
echo form_password('passwd');
echo form_submit('submit', '登录');
echo form_close();
?>

<script language="JavaScript" type="text/javascript">
function close_myself()
{
	window.opener.location.href = window.opener.location.href;
	window.close();
}
</script>
<a href="javascript:void(0)" onclick="close_myself()">完成</a>
</body>