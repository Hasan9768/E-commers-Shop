<script>
			function myFunction(paths) {
			  setTimeout(function(){				 
				  window.location.href = paths;
				  
				  }, 3000);
			}
			</script>
<?php
	include "../config/db.php";
	$msg="";
	if(!isset($_GET['driver_id']))
	{
		header("location: index.php");
	}
	$driver_id= $_GET['driver_id'];
	$driver_data= mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `driver_information` WHERE driver_id=$driver_id"));
	
	if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$phone_number = $_POST['phone_number'];
		$license_number = $_POST['license_number'];
		$address = $_POST['address'];
		$password = $_POST['password'];
		$pl= strlen($password);
		if($pl == 0)
		{
			$update= "UPDATE `driver_information` SET `name`='$name',`phone_number`='$phone_number',`license_number`='$license_number',`address`='$address' WHERE `driver_information`.`driver_id` = '$driver_id'";
		}else{
		$update= "UPDATE `driver_information` SET `name`='$name',`phone_number`='$phone_number',`license_number`='$license_number',`address`='$address',`password`='$password' WHERE `driver_information`.`driver_id` = '$driver_id'";
		}
		
		$connect->query($update);
		if($connect->error)
		{
			$msg .="<div class='bg-danger p-2 text-light'>Database Probelm $connect->error</div>";
		}
		else{ $msg .="<div class='bg-success p-2 text-light'>Update success</div>";
		}
		echo "<script>
			var paths = 'index.php';
			myFunction(paths);			  
			</script>";
	}
	
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	<title>Welcome to <?php echo $app_name;?></title>
	<title>Edit -<?php echo $app_name;?></title>
</head>
<body>
		<div class="bg-info text-light p-2">
		<div class="container mx-auto">
			<span class="h4"><?php echo $app_name;?></span> <small>(Admin Panel)</small> 
			<div class="float-right"> 

				Welcome (<?php echo $_COOKIE['admin']; ?>)
				&nbsp;&nbsp;
				<a title="Logout" class="text-light" href="../config/logout.php"><i class="fas fa-sign-out-alt"></i></a>
			</div> 
		</div>
	</div>
	
	
	
	<div class="container p-5 mt-3 shadow">
		<div class="h4">Edit Driver Information</div><hr />
		<?php echo $msg;?>
		<form action="edit.php?driver_id=<?php echo $driver_id;?>" method="POST">			
			<label class="h5" for="name">Name</label>
			<input class="form-control" type="text" name="name" value="<?php echo $driver_data['name']?>" /><br />
			<label class="h5" for="phone_number">Phone</label>
			<input class="form-control" type="text" name="phone_number" value="<?php echo $driver_data['phone_number']?>" /><br />
			<label class="h5" for="license_number">License</label>
			<input class="form-control" type="text" name="license_number" value="<?php echo $driver_data['license_number']?>" /><br />
			<label class="h5" for="address">address</label>
			<input class="form-control" type="text" name="address" value="<?php echo $driver_data['address']?>" /><br />
			<label class="h5" for="password">password</label>
			<input class="form-control" type="text" name="password" /><br />
			<button class="btn btn-info" name="submit">Save Edit  <i class="fas fa-save"></i></button>
			
		</form>

	</div>
	

	
</body>
</html>