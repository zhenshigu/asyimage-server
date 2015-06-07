<?php
class CaiManage extends CI_Controller{
	private $host="http://10.0.2.2:8080/";
	function addCai(){
		if (!isset($_SESSION)){
			session_start();
		}
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('vname', 'Vname', 'trim|required');
	  	$this->form_validation->set_rules('price', 'Price', 'trim|required');
	  	$this->form_validation->set_rules('description', 'Description', 'trim|required');
		  if ($this->form_validation->run() == FALSE)
		  {
		  	$this->load->view('webviews/nav');
		  	$this->load->view('webviews/cai');
		  }else {
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
			$upfile = '/var/www/DingCan/resource/cai_img/'.$_SESSION['uid'].$_FILES['file']['name']; 
			if(is_uploaded_file($_FILES['file']['tmp_name'])) 
			{ 
			   if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile)) 
			   { 
			     echo '移动文件失败！'; 
			     exit; 
			    } else {
			    	
			    	$data['imageurl']=$this->host."DingCan/resource/cai_img/{$_SESSION['uid']}{$_FILES['file']['name']}";
			    	$data['rid']=$_SESSION['rid'];
			    	$this->load->model('rescai');
			    	if ($this->rescai->addCai($data)){
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
	function updateCai($vid){
	if (!isset($_SESSION)){
			session_start();
//			$_SESSION['uid']=3;
//			$_SESSION['vid']=1;
		}
		
		$this->load->library('form_validation');
  		$this->form_validation->set_rules('vname', 'Vname', 'trim|required');
	  	$this->form_validation->set_rules('price', 'Price', 'trim|required');
	  	$this->form_validation->set_rules('description', 'Description', 'trim|required');
		  if ($this->form_validation->run() == FALSE)
		  {
		 	 if (isset($vid)){
			$_SESSION['editvid']=$vid;
			}
		  	$this->load->model("rescai");
		  	$row=$this->rescai->byVid($_SESSION['editvid']);
		  	$this->load->view('webviews/nav');
		  	$this->load->view('webviews/updateCai',$row);
		  	
		  }else {
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
			$upfile = '/var/www/DingCan/resource/cai_img/'.$_SESSION['uid'].$_FILES['file']['name']; 
			if(is_uploaded_file($_FILES['file']['tmp_name'])) 
			{ 
			   if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile)) 
			   { 
			     echo '移动文件失败！'; 
			     exit; 
			    } else {
			    	$data['imageurl']="http://10.0.2.2:8080/DingCan/resource/cai_img/{$_SESSION['uid']}{$_FILES['file']['name']}";
			    	$data['vid']=$_SESSION['editvid'];
//			    	echo $_SESSION['editvid'];
//			    	var_dump($data);
			    	$this->load->model('rescai');
			    	if ($this->rescai->updateCai($data)){
			    		$this->load->view("webviews/nav");
			    		echo "<center><a href='http://localhost:8080/DingCan/index.php/server/showResturant/alllist'>菜式更改成功，点击返回</a></center>";
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
	function delCai(){
		$vid=$this->input->post();
		$this->load->model("rescai");
		if ($this->rescai->delCai($vid)){
			echo("success");
		}else {
			echo "fail";
		}
	}
}