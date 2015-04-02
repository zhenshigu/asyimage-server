<?php
class  ResturantManage extends CI_Controller{
	//setting the informations of the resturant
	function setResturant(){
		if (!isset($_SESSION)){
			session_start();
			$_SESSION['uid']=3;
		}
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('rname', 'Rname', 'trim|required');
	  	$this->form_validation->set_rules('telephone', 'Tel', 'trim|required|min_length[7]');
	  	$this->form_validation->set_rules('shen', 'Shen', 'trim|required');
	  	$this->form_validation->set_rules('shi', 'Shi', 'trim|required');
	  	$this->form_validation->set_rules('xian', 'Xian', 'trim|required');
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
			    	$data['image']="http://localhost:8080/DingCan/resource/res_img/{$_SESSION['uid']}.{$_FILES['file']['name']}";
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
				$_SESSION['uid']=3;
			}
			$this->load->library('form_validation');
	  		$this->form_validation->set_rules('rname', 'Rname', 'trim|required');
		  	$this->form_validation->set_rules('telephone', 'Tel', 'trim|required|min_length[7]');
		  	$this->form_validation->set_rules('shen', 'Shen', 'trim|required');
		  	$this->form_validation->set_rules('shi', 'Shi', 'trim|required');
		  	$this->form_validation->set_rules('xian', 'Xian', 'trim|required');
		  if ($this->form_validation->run() == FALSE)
		  {
		  	$this->load->view('webviews/updateRes');
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
			    	$data['image']="http://localhost:8080/DingCan/resource/res_img/{$_SESSION['uid']}.{$_FILES['file']['name']}";
			    	$data['uid']=$_SESSION['uid'];
			    	$this->load->model('rescai');
			    	if ($this->rescai->updateRes($data)){
			    		echo "updating resturant  success";
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