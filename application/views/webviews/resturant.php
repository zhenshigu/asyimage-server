<html>
<head>
</head>
<body>

<?php echo validation_errors(); ?>
<div class="col-md-7 ">
<form enctype="multipart/form-data" action="setResturant"   method="post">
  <div class="form-group">
    <label for="rname">餐厅名字</label>
    <input type="text" class="form-control"  id="rname"  name="rname">
  </div>
  <div class="form-group">
    <label for="telephone">订餐电话</label>
    <input type="text" class="form-control" id="telephone" name="telephone">
  </div>
   <div class="form-group">
    <label for="shen">所在省</label>
    <input type="text" class="form-control" id="shen"   name="shen">
  </div>
     <div class="form-group">
    <label for="shi">所在市</label>
    <input type="text" class="form-control" id="shi"   name="shi">
  </div>
     <div class="form-group">
    <label for="xian">所在县</label>
    <input type="text" class="form-control" id="xian"   name="xian">
  </div>
   餐厅头像<input name="file" type="file"> <br><br>
  <button type="submit" class="btn btn-primary">提交</button>
</form>
</div>
</body>
</html>