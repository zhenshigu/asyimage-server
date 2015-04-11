<?php
	class ShowResturant extends CI_Controller{
		//获取基于某地点的餐厅列表
		function getResByPlace($place=""){
			$start=(int)$this->input->post("start");
			$num=(int)$this->input->post("num");
			$place=array("广东","普宁","流沙",$start,$num);
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
		$this->load->view("webviews/nav");
		if (!isset($_SESSION['uid'])){
			echo "还没登陆";
			exit();
		}
		$this->load->model("rescai");
		$count=$this->rescai->getCount();
		if (!$count){
			$this->load->view("nav");
			echo "暂时还没有添加菜单";
			exit();
		}
		$pageCount=2;
		$from=$this->input->get("per_page")+0;
		if (empty($from)){
			$from=0;
		}
		if($res=$this->rescai->someCai($from,$pageCount)){
			$baseurl='http://localhost:8080/DingCan/index.php/server/showResturant/alllist/?';
			$data=$this->paginagtion($pageCount,$count,$from,$res,$baseurl);
			$this->load->view('webviews/nav');
			$this->load->view('webviews/allList',$data);
		}
	}
} 