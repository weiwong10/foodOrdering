<?php
session_start();
include "connect.php";

	if (isset($_POST['username']) && isset($_POST['password']))
	{
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);


		if(empty($username)){
			header("Location: index.php?error=Email is Required");
		}
		elseif (empty($password)) 
		{
			header("Location: index.php?error=Password is Required");
		}
		else
		{
					$sql = "SELECT * FROM users WHERE email = '".$username."' AND password = '".$password."'";

					$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

					if(mysqli_num_rows($result) > 0)
					{

						$row = mysqli_fetch_assoc($result);
						if($row['email'] === $username && $row['password'] === $password)
						{

								//To store the data into the session[admin_username] for future use
								$_SESSION['username'] = $username;

								//To go for the customer login page
								header("Location: users/index.php");
							
						}
						else
						{
							
							header("Location: index.php?error=Incorrect Username and Password");
						}
						
					}
					else
					{						
						$sqlAdmin = "SELECT * FROM admin WHERE name = '".$username."' AND password = '".$password."'";

						$resultAdmin = mysqli_query($conn,$sqlAdmin) or die(mysqli_error($conn));


						if(mysqli_num_rows($resultAdmin) > 0)
						{

							$admin = mysqli_fetch_assoc($resultAdmin);
							if($admin['name'] == $username && $admin['password'] == $password)
							{

									//To store the data into the session[admin_username] for future use
									$_SESSION['username'] = $admin['adminID'];

									//To go for the customer login page
									header("Location: admin/adminMain.php");
								
							}
						}
						else
						{
							
							header("Location: index.php?error=Incorrect Username and Password");
						}

					}

			

		}
	}
	else
	{
		header("Location: index.php");
	}
