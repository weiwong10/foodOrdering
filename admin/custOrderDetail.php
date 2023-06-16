<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'src/Exception.php';
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';

include('../connect.php');

if (isset($_GET['status']) && isset($_GET['orderID'])) {
    $status = $_GET['status'];
    $orderID = $_GET['orderID'];
    $name = $_GET['name'];
    $email = $_GET['email'];

    mysqli_query($conn, "UPDATE orders SET orderStatus='$status'  WHERE orderID='$orderID'");
}

// Generate the HTML table with order details
$table = '<table style="border-collapse: collapse; width: 100%;">
            <tr style="border-bottom: 1px solid #ccc;">
                <th style="padding: 8px; text-align: left;">Item</th>
                <th style="padding: 8px; text-align: left;">Image</th>
                <th style="padding: 8px; text-align: left;">Quantity</th>
                <th style="padding: 8px; text-align: left;">Price</th>
            </tr>';

            $orderDetailsQuery = mysqli_query($conn, "SELECT itemName, quantity, price, image FROM orders o, order_detail d, item i WHERE o.orderID = d.orderID AND d.itemID = i.itemID AND o.orderID='$orderID'");
            while ($row = mysqli_fetch_assoc($orderDetailsQuery)) {
                $itemName = $row['itemName'];
                $quantity = $row['quantity'];
                $price = $row['price'];
                $image = $row['image'];
            
                // Ensure the image path is not empty
                if (!empty($image)) {
                    // Add a row for each order detail
                    $table .= '<tr style="border-bottom: 1px solid #ccc;">
                                <td style="padding: 8px;">' . $itemName . '</td>
                                <td style="padding: 8px;"><img src="' . $image . '" alt="Image" style="width: 125px; height: 125px;"></td>
                                <td style="padding: 8px;">' . $quantity . '</td>
                                <td style="padding: 8px;">' . $price . '</td>
                            </tr>';
                }
                
            }

$orderAmountQuery = mysqli_query($conn, "SELECT amount FROM orders WHERE orderID ='$orderID'");
$rowAmount = mysqli_fetch_assoc($orderAmountQuery);

$table .= '<tr>
            <td colspan="3" style="padding: 8px; text-align: right; font-weight: bold;">Total Price</td>
            <td style="padding: 8px; font-weight: bold;">'
            . $rowAmount['amount'] .
            '</td>
            </tr>
            </table>';

// Email notification using PHPMailer
$subject = "Your Order has been shipped";
$txt = "Hi " . $name . ", <br> Your order has been successfully shipped. Thank you for buying candy from us. <br> We appreciate your business and hope you have a nice day!";

// Append the table to the email body
$txt .= '<br><br>Order Details:<br>' . $table;

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
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>
