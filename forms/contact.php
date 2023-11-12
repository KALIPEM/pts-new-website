<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer-6.8.1/src/PHPMailer.php';
require '../assets/PHPMailer-6.8.1/src/Exception.php';
require '../assets/PHPMailer-6.8.1/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    // $mail->SMTPDebug = 2;  // Enable verbose debug output
    $mail->isSMTP();       // Set mailer to use SMTP
    $mail->Host = 'smtp.example.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;  // Enable SMTP authentication
    $mail->Username = 'email@example.com';  // SMTP username
    $mail->Password = 'yourpassword';  // SMTP password
    $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;  // TCP port to connect to

    // Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('office@perfecttransports.com', 'Recipient Name');  // Add a recipient
    $mail->addReplyTo($_POST['email'], $_POST['name']);

    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $_POST['subject'];
    $mail->Body    = nl2br(e($_POST['message']));
    $mail->AltBody = e($_POST['message']);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
