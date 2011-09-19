<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('billing');
		$this->load->model('usermanager');
	}
	
	public function all($page = 0, $length = 0) {
		$cur_user = $this->weixiao->get_cur_user();
		if(empty($cur_user) || $cur_user->id != '100000') { //TODO 这个权限控制应该改为数据库TBL_USER表的is_admin字段
			echo '禁止访问！请登录。';
			return ;
		}
		$this->load->view('/volunteer/common/head', array('title' => '微笑网志愿者页面 | 用户管理'));
		
		$users = $this->usermanager->all($page, $length);
		$this->load->view('/volunteer/user', array('users' => $users));
		
		$this->load->view('/volunteer/common/footer', array('before_end_body' => ''));
	}
	
}
?>