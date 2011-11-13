<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('billing');
		$this->load->model('usermanager');
		$this->load->library('pagination');
	}
	
	public function all($page = 0, $length = 0) {
		$this->load->view('/common/head', array('title' => '微笑网 | 近期订单列表'));
		
		$config['base_url'] = 'http://weixiao001.com/order/all/';
		$config['total_rows'] = $this->billing->count_all();
		$config['per_page'] = '50';
		$config['next_link'] = '下一页'; 
                $config['prev_link'] = '上一页';
		$config['num_links'] = 9;
		$this->pagination->initialize($config);
		$split_page = $this->pagination->create_links();
		$orders = $this->billing->all($page/50, $length);		
		$this->load->view('order', array('orders' => $orders, 'split_page' => $split_page));
		
		$this->load->view('/common/footer', array('before_end_body' => ''));
	}
	
}
?>
