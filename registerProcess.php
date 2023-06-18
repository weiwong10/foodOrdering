<?php
include "connect.php";
session_start();

  //Email
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require_once 'admin/src/Exception.php';
  require_once 'admin/src/PHPMailer.php';
  require_once 'admin/src/SMTP.php';

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
  $address = test_input($_POST['address']);
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

  elseif (empty($address)) { 
    header("Location: register.php?error=Address is required"); }
        
  elseif (empty($password_1)) { 
	header("Location: register.php?error=Password is required");  }
	
  elseif ($password_1 != $password_2) {
	header("Location: register.php?error=The two passwords do not match"); }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  else{
  $user_check_query = "SELECT * FROM customer WHERE email= '$username' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  $contact_check_query = "SELECT * FROM customer WHERE contactNo= '$contactNo' LIMIT 1";
  $resultContact = mysqli_query($conn, $contact_check_query);
  $contact = mysqli_fetch_assoc($resultContact);
  
  if ($user) { // if user exists
    if ($user['email'] == $username) {
      header("Location: register.php?error=Email already exists");
	}
  }
  elseif ($contact) {
    header("Location: register.php?error=Contact Number already exists");

  }else{

  // Finally, register user if there are no errors in the form
	$password = md5($password_1);//enzcrypt the password before saving in the database
	

  	$query = "INSERT INTO customer (name , email, gender, dob, contactNo, password) 
  			  VALUES('$name','$username', '$gentle', '$dob', '$contactNo', '$password')";
  	mysqli_query($conn, $query);

    
    // Email notification using PHPMailer
    $subject = "System Registration";
    $txt = "Hi " . $name . ", Welcome to the Sweet Sensations.<br> You have successfully registered an account. <br> Your username is <strong>" . $username . "</strong> and password is <strong>" . $password_1 . "</strong><br> Thank you.";

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = 'tweiw10@gmail.com'; // Your Gmail email
        $mail->Password = 'pucfbxouhyvekdfl'; // Your Gmail password

        // Sender and recipient settings
        $mail->setFrom('no-reply@utem.edu.my', 'SYSTEM REGISTRATION [no-reply]');
        $mail->addAddress($username, $name);
        $mail->addReplyTo('no-reply@utem.edu.my', 'SYSTEM REGISTRATION [no-reply]');

        // Setting the email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $txt;

        $mail->send();

    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }


    echo "<script>alert('Register Success');</script>";
    echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
  }
  }
}

?>