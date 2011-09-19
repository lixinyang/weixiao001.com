<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('billing');
		$this->load->model('usermanager');
	}
	
	public function all($page = 0, $length = 0) {
		$this->load->view('/common/head', array('title' => '微笑网 | 近期订单列表'));
		
		$orders = $this->billing->all($page, $length);		
		$this->load->view('order', array('orders' => $orders));
		
		$this->load->view('/common/footer', array('before_end_body' => ''));
	}
	
}
?>