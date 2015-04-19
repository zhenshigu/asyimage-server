<?php
class  ResturantManage extends CI_Controller{
	//setting the informations of the resturant
	function setResturant(){
		if (!isset($_SESSION)){
			session_start();
			$_SESSION['uid']=5;
		}
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('rname', 'Rname', 'trim|required');
	  	$this->form_validation->set_rules('telephone', 'Tel', 'trim|required|min_length[7]');
//	  	$this->form_validation->set_rules('shen', 'Shen', 'trim|required');
//	  	$this->form_validation->set_rules('shi', 'Shi', 'trim|required');
//	  	$this->form_validation->set_rules('xian', 'Xian', 'trim|required');
		  if ($this->form_validation->run() == FALSE)
		  {
		  	$this->load->view('webviews/resturant');
		  }else {
		  	
		  	$data=$this->input->post();
		  	var_dump($_FILES);
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
			    		echo "resturant setting success";
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
	//modify the resturant information
	function updateResturant()
	{
		if (!isset($_SESSION)){
				session_start();
			}
		if (!isset($_SESSION['uid'])){
		echo "你还没登录";
		exit();
		}
			$this->load->library('form_validation');
	  		$this->form_validation->set_rules('rname', 'Rname', 'trim|required');
		  	$this->form_validation->set_rules('phone', 'Tel', 'trim|required|min_length[3]');
		  	$this->form_validation->set_rules('shen', 'Shen', 'trim|required');
		  	$this->form_validation->set_rules('shi', 'Shi', 'trim|required');
		  	$this->form_validation->set_rules('xian', 'Xian', 'trim|required');
		  if ($this->form_validation->run() == FALSE)
		  {
		  	$this->load->model('yhxt');
		  	$resinfo=$this->yhxt->findUid2($_SESSION['uid']);
		  	$this->load->view("webviews/nav");
		  	$this->load->view('webviews/updateRes',$resinfo);
		  }else {
		  $data=$this->input->post();
		  	var_dump($_FILES);
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
			    	$data['image']="http://localhost:8080/DingCan/resource/res_img/{$_SESSION['uid']}{$_FILES['file']['name']}";
			    	$data['uid']=$_SESSION['uid'];
			    	$this->load->model('rescai');
			    	if ($this->rescai->updateRes($data)){
			    		//更新session里面的餐厅信息
			    		$this->load->model("yhxt");
			    		$resinfo=$this->yhxt->findUid($_SESSION['uid']);
						if ($resinfo){
							$_SESSION['rid']=$resinfo->rid;
							$_SESSION['rname']=$resinfo->rname;
							$_SESSION['phone']=$resinfo->telephone;
							$_SESSION['location']=$resinfo->shen.$resinfo->shi.$resinfo->xian;
							$image=$resinfo->image;
							$_SESSION['image']=str_replace("10.0.2.2", "localhost", $image);
							header("Location:http://localhost:8080/DingCan/index.php/web/userManage/myadmin");
							}else {
								echo "fail";
							}
			    	}else {
			    		echo "fail";
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