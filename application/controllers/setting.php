<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends CI_Controller
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
	 * 个人设置的显示页
	 */
	public function index($msg=null)
	{
		$this->load->view('/common/head', array('title' => '微笑网 | 个人设置'));
		
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
				'msg' => $msg,
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
			$data["invited_users"] = $this->usermanager->find_invited_users($me->id);
			$this->load->view('setting', $data);
			$this->load->view('/common/right', $data);
		}
		else
		{
			echo '请先<a href="/">登录</a>';
		}
		
		$this->load->view('/common/footer', array('before_end_body' => ''));
	}
	
	/**
	 * 保存设置
	 */
	function save() {
//		$this->form_validation->set_rules('email', 'Email', 'required');
//		if ($this->form_validation->run() == FALSE)
		if (false)
		{
			redirect('/setting/');
		}
		else
		{
			$project = $this->input->get_post('project');
			$follow_weibo = 1;
			if (!$this->input->get_post('follow_weibo')) $follow_weibo = 0;
			$user = $this->weixiao->get_cur_user();
			if (!empty($user))
			{
				$values = array(
					'selected_project_id' => $project,
					'follow_weibo' => $follow_weibo,
				);
				$cur_user = $this->usermanager->update_user($user->id, $values);
				$this->weixiao->reset_cur_user();
				
				//关注官方微博
				if ($follow_weibo) {
					$bindings = $this->usermanager->get_binding_by_uid($this->weixiao->get_cur_user()->id);
					foreach ($bindings as $sns){
						if($sns->sns_website == UserManager::sns_website_sina){
							//$c = new WeiboClient( WB_AKEY , WB_SKEY , $sns->sns_oauth_token , $sns->sns_oauth_token_secret);
							//$msg = $c->follow(OFFICIAL_WEIBO_ID);
							$this->sina->init($sns);
							$this->sina->follow(OFFICIAL_WEIBO_ID);
							//var_dump($msg);
						}
						if($sns->sns_website == UserManager::sns_website_tqq) {
							//TODO
						}
					}
				}
				redirect('/setting/');
			}
		}
		
	}
}
?>