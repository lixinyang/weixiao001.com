	<div id="left">
		<?php echo validation_errors(); ?>
		<?php
		if (!empty($msg)){
		echo '<p><b>'.$msg.'</b></p>';
		}?>
		<p>昵称：<?php echo $user->display_name;?></p>
		<?php 
		echo form_open('/setting/save');
		echo form_label('支持的项目：','project');
		echo form_dropdown('project', $projects, $user->selected_project_id);
		?>
		<br/>（*微笑网默认捐赠给一帮一助学项目）
		<p>新浪微博：<?php echo $sina?'<a href="http://weibo.com/'.$sina->sns_uid.'" target="_blank">'.$sina->sns_display_name.'</a>':'未绑定（<a href="javascript:void(0)">现在绑定</a>）';?></p>
		<p>腾讯微博：<?php echo $qq?$qq->sns_display_name:'未绑定（<a href="javascript:void(0)">现在绑定</a>）';?></p>
		<p><input type="checkbox" name="follow_weibo" <?php echo $user->follow_weibo?'checked="checked"':''?> />关注微笑网官方微博</p>
		<?php 
		//echo form_checkbox('follow_wiebo', 'follow_weibo', $user->follow_weibo);
		//echo form_label('关注微笑网官方微博','follow_weibo');
		//echo '<br/>'; 
		echo form_submit('save', '保存');
		echo form_close();
		?>
	</div>
