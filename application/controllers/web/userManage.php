<?php
class UserManage extends CI_Controller{
	function  __construct(){
		parent::__construct();
	}
	//add the user
	function addUser(){
  		$this->load->library('form_validation');
  		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	  	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
	  	$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|min_length[6]');
	  if ($this->form_validation->run() == FALSE)
		  {
		   $this->load->view('webviews/addUser.php');
		  }
		  else
		  {
		  	$info=$this->input->post();
		  if ($info['password']!==$info['passconf']){
				return false;
			}
			$info['password']=md5($info['password']);
			unset($info['passconf']);
//		var_dump($info);
			$this->load->model('yhxt');
			if ($this->yhxt->register($info)){
				$this->load->view('webviews/addUserSuccess');
			}else {
				echo "fail";
			}
		   
		  }
	}
	//verify the user
	function verify(){
		session_start();
		if (isset($_SESSION['uid'])){
			$this->myadmin();
		}else{
			$this->load->view("webviews/nav");
	   		$this->load->view("webviews/login");
		}
	  	
	}

	function myadmin(){
		if (!isset($_SESSION)){
			session_start();
		}
		if (!isset($_SESSION['uid'])){
			//验证用户登录
			$email=$this->input->post("email",true);
			$password=$this->input->post("password",TRUE);
			$this->load->model('yhxt');
			$row=$this->yhxt->checkin($email,$password);
			if ($row ){
				$_SESSION['uid']=$row->uid;
				$_SESSION['email']=$row->email;
			}else {
				echo "login fail";
				exit();
			}
			//获取用户信息并保存到session
			$resinfo=$this->yhxt->findUid($_SESSION['uid']);
			if ($resinfo){
				$_SESSION['rid']=$resinfo->rid;
				$_SESSION['rname']=$resinfo->rname;
				$_SESSION['phone']=$resinfo->telephone;
				$_SESSION['location']=$resinfo->shen.$resinfo->shi.$resinfo->xian;
				$image=$resinfo->image;
				$_SESSION['image']=str_replace("10.0.2.2", "localhost", $image);
			}else {
				echo "获取餐厅信息失败";
				exit();
			}
		}	
				$this->load->model('rescai');
				$limit=4;
				$caiinfo=$this->rescai->getList(array($_SESSION['rid'],$limit));
				$data["caiinfo"]=$caiinfo;
				//get dingdan list
				$this->load->model("dingdan");
				$today=strtotime(date("Y-m-d"));
				$dingdaninfo=$this->dingdan->dingdanList(array($_SESSION['rid'],$today,4));
				$data["dingdaninfo"]=$dingdaninfo;
			$this->load->view("webviews/nav");
			$this->load->view('webviews/admin',$data);
	}
//log out
	function logout(){
		session_start();
		session_destroy();
		$this->verify();
	}
}