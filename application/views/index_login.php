<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>首页 - 登录后</title>
</head>
<body>
<?php 
$space = null;
function print_list($list) {
	$str = '';
	global $space;
	if ($space==null) $space = '';
	else $space .= '&nbsp;&nbsp;';
	foreach ($list as $key=>$val){
		if (!is_array($val) && !is_object($val)) {
			$str .= $space.$key.':'.$val.'<br/>';
		}
		else{
			$str .= $space.$key.':<br/>';
			$str .= print_list($val);
		} 
	}
	return  $str;
}
?>
<h1>Hi Dear, <?php echo $user->display_name; ?>!</h1>
<p>
<?php 
if (empty($user->email)) {
	$atts = array(
	              'width'      => '600',
	              'height'     => '400',
	              'scrollbars' => 'yes',
	              'status'     => 'yes',
	              'resizable'  => 'yes',
				  'title'	   => '绑定Email，多一种登录方式',
	              'screenx'    => '100',
	              'screeny'    => '100'
	            );
	echo anchor_popup('binding/email/bind', '绑定Email', $atts);
}
else {
	echo '绑定的Email：'.$user->email;
}
echo nbs(2);
echo anchor('index/logout', '退出登录'); ?>
</p>
<table border='1'>
<tr>
<th>项目</th><th>新浪微博</th><th>QQ连接</th><th>腾讯微博</th><th>人人网</th><th>开心网</th>
</tr>
<tr>
<td>是否绑定</td><?php 
$atts = array(
              'width'      => '600',
              'height'     => '400',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '100',
              'screeny'    => '100'
            );
?>
<td><?php echo empty($binding_sina)?anchor_popup('binding/sina/show','现在绑定',$atts):'已绑定'; ?></td>
<td><?php echo empty($binding_qq)?anchor_popup('binding/qq/show','现在绑定',$atts):'已绑定'; ?></td>
<td><?php echo empty($binding_tqq)?anchor_popup('binding/tqq/show','现在绑定',$atts):'已绑定'; ?></td>
<td><?php echo empty($binding_renren)?anchor_popup('binding/renren/show','现在绑定',$atts):'已绑定'; ?></td>
<td>建设中。。</td>
</tr>
<tr>
<td>Data in Binding Table</td>
<td><?php echo empty($binding_sina)?'无数据':print_list($binding_sina); ?></td>
<td><?php echo empty($binding_qq)?'无数据':print_list($binding_qq); ?></td>
<td><?php echo empty($binding_tqq)?'无数据':print_list($binding_tqq); ?></td>
<td><?php echo empty($binding_renren)?'无数据':print_list($binding_renren); ?></td>
<td>建设中。。</td>
</tr>
<tr>
<td>Data on sns site</td>
<td><?php echo empty($sina)?'无数据':print_list($sina); ?></td>
<td><?php echo empty($qq)?'无数据':print_list($qq); ?></td>
<td><?php echo empty($tqq)?'无数据':print_list($tqq); ?></td>
<td><?php echo empty($renren)?'无数据':print_list($renren); ?></td>
<td>建设中。。</td>
</tr>
<tr>
<td>好友数据</td>
<td><?php echo empty($friends_sina)?'无数据':print_list($friends_sina); ?></td>
<td><?php echo empty($friends_qq)?'无数据':print_list($friends_qq); ?></td>
<td><?php echo empty($friends_tqq)?'无数据':print_list($friends_tqq); ?></td>
<td><?php echo empty($friends_renren)?'无数据':print_list($friends_renren); ?></td>
<td>建设中。。</td>
</tr>
</table>
</body>