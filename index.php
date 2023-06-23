<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="image/candy11.png">

    <title>Sweet Sensations</title>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
	body{
	background-image: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url(image/candy1.jpg);
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
		<form id="border" class="border shadow p-3 rounded" action="loginProcess.php" method="post" style="width: 450px;">

		  <h1 class="text-center p-3">Sweet Sensations</h1>
	
		  <!--To show the error message when the required area is blank-->
		  
		  <?php if (isset($_GET['error'])) { ?>
		  <div class="alert alert-warning" role="alert">
		  	<?=$_GET['error']?>
		  </div>
		  <?php } ?>
		  
		  <div class="mb-3">
		    <label for="username" class="form-label">Email</label>
		    <input type="text" name="username" class="form-control" id="username">
		  </div>
		 
		  <div class="mb-3">
		    <label for="password" class="form-label">Password</label>
		    <input type="password" name="password" class="form-control" id="password">	   
		  </div>


		  <div class="col-md-12 text-center">
		  <button type="submit" class="btn btn-primary">Login</button>
		  </div>

		 <br> 
		  <p align="center">Forget password?
		  <a href="#" onclick="window.open('password-reset.php')"; >
		  	Reset Now
		  </a>
		  </p>
			
		  <p align="center">Do not have an Account?
		  <a href="#" onclick="window.open('register.php')"; >
		  	Register Now
		  </a>
		  </p>
		  

		</form>
	</div>

</body>
</html>
