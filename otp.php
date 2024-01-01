<?php
session_start();

function generateOTP() {
    return rand(100000, 999999); 
}


require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; 
$mail->SMTPAuth = true;
$mail->Username = 'alwin7378@gmail.com';  
$mail->Password = 'oekd jynp pjmt ctuj';  
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('alwin7378@gmail.com', 'Test Email');
$formotp = $_POST['signup_email'];
$mail->addAddress($formotp); 

$mail->isHTML(true); 
$otp = generateOTP();
$_SESSION['signup_otp'] = $otp;


$mail->Subject = 'Your OTP for verification';
$mail->Body = 'Your OTP is: ' . $otp;



if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>

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
        <form method="post"  onsubmit="return validateotp()">
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" required>
            <button type="submit" name="verify_otp">Verify OTP</button>
        </form>
    </div>

    <script>
        function validateotp() {
   
    var enteredOTP = document.getElementById("otp").value;
    var storedOTP = <?php echo json_encode($_SESSION['signup_otp']); ?>;

    if (enteredOTP.trim() === "") {
        alert('Please enter the OTP.');
        return false;
    }

    if (enteredOTP === storedOTP) {
        
        window.location.href = 'home.php';
        return true;
    } else {
        window.location.href = 'home.php';
        return false;
    }
}

    </script>
</body>


</html>