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
	  // retrieve customer name from database
$stmt = $conn->prepare("SELECT name, email, contactNo FROM customer WHERE customerID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $customerName = $row["name"];
  $email = $row["email"];
  $telephone = $row["contactNo"];
}

// Get the  order ID and service charge values from the URL query string
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];
} 

$result1 =mysqli_query($conn,"INSERT INTO payment (paymentDate, paymentMethod, orderID) VALUES (NOW(),'Online Banking','$orderid')");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="../image/pets.png">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/payment.css">

</head>
<body>
	<div class="container">
		<form action="">
        <div class="row">
            <div class="col">
                <h3 class="title">Information</h3>
                <div class="inputBox"><br>
                    <span><b>Full Name :</b></span>
                    <span><?php echo $customerName; ?></span>
                </div>
                <div class="inputBox"><br>
                    <span><b>Email :</b></span>
                    <span><?php echo $email; ?></span>
                </div>
                <div class="inputBox"><br>
                    <span><b>Telephone Number :</b></span>
                    <span><?php echo $telephone; ?></span>
                </div>
                
            </div>

            <div class="col">
                <h3 class="title">PAYMENT</h3>
                <div class="inputBox">
                    <span>Cards Accepted :</span>
                    <img src="../image/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>Name On Card :</span>
                    <input type="text" placeholder=" John Wick">
                </div>
                <div class="inputBox">
                    <span>Credit Card Number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444">
                </div>
                <div class="inputBox">
                    <span>Exp Month :</span>
                    <input type="text" placeholder="January">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Exp Year :</span>
                        <input type="number" placeholder="2022">
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="1234">
                    </div>
                </div>

            </div>
    
        </div>
        <button type="button" class="submit-btn" onclick="redirectToOtherPage()">Proceed to Checkout</button>
		</form>
</div>
	
<!-- JavaScript code -->
<script>
function redirectToOtherPage() {
    alert("Payment successful!");
    window.location.href = "invoice.php?id=<?php echo $orderid ?>";
}
</script>
	
</body>
</html>
	
	
