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
		$this->load->library('form_validation');
	   $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	  $this->form_validation->set_rules('password', 'Password', 'trim|required');
	  if ($this->form_validation->run() == FALSE)
	  {
	   $this->load->view('webviews/login');
	  }else {
		  	session_start();
			$email=$this->input->post("email",true);
			$password=$this->input->post("password",TRUE);
			$this->load->model('yhxt');
			$row=$this->yhxt->checkin($email,$password);
			if ($row){
			$_SESSION['uid']=$row->uid;
			$_SESSION['email']=$row->email;
			var_dump($_SESSION);
			}else {
				echo "login fail";
			}
	  }
	}
	
//log out
	function logout(){
		session_start();
		session_destroy();
	}
}