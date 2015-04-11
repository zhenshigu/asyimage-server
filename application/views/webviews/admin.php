
<div class="container" >
<!-- first row -->
<div class="row">
	<!-- frist column-->
	<div class="col-md-5">
	<!-- 面板 -->
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">用户信息
		    	<button type="button" class="btn btn-primary col-md-offset-8">设置</button>
		    </h3>
		  </div>
		  <div class="panel-body">
		    	<!-- first row -->
				<div class="row">
					<!-- frist column-->
					<div class="col-md-5">
					    <a href="#" class="thumbnail">
					      <img src=<?php echo isset($_SESSION['image'])?$_SESSION['image']:'null' ?> alt="暂无">
					    </a>
					</div>
					<!-- first column end -->
					<!-- second column -->
					<div class="col-md-7">
						<ul class="list-group">
						  <li class="list-group-item">餐厅名:<?php echo isset($_SESSION['rname'])?$_SESSION['rname']:"null" ?></li>
						  <li class="list-group-item">订餐电话:<?php echo isset($_SESSION['phone'])?$_SESSION['phone']:"null" ?></li>
						  <li class="list-group-item">餐厅位置:<?php echo isset($_SESSION['location'])?$_SESSION['location']:"null" ?></li>
						  <li class="list-group-item">管理人编号:<?php echo isset($_SESSION['uid'])?$_SESSION['uid']:"null" ?></li>
						  <li class="list-group-item">邮箱:<?php echo isset($_SESSION['email'])?$_SESSION['email']:"null" ?></li>
						</ul>
					</div>
					<!-- second column end -->
				</div>
				<!-- firstrow end -->
		  </div>
		 <div class="panel-footer">
		 <button type="button" class="btn btn-danger  col-md-offset-10" id="myexit">退出</button>
		 </div>
		</div>
		<!-- 面板end -->
	</div>
	<!-- first column end -->
	<!-- second column -->
	<div class="col-md-7">
	<!-- 菜单列表 -->
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">菜单列表
		    <button id="mycai" type="button" class="btn btn-primary col-md-offset-9">查看更多</button>
		    </h3>
		  </div>
		  <div class="panel-body">
		    <table class="table table-striped table-hover">
		    		<?php 
		    				foreach ($caiinfo as $cai){
		    					$imgurl=str_replace("10.0.2.2", "localhost", $cai['imageurl']);
		    					echo  "<tr><td><img src=$imgurl width='50px' height='50px'></td><td>{$cai['vname']}</td><td>价格:{$cai['price']}</td><td>描述:<td>{$cai['descrition']}</td></tr>";
		    				}
		    		?>
			</table>
		  </div>
		</div>
	</div>
	<!-- 菜单列表 -->
	<!-- second column end -->
</div>
<!-- firstrow end -->
<!-- second row -->
<div class="row">
	<!-- frist column-->
	<div  class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">待处理订单列表<button type="button" class="btn btn-primary col-md-offset-9">查看全部订单</button></h3>
			  </div>
			  <div id="handlelist" class="panel-body">
			  	    <table class="table table-striped table-hover">
		    		<?php 
		    				foreach ($dingdaninfo as $cai){
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
	 </div>
	 <!-- first column end -->
</div>
<!-- second row end -->
</div>
<script>
	$(function(){
			$("#myexit").click(function(){
				window.location.href="http://localhost:8080/DingCan/index.php/web/userManage/logout";  
			})
	})
	$(function(){
			$("#mycai").click(function(){
				window.location.href="http://localhost:8080/DingCan/index.php/server/showResturant/alllist";  
			})
	})
	$(function(){
			run();
	})
	function run(){
		interval = setInterval(hasnews, "10000"); 
	}
	function hasnews(){
			$.ajax({
					url:"http://localhost:8080/DingCan/index.php/server/dingdanManage/hasnews",
					type:"post",
					data:{"rid":"1"},
					dataType:"json",
					success:function(data){
						var str='<table class="table table-striped table-hover">';
						$.each(data,function(index,item){
							var status='';
								if(item.status==0){
									status="订单未完成";
								}else{
									status="订单撤销";
								}
								str+="<tr><td>订单编号:"+item.lid;
								str+="</td><td>下单时间:"+item.xdate;
								str+="</td><td>订单状态:"+status;
								str+="</td><td>总价:"+item.sum;
								str+="</td><td>送货地址:"+item.destination;
								str+="</td></tr>"
						});
						str+="</table>";
						$("#handlelist").html(str);
					},
					error:function(){
//						alert("fail");
					}
				})
	}
</script>