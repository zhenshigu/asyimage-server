<div class="container" >
<div class="row">
	<!-- frist column-->
	<div class="col-md-12">
<!-- 菜单列表 -->
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">订单列表</h3>
		  </div>
		  <div class="panel-body">
		    <table class="table table-striped table-hover">
		    		<?php 
		    				foreach ($list as $cai){
			    				$xdate=date('Y-m-d h:i:s',$cai['xdate']);
			    				switch ($cai['status']){
			    					case 0:
			    						$status="订单未完成";
			    						break;
			    					case 1:
			    						$status="订单完成";
			    						break;
			    					case 2:
			    						$status="订单取消";
			    						break;
			    				}
		    					echo  "<tr><td>订单编号:{$cai['lid']}</td><td>下单时间:$xdate</td>
		    					<td>订单状态:$status</td>
		    					<td>总价:{$cai['sum']}</td>
		    					<td>送货地址:{$cai['destination']}</td>
		    					</tr>";
		    				}
		    		?>
			</table>
		  </div>
		</div>
	<!-- 菜单列表 -->
	</div>
	</div>
<div class="row">
	<!-- frist column-->
	<div class="col-md-7 col-md-offset-5">
	<?php echo $navigation;?>
	</div>
</div>
</div>