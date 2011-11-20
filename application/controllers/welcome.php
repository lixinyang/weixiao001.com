<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','form'));
		$this->load->model(array('usermanager' , 'project' , 'friend'));
		$this->load->library(array('form_validation','input','sina'));
	}
	
	/**
	 * 
	 * 网站的首页
	 */
	public function index()
	{
		header("Content-Type: text/html; charset=utf-8", true);
		$this->load->view('/common/head', array(
							'title' => '微笑网 - 公益购物',
							'desc' => '微笑网公益购物让每个社区公民在不增加购物花费的同时为慈善事业进行捐赠。请各位笑友邀请更多好友加入社区！'));
		
		if($this->weixiao->is_login())
		{
			$projects = $this->project->all();
			$options = array();
			foreach ($projects as $p) {
				$options[$p->id] = $p->name;
			}
			$me = $this->weixiao->get_cur_user();
			$data = array(
				'user' => $me,
				'sina' => null,
				'qq' => null,
				'projects' => $options,
				'project' => null,
				'friends' => $this->friend->friends($me->id),
				'fans' => $this->friend->fans($me->id),
			);
			$bindings = $this->usermanager->get_binding_by_uid($me->id);
			foreach ($bindings as $sns){
				if($sns->sns_website == UserManager::sns_website_sina) $data['sina'] = $sns;
				if($sns->sns_website == UserManager::sns_website_tqq) $data['qq'] = $sns;
			}
			$pid = $me->selected_project_id;
			if ($pid){
				$data['project'] = $this->project->get($pid)->name;
			}
			$this->load->view('home', $data);
			$this->load->view('/common/right', $data);
		}
		else
		{
			echo '请先<a href="/">登录</a>';
		}
		
		$this->load->view('/common/footer', array('before_end_body' => ''));
	}
	
	/**
	 * 
	 * 退出登录
	 */
	public function logout() {
		$this->weixiao->logout();
		redirect('/');
	}
	
	/**
	 * 
	 * 推荐好友点击回来的链接，形如http://weixiao001.com/welcome/i/100002
	 * @param unknown_type $r
	 */
	public function i($ref = null) {
		//未传ref参数，这是有问题的，但简单的不处理了。
		if (empty($ref)) redirect('/');
		
		set_cookie(Weixiao::INVITE_TOKEN, $ref, 3600*24*365*10);
		redirect('/');
	}
}
?>