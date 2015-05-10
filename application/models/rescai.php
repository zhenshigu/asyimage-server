<?php
class  Rescai extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	//setting resturant information
	function setRes($data){
		$sql="insert into resturant(rname,telephone,shen,shi,xian,image,uid) values(?,?,?,?,?,?,?)";
		return  $this->db->query($sql,$data);
	}
	//update resturant information
	function updateRes($data){
		$sql="update resturant set rname=?,telephone=?,shen=?,shi=?,xian=?,image=? where uid=?";
		return $this->db->query($sql,$data);
	}
	//add cai
	function addCai($data)
	{
		$sql="insert into caishi(vname,price,descrition,imageurl,rid) values(?,?,?,?,?)";
		return  $this->db->query($sql,$data);
	}
	//update cai
	function updateCai($data){
		$sql="update caishi set vname=?,price=?,descrition=?,imageurl=? where vid=?";
		return $this->db->query($sql,$data);
	}
	//get cai list
	function getList($data){
		$sql="select * from caishi where rid=? limit ?";
		$query=$this->db->query($sql,$data);
		return $query->result_array();
	}
	//获得某个范围的菜单，用于分页
	function someCai($rid,$from,$pageCount){
		$sql="select * from caishi where rid=?  limit ?,?";
		$query=$this->db->query($sql,array($rid,$from,$pageCount));
		if ($query->num_rows()>0){
			return $query->result_array();
		}else {
			return  FALSE;
		}
	}
	//获得菜单数目
	//20150508修改，指定餐厅rid
	function getCount($data){
		$sql="select * from caishi where rid=?";
		$query=$this->db->query($sql,$data);
		return $query->num_rows();
	}
	//获得基于vid的菜式
	function  byVid($vid){
		$sql="select * from caishi where vid=?";
		$query=$this->db->query($sql,array($vid));
		if ($query->num_rows()>0){
			return $query->row_array();
		}else {
			return  FALSE;
		}
	}
	//删除菜
		function delCai($vid){
		$sql="delete from caishi where vid=?";
		return $this->db->query($sql,$vid);
	}
	//
}