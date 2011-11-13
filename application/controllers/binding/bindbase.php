<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once '../librarys/weibooauth.php';
class Bindbase extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('usermanager');
		$this->load->library(array('form_validation','input'));
	}

	/**
	 * 这个方法处理用户登录成功后binding和user之间的逻辑，老牛X了
	 * 
	 */
	protected function post_login($sns_website, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $sns_display_name=null, $token_expire_in=null) {
		$user = $this->weixiao->get_cur_user();
		$binding = $this->usermanager->get_binding_by_sns_uid($sns_website, $sns_uid);

		//sns这个帐号已经绑定过了
		if(!empty($binding))
		{
			if (empty($user)) {//老用户用snsn帐号登录：更新user的最近登录时间、display_name，更新binding的参数, test done
				$user = $this->usermanager->get_by_id($binding->user_id);
				//把新创建的用户放到ci->weixiao里
				$this->weixiao->set_user_token($user->user_token);
				$cur_user = $this->weixiao->get_cur_user();
				$data = array(
					'title'=>'欢迎回来。。。',
					'heading'=>'Hi dear '.$cur_user->display_name.'，欢迎回来！',
					'text'=>'',
					'timeout'=>5000,
					'auto_close'=>true
				);
				$this->load->view('binding/splash', $data);
			}
			elseif ($user->id == $binding->user_id) {//已经绑定的和当前帐号是同一个人，那么只更新一下binding的参数即可，以及user的display_name
				$this->usermanager->update_sns_binding($user->id, $sns_website, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $sns_display_name, $token_expire_in);
				if ($user->display_name != $binding->sns_display_name)
					$this->usermanager->update_user($user->id, $sns_display_name);
				$data = array(
					'title'=>'绑定成功',
					'heading'=>'Hi dear '.$binding->sns_display_name.' 从 '.$binding->sns_website.' 登录成功！',
					'text'=>'',
					'timeout'=>5000,
					'auto_close'=>true
				);
				$this->load->view('binding/splash', $data);
			}
			else {//这里出现问题了，绑定的用户已经和其他用户绑定过了，要提示给当前用户，不对user和binding数据做任何处理,test done
				$tmp_user = $this->usermanager->get_by_id($binding->user_id);
				$data = array(
					'title'=>'绑定失败',
					'heading'=>$binding->sns_website.' 的'.$binding->sns_display_name.' 绑定失败！',
					'text'=>'失败原因：此 '.$binding->sns_website.' 帐号已经绑定给了另一个用户 -- "'.$tmp_user->display_name.'" 。 那也是您的帐号吗？',
					'timeout'=>5000,
					'auto_close'=>false
				);
				$this->load->view('binding/splash', $data);
			}
		}
		else {//这个sns帐号没有绑定过呢，good
			if (empty($user)) { //新用户首次使用sns帐号登录（sns帐号没绑定过，用户也不在登录状态）：那么创建新的binding和user
				//创建用户（同时创建sns_binding）test done
				$inviter_id=$this->weixiao->get_inviter_id();
				$user = $this->usermanager->create_user($sns_website, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $sns_display_name, null, $inviter_id);
				//把新创建的用户放到ci->weixiao里
				$this->weixiao->set_user_token($user->user_token);
				$data = array(
					'title'=>'绑定成功',
					'heading'=>'Hi dear '.$user->display_name.'， 欢迎加入微笑网！',
					'text'=>'现在，您可以随时在微笑网设置捐赠的项目了。谢谢！',
					'timeout'=>5000,
					'auto_close'=>false
				);
				$this->load->view('binding/splash', $data);
			}
			else { //老用户绑定新sns帐号：创建一个新的binding、更新user的display_name
				//这里可能导致一个用户绑上两个人人帐号哦，目前允许这样做, test done
				$binding = $this->usermanager->create_sns_binding($user->id, $sns_website, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $sns_display_name, $token_expire_in);
				if ($user->display_name != $binding->sns_display_name)
					$this->usermanager->update_user($user->id, $sns_display_name);
				$data = array(
					'title'=>'绑定成功',
					'heading'=>'Hi dear '.$binding->sns_display_name.' 从 '.$binding->sns_website.' 绑定成功！',
					'text'=>'',
					'timeout'=>5000,
					'auto_close'=>true
				);
				$this->load->view('binding/splash', $data);
			}
		}
	}
}
?>
