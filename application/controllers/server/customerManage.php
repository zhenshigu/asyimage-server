<?php
class CustomerManage extends CI_Controller{
	function addCustomer(){
		$info=$this->input->post();
			if (!isset($info['cname'])||!isset($info['email'])||!isset($info['sex'])||!isset($info['phone'])||!isset($info['shen'])||!isset($info['xian'])||!isset($info['shi'])){
				echo "fields can not be null";
			}
//			$info=array("111@qq.com","hao","girl","1564871487","gd","gz","py",md5("123"));
			$this->load->model('yhxt');
			if ($this->yhxt->registerc($info)){
//				$this->load->view('webviews/addUserSuccess');
				echo  "success";
			}else {
				echo "fail";
			}
	}
	function verify(){
			$email=$this->input->post("email",true);
			$password=$this->input->post("password",TRUE);
//$email="111@qq.com";
//$password="202cb962ac59075b964b07152d234b70";
			$this->load->model('yhxt');
			$row=$this->yhxt->checkinc($email,$password);
			if ($row){
			$arr['cid']=$row->cid;
			$arr['email']=$row->email;
			$arr['name']=$row->cname;
			$arr['phone']=$row->phone;
			$arr['shen']=$row->shen;
			$arr['xian']=$row->xian;
			$arr['shi']=$row->shi;
			echo json_encode($arr);
			}else {
				$arr['no']=false;
				echo json_encode($arr);
			}
	}
}