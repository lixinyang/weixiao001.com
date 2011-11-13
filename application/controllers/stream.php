<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 用户的News Feed
 * @author lxy
 *
 */
class Stream extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','form'));
		$this->load->model(array('usermanager', 'project'));
		$this->load->library(array('sina'));
	}
	
	/**
	 * 
	 * 用户News Feed列表
	 */
	public function index($msg=null)
	{
		$this->load->view('/common/head', array('title' => '微笑网 | 消息'));
		
		if($this->weixiao->is_login())
		{
			$this->sina->init($this->usermanager->get_binding($this->weixiao->get_cur_user()->id, Usermanager::sns_website_sina));
			$data = array(
				'user' => $this->weixiao->get_cur_user(),
				'frd' => $this->sina->friends(),
				'project' => null,
			);
			$pid = $this->weixiao->get_cur_user()->selected_project_id;
			if ($pid){
				$data['project'] = $this->project->get($pid)->name;
			}
			$this->load->view('stream', $data);
			$this->load->view('/common/right', $data);
		}
		else
		{
			echo '请先<a href="/">登录</a>';
		}
		
		$this->load->view('/common/footer', array('before_end_body' => ''));
	}
	
}
?>