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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sweet Sensations</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  
  <script src="https://kit.fontawesome.com/805d306191.js" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/adminMain.css">

  <link rel="shortcut icon" type="image/png" href="../image/candy11.png">

</head>

<body>
<?php include("headerAdmin.php") ?>

 
<br><br><br>
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">Home Page</h2>

  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
    Admin may do the following task
  </p>
</div>

<div class="container">
    <div class="box-container">
        <div class="box">
            <div class="image">
                <a href="manageMenu.php">
                    <img src="../image/back.jpg" alt="Description of the image" title="This is an example image">
                </a>
            </div>
            <div class="content">
                <h3>Manage Menu</h3>
                <div class="icons">
                </div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <a href="manageOrder.php">
                    <img src="../image/back1.jpeg" alt="Description of the image" title="This is an example image">
                </a>                        
            </div>
            <div class="content">
                <h3>Manage Orders</h3>
                <div class="icons">
                </div>
            </div>
        </div>

        <!-- <div class="box">
            <div class="image">
                <a href="requestBuildingHistory.php">
                    <img src="images/history.jpg" alt="Description of the image" title="This is an example image">
                </a>                        
            </div>
            <div class="content">
                <h3>Booking History</h3>
                <div class="icons">
                </div>
            </div>
        </div> -->

    </div>
</div>


  
</body>

</html>