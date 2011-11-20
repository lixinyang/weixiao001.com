<div id="content">
<p>
<?php if(!empty($msg)) echo '<h3>'.$msg.'</h3>';?>
导入京东订单
<form action="/volunteer/jingdong/add" method="post">
<textarea rows="8" cols="100" name="text">在这里粘贴入从京东后台“结算中心”->“业绩报表”中拷贝的内容。</textarea><br/>
<input type="submit" value="现 在 提 交" />
</form>
</p>
<table>
<tr>
<th>京东订单号</th>
<th>下单时间</th>
<th>处理时间</th>
<th>订单状态</th>
<th>订单金额（元）</th>
<th>返点金额（元）</th>
</tr>
<?php foreach ($orders as $order){
?>
<tr id='user-<?php echo $user->id;?>'>
<td><?php echo $order->order_no;?></td>
<td><?php echo $order->order_create_time;?></td>
<td><?php echo $order->order_process_time;?></td>
<td><?php echo $order->status;?></td>
<td><?php echo $order->order_money;?></td>
<td><?php echo $order->commision;?></td>
</tr>
<?php }?>
</table>
</div>