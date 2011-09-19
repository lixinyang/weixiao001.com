	<div id="right">
		<div id="user_login">
			你好，<span id="user_name"><?php echo $user->display_name?></span><span style="float:right"><a href="/setting/">个人设置</a></span>
			<p>支持的项目：<span id="selected_project_name"><?php echo $project?$project:'未设置';?></span><br/>
			<span style="float:right"><a href="/welcome/logout">退出登录</a></span></p>
		</div>
		<div>
			<p>邀请好友
			<script type="text/javascript" charset="utf-8">
			(function(){
			  var _w = 106 , _h = 24;
			  var param = {
			    url:'http://weixiao001.com/',
			    type:'5',
			    count:'', /**是否显示分享数，1显示(可选)*/
			    appkey:'3382333545', /**您申请的应用appkey,显示分享来源(可选)*/
			    title:'', /**分享的文字内容(可选，默认为所在页面的title)*/
			    pic:'', /**分享图片的路径(可选)*/
			    ralateUid:'2176040087', /**关联用户的UID，分享微博会@该用户(可选)*/
			    rnd:new Date().valueOf()
			  }
			  var temp = [];
			  for( var p in param ){
			    temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
			  }
			  document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://hits.sinajs.cn/A1/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>')
			})()
			</script></p>
		</div>
		<div id="friends_list">
			<?php if (!empty($friends)):?>
			好友列表
			<ul>
				<?php 
				foreach ($friends as $f){
					$you = $this->usermanager->get_by_id($f->you);
					$binding = $this->usermanager->get_binding($you->id , Usermanager::sns_website_sina);
					echo '<li><a href="http://weibo.com/'.$binding->sns_uid.'">'.$you->display_name.'</a></li>';
				}?>
			</ul>
			<?php endif;?>
			<?php if (!empty($fans)):?>
			粉丝列表
			<ul>
				<?php 
				foreach ($fans as $f){
					$you = $this->usermanager->get_by_id($f->me);
					$binding = $this->usermanager->get_binding($you->id , Usermanager::sns_website_sina);
					echo '<li><a href="http://weibo.com/'.$binding->sns_uid.'">'.$you->display_name.'</a></li>';
				}?>
			</ul>
			<?php endif;?>
			<?php if (!empty($invited_users)):?>
			成功邀请用户列表
			<ul>
				<?php 
				foreach ($invited_users as $f){
					$you = $this->usermanager->get_by_id($f->id);
					$binding = $this->usermanager->get_binding($you->id , Usermanager::sns_website_sina);
					echo '<li><a href="http://weibo.com/'.$binding->sns_uid.'">'.$you->display_name.'</a></li>';
				}?>
			</ul>
			<?php endif;?>
		</div>
	</div>
