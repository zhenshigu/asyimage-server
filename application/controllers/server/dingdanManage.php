<?php
class  DingdanManage extends CI_Controller{
	function addDingdan(){
		$data=$this->input->post();
		$jsonDingdan=$data['dingdan'];
		$jsonVd=$data['vd'];
		$dingdan=json_decode($jsonDingdan,true);
		$jsonVd=json_decode($jsonVd,true);
		$this->load->model('dingdan');
		//==========test============
//		$a='{"destination":"dd","sum":100,"rid":1,"cid":1}';
//
//		$aa=json_decode($a,true);
//		$b="[{'vid':2,'count':1},{'vid':3,'count':2}]";
//		$bb=json_decode($b,true);
//		var_dump($aa);
//		var_dump($bb);
		$this->dingdan->addDingdan($aa,$bb);
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
}