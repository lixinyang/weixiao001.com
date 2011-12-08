<?php
/**
 * 
 * 这是一个很NB的类，它是weixiao001相关逻辑的入口，它会被CI框架自动加载（见config/autoload.php）。
 * 所以它可以这样使用get_instance()->weixiao->get_cur_user();
 * 
 * 它里面定义了常量、变量、常用方法
 * @author lxy
 *
 */
class Weixiao
{
	//Cookie中cookie_token的变量名
	const COOKIE_TOKEN = "cookie_token";
	//Cookie中user_token的变量名
	const USER_TOKEN = "user_token";
	//在session中设置
	const SESSION_REFRESH_SINA = 'refresh_sina';
	//Cookie中邀请人的id
	const INVITE_TOKEN = "invite_id";
	
	private $ci;
	public $cookie_token;
	private $user_token;
	private $user;
	
	function __construct()
	{
		$this->ci = & get_instance();
	}
	
	/**
	 * 
	 * 这个方法被CookieSessionHook所调用，在post_controller_constructor的时机被调用
	 */
	public function init()
	{
	 	//cookie_token为空就生成一个，否则什么都不干
		if(!get_cookie(Weixiao::COOKIE_TOKEN))
		{
			set_cookie(Weixiao::COOKIE_TOKEN, $this->gen_cookie_token(), 3600*24*365*10);
		}
		$this->cookie_token = get_cookie(Weixiao::COOKIE_TOKEN);
		$this->set_user_token(get_cookie(Weixiao::USER_TOKEN));
		
		//用户Session开始的时候去刷一下用户在sina的数据，包括个人资料和其好友数据
		$ref = $this->ci->session->userdata(Weixiao::SESSION_REFRESH_SINA);
		if (empty($ref) && $this->is_login()) {
			$this->refresh_sina();
			$this->update_user();
			$this->ci->session->set_userdata(Weixiao::SESSION_REFRESH_SINA, 'done');
		}
	}
	/**
	 * 
	 * 更新登录者的最近登录时间和登录IP
	 */
	private function update_user() {
		$this->ci->load->library(array('input'));
		$values = array(
		'last_login_time' =>date("Y-m-d H:i:s"),
		'last_login_ip' => $this->ci->input->ip_address(),
		);
		$this->ci->usermanager->update_user($this->get_cur_user()->id , $values);
	}
	
	/**
	 * 
	 * 将当前登录用户的sina数据更新到user、binding、friends等表中
	 */
	public function refresh_sina() {
		$this->ci->load->library(array('sina'));
		$binding = $this->ci->usermanager->get_binding($this->get_cur_user()->id, Usermanager::sns_website_sina);
		$this->ci->sina->init($binding);
		
		$sina = $this->ci->sina->verify_credentials();
		if ($sina) {
			$values = array(
			'sns_display_name'=>$sina['screen_name'],
			'province'=>$sina['province'],
			'city'=>$sina['city'],
			'location'=>$sina['location'],
			'description'=>$sina['description'],
			'url'=>$sina['url'],
			'profile_image_url'=>$sina['profile_image_url'],
			'gender'=>$sina['gender'],
			'followers_count'=>$sina['followers_count'],
			'friends_count'=>$sina['friends_count'],
			'statuses_count'=>$sina['statuses_count'],
			'created_at'=>date("Y-m-d H:i:s" , strtotime($sina['created_at'])),
			'verified'=>$sina['verified'],
			'last_refresh'=>date("Y-m-d H:i:s"),
			);
			//获取好友列表，如果好友列表的md5发生了变化，那么更新到数据库里面
			$res = $this->ci->sina->friends_ids();
			$friends = join(',' , $res['ids']);
			$friends_md5 = md5($friends);
			if($friends_md5 != $binding->friends_md5) {
				$values['friends'] = $friends;
				$values['friends_md5'] = $friends_md5;
				//更新微笑网的好友列表
				$this->refresh_friends($friends , $binding->friends);
			}
			$this->ci->usermanager->update_binding($binding->id, $values);
			$user = $this->get_cur_user();
			$user->display_name = $sina['screen_name'];
			$this->ci->usermanager->update_user($user->id, $user);
		}
	}
	
	/**
	 * 
	 * 根据新旧两份好友列表，将变化了的部分更新到friends表中
	 * @param string $new 新的好友列表
	 * @param string $old 就的好友列表
	 */
	private function refresh_friends($new, $old) {
		$n = explode(',' , $new);
		$o = array();
		if(!empty($old)) $o = explode(',' , $old);
		
		$this->ci->load->model('friend');
		$me = $this->get_cur_user()->id;
		
		//添加的好友
		$add = array_diff($n , $o);
		$add = $n;
		if(!empty($add)) {
			foreach ($add as $you_at_sina) {
				$you = $this->ci->usermanager->get_binding_by_sns_uid(Usermanager::sns_website_sina , $you_at_sina);
				if(!empty($you)) {	//好友在微笑网有帐号的话
					$this->ci->friend->follow($me , $you->user_id , Friend::AT_SINA);
				}
			}
		}
		
		//减少的好友
		$del = array_diff($o , $n);
		if(!empty($del)) {
			foreach ($del as $you_at_sina) {
				$you = $this->ci->usermanager->get_binding_by_sns_uid(Usermanager::sns_website_sina , $you_at_sina);
				if(!empty($you)) {	//好友在微笑网有帐号的话
					$this->ci->friend->unfollow($me , $you->user_id , Friend::AT_SINA);
				}
			}
		}
	}
	
	/**
	 * 
	 * cookie_token生成器，规则很简单：unix_time_stamp.'_'.两位随机数
	 */
	private function gen_cookie_token()
	{
		$str = time()."".rand(10,99);
    	return substr($str,4);
		
	}
	
	/**
	 *  
	 * @param string $user_token
	 */
	public function set_user_token($user_token)
	{
		$this->user_token = $user_token;
		//如果cookie没有设置则设置一下
		if($user_token)
		{
			set_cookie(Weixiao::USER_TOKEN, $this->user_token, 3600*24*365*10);
		}
		
	}
	
	/**
	 * 当前用户是否登录
	 * 
	 */
	public function is_login()
	{
		$this->get_cur_user();
		return !empty($this->user);
	}
	
	public function logout()
	{
		$this->user = null;
		$this->user_token = null;
		delete_cookie(Weixiao::USER_TOKEN);
		$this->ci->session->sess_destroy();
	}
	
	/**
	 * 
	 * 取得当前的访问用户
	 * 已登录返回登录用户，未登录返回null
	 */
	public function get_cur_user()
	{
		//$this->set_user_token(get_cookie(Weixiao::USER_TOKEN));
		if(empty($this->user) || $this->user->user_token!=$this->user_token)
		{
			if($this->user_token)
			{
				$this->user = $this->ci->usermanager->get_by_token($this->user_token);
			}
		}
		return $this->user;
	}
	
	public function reset_cur_user()
	{
		$this->user = null;
		$this->get_cur_user();
	}
	
	public function get_inviter_id()
	{
				$inviter_id = get_cookie(Weixiao::INVITE_TOKEN);
				if($inviter_id == null || !is_numeric($inviter_id))
					$inviter_id = 0;
					return $inviter_id;
	}
	
	private $merchants = array(
	'245'=>'卓越亚马逊',
	'247'=>'当当网',
	'280'=>'新蛋网',
	'252'=>'乐友',
	'249'=>'红孩子',
	'255'=>'凡客诚品',
	'4102'=>'我买网',
	'5434'=>'高鹏团购',
	'227'=>'乐蜂网',
	'254'=>'京东商城',
	'5549'=>'淘宝商城',
	);
	public function get_merchant_name($action_id) {
		if(array_key_exists($action_id, $this->merchants)) {
			return $this->merchants[$action_id];
		}
		return null;
	}
	
	/**
	 * 
	 * 判断一个用户是否是admin用户
	 * @param unknown_type $user
	 */
	public function is_admin($user) {
		if(empty($user)) { //TODO 这个权限控制应该改为数据库TBL_USER表的is_admin字段
			return false;
		}
		elseif ($user->id == '100000' || $user->id == '100001') {
			return true;
		}
		else {
			return false;
		}
	}

}
?>
