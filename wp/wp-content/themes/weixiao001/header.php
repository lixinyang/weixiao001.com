<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php bloginfo('name'); ?>- <?php bloginfo('description'); ?> <?php wp_title(); ?></title>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
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
