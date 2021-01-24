<?php
	include"../config/db.php";$msg = "";
	if(isset($_POST['submit']))
	{
		$product_name 		= $_POST['product_name'];
		$product_category 	= $_POST['product_category'];
		$product_details 	= $_POST['product_details'];
		$product_brand 		= $_POST['product_brand'];
		$product_quantity 	=$_POST['product_quantity'];
		$prize 	=$_POST['prize'];
		
		$q = "INSERT INTO `product`
		(`name`, `brand`, `quantity`, `details`, `prize`, `category`)
		values('$product_name','$product_brand','$product_quantity','$product_details','$prize','$product_category')";
		
		$c = $connect->query($q);
		if($connect->error)
		{
			echo $connect->error;
		}else
		{
			$msg .= "<div class='bg-success text-light p-2'>Successfully added</div> <br>";
		}
	}
	
	$categary_list= mysqli_query($connect,"select * from category");
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	
	<title>Add Product -	<?php echo $app_name;?></title>
</head>
<body>	
	<div class="bg-info p-2">
		<div class="container">		
			<span class="h4 text-light">
					<a class="text-decoration-none text-light" href="index.php">
						<?php echo $app_name;?>
					</a>
			</span> 
		
			<span class="float-right">
				<a class="h5 text-light text-decoration-none" href="index.php" title="Go Home"> <i class="fas fa-home"></i></a> &nbsp; &nbsp;
				<a class="h5 text-light text-decoration-none" href="../config/logout.php" title="Logout"> <i class="fas fa-sign-out-alt"></i></a>
			</span>
		</div>
	</div>
	<br />



	<div class="container">
		<div class="mx-auto w-75 shadow shadow-info p-5">
			<div class="h5">Product Registration</div>
			<hr>
			<?php echo $msg;?>
		<form class="form-group" action="add_product.php" method="POST">		
			<div class="form-group row">
				<label for="product_category" class="col-sm-2 col-form-label">Category name:</label>
				<div class="col-sm-10">
				  <select class="form-control" name="product_category" id="" required>
					<option value="">Select</option>
					<?php
					while($run = mysqli_fetch_assoc($categary_list))
					{
						echo "<option value=".$run['category_id'].">".$run['name']."</option>";
					}
					?>
				  </select>
				</div>
			</div> <br>
			<div class="form-group row">
				<label for="product_name" class="col-sm-2 col-form-label">Product name:</label>
				<div class="col-sm-10">
				  <input type="text" name="product_name" class="form-control">
				</div>
			</div> <br>
			<div class="form-group row">
				<label for="product_brand" class="col-sm-2 col-form-label">Product Brand:</label>
				<div class="col-sm-10">
				  <input type="text" name="product_brand" class="form-control">
				</div>
			</div> <br>
			
			<div class="form-group row">
				<label for="product_quantity" class="col-sm-2 col-form-label">Quantity:</label>
				<div class="col-sm-10">
				  <input type="number" name="product_quantity" class="form-control">
				</div>
			</div><br>
			<div class="form-group row">
				<label for="prize" class="col-sm-2 col-form-label">prize:</label>
				<div class="col-sm-10">
				  <input type="number" name="prize" class="form-control">
				</div>
			</div><br>
			
			<div class="form-group row">
				<label for="product_details" class="col-sm-2 col-form-label">Product Details: </label>
				<div class="col-sm-10">
				  <input type="text" name="product_details" class="form-control">
				</div>
			</div><br>

		
				
				
			<input class="form-control btn-info" type="submit" value="Add" name="submit" />
								
		</form>
		</div>
	</div>


	
</body>
</html>