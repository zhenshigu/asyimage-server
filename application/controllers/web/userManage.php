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
			$this->load->view("webviews/nav");
			$this->load->view('webviews/admin');
		}else{
			$this->load->view("webviews/nav");
	   		$this->load->view("webviews/login");
		}
	  	
	}
	function myadmin(){
			session_start();
			$email=$this->input->post("email",true);
			$password=$this->input->post("password",TRUE);
			$this->load->model('yhxt');
			$row=$this->yhxt->checkin($email,$password);
			if ($row ){
			$_SESSION['uid']=$row->uid;
			$_SESSION['email']=$row->email;
			$resinfo=$this->yhxt->finduid($row->uid);
			if ($resinfo){
				$_SESSION['rid']=$resinfo->rid;
				$_SESSION['rname']=$resinfo->rname;
				$_SESSION['phone']=$resinfo->telephone;
				$_SESSION['location']=$resinfo->shen.$resinfo->shi.$resinfo->xian;
				$image=$resinfo->image;
				$_SESSION['image']=str_replace("10.0.2.2", "localhost", $image);
				$this->load->model('rescai');
				$limit=8;
				$caiinfo=$this->rescai->getList(array($_SESSION['rid'],$limit));
				$data["caiinfo"]=$caiinfo;
				//get dingdan list
				$this->load->model("dingdan");
				$dingdaninfo=$this->dingdan->dingdanList(array($_SESSION['rid'],4));
				$data["dingdaninfo"]=$dingdaninfo;
			}
			$this->load->view("webviews/nav");
			$this->load->view('webviews/admin',$data);
			}elseif (isset($_SESSION['uid'])){
				$this->load->model('rescai');
				$limit=8;
				$caiinfo=$this->rescai->getList(array($_SESSION['rid'],$limit));
				$data["caiinfo"]=$caiinfo;
				//get dingdan list
				$this->load->model("dingdan");
				$dingdaninfo=$this->dingdan->dingdanList(array($_SESSION['rid'],4));
				$data["dingdaninfo"]=$dingdaninfo;
				$this->load->view("webviews/nav");
				$this->load->view('webviews/admin',$data);
			}
			else {
				echo "login fail";
			}
	}
//log out
	function logout(){
		session_start();
		session_destroy();
		$this->verify();
	}
}