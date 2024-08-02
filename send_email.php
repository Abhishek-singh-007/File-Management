<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmail($to, $subject, $body)
{
  $mail = new PHPMailer(true);
  try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'your-email@gmail.com'; // SMTP username
    $mail->Password = 'your-email-password'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom('your-email@gmail.com', 'Your Name');
    $mail->addAddress($to); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}
?>