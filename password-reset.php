<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$usr = $_POST['username'];
		$newPass = $_POST['password'];
		//$servername = "localhost";
		//$username = "root";
		//$password = "";
		//$database = "tripbuddytest";
		include "connect.php";

	//	$data=mysqli_connect($servername,$username,$password,$database);
	//	if($data===false)
	//	{
	//		die("connection_error");
	//	}
		$sql="update users set password= '".$newPass. "' WHERE email = '".$usr. "'";
		$result=mysqli_query($conn,$sql);
        echo "<script>alert('Password Change Success');</script>";
        echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>body
	{
		background-color: lightblue;
		background-image: url("image/carparknew.jpg");
		background-repeat: no repeat;
		background-attachment: fixed;
		background-size: cover;	
		opacity: 0.9;
	}

	#border
	{
	background-color: white;
	}
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
		<div id="checkForm" class="border shadow p-3 rounded bg-white" style="width: 450px">

		  <h1 class="text-center p-3">Reset Password</h1>

		  <div class="mb-3">
		    <label for="username" class="form-label">Username</label>
		    <input type="text" name="username" class="form-control" id="username">
            <p style="display:none" id="errorUsr" class="text-danger">Please enter your email</p>
		  </div>
		 
		  <div class="mb-3">
		    <label for="phone" class="form-label">Phone Number</label>
		    <input type="text" name="phone" class="form-control" id="phone">
            <p style="display:none" id="error" class="text-danger">Please provide your phone number</p>
		  </div>

	
		 <div class ="form-group mb-3 text-center">
		  <button type="submit" id="submit" disabled class="btn btn-primary">Check</button>
		  </div>
		  
          <div class="spinner-border text-info" role="status" id="loadCheck" style="display:none">
            <span class="visually-hidden">Checking user...</span>
          </div>
		  <p style="display:none" id="notFound" class="text-danger">User Not Found.</p>
		  <br> 
		  <p align="center">Remembered your password?
		  <a href="index.php">
		  	Login Now
		  </a>
		  </p>

        </div>
        <div id="changeForm" class="border shadow p-3 rounded bg-white" style="width: 450px;display:none">

		  <h1 class="text-center p-3">Set New Password</h1>
            <form method="post" id="updatePassword">
		  <div class="mb-3">
		    <label for="password" class="form-label">Password</label>
		    <input type="password" name="password" class="form-control" id="password">
		  </div>
		 
		  <div class="mb-3">
		    <label for="passwordConfirm" class="form-label">Confirm Password</label>
		    <input type="password" name="passwordConfirm" class="form-control" id="passwordConfirm">
            <p style="display:none" id="errorPass" class="text-danger">Passwords do not match!</p>
		  </div>

	
		 <div class ="form-group mb-3 text-center">
		  <button type="submit" id="passSubmit" disabled class="btn btn-primary">Change Password</button>
		  </div>
            <form>
		  <br> 
		  <p align="center">Remembered your password?
		  <a href="index.php">
		  	Login Now
		  </a>
		  </p>

        </div>
	</div>


</body>
<script src="forgetpass.js"></script>

</body>
</html>
