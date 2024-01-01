
<?php

if(isset($_POST["submit"])){

   

require 'PHPMailer/PHPMailerAutoload.php';
$name=$_POST["name"];
$email=$_POST["email"];
$mail = new PHPMailer;

$mail->SMTPDebug = 4;                               

$mail->isSMTP();                                      
$mail->Host = 'smtp.gmail.com';  
$mail->SMTPAuth = true;                               
$mail->Username = 'alwin7378@gmail.com';                
$mail->Password = 'oekd jynp pjmt ctuj';                           
$mail->SMTPSecure = 'tls';                            
$mail->Port = 587;                                   

$mail->setFrom('alwin7378@gmail.com', 'Test Email');
$mail->addAddress('alwin7378@gmail.com');     

$mail->isHTML(true);                                  

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}}
?>

<!DOCTYPE html>
<html>
<head>


</head>
<body>
<form action="sample.php" method="post">
    <input type="text"  placeholder="enter name" name="name"><br>
    <input type="email" placeholder="enter email" name="email"><br>

    <input type="submit" value="submit" name="submit">

</form>

</body>
</html>