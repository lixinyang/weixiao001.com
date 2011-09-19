<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo empty($title)?'微笑网':$title;?></title>
<?php if (!empty($desc)):?>
<meta name="description" content="><?php echo $desc;?>" />
<?php endif;?>
<link href="/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/weixiao.js"></script>
</head>
<body>
<div id="header">
	<a href="/"><h1>微笑网公益购物</h1></a>
	<h2>你购物，我们捐款，公益很简单 </h2>
</div>
<div id="menu">
	<ul>
		<li><a href="/">首页</a></li>
		<li><a href="/wp/gongyi/">公益项目</a></li>
		<li><a href="/wp/zhangmu/">账目公示</a></li>
		<li><a href="/order/all/">近期订单</a></li>
	</ul>
</div>
<div id="content">
