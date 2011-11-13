<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title><?php echo empty($title)?'登录完成':$title; ?></title>
</head>
<body>
<script language="JavaScript" type="text/javascript">
function close_myself()
{
	window.opener.location.href = window.opener.location.href;
	window.close();
}
<?php 
if(empty($timeout)) $timeout = 5000;
if(!isset($auto_close)) $auto_close = true;
if($auto_close):
?>
window.setTimeout(close_myself, <?php echo $timeout; ?>);
<?php endif;?>
</script>
<h1><?php echo empty($heading)?'登录完成':$heading; ?></h1>
<p><?php echo empty($text)?'':$text; ?></p>
<?php if($auto_close):?>
<p><?php echo $timeout/1000; ?>秒后窗口自动关闭。。。</p>
<?php endif;?>
<a href="javascript:void(0)" onclick="close_myself()">立即关闭</a></p>
</body>