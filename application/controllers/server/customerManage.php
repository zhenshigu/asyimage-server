<?php
class CustomerManage extends CI_Controller{
	function addCustomer(){
		$info=$this->input->post();
		if ($info['password']!==$info['passconf']){
				echo "password1 and pwd2 are not the same";
				exit();
			}
			if (!isset($info['cname'])||!isset($info['email'])||!isset($info['sex'])||!isset($info['phone'])||!isset($info['shen'])||!isset($info['xian'])||!isset($info['shi'])){
				echo "fields can not be null";
			}
			$info['password']=md5($info['password']);
			unset($info['passconf']);
			$this->load->model('yhxt');
			if ($this->yhxt->registerc($info)){
				$this->load->view('webviews/addUserSuccess');
			}else {
				echo "fail";
			}
	}
	function verify(){
			session_start();
			$email=$this->input->post("email",true);
			$password=$this->input->post("password",TRUE);
			$this->load->model('yhxt');
			$row=$this->yhxt->checkinc($email,$password);
			if ($row){
			$_SESSION['uid']=$row->uid;
			$_SESSION['email']=$row->email;
			var_dump($_SESSION);
			}else {
				echo "login fail";
			}
	}
}