<?php
/**
 * 
 * 他管理raw_order表等所有订单、账务相关的接口。
 * 包括TBL_ORDER，TBL_ORDER_SYNC，TBL_ORDER_CHANGELOG三张表。
 * 包括：和商家的订单同步，给用户的订单查询两大主要功能。
 * @author lxy
 *
 */
class Billing extends CI_Model
{

	/**
	 * 
	 * 从数据库中获取某一唯一值的方法
	 * 没找到返回null
	 * 找到一个就返回那个
	 * 找到多个就抛exception（要注意哦！！）
	 * @param string $table_name
	 * @param array $query 如：array('email'=>$email)
	 * @throws Excpetion
	 */
	private function get_uniq($table_name, $query)
	{
		$q = $this->db->get_where($table_name, $query);
		if($q->num_rows()==0)
		{
			return null;
		}
		else if($q->num_rows()>1)
		{
			throw new Exception("damn! we got something dupulicated that should be uniq: table(".$table_name."), query(".var_dump($query).")");
		}
		else
		{
			return $q->row();
		}
	}

	/**
	 * 
	 * 向TBL_ORDER_SYNC中插入一条记录，将刚插入的记录返回给调用者
	 * @param string $query_string
	 * @param string $order_no
	 * @param string $yiqifa_unique_id
	 * @param string $feed_back
	 * @param datetime $order_time
	 * @param string $commision
	 * @param string $status
	 * 
	 * @return stdClass 刚插入的记录
	 */
	function insert_order_sync($data, $data_source, $yiqifa_unique_id, $order_no, $feed_back) {
		$log_time = date("Y-m-d H:i:s", time());
		$order = array(
			'data'=>$data,
			'data_source'=>$data_source,
			'yiqifa_unique_id'=>$yiqifa_unique_id,
			'order_no'=>$order_no,
			'feed_back'=>$feed_back,
			'log_time'=>$log_time
		);
		$res = $this->db->insert(TBL_ORDER_SYNC, $order);
		return $this->get_uniq(TBL_ORDER_SYNC, array('log_time'=>$log_time, 'yiqifa_unique_id'=>$yiqifa_unique_id));
	}
	
	/**
	 * 
	 * 根据idraw_order获取订单同步数据
	 * @param string $idraw_order
	 */
	function get_order_sync($idraw_order) {
		return $this->get_uniq(TBL_ORDER_SYNC, array('idraw_order'=>$idraw_order));
	}
	
	/**
	 * 
	 * @param stdClass $order
	 */
	function insert_order($order) {
		$current = date("Y-m-d H:i:s", time());
		$order->wx_create_time = $current;
		$order->wx_last_update_time = $current;
		$res = $this->db->insert(TBL_ORDER, $order);
	}

	/**
	 * 
	 * 将订单写入订单变动记录表
	 * @param stdClass $order
	 */
	function insert_order_changelog($order) {
		$current = date("Y-m-d H:i:s", time());
		$order->changelog_time = $current;
		$res = $this->db->insert(TBL_ORDER_CHANGELOG, $order);
	}
	
	/**
	 * 
	 * 将订单表数据更新为新的订单数据，将原来的订单数据写入changelog表
	 * @param unknown_type $order
	 * @param unknown_type $o
	 */
	function update_order($order, $o) {
		//将新的数据写入订单表
		$this->insert_order($o);
		//将老的订单写入订单变动记录表
		$this->insert_order_changelog($order);
		//将老订单从订单表删除
		$this->db->delete(TBL_ORDER, array('idwx_orders'=>$order->idwx_orders));
	}

	/**
	 * 
	 * 根据idwx_orders（订单在商家的订单号）获取订单信息
	 * @param string $idwx_orders
	 */
	function get_order_by_id($idwx_orders) {
		return $this->get_uniq(TBL_ORDER, array('idwx_orders'=>$idwx_orders));
	}
	/**
	 * 
	 * 根据order_no（订单在商家的订单号）获取订单信息
	 * @param string $order_no
	 */
	function get_order_by_yiqifa_unique_id($yiqifa_unique_id) {
		return $this->get_uniq(TBL_ORDER, array('yiqifa_unique_id'=>$yiqifa_unique_id));
	}
	
	/**
	 * 
	 * 解析亿起发push来的原始订单数据为订单对象需要的数据
	 * @param string $query_string 亿起发push来的query_string
	 */
	private function parsePushRawOrder($query_string) {
		if (empty($query_string)) return null;
		//$query_string = mb_convert_encoding($query_string, 'utf-8');
		$query_string = urldecode($query_string);
		$query_string = mb_convert_encoding($query_string, 'utf-8');
		
		$res = array();
		$ps = explode('&', $query_string);
		foreach ($ps as $p) {
			$pp = explode('=', $p);
			$res[$pp[0]] = $pp[1];
		}
		
		$o = new stdClass();
		$o->order_no = $res['order_no'];
		$o->yiqifa_unique_id = $res['unique_id'];
		$o->feed_back = $res['feed_back'];
		$o->order_time = $res['order_time'];
		$o->commision = $res['commision'];
		$o->status = $res['status'];
		$o->action_id = $res['action_id'];
		$o->action_name = $res['action_name'];
		$o->prod_id = $res['prod_id'];
		$o->prod_name = $res['prod_name'];
		$o->prod_count = $res['prod_count'];
		$o->prod_money = $res['prod_money'];
		$o->prod_type = $res['prod_type'];
		
		return $o;
	}
	/**
	 * 
	 * 解析从亿起发GET过来的原始订单数据为订单对象需要的数据
	 * @param string $query_string 从亿起发GET过来的原始订单数据（返回值中的一行记录）
	 */
	private function parseGetRawOrder($line) {
		if (empty($line)) return null;
		
		$res = explode('||', $line);
		
		$o = new stdClass();
		$o->order_no = $res[5];
		$o->yiqifa_unique_id = $res[0];
		$o->feed_back = $res[10];
		$o->order_time = $res[4];
		$o->commision = $res[12];
		$o->status = $res[11];
		$o->action_id = $res[1];
		$o->action_name = null;
		$o->prod_id = $res[7];
		$o->prod_name = null;
		$o->prod_count = $res[8];
		$o->prod_money = $res[9];
		$o->prod_type = $res[13];
		
		return $o;
	}
	
	/**
	 * 
	 * 根据一个（亿起发同步来的）订单同步数据来更新订单数据
	 * @param stdClass $raw, 原始的订单数据
	 */
	function update_order_on_sync($raw) {
		//取得订单表中的订单数据
		$order = $this->get_order_by_yiqifa_unique_id($raw->yiqifa_unique_id);
		
		$ci = & get_instance();
		$ci->load->model('usermanager');
		//分push来的数据和get来的数据解析为规范数据
		switch ($raw->data_source) {
			case 'push':
				$o = $this->parsePushRawOrder($raw->data);
				break;
			case 'get':
				$o = $this->parseGetRawOrder($raw->data);
				break;
			default:
				throw new Exception($raw->idraw_order." in ".TBL_ORDER_SYNC." datasource error!");
				break;
		}
		
		//如果反馈标签（e参数）能在用户表中找到，那么就写入order表的user_id字段
		$o->idraw_order = $raw->idraw_order;
		if ($ci->usermanager->get_by_id($o->feed_back)) {
			$o->user_id = $o->feed_back;
		}
		
		//更新order表的数据
		if (empty($order)) { //这张订单第一次来，那么创建
			$this->insert_order($o);
		}
		else { //已有这张订单的记录了，那么更新订单信息
			if ($order->idraw_order != $raw->idraw_order) { //尚未更新过，更新的时候会把order的idraw_order字段换成新的raw_order的
				$this->update_order($order, $o);
			}
			else { //已经更新过了。这在正常情况下不会出现
				return ;
			}
		}
	}
	
	function all($page = 0, $length = 0) {
		if(!$length) $length = 50;

		$this->db->order_by("order_time", "desc");
		$query = $this->db->get(TBL_ORDER , $length , $page*$length);
		
		return $query->result();
	}
	function count_all() {
		return $this->db->count_all_results(TBL_ORDER);
	}

}
?>
