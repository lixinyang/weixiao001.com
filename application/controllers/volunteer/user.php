<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('billing');
		$this->load->model('usermanager');
		$this->load->library('pagination');
	}
	
	public function all($page = 0, $length = 0) {
		$cur_user = $this->weixiao->get_cur_user();
		if(!$this->weixiao->is_admin($cur_user)) {
			echo '禁止访问，未登录或者非管理员帐号！请登录。';
			return ;
		}
		
		if($length==0) $length = 50;
		
		$this->load->view('/volunteer/common/head', array('title' => '微笑网志愿者页面 | 用户管理'));
		
		$config['base_url'] = 'http://weixiao001.com/volunteer/user/all/';
		$config['total_rows'] = $this->usermanager->count_all();
		$config['per_page'] = $length;
		$config['next_link'] = '下一页'; 
        $config['prev_link'] = '上一页';
		$config['num_links'] = 9;
		$this->pagination->initialize($config);
		$split_page = $this->pagination->create_links();
		
		$users = $this->usermanager->all($page, $length);
		$this->load->view('/volunteer/user', array('users' => $users, 'split_page' => $split_page));
		
		$this->load->view('/volunteer/common/footer', array('before_end_body' => ''));
	}
	
}
?>