<div class="container" >
<div class="row">
	<!-- frist column-->
	<div class="col-md-12">
<!-- 菜单列表 -->
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">菜单列表<button id="addnew" type="button" class="btn btn-danger col-md-offset-10">新增菜单</button></h3>
		  </div>
		  <div class="panel-body">
		    <table class="table table-striped table-hover">
		    		<?php 
				    		if (isset($list)){//20150508modify
					    		foreach ($list as $cai){
			    					$imgurl=str_replace("10.0.2.2", "localhost", $cai['imageurl']);
			    					echo  "<tr><td><img src=$imgurl width='50px' height='50px'></td><td>{$cai['vname']}</td><td>价格:{$cai['price']}</td><td>描述:{$cai['descrition']}</td>";
			    					echo '<td><button  type="button" class="btn btn-primary col-md-offset-9 editcai"> 编辑</button><input type="hidden" id="cid" value='.$cai['vid'].'></td>
			    					<td><button  type="button" class="btn btn-danger  delcai"> 删除</button><input type="hidden" id="cid2" value='.$cai['vid'].'></td></tr>';
			    				}
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
	<?php // 20150508 modify
		if (isset($navigation)){
			echo $navigation;
		}
	 ?>
	</div>
</div>
</div>
<script type="text/javascript">
<!--

//-->
$(function(){
	$("#addnew").click(function(){
		window.location.href="http://localhost:8080/DingCan/index.php/web/caiManage/addCai";  
	})
})
$(function(){
	$(".editcai").click(function(){
//		var siblings=$(this).parent().siblings();
//		var imgsrc=(siblings.eq(0).find("img").attr('src'));
//		var cname=(siblings.eq(1).text());
//		var price=(siblings.eq(2).text());
//		var descrition=(siblings.eq(3).text());
		
//		siblings.each(function(i){
//			alert($(this).text());
//			})
		var vid=$(this).next().val();
		window.location.href="http://localhost:8080/DingCan/index.php/web/caiManage/updateCai/"+vid;  
	})
})
$(function(){
	$(".delcai").click(function(){
		var vid=$(this).next().val();
		var btn=$(this);
		$.ajax({
				url:"http://localhost:8080/DingCan/index.php/web/caiManage/delCai",
				dataType:"html",
				type:"post",
				data:{"vid":vid},
				success:function(data){
					if(data=="success"){
						btn.parent().parent().remove();
					}else{
						alert("删除错误");
					}
				},
				error:function(){
					alert("菜单被引用，目前还不能删除");
				}
		})
		
//		window.location.href="http://localhost:8080/DingCan/index.php/web/caiManage/addCai";  
	})
})
</script>
