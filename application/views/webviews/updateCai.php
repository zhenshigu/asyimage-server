<html>
<head>
</head>
<body>

<?php echo validation_errors(); ?>
<form enctype="multipart/form-data" action="updateCai" method="post" >


<h5>name</h5>
<input type="text" name="vname" value="" size="50" />

<h5>price </h5>
<input type="text" name="price" value="" size="50" />

<h5>description </h5>
<input type="text" name="description" value="" size="50" />
image<input name="file" type="file">  
<div><input type="submit" value="Submit" /></div>
</form>
</body>
</html>