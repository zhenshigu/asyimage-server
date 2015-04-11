<?php
class Yhxt extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	//user checkin model
	function checkin($email,$password){			
		$query=$this->db->query('select * from master where email="'.$email.'" and password="'.md5($password).'"');
		if ($query->num_rows()>0){
			$row=$query->row();
			return $row;
		}
		else {
			return  false;
		}
	}
	//customer checkin
	function checkinc($email,$password){
		$query=$this->db->query("select * from customer where email='".$email."' and password='".$password."'");
		if ($query->num_rows()>0){
			$row=$query->row();
			return $row;
		}
		else {
			return  false;
		}
	}
	//user register model
	function register($info){
		$sql="insert into master(password,email) values(?,?)";
		return $this->db->query($sql,$info);
	}
	//customer register 
	function  registerc($info){
		$sql="insert into customer(email,cname,sex,phone,shen,shi,xian,password) values(?,?,?,?,?,?,?,?)";
		return $this->db->query($sql,$info);
	}
	//find the specified User
	function findUser($cInfo,$from,$perPage){
		$sql="select * from user where name=? limit ?,?";
		$query=$this->db->query($sql,array($cInfo,$from,$perPage));
		if ($query->num_rows()>0){
			return $query->result();
		}else {
			return  FALSE;
		}
	}
	//find user by uid
	function findUid($uid){
		$sql="select * from resturant where uid=? ";
		$query=$this->db->query($sql,array($uid));
			if ($query->num_rows()>0){
			return $query->row();
		}else {
			return  FALSE;
		}
	}
	//find user by cid
	function findCid($cid){
		$sql="select * from customer where cid=? ";
		$query=$this->db->query($sql,array($cid));
			if ($query->num_rows()>0){
			return $query->row();
		}else {
			return  FALSE;
		}
	}
	//get count
	function getCount($name){
		$sql="select * from user where name=?";
		$query=$this->db->query($sql,array($name));
		return $query->num_rows();
	}
	//delete the specified user
	function delUser($uid){
		$sql="delete from user where uid=?";
		if ($this->db->query($sql,array($uid))){
			return $this->db->affected_rows();
		} 
		return false;
	}
	//modify the specified custmoer
	function modifyUser($cInfo){
		$sql="update user set tid=?,name=?,sex=?,age=?,email=? where uid=?";
		return $this->db->query($sql,$cInfo);
	}
	//change user password
	function changePwd($pwd,$name){
		$sql="update user set passsword=? where name=?";
		return $this->db->query($sql,array($pwd,$name));
	}
	//if the user has the privilege
	function isPrivilege($uid,$pri){
		$sql="select * from user,userpri where user.uid=? and user.uid=userpri.uid ".$pri;
		$query=$this->db->query($sql,array($uid,$pri));
			if ($query->num_rows()>0){
				return true;
			}else {
				return false;
			}
		
		
	}
	
	//add new customer
	function addCustomer($cinfo){
		$this->db->trans_start();
			$query=$this->db->query("select * from lastcode");
			$row=$query->row();
			$nextcode=$row->code;
			$cinfo['code']=$nextcode;
			$nextcode+=1;
			$this->db->query("update lastcode set code=".$nextcode);
		$sql="insert into customer(name,documentType,idnumber,address,contact,credit,register,sex,age,salary,worktime,date,code) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		 $this->db->query($sql,$cinfo);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	//get count
	function getCount2($name){
		$sql="select * from customer where name=?";
		$query=$this->db->query($sql,array($name));
		return $query->num_rows();
	}
	//find the specified customer
	function findCustomer($cInfo,$from,$perPage){
		$sql="select * from customer where name=? limit ?,? ";
		$query=$this->db->query($sql,array($cInfo,$from,$perPage));
		if ($query->num_rows()>0){
			return $query->result();
		}else {
			return  FALSE;
		}
	}
	//find customer by idnumber
	function findCustomerId($id){
		$sql="select * from customer where idnumber=?";
		$query=$this->db->query($sql,array($id));
		if ($query->num_rows()>0){
			return $query->row();
		}else {
			return false;
		}
	}
	//modify the specified custmoer
	function modifyCustomer($cInfo){
		$sql="update customer set sex=?,age=?,address=?,contact=?,credit=? where cid=?";
		$query= $this->db->query($sql,$cInfo);
		return $this->db->affected_rows();
	}
	//获得客户信誉
	function customerCredit($cid){
		$sql="select * from customer where cid=?";
		$query=$this->db->query($sql,array($cid));
		return $query->row_array();
		
	}
	//查看用户权限、
	function privilege($uid){
		$sql="select * from user,userpri where user.uid=? and user.uid=userpri.uid";
		$query=$this->db->query($sql,array($uid));
		if ($query->num_rows()>0) {
			return $query->row_array();
		}else {
			return FALSE;
		}
	}
	//查看用户是否存在权限表userpri里面,没有的话则插入
	function isUserPri($uid){
		$sql="select * from userpri where uid=?";
		$query=$this->db->query($sql,array($uid));
		if($query->num_rows()<1){
			$sql="insert into userpri(uid) values(?)";
			$query=$this->db->query($sql,array($uid));
		}
	}
	//更新用户权限
	function updateUserpri($pri){
		$sql="update userpri set pricustomer=?,priuser=?,prisp=?,priff=?,priyq=?,prizq=? where uid=?";
		return $this->db->query($sql,$pri);
		
	}
}