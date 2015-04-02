<html>
<head>
</head>
<body>

<?php echo validation_errors(); ?>
<form action="addUser" method="post">


<h5>Password</h5>
<input type="text" name="password" value="" size="50" />

<h5>Password Confirm</h5>
<input type="text" name="passconf" value="" size="50" />

<h5>Email Address</h5>
<input type="text" name="email" value="" size="50" />

<div><input type="submit" value="Submit" /></div>
</form>
</body>
</html>