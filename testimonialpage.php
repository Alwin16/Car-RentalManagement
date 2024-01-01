<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #testimonialForm {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        #testimonialForm label {
            display: block;
            margin-bottom: 8px;
        }

        #testimonialForm input,
        #testimonialForm textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        #testimonialForm button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #testimonialForm button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div id="testimonialForm">
        <h2>Add Testimonial</h2>
        <form action="" method="post">
            <label for="userId">User ID:</label>
            <input type="text" id="userId" name="userId" required>

            <label for="userEmail">User Email:</label>
            <input type="email" id="userEmail" name="userEmail" required>

            <label for="postingDate">Posting Date:</label>
            <input type="datetime-local" id="postingDate" name="postingDate" required>

            <label for="feedback">Your Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" required></textarea>

            <button type="submit">Submit Testimonial</button>
        </form>
    </div>
</body>

</html>


<?php
$host = "localhost";
$port = "5432";
$dbname = "carrental";
$user = "postgres";
$password = "postgres";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "Failed to connect to the database.";
    exit;
}
else{
    echo "connection successful";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    $userEmail = $_POST['userEmail'];
    $postingDate = $_POST['postingDate'];
    $feedback=$_POST['feedback'];

    $insertQuery = "INSERT INTO tbltestimonial (id, useremail, postingdate,testimonial) VALUES ('$userId', '$userEmail', '$postingDate','$feedback')";
    $insertResult = pg_query($conn, $insertQuery);

    if ($insertResult) {
        echo "Testimonial added successfully!";
    } else {
        echo "Error adding testimonial: " . pg_last_error($conn);
    }
}
?>


