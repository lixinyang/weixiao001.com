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
		if(!$this->weixiao->is_admin($cur_user)) {
			echo '禁止访问，未登录或者非管理员帐号！请登录。';
			return ;
		}
		$this->load->view('/volunteer/common/head', array('title' => '微笑网志愿者页面 | 用户管理'));
		
		$users = $this->usermanager->all($page, $length);
		$this->load->view('/volunteer/user', array('users' => $users));
		
		$this->load->view('/volunteer/common/footer', array('before_end_body' => ''));
	}
	
}
?>