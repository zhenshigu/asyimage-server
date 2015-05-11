<?php echo validation_errors(); ?>
<div class="col-md-7 ">
<form action="addUser"   method="post">
  <div class="form-group">
    <label for="password">密码</label>
    <input type="password" class="form-control"  id="password"  name="password">
  </div>
  <div class="form-group">
    <label for="passconf">重复密码</label>
    <input type="password" class="form-control" id="passconf" name="passconf">
  </div>
   <div class="form-group">
    <label for="email">邮箱</label>
    <input type="text" class="form-control" id="email"   name="email">
  </div>
  <button type="submit" class="btn btn-primary">提交</button>
</form>
</div>
</body>
</html>