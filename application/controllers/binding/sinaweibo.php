<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( dirname(__FILE__).'/bindbase.php' );
class Sinaweibo extends Bindbase {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('usermanager');
		$this->load->library(array('sina'));
	}
	
	function show() {
		$data = array();
		$data['auth_url'] = $this->get_auth_url();
		//$this->load->view('binding/sina', $data);
		redirect($data['auth_url']);
	}

	private function get_auth_url() {
		$o = $this->sina->get_oauth();
		$keys = $o->getRequestToken();
		$callback = site_url().'/binding/sinaweibo/callback';
		
		$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback );
		
		//$_SESSION['oauth_keys'] = $keys;
		$this->session->set_userdata($keys);
		
		return $aurl;
	}

	function callback() {
		$o = $this->sina->get_oauth($this->session->userdata('oauth_token') , $this->session->userdata('oauth_token_secret'));
		//这个key就是这个用户的令牌，很NB，要好好保存
		//var_dump($_REQUEST);
		$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;
		$sns_oauth_token = $last_key['oauth_token'];
		$sns_oauth_token_secret = $last_key['oauth_token_secret'];
		$sns_uid = $last_key['user_id'];
		//var_dump($last_key);
		error_log('haha'.$last_key);
		error_log($this->session->userdata('oauth_token'));
		if(empty($sns_uid)) throw new Exception('oauth fail, havnt got getAccessToken()');
		
		//获取用户信息
		$this->sina->init(null , $sns_oauth_token , $sns_oauth_token_secret);
		$me = $this->sina->verify_credentials();
		
		//把资料准备好之后，剩下的就交给父类里的模版方法了！
		parent::post_login(UserManager::sns_website_sina, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $me['name']);
	}
}
?>
