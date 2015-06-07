<?php
	class ShowResturant extends CI_Controller{
		//获取基于某地点的餐厅列表
		function getResByPlace($place=""){
			$start=(int)$this->input->post("start");
			$num=(int)$this->input->post("num");
			$shen=$this->input->post("shen");
			$shi=$this->input->post("shi");
			$xian=$this->input->post("xian");
			
//			$place=array("广东","普宁","流沙",$start,$num);
			$place=array($shen,$shi,$xian,$start,$num);
			$this->load->database();
			$sql="select * from resturant where  shen=? and shi=? and xian=? limit ?,?";
			$query=$this->db->query($sql,$place);
			$arr=array();
			if ($query){
				foreach ($query->result() as $row) {
					//=====20140409[modify]add the rid field============
					$tmp['rid']=$row->rid;
					//=============================================
					$tmp["name"]=$row->rname;
					$tmp['phone']=$row->telephone;
					$tmp['image']=$row->image;
					$tmp['shen']=$row->shen;
					$tmp['shi']=$row->shi;
					$tmp['xian']=$row->xian;
					array_push($arr, $tmp);
				}
				echo 	json_encode($arr);
//				echo $shen.$shi.$xian;
				//var_dump($arr);
			}
			
		}
		//获取餐厅菜单
		function getCaiByRes(){
			$rid=(int)$this->input->post("rid");
			$start=(int)$this->input->post("start");
			$num=(int)$this->input->post("num");
			$data=array($rid,$start,$num);
//			$data=array(1,0,2);
			$this->load->database();
			$sql="select * from caishi where rid=? limit ?,?";
			$query=$this->db->query($sql,$data);
			$arr=array();
			if ($query){
				foreach ($query->result() as $row) {
					$tmp['vid']=$row->vid;
					$tmp["name"]=$row->vname;
					$tmp['price']=$row->price;
					$tmp['descrition']=$row->descrition;
					$tmp['imageurl']=$row->imageurl;
					$tmp['rid']=$row->rid;
					array_push($arr, $tmp);
				}
				echo json_encode($arr);
			}
		}
		//分页函数
		function paginagtion($pageCount,$count,$from,$result,$baseurl){
		$this->load->library('pagination');
		$data=array();
		$data['list']=$result;
		$config['base_url'] = $baseurl;
		//$config['uri_segment'] = 4;
		$config['total_rows']=$count;
		$config['per_page'] = $pageCount; 
		$config['num_links'] = 2;
		$config ['first_link'] = '首页';
  		$config ['last_link'] = '末页';
  		$config ['next_link'] = '下一页>';
 		$config ['prev_link'] = '<上一页';
		$config['enable_query_strings']=TRUE;
		$config['page_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['navigation']=$this->pagination->create_links();
		return $data;
	}
	//通过分页显示所有菜单
	function alllist(){
		if (!isset($_SESSION)){
			session_start();
		}
		
		if (!isset($_SESSION['uid'])){
			$this->load->view("webviews/nav");
			echo "还没登陆";
			exit();
		}
		$this->load->model("rescai");
		$count=$this->rescai->getCount(array($_SESSION['rid']));//20150508修改，添加rid参数
		if (!$count){
			$this->load->view('webviews/nav');
			$this->load->view('webviews/allList');
			echo "暂时还没有添加菜单";
			return ;
		}
		$pageCount=6;
		$from=$this->input->get("per_page")+0;
		if (empty($from)){
			$from=0;
		}
		if($res=$this->rescai->someCai($_SESSION['rid'],$from,$pageCount)){//20150508修改，添加rid参数
			$baseurl='http://localhost:8080/DingCan/index.php/server/showResturant/alllist/?';
			$data=$this->paginagtion($pageCount,$count,$from,$res,$baseurl);
			$this->load->view('webviews/nav');
			$this->load->view('webviews/allList',$data);
		}
	}
	//通过分页显示所有订单
	function allDingdan(){
		if (!isset($_SESSION)){
			session_start();
		}
		
		if (!isset($_SESSION['uid'])){
			$this->load->view("webviews/nav");
			echo "还没登陆";
			exit();
		}
		$this->load->model("dingdan");
		$count=$this->dingdan->getCount(array($_SESSION['rid']));
		if (!$count){
			$this->load->view("webviews/nav");
			echo "暂时还没有订单";
			exit();
		}
		$pageCount=6;
		$from=$this->input->get("per_page")+0;
		if (empty($from)){
			$from=0;
		}
		if($res=$this->dingdan->someDd($_SESSION['rid'],$from,$pageCount)){
			$baseurl='http://localhost:8080/DingCan/index.php/server/showResturant/allDingdan/?';
			$data=$this->paginagtion($pageCount,$count,$from,$res,$baseurl);
			$this->load->view('webviews/nav');
			$this->load->view('webviews/allDingdan',$data);
		}
	}
	//显示订单详情
	function dingdanDetail($lid){
//		$lid=$this->input->get();
		$this->load->model("dingdan");
		$result=$this->dingdan->getVd($lid);
		$data['detail']=$result;
		$this->load->view('webviews/nav');
		$this->load->view('webviews/dingdanDetail',$data);
	}
	//关于
	function theAbout(){
		$this->load->view('webviews/nav');
		$this->load->view("webviews/about");
	}
	//联系方式
	function contact(){
		$this->load->view('webviews/nav');
		$this->load->view("webviews/contact");
	}
} 