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
	} 