<?php
require_once( dirname(__FILE__).'/weibooauth.php' );
/**
 * 
 * 这个类用来作为调用新浪微博中间层，多一层间接，多一个控制点。
 * 注意：必须先调用init()方法后再使用
 * 
 * @author lxy
 *
 */
class Sina
{
	private $client = null;
	
	/**
	 * 
	 * 如果传入sns_bindings数据库表的数据，那么使用用户的token，否则使用系统默认微博帐号的token
	 * @param sns_bindings数据库表的数据 $binding
	 */
	function init($binding=null , $oauth_token=null , $oauth_token_secret=null) {
		if ($binding) {
			$this->client = new WeiboClient( WB_AKEY , WB_SKEY , $binding->sns_oauth_token , $binding->sns_oauth_token_secret);
		}
		else if ($oauth_token!=null && $oauth_token_secret!=null) {
			$this->client = new WeiboClient( WB_AKEY , WB_SKEY , $oauth_token , $oauth_token_secret);
		}
		else {
			$this->client = new WeiboClient( WB_AKEY , WB_SKEY , DEFAULT_WB_TOKEN , DEFAULT_WB_TOKEN_SECRET);
		}
	}
	
	public function get_oauth($oauth_token=null , $oauth_token_secret=null) {
		if ($oauth_token!=null && $oauth_token_secret!=null) {
			$oauth = new WeiboOAuth( WB_AKEY , WB_SKEY , $oauth_token , $oauth_token_secret);
		}
		else {
			$oauth = new WeiboOAuth( WB_AKEY , WB_SKEY  );
		}
		
		return $oauth;
	}
	
	/**
	 * 
	 * 验证当前用户是否合法，合法的时候取回用户信息。
	 * http://api.t.sina.com.cn/account/verify_credentials.json
	 */
	function verify_credentials() {
		$res = $this->client->verify_credentials();
		return $res;
	}
	
	/**
	 * 
	 * 取用户的好友，包括好友的个人资料。
	 * 每页200个，默认取第一页。
	 * http://api.t.sina.com.cn/statuses/friends.json
	 * @param int $page
	 */
	function friends($page=-1) {
		//固定每页200条
		$res = $this->client->friends($page, 200);
		return $res;
	}
	
	/**
	 * 
	 * 取用户关注用户的id列表，因为sina最多允许关注2000人，所以列表可以一次取完
	 */
	function friends_ids(){
		//从第一页开始，取5000个
		$res = $this->client->friends_ids(-1, 5000);
		return $res;
	}
	
	/**
	 * 
	 * 发新微博
	 * http://api.t.sina.com.cn/statuses/update.json
	 * @param string $text 微博内容
	 */
	function update($text) {
		$res = $this->client->update($text);
		return $res;
	}
	
	/**
	 * 
	 * 取用户最近发的微博
	 * http://api.t.sina.com.cn/statuses/user_timeline.json
	 * @param int $page 从1开始
	 * @param int $count
	 */
	function user_timeline($page, $count) {
		$res = $this->client->user_timeline($page, $count);
		return $res;
	}
	
	/**
	 * 
	 * 在新浪微博follow其他用户
	 * http://api.t.sina.com.cn/friendships/create.json
	 * @param string $uid_or_name
	 */
	function follow($uid_or_name) {
		$res = $this->client->follow($uid_or_name);
		return $res;
	}

}
?>