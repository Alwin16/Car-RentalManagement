<?php
require 'PHPMailer/PHPMailerAutoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

   
    $mail = new PHPMailer;


    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;
    $mail->Username = 'alwin7378@gmail.com';  
    $mail->Password = 'oekd jynp pjmt ctuj';  
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('alwin7378@gmail.com', 'Your Name');
    $mail->addAddress($to); 

    $mail->isHTML(true); 
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->SMTPDebug = 2;

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
?>
