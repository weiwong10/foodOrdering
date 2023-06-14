<?php
include "connect.php";
session_start();
	

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

    
  $username = test_input($_POST['username']);
  $name = test_input($_POST['name']);
  $gentle = test_input($_POST['gentle']);
  $dob = test_input(date('Y-m-d', strtotime($_POST['dateofbirth'])));
  $contactNo = test_input($_POST['contactNo']);
  $icNo = test_input($_POST['icNo']);
  $password_1 = test_input($_POST['password_1']);
  $password_2 = test_input($_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { 
	header("Location: register.php?error=Fullname is required"); }
	
  elseif (empty($username)) { 
	header("Location: register.php?error=Email is required"); }
	
  elseif($gentle != 'M' && $gentle != 'F'){
    header("Location: register.php?error=Gender is required"); }
	
  elseif (empty($dob)) { 
	header("Location: register.php?error=Date of Birth is required"); }

  elseif (empty($contactNo)) { 
    header("Location: register.php?error=Phone Number is required"); }
    
  elseif (empty($icNo)) { 
	header("Location: register.php?error=IC No is required"); }
	
  elseif (empty($password_1)) { 
	header("Location: register.php?error=Password is required");  }
	
  elseif ($password_1 != $password_2) {
	header("Location: register.php?error=The two passwords do not match"); }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  else{
  $user_check_query = "SELECT * FROM users WHERE email= '$username' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  $contact_check_query = "SELECT * FROM users WHERE contactNo= '$contactNo' LIMIT 1";
  $resultContact = mysqli_query($conn, $contact_check_query);
  $contact = mysqli_fetch_assoc($resultContact);
  
  if ($user) { // if user exists
    if ($user['email'] == $username) {
      header("Location: register.php?error=Email already exists");
	}
  }
  if($contact){
    header("Location: register.php?error=Contact Number already exists");
  }

  $ic_check_query = "SELECT * FROM users WHERE icNo= '$icNo' LIMIT 1";
  $resultIc = mysqli_query($conn, $ic_check_query);
  $ic = mysqli_fetch_assoc($resultIc);
  
  if($ic){
    header("Location: register.php?error=This IC No already exists");
  }

  // Finally, register user if there are no errors in the form
	$password = ($password_1);//enzcrypt the password before saving in the database
	

  	$query = "INSERT INTO users (name , email, gender, dob, contactNo, icNo, password) 
  			  VALUES('$name','$username', '$gentle', '$dob', '$contactNo', '$icNo', '$password')";
  	mysqli_query($conn, $query);
    echo "<script>alert('Register Success');</script>";
    echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
    }
}

?>