<?php
include("../connect.php");
session_start();
if(isset($_SESSION["username"]))
{
	$id= $_SESSION["username"];
	
}
else{
	header('Location: ../index.php');
}

$sql = "SELECT * FROM item";
$result = $conn->query($sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/png" href="../image/candy11.png">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link rel="stylesheet" type="text/css" href="../css/menu.css">
<title>Sweet Sensations</title>
</head>

<body>
	<?php include('headerCust.php');?>
	<p style="margin-top: 120px; "><center><b style="font-size: 25px;">ALL CANDY</b></center></p>
	
	<main>
	<?php 
		while($row = mysqli_fetch_assoc($result)) {
			echo "<form method='post' action='addCart.php'>"; // open form for each product
	?>
		<div class="card"> 
			<div class="image">
				<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"  />'; ?>
			</div>
			<div class="caption">
				<p class="productName"><b><?php echo $row["itemName"] ?></b></p>
				<p class="price"><b>Price : RM <?php echo $row["unitPrice"] ?></b></p>
				<p class="stock"><b>Stock Quantity :<?php echo $row["stockQuantityProduct"] ?></b></p>
				<input type='hidden' name='itemID' value='<?php echo $row["itemID"] ?>'/>
				<input type='hidden' name='unitPrice' value='<?php echo $row["unitPrice"] ?>'/>
				<input type='hidden' name='itemName' value='<?php echo $row["itemName"] ?>'/>	
				<p class="price" >Quantity :<input type="number" name="quantity" id="quantity" value="0" min="1" class="form-control" ></p>		

				<button class="add" type="submit" name="add_to_cart">Add to Cart</button>
			</div>
		</div>
		</form> 
		<?php } ?>
</main>
  <script>
    function validateForm() {
      var quantity = document.getElementById("quantity").value;

      if (quantity < 1) {
        alert("Please enter a quantity greater than 0.");
        return false;
      }

      return true;
    }
  </script>
	
</body>
</html>