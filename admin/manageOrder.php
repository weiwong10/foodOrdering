<?php
session_start();
include('../connect.php');
if(isset($_SESSION["username"]))
{
	$id = $_SESSION["username"];
	
	
}
else{
	header('Location: ../index.php');
}

// if(isset($_GET['status']) && isset($_GET['orderID']))
// {
// 	$status = $_GET['status'];
// 	$orderID = $_GET['orderID'];

// 	mysqli_query($conn,"UPDATE orders SET orderStatus='$status'  WHERE orderID='$orderID'");
	
	
// 	header("Location: manageOrder.php");
	
// }

?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="../image/pets.png">

    <!--Bootstrap-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!--font Awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	
	<title>Order</title>
</head>
	
<body>
	
	<?php include('headerAdmin.php'); ?>
	

	<br><br><br><br><br><br>
	<h2 class="txt1" style="text-align: center">CUSTOMER ORDER</h2>    
	<br>
	<div class="container">
		<table class="table table-hover text-center">
			<thead class="table-dark">
				<tr style="font-size: 17px">
					<th scope="col">NO.</th>
					<th scope="col">ORDER ID</th>
					<th scope="col">NAME</th>
					<th scope="col">TELEPHONE NUMBER</th>
					<th scope="col">STATUS</th>	
					<th scope="col">ACTION </th>
					<th scope="col">DETAIL </th>
				</tr>
			</thead>
			<tbody>
			<?php
	
			$ret = mysqli_query($conn,"SELECT orderID, name, email, contactNo, orderStatus FROM orders o, customer c WHERE o.customerID = c.customerID AND orderStatus = 'Pending'");

			$i=1;
		   
			if(mysqli_num_rows($ret)>0){
				while ($row=mysqli_fetch_assoc($ret)){
					?>
					<tr style="font-size: 17px">
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['orderID'] ?></td>
						<td><?php echo $row['name'] ?></td>
						<td><?php echo $row['contactNo'] ?></td>
						<td><?php echo $row['orderStatus'] ?></td>
						<td>
						<select  id="statusSelect" onChange="status_update(this.options[this.selectedIndex].value, '<?php echo $row['orderID'] ?>', '<?php echo $row['name']?>' , '<?php echo $row['email']?>')">
						<option value="">Update Status</option>	
						<option value="Shipped">Shipped out</option>
						</select>
						</td>
						<td>
          				<a href="custReceipt.php?id=<?php echo $row['orderID'] ?>" class="link-dark" style="text-decoration: none;"><i class="fa fa-download"></i>&nbsp;Details</a>
        				</td>

					</tr>
					<?php
				}
			}
			?>
			</tbody>
		</table>								
	</div>
	<script type="text/javascript">
		function status_update(value,  orderID, name, email) 
		{
    		if (confirm("Do you want to " + value + "?")) 
			{
				let url = "http://localhost/foodOrdering/admin/custOrderDetail.php";
				window.location.href = url + "?status=" + value + "&orderID=" + orderID + "&name=" + name + "&email=" + email;
    		} else {
        		// Set the selected index back to 0
				document.getElementById("statusSelect").selectedIndex = 0;
    		}
		}
	</script>
	<!--bootsrap-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
