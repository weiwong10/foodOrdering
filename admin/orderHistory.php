<?php
session_start();
include('../connect.php');
if(isset($_SESSION["username"]))
{
  $id= $_SESSION["username"];
  
}
else{
  header('Location: ../index.php');
}

// Get the search parameters from the form
$orderID = isset($_GET['orderID']) ? $_GET['orderID'] : '';
$orderDate = isset($_GET['orderDate']) ? $_GET['orderDate'] : '';

// Construct the SQL query with the search parameters
$sql = "SELECT * FROM orders o 
        INNER JOIN order_detail a ON o.orderID = a.orderID 
        INNER JOIN item p ON p.itemID = a.itemID ";

// Add the search conditions if the parameters are provided
if (!empty($orderID)) {
  $sql .= " AND o.orderID = '$orderID'";
}
if (!empty($orderDate)) {
  $sql .= " AND o.orderDate = '$orderDate'";
}

$sql .= " GROUP BY o.orderID";

$result = mysqli_query($conn, $sql);

// Set the number of results per page
$resultsPerPage = 10;

// Get the current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $resultsPerPage;

// Construct the SQL query with pagination
$sql = "SELECT * FROM orders o 
        INNER JOIN order_detail a ON o.orderID = a.orderID 
        INNER JOIN item p ON p.itemID = a.itemID 
        WHERE orderStatus = 'Shipped'";

// Add the search conditions if the parameters are provided
if (!empty($orderID)) {
  $sql .= " AND o.orderID = '$orderID'";
}
if (!empty($orderDate)) {
  $sql .= " AND o.orderDate = '$orderDate'";
}

$sql .= " GROUP BY o.orderID";
$sql .= " LIMIT $offset, $resultsPerPage";

$result = mysqli_query($conn, $sql);

// Count the total number of results for pagination
$totalResults = mysqli_num_rows(mysqli_query($conn, $sql));

// Calculate the total number of pages
$totalPages = ceil($totalResults / $resultsPerPage);

?>



<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/png" href="../image/candy11.png">

	<!--Bootstrap-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!--font Awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	
    <title>Sweet Sensations</title>
</head>
	
<body> 
	
	<?php include('headerAdmin.php'); ?>
		
			  <p style="margin-top: 120px; "><center><b style="font-size: 20px;">ORDER HISTORY</b></center></p>
	
    <div class="container" style="margin-top: 50px;">
    <form action="" method="GET" class="mb-3">
        <div class="row">
        <div class="col-md-2">
            <input type="text" name="orderID" placeholder="Search by Order ID" class="form-control">
        </div>
        <div class="col-md-2">
            <input type="date" name="orderDate" placeholder="Search by Order Date" class="form-control">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary" style="margin-left: 10px;">Reset</a>
        </div>
        </div>
    </form>
    <table class="table table-hover text-center">
        <!-- table headers and rows -->
    </table>
    </div>

				

			<div class="container" style="margin-top: 50px;">
			<table class="table table-hover text-center">
				 <thead class="table-dark">
				
				<tr>
					<th scope="col">NO.</th>
					<th scope="col">ORDER ID</th>
					<th scope="col">ORDER DATE</th>
					<th scope="col">ORDER STATUS</th>
					<th scope="col">PRINT INVOICE</th>
				</tr>
					 </thead>
				
					
					



<tbody>
  <?php
  $i = ($page - 1) * $resultsPerPage + 1;
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr>
        <td><?php echo $i++ ?></td>
        <td># <?php echo $row['orderID'] ?></td>
        <td><?php echo $row['orderDate'] ?></td>
        <td><?php echo $row['orderStatus'] ?></td>
        <td>
          <a href="custReceipt.php?id=<?php echo $row['orderID'] ?>" class="link-dark" style="text-decoration: none;"><i class="fa fa-download"></i>&nbsp;Details</a>
        </td>
      </tr>
      <?php
    }
  } else {
    echo "No results found.";
  }
  ?>

<!-- Display pagination links -->
<div class="d-flex justify-content-center">
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <?php if ($page > 1) { ?>
        <li class="page-item">
          <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . ($page - 1) . '&orderID=' . $orderID . '&orderDate=' . $orderDate ?>">Previous</a>
        </li>
      <?php } ?>
      <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
          <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . $i . '&orderID=' . $orderID . '&orderDate=' . $orderDate ?>"><?php echo $i; ?></a>
        </li>
      <?php } ?>
      <?php if ($page < $totalPages) { ?>
        <li class="page-item">
          <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . ($page + 1) . '&orderID=' . $orderID . '&orderDate=' . $orderDate ?>">Next</a>
        </li>
      <?php } ?>
    </ul>
  </nav>
</div>

				</tbody>
				</table>
	</div>
	
	<!--bootsrap-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
					
	</body>
</html>



	