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
}