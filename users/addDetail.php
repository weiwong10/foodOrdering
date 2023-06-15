<?php
include("../connect.php");
 session_start();
  if (isset($_SESSION["username"])) {
    $customerID = $_SESSION["username"];
  } else {
    header("Location: ../index.php");
    exit();
  }

if (isset($_POST['checkout'])){

  // calculate package IDs and total prices from cart
  $itemID = array();
  $totalAmount = array();
  foreach ($_SESSION["cart1"] as $item) {
    $itemID[] = $item["itemID"];
    $totalAmount[] = $item["quantity"] * $item["unitPrice"];
  }
  

 // calculate total amount
  $totalAmount = 0;
  foreach ($_SESSION["cart1"] as $item) {
    $subtotal = $item["quantity"] * $item["unitPrice"];
    $totalAmount += $subtotal;
  }
  
  // insert order into database
  $stmt = $conn->prepare("INSERT INTO orders (customerID, orderDate, amount, orderStatus) VALUES (?, ?, ?, ?)");
  $orderDate = date('Y-m-d H:i:s');
  $stmt->bind_param("iss", $customerID, $orderDate, $totalAmount, 'Pending');

  if ($stmt->execute()) {
    $ordersID = $stmt->insert_id;

    // insert appointment details into database
    $stmt = $conn->prepare("INSERT INTO order_detail (orderID, itemID, quantity, price) VALUES (?, ?, ?, ?)");

    foreach ($_SESSION["cart1"] as $item) 
	{
    $itemID = $item["itemID"];
    $quantity = $item["quantity"];
    $totalPrice = $item["unitPrice"] * $quantity;
	$stmt->bind_param("iiis", $ordersID, $itemID, $quantity, $totalPrice);
		
		

    if (!$stmt->execute()) 
	{
        echo "Error inserting product detail: " . $stmt->error;
        exit();
    }
	
	// Update product table to deduct stock quantity
    
	}
	  
    
// clear shopping cart
	unset($_SESSION['cart1']);
    $success_message = "Orders made successfully. Proceed to payment.";
    $redirect_url = "payment.php?amount=" . urlencode($totalAmount) . "&orderid=" . urlencode($ordersID);
    echo "<script>alert('$success_message'); window.location.href='$redirect_url';</script>";
    exit();



    exit();
  } else {
    echo "Error inserting order: " . $stmt->error;
  }
}

?>