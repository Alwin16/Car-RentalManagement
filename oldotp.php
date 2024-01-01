<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        .container {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <title>OTP Verification</title>
</head>

<body>
    <div class="container">
        <h2>Enter OTP</h2>
        <form method="post" action="">
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" required>
            <button type="submit" onclick=validateotp() name="verify_otp">Verify OTP</button>
        </form>
    </div>
</body>

</html>

<?php
session_start();

function generateOTP() {
    return rand(100000, 100001); // Change the range as needed
}

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

// Enable verbose debug output
$mail->SMTPDebug = 2;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'alwin7378@gmail.com'; // SMTP username (your email)
$mail->Password = 'oekd jynp pjmt ctuj'; // SMTP password (your email password)
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to

$mail->setFrom('alwin7378@gmail.com', 'Test Email');
$mail->addAddress('iamalwin74@gmail.com'); // Add a recipient (recipient's email)

$mail->isHTML(true); // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}


function validateotp() {
    if (isset($_POST['verify_otp'])) {
        $otp = generateOTP();
        $_SESSION['signup_otp'] = $otp;
        echo "<script>alert('OTP sent to your email');</script>";

        require 'PHPMailer/PHPMailerAutoload.php';

        $rec = $_POST["otp"];

        if ($otp == $rec) {
            echo "<script>alert('OTP verified');</script>";
            header("Location: index.php");
            exit;
        }

    }}
?>
