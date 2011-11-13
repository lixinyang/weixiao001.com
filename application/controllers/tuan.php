<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tuan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','weibooauth','html'));
		//$this->load->model('billing');
	}
	
	private $sites = array(
		'lashou'=>array(
			'url'=>'http://open.client.lashou.com/api/detail/city/2419/p/1/r/3',
			'name'=>'拉手网',
			'parser'=>'tuan800',
			'to_url'=>'http://p.yiqifa.com/c?s=5c6fe1c3&w=351245&c=5298&i=10942&l=0&e=dddefault&t=to_url',
		),
	);
	
	public function get($site = null) {
		//默认抓的团购网站
		if (empty($site)) $site = "lashou";
		$si = $this->sites[$site];
		
		$res = $this->http($si['url'], 'GET');
		$xml = simplexml_load_string($res);
		foreach ($xml->children() as $url) {
			echo $url->loc.'<br/>';
			echo $url->data->display->website.'<br/>';
			echo $url->data->display->city.'<br/>';
			echo $url->data->display->title.'<br/>';
			echo '<hr/>';
		}
		$c = new WeiboClient( WB_AKEY , WB_SKEY , DEFAULT_WB_TOKEN , DEFAULT_WB_TOKEN_SECRET);
		$c->update($text);
	}

	/**
	 * Make an HTTP request
	 *
	 * @return string API results
	 */
	private function http($url, $method, $postfields = NULL , $multi = false) {
		$http_info = array();
		$ci = curl_init();
		/* Curl settings */
		curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ci, CURLOPT_URL, $url );


		$response = curl_exec($ci);
		$http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
		$http_info = array_merge($http_info, curl_getinfo($ci));

		curl_close ($ci);
		return $response;
	}
	
}
?>