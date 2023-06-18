<?php include ('registerProcess.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="shortcut icon" type="image/png" href="image/candy11.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
	body{
	background-image: url("image/sweet3.jpg");
	background-repeat: no repeat;
	background-attachment: fixed;
	background-size: cover;	
	opacity: 0.9;
	}

	#border{
	background-color: white;
	}

</style>

<body>
	<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
		<form id="border" class="border shadow p-3 rounded" action="registerProcess.php" method="post" style="width: 450px;" enctype="multipart/form-data">

		  <h1 class="text-center p-3">Register Page</h1>
	
		  <!--To show the error message when the username is blank-->
		  
		  <?php if (isset($_GET['error'])) { ?>
		  <div class="alert alert-warning" role="alert">
		  	<?=$_GET['error']?>
		  </div>
		  <?php } ?>
		  
		  <div class="mb-3">
		    <label for="name" class="form-label">Full Name</label>
		    <input type="text" name="name" class="form-control" id="name">
		  </div>
		  
		  <div class="mb-3">
		    <label for="username" class="form-label">Email</label>
		    <input type="text" name="username" placeholder="example@gmail.com" class="form-control" id="username">
		  </div>
		  
		  <div class="mb-0">
			<label class="form-label">Select Gender</label>		  	
		  </div>
		  <select class="form-select mb-3" name="gentle">
		  	<option selected>-- Select Gender --</option>
		  	<option value="M">Male</option>
		  	<option value="F">Female</option>
		  </select>
		  
		  <div class="mb-0">
			<label class="form-label">Select Date Birth</label>
			</div>
			<p>
			<input type="date" name="dateofbirth" class="form-control" />
			</p>
		  
			<div class="mb-3">
		    <label for="contactNo" class="form-label">Phone Number </label>
		    <input type="text" name="contactNo" placeholder="e.g. 0126880717" class="form-control" id="contactNo">
		    </div>
		  
			<div class="mb-3">
		    <label for="contactNo" class="form-label">Address </label>
		    <input type="text" name="address" placeholder="e.g. 1/3 Jalan Utama 1, Taman Utaman, 55100 Kuala Lumpur" class="form-control" id="contactNo">
		    </div>

		  <div class="mb-3">
			<label>Password</label>
			<input type="password" name="password_1" class="form-control">
		  </div>
		  
		  <div class="mb-3">
			<label>Confirm Password</label>
			<input type="password" name="password_2" class="form-control">
		  </div>
		
		  <div class="col-md-12 text-center">
			<button type="submit" class="btn btn-primary" name="reg_user">Register</button>
		  </div>
			
		  <p>
		  <div class="col-md-12 text-center">
			Already have an account? <a href="#" onclick="window.open('index.php')"; >Sign in</a>
		  </p>

		</form>
	</div>
</body>
</html>