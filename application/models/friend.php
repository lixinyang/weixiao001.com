<?php
/**
 * 
 * 他管理friend表，好友可能4个来源：微笑网好友、新浪微博好友、推荐、被推荐
 * @author lxy
 *
 */
class Friend extends CI_Model
{
	/**
	 * 好友来源：微笑网
	 */
	const AT_WEIXIAO = 1; 
	/**
	 * 好友来源：新浪微博
	 */
	const AT_SINA = 2; 
	/**
	 * 好友来源：me邀请you
	 */
	const AT_INVITE = 3; 
	/**
	 * 好友来源：me被you邀请
	 */
	const AT_INVITED = 4; 
	
	/**
	 * 
	 * 从数据库中获取某一唯一值的方法
	 * 没找到返回null
	 * 找到一个就返回那个
	 * 找到多个就抛exception（要注意哦！！）
	 * @param string $table_name
	 * @param array $query
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
			return null;
			//throw new Excpetion("damn! we got something dupulicated that should be uniq: table(".$table_name."), query(".var_dump($query).")");
		}
		else
		{
			return $q->row();
		}
	}
	
	/**
	 * 
	 * 根据me/you的uid取我们俩之间的关系
	 * @param int $me
	 * @param int $you
	 */
	private function get($me, $you){
		$res = $this->get_uniq(TBL_FRIEND, array('me'=>$me, 'you'=>$you));
		return $res;
	}
	/**
	 * 获取两人间的关系，如果没有就创建
	 * 新创建的me/you之间的关系记录，默认没有任何关系
	 * @param int $me uid
	 * @param int $you uid
	 */
	private function get_or_create($me, $you){
		$res = $this->get($me, $you);
		if($res) return $res;
		
		$log_time = date("Y-m-d H:i:s", time());
		$data = array(
			'me'=>$me,
			'you'=>$you,
			'create_time'=>$log_time
		);
		$res = $this->db->insert(TBL_FRIEND, $data);
		return $this->get($me, $you);
	}
	/**
	 * 
	 * 更新me/you之间的关系
	 * @param $friend friend对象
	 */
	private function update($friend){
		$this->db->update(TBL_FRIEND, $friend, array('id'=>$friend->id));
		//echo $this->db->last_query();
		
		return $this->get($friend->me, $friend->you);
	}
	/**
	 * 
	 * 获取好友列表，me/you都可为空，但不能同时为空，否则返回null
	 * @param int $me
	 * @param int $you
	 * @param array $at list要取哪几种来源的好友，null或者空列表都代表去所有类型。array('at_weixiao'=>1, 'at_sina'=>1)
	 */
	private function get_list($me, $you, $at = null) {
		//不能都为空
		if (empty($me) && empty($you)) return null;
		
		$w = array();
		if (!empty($me)) $w['me'] = $me;
		if (!empty($you)) $w['you'] = $you;
		if (!empty($at)) $w += $at;
		$this->db->order_by("create_time", "desc");
		$query = $this->db->get_where(TBL_FRIEND , $w);
		
		return $query->result();
	}
	
	/**
	 * 这个函数将邀请人、被邀请人互相关注。调用者还需要：修改被邀请人的user表中的invited_by字段
	 * 如果被邀请人已经存在了invite关系，那么什么也不做直接return null
	 * 如果邀请人或被邀请人是空，那么什么也不做，直接return null
	 * @param int $invitor 邀请人的user的id
	 * @param int $invited 被邀请人的user的id
	 * @return 正常return void，参数不正确等异常返回null
	 */
	function invite($invitor, $invited) {
		//邀请人或者被邀请人为空，那么直接返回null
		if(empty($invited) || empty($invitor)) return null;
		
		// 先看看被邀请人是否已有邀请记录，有的话什么也不做直接返回null
		$rs = $this->get_list($invited, null, array('at_invited'=>1));
		if (!empty($rs)) return null;

		//让被邀请人关注邀请人
		$r = $this->get_or_create($invited, $invitor);
		$r->at_invited = 1;
		$r = $this->update($r);
		//让邀请人关注被邀请人
		$r = $this->get_or_create($invitor, $invited);
		$r->at_invite = 1;
		$r = $this->update($r);
	}
	/**
	 * 
	 * 取一个人的被邀请人列表
	 * @param int $invitor 邀请人uid
	 */
	function invited_list($invitor) {
		$rs = $this->get_list(null, $invitor, array('at_invite'=>1));
		return $rs;
	}
	
	/**
	 * 
	 * 关注某人，加为微笑网好友
	 * @param int $me 
	 * @param int $you
	 * @param int $at 通过哪个渠道认识的？默认值是在微笑网认识的
	 */
	function follow($me , $you , $at = Friend::AT_WEIXIAO) {
		//均不能为空，否则返回null
		if(empty($me) || empty($you)) return null;
		
		$r = $this->get_or_create($me, $you);
		switch ($at) {
			case Friend::AT_WEIXIAO:
				$r->at_weixiao = 1;
				break;
			case Friend::AT_SINA:
				$r->at_sina = 1;
				break;
			case Friend::AT_INVITE:
				$r->at_invite = 1;
				break;
			case Friend::AT_INVITED:
				$r->at_invited = 1;
				break;
			default:
				$r->at_weixiao = 1;
		}
		$r = $this->update($r);
	}
	/**
	 * 
	 * 解除微笑网关注关系
	 * @param int $me
	 * @param int $you
	 * @param int $at 通过哪个渠道认识的？默认值是在微笑网认识的
	 */
	function unfollow($me, $you , $at = Friend::AT_WEIXIAO) {
		//均不能为空，否则返回null
		if(empty($me) || empty($you)) return null;
		
		$r = $this->get($me, $you);
		if (!empty($r)) { //原来就没follow的话就跳过了
			switch ($at) {
				case Friend::AT_WEIXIAO:
					$r->at_weixiao = 0;
					break;
				case Friend::AT_SINA:
					$r->at_sina = 0;
					break;
				case Friend::AT_INVITE:
					$r->at_invite = 0;
					break;
				case Friend::AT_INVITED:
					$r->at_invited = 0;
					break;
				default:
					$r->at_weixiao = 1;
			}
			$r = $this->update($r);
		}
	}
	/**
	 * 
	 * 列我在微笑网关注的人的列表
	 * @param int $me
	 */
	function friends($me) {
		$res = $this->get_list($me, null);
		return $res;
	}
	/**
	 * 
	 * 列我在微笑网关注我的人的列表
	 * @param int $me
	 */
	function fans($me) {
		$res = $this->get_list(null , $me);
		return $res;
	}
	
}
?>