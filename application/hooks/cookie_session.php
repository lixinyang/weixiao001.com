<?php
/**
 * 
 * 它作为hook被框架调用，见config/hooks.php
 * 这个类是用来维护整个站的Cookie和Session的。逻辑如下：
 * Cookie:
 * 		Cookie只有两个值：cookie_token、user_token
 * 		cookie_token: 
 * 			说明：每个人只要访问网站，如果没有cookie_token就会被分配一个，用于追踪，有效期10年。
 * 			生成：cookie里没有cookie_token就生成一个新的放入cookie里
 * 			销毁：不会销毁，除非用户自己在浏览器里清除cookie
 * 		user_token: 
 * 			说明：用户登录之后，就会在cookie里放user_token，用户保持用户登录状态，有效期10年。
 * 			生成：用户登录时（例如sina微博登录后的callback）生成，写入cookie。即，user_token为空的时候不自动生成。
 * 			销毁：用户“退出登录”的时候销毁。
 * Session:
 * 		Session里只放一个值：user_id
 * 		生成：发现user_token有值，而session中没有user_id的时候有本hook自动添加
 * 		销毁：用户“退出登录”的时候销毁
 * 
 * @author lxy
 *
 */
class CookieSessionHook
{
	private $ci;
	
	function __construct()
	{
		$this->ci = & get_instance();
	}
	
	public function post_controller_constructor()
	{
		$this->ci->weixiao->init();
	}
}