<?php
	include "../config/db.php";
	$msg="";
	if(isset($_POST['submit']))
	{
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		
		$q= "Insert into admin(`user`,`pass`) VALUES('$user','$pass')";
		$s= $connect->query($q);
		if($connect->error)
		{
			 $msg.="<div class='bg-danger text-light p-2'>$connect->error</div>";
		}
		else{
			 $msg.="<div class='bg-success text-light p-2'>Registation Successful <a href='../config/login.php'>Login</a></div>";
		}
		
		
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/js/bootstrap.js" />
	<title>Registation User -Database Project</title>
</head>
<body>
	<div class="bg-primary h2 text-light p-2 center">Database Project</div>
	<div class="mx-auto w-25">
	<?php echo $msg;?>
		
	<form  action="register_admin.php" method="POST">
		<div class="col-12">
			<label for="user">Enter Username</label>
			<input class="form-control" type="text" name="user"/>
		</div>
		<div class="col-12">
			<label for="user">Enter Password</label>
			<input class="form-control" type="password" name="pass"/>
		</div>
		<div class="col-12">
			<label for="user">Enter Password Again</label>
			<input class="form-control" type="password" name="repass"/>
		</div>
		<div class="col-12"> <br />
			<input class="form-control btn-success" type="submit" value="Create Account" name="submit"/>
		</div>
	</form>
	</div>
	
</body>
</html>