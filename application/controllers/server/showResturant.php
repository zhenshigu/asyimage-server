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
	} 