<?php
?>
<div class="container" >
<div class="row">
	<!-- frist column-->
	<div class="col-md-12">
<!-- 菜单列表 -->
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">订单详情</h3>
		  </div>
		  <div class="panel-body">
		    <table class="table table-striped table-hover">
		    		<?php 
				    		if (isset($detail)){//20150508modify
				    			$sum=0;
					    		foreach ($detail as $cai){
					    			$sum+=$cai['price']*$cai['count'];
			    					$imgurl=str_replace("10.0.2.2", "localhost", $cai['imageurl']);
			    					echo  "<tr><td><img src=$imgurl width='50px' height='50px'></td><td>{$cai['vname']}</td><td>价格:{$cai['price']}</td><td>描述:{$cai['descrition']}</td>
			    					<td>数量:{$cai['count']}</td></tr>";
			    				}
			    				
			    				echo "<tr><td>订单总价:".$sum."</td></tr>";
				    		}
		    		?>
			</table>
		  </div>
		</div>
	<!-- 菜单列表 -->
	</div>
	</div>
</div>