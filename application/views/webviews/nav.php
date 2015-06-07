<?php header("Content-Type:text/html;charset=utf-8");?>
<meta charset="utf-8">
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<style>
body {
  min-height: 800px;
  padding-top: 70px;
}
</style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">无线订餐系统web版本</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://localhost:8080/DingCan/index.php/web/userManage/verify">返回主页</a></li>
            <li><a href="http://localhost:8080/DingCan/index.php/server/showResturant/theAbout">关于</a></li>
            <li><a href="http://localhost:8080/DingCan/index.php/server/showResturant/contact">联系方式</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://localhost:8080/DingCan/index.php/web/userManage/addUser">注册</a></li>
             <li><a href="http://localhost:8080/DingCan/index.php/web/userManage/verify">登录</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
     </nav>