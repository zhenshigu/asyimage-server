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
		$this->db->trans_complete(); 
	}
}