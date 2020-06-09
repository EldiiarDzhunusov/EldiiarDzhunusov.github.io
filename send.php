<?php

$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$reason = filter_var($_POST['reason'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'emailerfromeld@gmail.com';                     // SMTP username
    $mail->Password   = '!Qwerty12345';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('junusov.eldiyar@gmail.com', 'My Portfolio Website');
    $mail->addAddress('junusov.eldiyar@gmail.com', $name);     // Add a recipient
    

    //html body
    $body= "<p>The contact form from eldiiardzhunusov.github.io</p><p>Sent from: " . $name .  "</p> The reason: " . $reason . "</p><p> The message is: " . $message . "</p><p> Email adress: " . $email . "</p>";

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Message from ' . $name;

    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    //echo 'Message has been sent';
    header("location: thankyou.html");

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
