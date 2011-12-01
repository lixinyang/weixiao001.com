<?php echo $split_page; ?>
<table>
<tr>
<th>商家名称</th>
<th>订单号</th>
<th>下单时间</th>
<th>订单状态</th>
<th>预计捐赠（元）</th>
<th>微笑网用户名</th>
</tr>
<?php foreach ($orders as $order){
$status = $order->status;
if($status == 'A') $status = '成功订单';
if($status == 'R') $status = '未确认';
if($status == 'F') $status = '无效订单';
$user = $order->user_id;
if(!empty($user)) {
	$sns = $this->usermanager->get_binding($user, UserManager::sns_website_sina);
	$user = $this->usermanager->get_by_id($user);
	$user_string = '';
}
if(empty($user)) $user_string = '--';
elseif (empty($sns)) $user_string = $user->display_name;
else $user_string = '<a href="http://weibo.com/u/'.$sns->sns_uid.'" target="_blank">'.$user->display_name.'</a>';
?>
<tr id='order-<?php echo $order->idwx_orders;?>'>
<td><?php echo $this->weixiao->get_merchant_name($order->action_id);?></td>
<td><?php echo $order->order_no;?></td>
<td><?php echo $order->order_time;?></td>
<td><?php echo $status;?></td>
<td><?php echo $order->commision;?></td>
<td><?php echo $user_string;?></td>
</tr>
<?php }?>
</table>
<?php echo $split_page; ?>
<p>点此查看<a href="http://weixiao001.com/wp/faq/dingdan-zhuangtai/">订单状态说明</a></p>
<p>*若您的订单不在此表中请将“<em>订单号、订单金额、微笑网用户名</em>”三项发送到weixiao001.com@gmail.com</p>
