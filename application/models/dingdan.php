<?php
class  Dingdan extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	//添加订单
	function addDingdan($dingdan,$vd){
		//开始事务
		 $this->db->trans_start();
		 $sql1="insert into dingdan(sum,rid,cid,destination,xdate,status) values(?,?,?,?,?,?)";
		 $sql2="insert into vd(count,vid,lid) values(?,?,?)";
		 $now=time();
		 $status="下单成功";
		 array_push($dingdan, $now);
		 array_push($dingdan, $status);
		$this->db->query($sql1,$dingdan);
		$lid=$this->db->insert_id();
		foreach ($vd as $one) {
			array_push($one, $lid);
			$this->db->query($sql2,$one);
		}
		//设置rid的newlist为1
		$sql3="update resturant set newlist=1 where rid=?";
		$this->db->query($sql3,array($dingdan['rid']));
		$this->db->trans_complete(); 
	}
	//获取有限订单列表
	function dingdanList($data){
		$sql="select * from dingdan where rid=? and xdate>? order by xdate desc    limit ? ";
		$query=$this->db->query($sql,$data);
		return $query->result_array();
	}
	//获取所有订单
function allDingdan($data){
		$sql="select * from dingdan,resturant where cid=? and dingdan.rid=resturant.rid";
		$query=$this->db->query($sql,$data);
		return $query->result_array();
	}
	//获取订单的具体条目
	function  getVd($data){
		$sql="select * from vd,caishi where lid=? and  vd.vid=caishi.vid";
		$query=$this->db->query($sql,$data);
		return $query->result_array();
	}
	//分页显示订单
	function someDd($rid,$from,$pageCount){//20150508增加rid参数
		$sql="select * from dingdan where rid=?  limit ?,?";
		$query=$this->db->query($sql,array($rid,$from,$pageCount));
		if ($query->num_rows()>0){
			return $query->result_array();
		}else {
			return  FALSE;
		}
	}
	//获得订单数目,用于分页
	function getCount($data){
		$sql="select lid from dingdan where rid=?";//20150508增加rid参数
		$query=$this->db->query($sql,$data);
		return $query->num_rows();
	}
	//获取特定订单
	function getDingdan($data){
		$sql="select * from dingdan where rid=?  and xdate>? order by xdate desc";
		$query=$this->db->query($sql,$data);
		return $query->result_array();
	}
	//查询是否有新消息
	function hasnews($data){
		$sql="select newlist,cancellist from resturant where rid=?";
		$query=$this->db->query($sql,$data);
		if ($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	function reset(){
		$sql="update resturant set newlist=0,cancellist=0";
		$query=$this->db->query($sql);
	}
	//获取订单地址列表
	function  getAddr($data){
		$sql="select * from address where cid=?";
		$query=$this->db->query($sql,$data);
		return $query->result_array();
	}
	//添加订单地址
	function  addAddr($data){
		$sql="insert into address(rname,rphone,raddress,cid) values(?,?,?,?)";
		return  $this->db->query($sql,$data);
	}
	//删除订单地址
	function delAddr($data){
		$sql="delete from address where aid=?";
		return  $this->db->query($sql,$data);
	}
	//取消订单
	function  cancelOrder($data){
		$sql="update dingdan set status=2,tdate=? where lid=?";
	   $this->db->query($sql,array($data["mytime"],$data["lid"]));
	   //设置rid的newlist为1
		$sql3="update resturant set cancellist=1 where rid=?";
		return  $this->db->query($sql3,array($data["rid"]));
	}
	//确认订单
	function  confirmOrder($data){
		$sql="update dingdan set status=1 where lid=?";
		return  $this->db->query($sql,$data);
	}
}