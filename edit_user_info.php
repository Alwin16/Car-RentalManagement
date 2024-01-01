<?php
session_start();

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

if (!isset($_SESSION['useremail'])) {
    header("Location: login.php"); 
    exit;
}

$useremail = $_SESSION['useremail'];

$query = "SELECT * FROM tblusers WHERE EmailId = '$useremail'";
$result = pg_query($conn, $query);

if (!$result) {
    echo "Query failed: " . pg_last_error($conn);
    exit;
}

$user = pg_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
   
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $updateQuery = "UPDATE tblusers SET
                    fullname = '$fullname',
                    password = '$password',
                    
                    dob = '$dob',
                    address = '$address',
                    city = '$city',
                    country = '$country'
                    WHERE EmailId = '$useremail'";

    $updateResult = pg_query($conn, $updateQuery);

    if (!$updateResult) {
        echo "Update failed: " . pg_last_error($conn);
    } else {
        header("Location: profile.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit User Info</title>

    <style>
        body {
    background-image: url('profile.jpg');
    background-size: cover; 
    background-repeat: no-repeat;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5; 
}


header {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo img {
    max-height: 50px;
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
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 0.5s ease-in-out; 
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

form {
    max-width: 400px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out; /* Add a smooth transition */
}

button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>

    

    <main>
        <h1>Edit User Info</h1>
        <form method="post" action="">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>" required>

            <br>
            <label for="dob">Date of Birth:</label>
            <input type="text" id="dob" name="dob" value="<?php echo $user['dob']; ?>" required>
            <br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" required>
            <br>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo $user['city']; ?>" required>
            <br>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="<?php echo $user['country']; ?>" required>
            <br>
            <button type="submit">Update</button>
        </form>
    </main>

    

    <script src="script.js"></script>
</body>
</html>
