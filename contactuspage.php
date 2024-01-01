<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            background-image: url('your_background_image.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #contact-form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="contact-form">
    <h2>Contact Us</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
<?php

$host = 'localhost';
$port = '5432';
$dbname = 'carrental';
$user = 'postgres';
$password = 'postgres';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact_number = $_POST["contact_number"];
    $message = $_POST["message"];

    $query = "INSERT INTO tblcontactusquery (name, email, contact_number, message) VALUES ('$name', '$email', '$contact_number', '$message')";
    $result = pg_query($conn, $query);

    if ($result) {
        header("Location: contactuspage.php?status=success");
        exit();
    } else {
        die("Query failed: " . pg_last_error($conn));
    }

    $subject = 'New Contact Form Submission';
    $message_body = "Name: $name\nEmail: $email\nContact Number: $contact_number\nMessage: $message";

    $headers = "From: $email" . "\r\n";

    $mail_result = mail($to, $subject, $message_body, $headers);

    if ($mail_result) {
        header("Location: contactuspage.php?status=success");
        exit();
    } else {
        die("Email sending failed");
    }
}
?>


