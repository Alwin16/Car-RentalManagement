<?php
$host = "localhost";
$port = "5432";
$dbname = "carrental";
$user = "postgres";
$password = "postgres";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

session_start();
$useremail = $_SESSION['useremail']; 


$queryUser = "SELECT fullName, contactno FROM tblusers WHERE EmailId = '$useremail'";
$resultUser = pg_query($conn, $queryUser);

if ($resultUser && pg_num_rows($resultUser) > 0) {
    $userData = pg_fetch_assoc($resultUser);

    $fullName = $userData['fullname'];
    $contactNumber = $userData['contactno'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh; 
        }

        .contact-us-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%; 
            max-width: 600px; 
            text-align: left; 
            animation: fadeInUp 1s ease-in-out;
        }

        .contact-us-section h2 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <title>Contact Us</title>
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="carlisting.php">Car List</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="contact-us-section">
            <h2>Contact Us</h2>
            <p>Feel free to reach out to us for any inquiries or concerns.</p>
            <form action="contactprocess.php" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $fullName; ?>">
                
                <label for="email">Email ID</label>
                <input type="text" name="email" value="<?php echo $useremail; ?>">
                
                <label for="contact_number">Contact No</label>
                <input type="text" name="contact_number" value="<?php echo $contactNumber; ?>">
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                
                <button type="submit">Submit</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 Your Car Rental</p>
    </footer>

</body>
</html>
