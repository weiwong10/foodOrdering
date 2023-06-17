<?php
include("../connect.php");
 session_start();
  if (isset($_SESSION["username"])) {
    $id = $_SESSION["username"];
  } else {
    header("Location: ../index.php");
    exit();
  }

$sql = "SELECT * FROM orders o 
        INNER JOIN order_detail a ON o.orderID = a.orderID 
        INNER JOIN item p ON p.itemID = a.itemID 
        WHERE customerID ='$id' GROUP BY  o.orderID ORDER BY o.orderID DESC";
$result = mysqli_query($conn, $sql);
$i = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="../image/candy11.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<title>Sweet Sensations</title>
</head>

<body>
	<?php include('headerCust.php');?>
	<div class="container">
		<h2 class="text-center" style="margin-top: 110px;">ORDER HISTORY</h2><br>
		<table class = "table table-bordered text-center">
			<thead class="table-dark">
				<tr>
					<th scope="col">No.</th>
					<th scope="col">ORDER ID</th>
					<th scope="col">ORDER DATE</th>
					<th scope="col">STATUS</th>
					<th scope="col">PRINT INVOICE</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if (mysqli_num_rows($result)>0)
					{
						while($row = mysqli_fetch_assoc($result))
						{ ?>
							<tr>
								<td><?php echo $i++ ?></td>
								<td># <?php echo $row['orderID'] ?></td>
								<td><?php echo $row['orderDate'] ?></td>
								<td><?php echo $row['orderStatus'] ?></td>
								<td>
          							<a href="invoice.php?id=<?php echo $row['orderID'] ?>" class="link-dark" style="text-decoration: none;"><i class="fa fa-download"></i>&nbsp;Details</a>
        						</td>
							</tr>
					<?php	}
					} else {
						echo "No results found.";
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>