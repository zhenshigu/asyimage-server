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
		  	$this->load->view("webviews/nav");
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
				$this->load->view("webviews/nav");
				$this->load->view('webviews/addUserSuccess');
			}else {
				$this->load->view("webviews/nav");
				echo "添加失败";
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
		$this->load->model('yhxt');
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
				$this->load->view("webviews/nav");
				echo "login fail";
				exit();
			}
			//获取用户信息并保存到session
//			$resinfo=$this->yhxt->findUid($_SESSION['uid']);
//			if ($resinfo){
//				$_SESSION['rid']=$resinfo->rid;
//				$_SESSION['rname']=$resinfo->rname;
//				$_SESSION['phone']=$resinfo->telephone;
//				$_SESSION['location']=$resinfo->shen.$resinfo->shi.$resinfo->xian;
//				$image=$resinfo->image;
//				$_SESSION['image']=str_replace("10.0.2.2", "localhost", $image);
//			}else {
//				$this->load->view("webviews/nav");
//				$this->setResturant();
//				return ;
//			}
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
				$this->load->view("webviews/nav");
				$this->setResturant();
				return ;
			}
				$this->load->model('rescai');
				$limit=4;
				$caiinfo=$this->rescai->getList(array($_SESSION['rid'],$limit));
				$data["caiinfo"]=$caiinfo;
				//get dingdan list
				$this->load->model("dingdan");
				$today=strtotime(date("Y-m-d"));
				$dingdaninfo=$this->dingdan->dingdanList(array($_SESSION['rid'],$today,4));
				$this->dingdan->reset();//20150510 重置餐厅状态
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
	//设置餐厅信息
	function setResturant(){
		if (!isset($_SESSION)){
			session_start();
		}
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('rname', 'Rname', 'trim|required');
	  	$this->form_validation->set_rules('telephone', 'Tel', 'trim|required|min_length[7]');
//	  	$this->form_validation->set_rules('shen', 'Shen', 'trim|required');
//	  	$this->form_validation->set_rules('shi', 'Shi', 'trim|required');
//	  	$this->form_validation->set_rules('xian', 'Xian', 'trim|required');
		  if ($this->form_validation->run() == FALSE)
		  {
		  	$this->load->view("webviews/nav");
		  	$this->load->view('webviews/resturant');
		  }else {
		  	$this->load->view("webviews/nav");
		  	$data=$this->input->post();
//		  	var_dump($_FILES);
//			var_dump($data);
		  	if($_FILES['file']['error'] > 0){ 
					   echo '!problem:'; 
					   switch($_FILES['file']['error']) 
					   { 
					     case 1: echo '文件大小超过服务器限制'; 
					             break; 
					     case 2: echo '文件太大！'; 
					             break; 
					     case 3: echo '文件只加载了一部分！'; 
					             break; 
					     case 4: echo '文件加载失败！'; 
					             break; 
					   } 
					   exit; 
			} 
			if($_FILES['file']['size'] > 1000000){ 
			   echo '文件过大！'; 
			   exit; 
			} 
			if($_FILES['file']['type']!='image/jpeg' && $_FILES['file']['type']!='image/gif'){ 
			   echo '文件不是JPG或者GIF图片！'; 
			   exit; 
			} 
			$filetype = $_FILES['file']['type']; 
			if($filetype == 'image/jpeg'){ 
			  $type = '.jpg'; 
			} 
			if($filetype == 'image/gif'){ 
			  $type = '.gif'; 
			}  
			$upfile = '/var/www/DingCan/resource/res_img/'.$_SESSION['uid'].$_FILES['file']['name']; 
			if(is_uploaded_file($_FILES['file']['tmp_name'])) 
			{ 
			   if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile)) 
			   { 
			     echo '移动文件失败！'; 
			     exit; 
			    } else {
			    	$data['image']="http://10.0.2.2:8080/DingCan/resource/res_img/{$_SESSION['uid']}{$_FILES['file']['name']}";
			    	$data['uid']=$_SESSION['uid'];
			    	$this->load->model('rescai');
			    	if ($this->rescai->setRes($data)){
			    		$this->load->view("webviews/nav");
			    		echo "餐厅设置成功";
			    		$this->load->model('yhxt');
				    	$resinfo=$this->yhxt->findUid($_SESSION['uid']);
						if ($resinfo){
							$_SESSION['rid']=$resinfo->rid;
							$_SESSION['rname']=$resinfo->rname;
							$_SESSION['phone']=$resinfo->telephone;
							$_SESSION['location']=$resinfo->shen.$resinfo->shi.$resinfo->xian;
							$image=$resinfo->image;
							$_SESSION['image']=str_replace("10.0.2.2", "localhost", $image);
						}
			    	}
			    }
			    
			} 
			else 
			{ 
			   echo 'problem!'; 
			   exit; 
			}  
		 }
	}
}