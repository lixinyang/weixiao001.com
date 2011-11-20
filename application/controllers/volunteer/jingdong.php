<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jingdong extends CI_Controller
{
	var $msg = '';
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('billing');
	}
	
	public function index($page = 0, $length = 0) {
		$cur_user = $this->weixiao->get_cur_user();
		if($this->weixiao->is_admin($cur_user)) {
			echo '禁止访问，未登录或者非管理员帐号！请登录。';
			return ;
		}
		$this->load->view('/volunteer/common/head', array('title' => '微笑网志愿者页面 | 京东订单导入'));
		
		$orders = $this->billing->all_jingdong(0,100);
		$this->load->view('/volunteer/jingdong', array('orders'=>$orders, 'msg'=>$this->msg));
		
		$this->load->view('/volunteer/common/footer', array('before_end_body' => ''));
	}
	
	public function add() {
		$cur_user = $this->weixiao->get_cur_user();
		if!($this->weixiao->is_admin($cur_user)) {
			echo '禁止访问，未登录或者非管理员帐号！请登录。';
			return ;
		}
		
		$input = $_POST['text'];
		if(empty($input)) {
			$this->msg = '<font color="yellow">提交内容为空</font>';
		}
		else {
			foreach (explode("\n",$input) as $line) {
				$line = trim($line);
				//跳过空行
				if(empty($line)) continue;
				
				$col = explode("\t", $line);
				if(count($col) < 6) {
					$this->msg .= $line.', <font color="red">格式错误</font><br/>';
				}
				else {
					if ($this->billing->get_order_jingdong(trim($col[0]),trim($col[1]))) {
						$this->msg .= '订单'.$col[0].'<font color="yellow">已存在，跳过</font><br/>';
					}
					else{
						$order = array(
							'order_no'=>trim($col[0]),
							'order_create_time'=>trim($col[1]),
							'order_process_time'=>trim($col[2]),
							'status'=>trim($col[3]),
							'order_money'=>trim($col[4]),
							'commision'=>trim($col[5]),
						);
						$this->billing->insert_order_jingdong($order);
						$raw = $this->billing->get_order_jingdong(trim($col[0]),trim($col[1]));
						$o = new stdClass();
						$o->from = 'jingdong';
						$o->idraw_order = $raw->id_jingdong;
						$o->order_no = $raw->order_no;
						$o->order_time = $raw->order_create_time;
						$o->commision = $raw->commision;
						$status = 'A';//成功订单
						if(strstr($raw->status,'无效')) $status = 'F';//无效订单
						$o->status = $status;
						$o->action_id = '254';
						$o->prod_money = $raw->order_money;
						$this->billing->insert_order($o);
						$this->msg .= $col[0].'保存成功<br/>';
					}
				}
			}
		}
		$this->index();
	}
	
}
?>