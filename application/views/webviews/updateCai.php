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
<div class="col-md-7 ">
<img src="<?php echo  str_replace("10.0.2.2", "localhost", $imageurl)?>" alt="..." class="img-circle">
<form enctype="multipart/form-data"  method="post">
  <div class="form-group">
    <label for="vname">菜名</label>
    <input type="text" class="form-control" id="vname" placeholder='<?php echo $vname?>'  name="vname">
  </div>
  <div class="form-group">
    <label for="price">价格</label>
    <input type="text" class="form-control" id="price" placeholder="<?php echo $price?>" name="price">
  </div>
   <div class="form-group">
    <label for="descrition">描述</label>
    <input type="text" class="form-control" id="description" placeholder="<?php echo $descrition?>" name="description">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">新图片上传</label>
    <input type="file" id="exampleInputFile" name="file">
    <p class="help-block">选择新菜式图片.</p>
  </div>
  <button type="submit" class="btn btn-primary">提交</button>
</form>
</div>
</div>
</div>