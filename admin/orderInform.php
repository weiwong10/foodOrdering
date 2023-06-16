<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'src/Exception.php';
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';


include('../connect.php');

if(isset($_GET['status']) && isset($_GET['orderID']))
{
	$status = $_GET['status'];
	$orderID = $_GET['orderID'];
	$name = $_GET['name'];
	$email = $_GET['email'];

	mysqli_query($conn,"UPDATE orders SET orderStatus='$status'  WHERE orderID='$orderID'");	
}

// Email notification using PHPMailer
$subject = "Your Order have been shipped";
$txt = "Hi " . $name . ", <br> Your order has been successfully shipped. Thank you for buying candy from us. <br> We appreciate your business and hope you have a nice day!";

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'weiwong990827@gmail.com'; // Your Gmail email
    $mail->Password = 'hdeijdcgfxbuvqtd'; // Your Gmail password

    // Sender and recipient settings
    $mail->setFrom('no-reply@utem.edu.my', 'SWEET SENSATIONS [no-reply]');
    $mail->addAddress($email, $name);
    $mail->addReplyTo('no-reply@utem.edu.my', 'SWEET SENSATIONS [no-reply]');

    // Setting the email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $txt;

    $mail->send();

    echo "<script>alert('Update Success');</script>";
    echo "<script>window.location.href ='manageOrder.php'</script>";

    // echo "Data already inserted!! <br> Please check your email. <br>";
    // echo "<a href=manageOrder.php>Back</a>";
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>
