<?php
	include "../config/db.php";
	if(!isset($_COOKIE['admin']))
	{
		header("location:../config/login.php");
	}
	$user= $_COOKIE['admin'];
	
	 function find_dirver($id)
	{
		include "../config/db.php";
		
		$query= "SELECT user FROM `user` WHERE id=$id";
		$r = mysqli_query($connect,$query);
		$result_array = mysqli_fetch_assoc($r);
		if(mysqli_num_rows($r)<0)
		{
			return null;
		}else
		{
			return $result_array;
		}
		
	}
	
	$q = mysqli_query($connect,"SELECT * FROM `product`");
				$dcount =mysqli_num_rows($q);
	
	
	
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../fa/css/all.css" />
	<title>Welcome to <?php echo $app_name;?></title>
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

<div class="container p-2 mt-3">
  <div class="row">
    <div class="col-3">
		<div class="h5 bg-info p-2 text-light">Category List
		<span class="float-right">
			<a class="text-light" title="Register New Sergeant" href="add_category.php"><small>Add</small> <i class="fas fa-plus-circle"></i></a></span> </div>
		<table class="table">
			<tr>
				<th>Id</th>
				<th>Name</th>
			
			</tr>
			<?php
				$qs = mysqli_query($connect,"select * from category");
				$ucount = mysqli_num_rows($qs);
				if($ucount >0)
				{
					while($cat = mysqli_fetch_assoc($qs))
					{
						echo "<tr>
					<td>".$cat['category_id']."</td>
					<td>".$cat['name']."</td>					
						</tr> ";
					}
					
				}else
				{
					echo "<tr><td colspan='4'>Nothing Found :(</td></tr>";
				}
				
			?>
		</table>
	</div>
    <div class="col-9">
		<div class="h5 bg-info p-2 text-light"> Product list (<?php echo $dcount;?>)
			<span class="float-right"><a title="Register new Product" class="text-light" href="add_product.php"><small>Add</small> <i class="fas fa-plus-circle"></i></a></span> 
		</div>
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Brnad</th>				
				<th>Details</th>
				<th>Prize</th>
				<th>Time</th>
				<th>Quantity</th>
				<th>Action</th>
				
				
			</tr>
			<?php
				
				if($dcount>0)
				{
					while($product = mysqli_fetch_assoc($q))
					{
						$categroy_code= $product['category'];
						$categroy_name = mysqli_fetch_assoc(mysqli_query($connect,"select * from category where category_id=$categroy_code"));
						echo "<tr>
							
					<td>".$product['name']."</td>
					<td>".$product['brand']."</td>
					<td>".$product['details']."</td>	
					<td>".$product['prize']."</td>	
					<td>".$product['time']."</td>	
					<td>".$product['quantity']."</td>	
					
					<td><a href='delete.php?type=product&category_id=".$product['product_id']."'>Delete</a></td>	
									
				
						</tr> ";
						
					}
					
				}
				else
				{
					echo "<tr><td colspan='4'>Nothing Found :(</td></tr>";
				}
				
				
				
			?>
		</table>
		
	</div>    
    
  </div>
</div>
	
	
</body>
</html>