<div class="container" >
<!-- first row -->
<div class="row">
<div class="col-md-7 col-md-offset-2">
<center><img src="<?php echo  str_replace("10.0.2.2", "localhost", $image)?>" alt="load picture fail" class="img-circle"></center>
<form enctype="multipart/form-data"  method="post">
  <div class="form-group">
    <label for="vname">餐厅名</label>
    <input type="text" class="form-control" id="rname" placeholder='<?php echo $rname?>'  name="rname">
  </div>
  <div class="form-group">
    <label for="price">订餐电话</label>
    <input type="text" class="form-control" id="phone" placeholder="<?php echo $telephone?>" name="phone">
  </div>
   <div class="form-group">
    <label for="descrition">省</label>
    <input type="text" class="form-control" id="shen" placeholder="<?php echo $shen?>" name="shen">
  </div>
     <div class="form-group">
    <label for="descrition">市</label>
    <input type="text" class="form-control" id="shi" placeholder="<?php echo $shi?>" name="shi">
  </div>
     <div class="form-group">
    <label for="descrition">县</label>
    <input type="text" class="form-control" id="xian" placeholder="<?php echo $xian?>" name="xian">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">新图片上传</label>
    <input type="file" id="exampleInputFile" name="file">
    <p class="help-block">选择新餐厅图片.</p>
  </div>
  <button type="submit" class="btn btn-primary">提交</button>
</form>
</div>
</div>
</div>
