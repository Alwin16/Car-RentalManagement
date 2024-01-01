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

$userQuery = "SELECT * FROM tblusers WHERE EmailId = '$useremail'";
$userResult = pg_query($conn, $userQuery);

if (!$userResult) {
    echo "Error fetching user information: " . pg_last_error($conn);
    exit;
}

$user = pg_fetch_assoc($userResult);

$bookingsQuery = "SELECT * FROM tblbooking WHERE userEmail = '$useremail'";
$bookingsResult = pg_query($conn, $bookingsQuery);

if (!$bookingsResult) {
    echo "Error fetching user bookings: " . pg_last_error($conn);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Profile</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
}

nav {
    background-color: #444;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

nav li {
    float: left;
}

nav a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

nav a:hover {
    background-color: #ddd;
    color: black;
}

.user-options {
    float: right;
    padding: 15px;
}

.user-options button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.user-dropdown {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    z-index: 1;
}

.user-dropdown ul {
    list-style-type: none;
    padding: 0;
}

.user-dropdown li {
    padding: 10px;
    text-align: center;
}

main {
    padding: 20px;
}

h1 {
    text-align: center;
}

.user-info {
    background-color: #f7f7f7;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}

.user-info h2 {
    color: #333;
}

.user-info p {
    margin: 10px 0;
    font-size: 16px;
}

.user-info button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.user-bookings {
    background-color: #f7f7f7;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
}

.user-bookings h2 {
    color: #333;
}

.user-bookings p {
    margin: 10px 0;
    font-size: 16px;
    line-height: 1.5;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
}
</style>
</head>
<body>
<style>
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
        
        <h1>Vehicle Hire User Profile</h1>
        

    </header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="carlisting.php">Car List</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </nav>
        <div class="user-options">
            <button onclick="showUserOptions()"><?php echo $user['fullname']; ?></button>
            <div class="user-dropdown">
                <ul>
               
                  
                </ul>
            </div>
        </div>
    </header>

    <main>
        <h2>Welcome, <?php echo $user['fullname']; ?>!</h2>

        <div class="user-info">
            <h2>User Information</h2>
            <p>Full Name: <?php echo $user['fullname']; ?></p>
            <p>Email: <?php echo $user['emailid']; ?></p>
            
            <p>Date of Birth: <?php echo $user['dob']; ?></p>
            <p>Address: <?php echo $user['address']; ?></p>
            <p>City: <?php echo $user['city']; ?></p>
            <p>Country: <?php echo $user['country']; ?></p>

            <button onclick="editUserInfo()">Edit Information</button>
        </div>

        <div class="user-bookings">
            <h2>My Bookings</h2>

            <?php
            if (pg_num_rows($bookingsResult) > 0) {
                while ($booking = pg_fetch_assoc($bookingsResult)) {
                    echo "<p>Booking ID: {$booking['id']}</p>";
                   
                    echo "<p>Vehicle ID: {$booking['vehicleid']}</p>";
                    echo "<p>From Date: {$booking['fromdate']}</p>";
                    echo "<p>To Date: {$booking['todate']}</p>";
                    echo "<hr>";
                }
            } else {
                echo "<p>No bookings found.</p>";
            }
            ?>

        </div>
    </main>

    <footer>
        <p>&copy; 2023 Your Car Rental</p>
    </footer>

    <script>
        function showUserOptions() {
            alert('User Options');
        }

        function editUserInfo() {
            window.location.href = 'edit_user_info.php';
        }
    </script>

</body>
</html>
