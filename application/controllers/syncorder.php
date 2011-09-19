<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SyncOrder extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('billing');
	}
	
	/**
	 * 
	 * 从请求中获取参数，如果参数不存在就返回空字符串。
	 * TODO 并未处理一个参数名多个值的情况
	 */
	private function getp($param_name) {
		return isset($_GET[$param_name])?$_GET[$param_name]:'';
	}
	
	/**
	 * 
	 * 和亿起发的Push接口，亿起发在收到商家订单后时时通知到我们的这个接口上，接口最主要的功能是及时入库。
	 * 下面是一个真是的请求LOG。
	 * "GET /syncorder/push/?unique_id=48611084&create_date=2011-06-18+08%3A49%3A35&action_id=245&action_name=%D7%BF%D4%BD%CD%F8CPS&sid=77110&wid=317782&order_no=C02-3349910-7402415&order_time=2011-06-17+00%3A00%3A00&prod_id=B004JZY8S2&prod_name=%D0%C5%CF%A2%CA%B1%B4%FA%C3%C0%BE%FC%B5%C4%D7%AA%D0%CD%BC%C6%BB%AE%3A%B4%F2%D4%EC21%CA%C0%BC%CD%B5%C4%BE%FC%B6%D3%28%D2%EB%CE%C4%BC%AF%29&prod_count=2&prod_money=81.5&feed_back=30666091&status=R&comm_type=14&commision=6.52&chkcode=9c3ea200652ae38f57e2539e0a869926&prod_type=14&exchange_rate=0.0 HTTP/1.1"
	 */
	public function push() {
		$yiqifa_unique_id = $this->getp('unique_id');
		$order_no = $this->getp('order_no');
		$feed_back = $this->getp('feed_back');
		$data = $_SERVER['QUERY_STRING'];
		if ($data) {
			//写原始记录表
			$raw_order = $this->billing->insert_order_sync($data, 'push', $yiqifa_unique_id, $order_no, $feed_back);
			//更新订单表数据
			$this->billing->update_order_on_sync($raw_order);
			echo 1;
		}
		else {
			echo -1;
		}
	}
	
	/**
	 * 
	 * 以get接口获取订单数据。可以在参数中指定开始结束时间，默认同步昨天的
	 * 调用方法/syncorder/get/2011-06-10/2011-06-15/
	 * @param string $start
	 * @param string $end
	 */
	public function get($start = null, $end = null) {
		//默认同步昨天的订单
		if (empty($start)) $start = date("Y-m-d", strtotime('-1 day'));
		//默认结束时间和开始时间相同
		if (empty($end)) $end = $start;
		
		//weixiao001.com
		$site1 = 'http://o.yiqifa.com/servlet/queryCpsMultiRow?sid=&username=lzy2086@qq.com&privatekey=weixiaogongyigouwu&st='.$start.'&ed='.$end.'&action_id=&order_no=&wid=351245&status=';
		$res = $this->http($site1, 'GET');
		echo 'weixiao001.com<br/>'.$res.'<hr/>';
		//亿起发返回的数据是gbk编码的
		$res = mb_convert_encoding($res, 'utf-8', 'gbk');
		$lines = explode("\r\n", $res);
		foreach ($lines as $line) {
			$fields = explode('||', $line);
			if (count($fields)>10) {
				//写原始记录表
				$raw_order = $this->billing->insert_order_sync($line, 'get', $fields[0], $fields[5], $fields[10]);
				//更新订单表数据
				$this->billing->update_order_on_sync($raw_order);
				echo '<br/>insert: '.$line;
			}
		}
		
		//weixiao.sinaapp.com
		$site2 = 'http://o.yiqifa.com/servlet/queryCpsMultiRow?sid=&username=lzy2086@qq.com&privatekey=weixiaogongyigouwu&st='.$start.'&ed='.$end.'&action_id=&order_no=&wid=317782&status=';
		$res = $this->http($site2, 'GET');
		echo 'weixiao.sinaapp.com<br/>'.$res.'<hr/>';
		//亿起发返回的数据是gbk编码的
		$res = mb_convert_encoding($res, 'utf-8', 'gbk');
		$lines = explode("\r\n", $res);
		foreach ($lines as $line) {
			$fields = explode('||', $line);
			if (count($fields)>10) {
				//写原始记录表
				$raw_order = $this->billing->insert_order_sync($line, 'get', $fields[0], $fields[5], $fields[10]);
				//更新订单表数据
				$this->billing->update_order_on_sync($raw_order);
				echo '<br/>insert: '.$line;
			}
		}
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