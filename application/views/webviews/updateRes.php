<html>
</head>
<body>

<?php echo validation_errors(); ?>
<form enctype="multipart/form-data" action="updateResturant" method="post" >


<h5>name</h5>
<input type="text" name="rname" value="" size="50" />

<h5>telephone </h5>
<input type="text" name="telephone" value="" size="50" />

<h5>shen </h5>
<input type="text" name="shen" value="" size="50" />
shi<input type="text" name="shi" value="" size="50" />
xian<input type="text" name="xian" value="" size="50" />
image<input name="file" type="file">  
<div><input type="submit" value="Submit" /></div>
</form>
</body>
</html>
