<div class="container" >
<div class="row">
	<!-- frist column-->
	<div class="col-md-12">
<!-- 菜单列表 -->
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">菜单列表<button id="mycai" type="button" class="btn btn-danger col-md-offset-10">新增菜单</button></h3>
		  </div>
		  <div class="panel-body">
		    <table class="table table-striped table-hover">
		    		<?php 
		    				foreach ($list as $cai){
		    					$imgurl=str_replace("10.0.2.2", "localhost", $cai['imageurl']);
		    					echo  "<tr><td><img src=$imgurl width='50px' height='50px'></td><td>{$cai['vname']}</td><td>价格:{$cai['price']}</td><td>描述:<td>{$cai['descrition']}</td>";
		    					echo '<td><button id="mycai" type="button" class="btn btn-primary col-md-offset-9"> 编辑</button></td></tr>';
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
<?php
