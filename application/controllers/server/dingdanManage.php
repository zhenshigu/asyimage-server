<?php
class  DingdanManage extends CI_Controller{
	function addDingdan(){
		error_reporting(2047);
		$data=$this->input->post();
		$jsonDingdan=$data['dingdan'];
		$jsonVd=$data['vd'];
		$dingdan=json_decode($jsonDingdan,true);
		$jsonVd=json_decode($jsonVd,true,2);
		$cc=array();
		for ($i=0;$i<count($jsonVd);$i++){
			$tmp=json_decode($jsonVd[$i],true);
			unset($tmp["price"]);
			unset($tmp['name']);
			array_push($cc, $tmp);
		}
		var_dump($dingdan);
		var_dump($cc);
		$this->load->model('dingdan');
		$this->dingdan->addDingdan($dingdan,$cc);
	}
	//获得所有订单
	function getDingdan(){
		$data=$this->input->post();
//		$data=array(1);
		$this->load->model('dingdan');
		$result=$this->dingdan->allDingdan($data);
		for($i=0;$i<count($result);$i++){
			$result[$i]['xdate']=date("Y-m-d h:i:s",$result[$i]['xdate']);
		}
		echo json_encode($result,true);
	}
	//获取订单的具体条目
	function getVd(){
		$data=$this->input->post();
//		$data=array(1);
		$this->load->model('dingdan');
		$result=$this->dingdan->getVd($data);
		echo json_encode($result,true);
	}
	function test(){
		echo date("Y-m-d h:i:s",1428670773);
	}
	function hasnews(){
//		$data=$this->input->post();
		$data=array(1);
		$this->load->model('dingdan');
		$row=$this->dingdan->hasnews($data);
		if ($row){
			if ($row->newlist==1 ||$row->cancellist==1){
				$today=strtotime(date("Y-m-d"));
				array_push($data, $today);
				$dingdaninfo=$this->dingdan->getDingdan($data);
				$this->dingdan->reset();
		    	echo   json_encode($dingdaninfo);
			}
		}else {
			echo "null";
		}
	}
	//获得订单地址
	function getAddr(){
		$data=$this->input->post();
//		$data=array(1);
		$this->load->model('dingdan');
		$result=$this->dingdan->getAddr($data);
		echo  json_encode($result,true);
	}
	//添加新的订单地址
	function  addAddr(){
		$data=$this->input->post();
		$this->load->model('dingdan');
		if ($this->dingdan->addAddr($data)){
			echo "success";
		}else {
			echo "fail";
		}
	}
	//删除订单地址
	function delAddr(){
		$data=$this->input->post();
	$this->load->model('dingdan');
		if ($this->dingdan->delAddr($data)){
			echo "success";
		}else {
			echo "fail";
		}
	}
	//取消订单
	function cancelOrder(){
		$data=$this->input->post();
		array_push($data, time());
		$tmp=array();
		$tmp=array_reverse($data);
		$this->load->model('dingdan');
		if ($this->dingdan->cancelOrder($tmp)){
			echo "success";
		}else {
			echo "fail";
		}
	}
	//确认订单
	function confirmOrder(){
		$data=$this->input->post();
		$this->load->model('dingdan');
		if ($this->dingdan->confirmOrder($data)){
			echo "success";
		}else {
			echo "fail";
		}
	}
}