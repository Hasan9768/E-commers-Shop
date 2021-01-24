<?php
	include"../config/db.php";$msg = "";
	if(isset($_POST['submit']))
	{
		$name 			= $_POST['name'];		
		
		
		
		$q = "INSERT INTO `category`(`name`)
		VALUES('$name')";
		
		$c = $connect->query($q);
		if($connect->error)
		{
			echo $connect->error;
		}else
		{
			$msg .= "<div class='bg-success text-light p-2'>Successfully added</div>";
		}
	}
	$category_list = mysqli_query($connect,"Select * from category");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	
	<title>Add Category -<?php echo $app_name;?></title>
</head>
<body>
	<div class="bg-info p-2">
		<div class="container">		
				<span class="h4 text-light">
				<a class="text-decoration-none text-light" href="index.php"><?php echo $app_name;?></a>
				</span> 
		
			<span class="float-right">
			<a class="h5 text-light text-decoration-none" href="index.php" title="Go Home"> <i class="fas fa-home"></i></a> &nbsp; &nbsp;
			<a class="h5 text-light text-decoration-none" href="../config/logout.php" title="Logout"> <i class="fas fa-sign-out-alt"></i></a>
			</span>
		</div>
	</div>
	<br />
	<div class="container">
		<div class="border border-info p-4 w-75 mx-auto">
			<div class="h5">Category Registration</div>
			<hr>
			<?php echo $msg;?>
			
			<br /><br />
			<form class="form-group" action="add_category.php" method="POST">		
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Category Name:</label>
					<div class="col-sm-10">
					<input type="text" name="name" class="form-control" required>
					</div>
				</div>								
					
				<input class="form-control btn-info" type="submit" value="Add" name="submit" />
									
			</form>
	</div>
	<br />
	<div class="p-4 w-75 mx-auto">
		<table class="table">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Action</th>
		</tr>
		<?php 
		
			
			while($row = mysqli_fetch_assoc($category_list))
			{
				$c = $row['category_id'];
				$check_delete= mysqli_num_rows(mysqli_query($connect,"select * from product where category=$c"));
				if($check_delete>0)
				{
					$title = "This category has many product. Delete all product first";
					$link = "";
				}
				else{
					$title="Delete Category";
					$link="delete.php?type=category&category_id=$c";
				}
				echo "<tr>
				<td>".$row['category_id']."</td>
				<td>".$row['name']."</td>
				<td><a href='$link' title='$title'><i class='fas fa-trash-alt'></i></a></td>
				</tr>";
			}
		
		?>
		</table>
	</div>
	
</div>
		
</body>
</html>