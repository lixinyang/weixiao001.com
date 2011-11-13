<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('usermanager');
		$this->load->model('project');
		$this->load->library(array('sina'));
	}
	
	/**
	 * 
	 * 获得当前登录用户
	 */
	public function current_user()
	{
		header("Content-Type: application/json; charset=utf-8", true);
		if($this->weixiao->is_login())
		{
			$user = $this->weixiao->get_cur_user();
			$project_id = $user->selected_project_id;
			if(empty($project_id)) {
				$project_id = "";
				$project_name = "";
			}
			else {
				$project = $this->project->get($project_id);
				$project_name = $project->name;
			}
			$invited_count = count($this->usermanager->find_invited_users($user->id));
			$invited_commision = $this->usermanager->find_invited_commision($user->id);
			
			$ret = "{";
			$ret .= "\"id\": \"".$user->id."\",";
			$ret .= "\"user_token\": \"".$user->user_token."\",";
			$ret .= "\"display_name\": \"".$user->display_name."\",";
			$ret .= "\"selected_project_id\": \"".$project_id."\",";
			$ret .= "\"selected_project_name\": \"".$project_name."\",";
			$ret .= "\"invited_count\": \"" . $invited_count . "\",";
			$ret .= "\"invited_commision\": \"" . $invited_commision . "\"";
			$ret .= "}";
			
			echo $ret;
		}
		else
		{
			echo 'false';
		}
	}
	/**
	 * 
	 * 根据user_token获得用户信息
	 */
	public function user($user_token)
	{
		header("Content-Type: application/json; charset=utf-8", true);
		header("Access-Control-Allow-Origin: *");
		if($user_token)
		{
			$user = $this->usermanager->get_by_token($user_token);
			if(empty($user)) return  'false';
			
			$project_id = $user->selected_project_id;
			if(empty($project_id)) {
				$project_id = "";
				$project_name = "";
			}
			else {
				$project = $this->project->get($project_id);
				$project_name = $project->name;
			}
			
			$ret = "{";
			$ret .= "\"id\": \"".$user->id."\",";
			$ret .= "\"user_token\": \"".$user->user_token."\",";
			$ret .= "\"display_name\": \"".$user->display_name."\",";
			$ret .= "\"selected_project_id\": \"".$project_id."\",";
			$ret .= "\"selected_project_name\": \"".$project_name."\"";
			$ret .= "}";
			
			echo $ret;
		}
		else
		{
			echo 'false';
		}
	}
	
	/**
	 * 
	 * 处理用户提交的反馈
	 */
	public function feedback() {
		header("Content-Type: application/json; charset=utf-8", true);
		$text = $_POST['text'];
		$text = '@微笑网公益购物 说'.$text;
		if ($this->weixiao->is_login()) {
			$user = $this->weixiao->get_cur_user();
			$bindings = $this->usermanager->get_binding_by_uid($user->id);
			$binding = $bindings[0];
			$text = '@'.$binding->sns_display_name.' 对'.$text;
		}
		else {
			$text = '路人甲 对'.$text;
		}
		$text = $text.' http://weixiao001.com/';
		$this->sina->init();
		$this->sina->update($text);
		echo 'true';
	}

	/**
	 * 
	 * 获取最近几条用户反馈，用于在首页展示
	 */
	public function latest_feedback() {
		header("Content-Type: application/json; charset=utf-8", true);
		//取这个用户发的第一页前4条微博
		$this->sina->init();
		$res = $this->sina->user_timeline(1,3);
		echo json_encode($res);
	}
}
?>