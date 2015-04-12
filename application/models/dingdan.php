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
		 $sql1="insert into dingdan(destination,sum,rid,cid,xdate,status) values(?,?,?,?,?,?)";
		 $sql2="insert into vd(vid,count,lid) values(?,?,?)";
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
		$sql="select * from dingdan where rid=? limit ?";
		$query=$this->db->query($sql,$data);
		return $query->result_array();
	}
	//分页显示订单
	function someDd($from,$pageCount){
		$sql="select * from dingdan  limit ?,?";
		$query=$this->db->query($sql,array($from,$pageCount));
		if ($query->num_rows()>0){
			return $query->result_array();
		}else {
			return  FALSE;
		}
	}
	//获得订单数目,用于分页
	function getCount(){
		$sql="select lid from dingdan";
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	//获取特定订单
	function getDingdan($data){
		$sql="select * from dingdan where rid=? and status<2 and xdate<?";
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
}