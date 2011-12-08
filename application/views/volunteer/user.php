<div id="content">
<?php echo $split_page; ?>
<table>
<tr>
<th>用户ID</th>
<th>用户名称</th>
<th>注册时间</th>
<th>最近访问时间</th>
<th>最近访问IP</th>
<th>新浪头像</th>
<th>地区</th>
<th>性别</th>
<th>新浪认证</th>
<th>新浪注册时间</th>
</tr>
<?php foreach ($users as $user){
	$binding = $this->usermanager->get_binding($user->id , Usermanager::sns_website_sina);
?>
<tr id='user-<?php echo $user->id;?>'>
<td><?php echo $user->id;?></td>
<td><?php echo $user->display_name;?></td>
<td><?php echo $user->regist_time;?></td>
<td><?php echo $user->last_login_time;?></td>
<td><?php echo $user->last_login_ip;?></td>
<td><a href="http://weibo.com/<?php echo $binding->sns_uid;?>"><img src="<?php echo $binding->profile_image_url;?>" /></a></td>
<td><?php echo $binding->location;?></td>
<td><?php echo $binding->gender;?></td>
<td><?php echo $binding->verified;?></td>
<td><?php echo $binding->created_at;?></td>
</tr>
<?php }?>
</table>
<?php echo $split_page; ?>
<p>*注意保护用户隐私*</p>
</div>