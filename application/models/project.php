<?php
/**
 * 
 * 管理公益项目
 * @author lxy
 *
 */
class Project extends CI_Model
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
	 * 根据idwx_orders（订单在商家的订单号）获取订单信息
	 * @param string $idwx_orders
	 */
	function get($id) {
		return $this->get_uniq(TBL_PROJECT, array('id'=>$id));
	}
	
	function all($page = 0, $length = 0) {
		if(!$length) $length = 50;

		$this->db->order_by("order", "asc");
		$query = $this->db->get(TBL_PROJECT , $length , $page*$length);
		
		return $query->result();
	}

}
?>