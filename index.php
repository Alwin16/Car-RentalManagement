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

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        
        $useremail = $_POST['useremail'];
        $password = $_POST['password'];

        $query = "SELECT * FROM tblusers WHERE EmailId = '$useremail' AND Password = '$password'";
        $result = pg_query($conn, $query);

        if ($result && pg_num_rows($result) > 0) {
            $_SESSION['useremail'] = $useremail;
            header("Location: home.php");
            exit;
        } else {
            $login_successful = false;
            $loginError = "Invalid email or password. Please try again.";
        }
    } elseif (isset($_POST['signup'])) {
        $signup_email = $_POST['signup_email'];
        $signup_password = $_POST['signup_password'];
        $name = $_POST['FullName'];
        $contactno = $_POST['ContactNo'];
        $dob= $_POST['dob'];
        $City = $_POST['City'];
        $Country = $_POST['Country'];

        $signupQuery = "INSERT INTO tblusers (EmailId, Password, FullName, ContactNo, dob, City, Country)
                        VALUES ('$signup_email', '$signup_password', '$name', '$contactno', '$dob', '$City', '$Country')";

        $signupResult = pg_query($conn, $signupQuery);

        if (!$signupResult) {
            echo "Query failed: " . pg_last_error($conn);
        } else {
            header("Location: otp.php");
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 400px;
    margin: 100px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
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
header {
        background-color: black;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }


.logo img{
    width:10%;
    height: auto;
}
h1 {
        text-align: center;
        color: white;
        background-color: black;
        margin: 0;
    }
</style>

<header>
        <div class="logo">
            <img src="logo.png" alt="Your Car Rental Logo">
        </div>
        <h1>Vehicle Hire</h1>
        

    </header>

    <main>
        <h2>Login</h2>
        <form method="post" action="">
            <label for="useremail">Email:</label>
            <input type="email" id="useremail" name="useremail" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>

        <p><?php echo isset($loginError) ? $loginError : ''; ?></p>

        <h2>Sign Up</h2>
        <form method="post" action="otp.php">
            <label for="signup_email">Email:</label>
            <input type="email" id="signup_email" name="signup_email" required>

            <label for="signup_password">Password:</label>
            <input type="password" id="signup_password" name="signup_password" required>

            <label for="FullName">Name:</label>
            <input type="text" id="FullName" name="FullName" required>

            <label for="ContactNo">Contact:</label>
            <input type="text" id="ContactNo" name="ContactNo" >

            <label for="dob">dob:</label>
            <input type="text" id="dob" name="dob" required>

            <label for="City">City:</label>
            <input type="text" id="City" name="City" required>
            <label for="Country">Country:</label>
            <input type="text" id="Country" name="Country" required>




            <button type="submit"  name="signup">Sign Up</button>
        </form>

        <p><?php echo isset($signupError) ? $signupError : ''; ?></p>
    </main>

    <footer>
        <p>&copy; 2023 Your Car Rental</p>
    </footer>

</body>
</html>
