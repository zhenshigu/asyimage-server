<?php
class CacheT extends CI_Controller{
	public function  mm(){
		$mydb=new mysqli("localhost","root","858978ym","test");
		if (!$mydb)
		{
			echo "connect failed";
			return ;
		}
		$sql="select * from cacheT";
		$result=$mydb->query($sql);
		$size=$result->num_rows;
		$data=array();
		for ($i=0;$i<$size;$i++)
		{
			$row=$result->fetch_array();
			$data["n1"]=$row;
			
		}
		$this->output->cache(5);
		$this->load->view("ca.php",$data);
	}
}

