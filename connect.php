<?php

$servername = "sql208.infinityfree.com";
$user = "if0_34452630";
$password="hIbfzQLyTHqV";
$database = "if0_34452630_foodordering";

$conn = new mysqli($servername, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connect success!";

?>



	
