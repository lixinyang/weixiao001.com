<?php
/**
 * 
 * 他管理user表和binding表两张表
 * @author lxy
 *
 */
class UserManager extends CI_Model
{
	/**
	 * 
	 * sns_binding表中的sns_website的取值
	 * @var unknown_type
	 */
	const sns_website_sina = 'sina';
	const sns_website_qq = 'qq';
	const sns_website_tqq = 'tqq';
	const sns_website_renren = 'renren';
	const sns_website_kaixin = 'kaixin';
	
	/**
	 * 
	 * 从数据库中获取某一唯一值的方法
	 * 没找到返回null
	 * 找到一个就返回那个
	 * 找到多个就抛exception（要注意哦！！）
	 * @param unknown_type $table_name
	 * @param unknown_type $query
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
			throw new Excpetion("damn! we got something dupulicated that should be uniq: table(".$table_name."), query(".var_dump($query).")");
		}
		else
		{
			return $q->row();
		}
	}
	function get_by_id($id)
	{
		$q = $this->db->get_where(TBL_USER, array('id'=>$id));
		if ($q->num_rows()==1) {
			return $q->row();
		}
		else {
			return null;
		}
	}
	/**
	 * 
	 * 根据用户在session中的user_token来取这个用户，因为user_id是单调递增的，而user_token是user_id的sha1，不容易被猜到
	 * 找到了1个就返回，没找到或者找到多个就返回null
	 * @param string $user_token
	 */
	function get_by_token($user_token)
	{
		$q = $this->db->get_where(TBL_USER, array('user_token'=>$user_token));
		if ($q->num_rows()==1) {
			return $q->row();
		}
		else {
			return null;
		}
	}

		/**
	 * 
	 * 根据email找用户
	 * 找到了1个就返回，没找到或者找到多个就返回null
	 * @param string $user_token
	 */
	function get_by_email($email)
	{
		return $this->get_uniq(TBL_USER, array('email'=>$email));
	}
	
	/**
	 * 通过sns站点，用户在我们站点上的uid，查询sns_binding
	 * 不存在会返回空数组，存在就返回binding的信息
	 * @param string $sns_website, $uid
	 */
	function get_binding($uid, $sns_website) 
	{
		$res = $this->get_uniq(TBL_SNS_BINDING, array('user_id'=>$uid, 'sns_website'=>$sns_website));
		return $res;
	}

	/**
	 * 通过sns站点，用户在我们站点上的uid，查询sns_binding
	 * 不存在会返回空数组，存在就返回binding的信息
	 * @param string $sns_website, $uid
	 */
	function get_binding_by_uid($uid) 
	{
		$q = $this->db->get_where(TBL_SNS_BINDING, array('user_id'=>$uid));
		return $q->result();
	}
	
	/**
	 * 通过sns站点，用户在sns站点上的uid，查询sns_binding
	 * 不存在会返回null，存在就返回binding的信息
	 * @param string $sns_website, $sns_uid
	 */
	function get_binding_by_sns_uid($sns_website, $sns_uid) {
		return $this->get_uniq(TBL_SNS_BINDING, array('sns_website'=>$sns_website,'sns_uid'=>$sns_uid));
	}
	
	function create_user($sns_website, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $name='', $token_expire_in=null, $inviter_id = 0)
	{
		//已经绑定过了
		$binding = $this->get_binding_by_sns_uid($sns_website, $sns_uid);
		if (!empty($binding)) {
			throw new Exception('sns_binding already binded: '.$sns_website.",".$sns_uid);
		}
		
		$this->db->trans_start();
		//生成user
		$data = array(
			'display_name' => $name,
			'regist_time' => date("Y-m-d H:i:s")
		);
		$this->db->insert(TBL_USER, $data);
		$uid = $this->db->insert_id();
		
		//设置user_token
		$this->db->where('id',$uid);
		$user_token = sha1($uid);
		$this->db->update(TBL_USER, array('user_token' => $user_token, 'inviter_id' => $inviter_id));
		
		//生成binding
		$this->create_sns_binding($uid, $sns_website, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $name, $token_expire_in);
		
		$this->db->trans_complete();
		
		return $this->get_by_token($user_token);
	}
	
	function create_sns_binding($uid, $sns_website, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $name='', $token_expire_in=null) {
		//已经绑定过了
		$binding = $this->get_binding_by_sns_uid($sns_website, $sns_uid);
		if (!empty($binding)) {
					throw new Exception('sns_binding already binded: '.$sns_website.",".$sns_uid);
		}
		$binding = array(
			'user_id'=>$uid,
			'sns_website'=>$sns_website,
			'sns_uid'=>$sns_uid,
			'sns_oauth_token'=>$sns_oauth_token,
			'sns_oauth_token_secret'=>$sns_oauth_token_secret,
			'sns_display_name'=>$name,
			'token_expire_date'=>date("Y-m-d H:i:s", time()+$token_expire_in)
		);
		$this->db->insert(TBL_SNS_BINDING, $binding);
		
		return $this->get_binding_by_sns_uid($sns_website, $sns_uid);
	}

	/**
	 * 
	 * 根据sns_website+sns_uid找到binding，然后更新其他属性
	 * @param unknown_type $uid
	 * @param unknown_type $sns_website
	 * @param unknown_type $sns_uid
	 * @param unknown_type $sns_oauth_token
	 * @param unknown_type $sns_oauth_token_secret
	 * @param unknown_type $name
	 * @param unknown_type $token_expire_in
	 */
	function update_sns_binding($uid, $sns_website, $sns_uid, $sns_oauth_token, $sns_oauth_token_secret, $name='', $token_expire_in=null) {
		$binding = array();
		if(!empty($uid)) $binding['user_id'] = $uid;
		if(!empty($sns_oauth_token)) $binding['sns_oauth_token'] = $sns_oauth_token;
		if(!empty($sns_oauth_token_secret)) $binding['sns_oauth_token_secret'] = $sns_oauth_token_secret;
		if(!empty($name)) $binding['sns_display_name'] = $name;
		if(!empty($token_expire_in)) $binding['token_expire_date'] = date("Y-m-d H:i:s", time()+$token_expire_in);

		$this->db->update(TBL_SNS_BINDING, $binding, array('sns_website'=>$sns_website,'sns_uid'=>$sns_uid));
		
		return $this->get_binding_by_sns_uid($sns_website, $sns_uid);
	}
	
	/**
	 * 
	 * 更新一个sns_binding，return void
	 * @param int $id binding的id
	 * @param array $values
	 */
	function update_binding($id, $values) {
		$this->db->update(TBL_SNS_BINDING, $values, array('id'=>$id));
		//echo $this->db->last_query();
	}
	
	/**
	 * 
	 * 根据uid找到用户然后更新其他属性
	 * @param Array $values
	 */
	function update_user($uid, $values) {
/*		$user = array();
		if(!empty($values['display_name'])) $user['display_name'] = $values['display_name'];
		if(!empty($values['email'])) $user['email'] = $values['email'];
		if(!empty($values['last_login_time'])) $user['last_login_time'] = $values['last_login_time'];
		if(!empty($values['last_login_ip'])) $user['last_login_ip'] = $values['last_login_ip'];
		if(!empty($values['selected_project_id'])) $user['selected_project_id'] = $values['selected_project_id'];
*/		
		$this->db->update(TBL_USER, $values, array('id'=>$uid));
		//echo $this->db->last_query();
		
		return $this->get_by_id($uid);
	}
	
	/**
	 * 
	 * 获得用户列表
	 * @param unknown_type $page
	 * @param unknown_type $length
	 */
	function all($page = 0, $length = 0) {
		if(!$length) $length = 50;

		//$this->db->order_by("order_time", "desc");
		$query = $this->db->get(TBL_USER , $length , $page*$length);
		
		return $query->result();
	}
	
	function find_invited_users($uid)
	{
		return $this->db->get_where(TBL_USER, array('inviter_id' => $uid))->result();
	}
	
	function find_invited_commision($uid)
	{
		$r = $this->db->query("select sum(commision) as c from " . TBL_ORDER . " where user_id in(select id from " . TBL_USER . " where inviter_id=" . $uid . ")")->result();
		if(count($r) > 0)
			return $r[0]->c;
		return 0;
	}
}
?>