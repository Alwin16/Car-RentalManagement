<?php
$host = "localhost";
$port = "5432";
$dbname = "carrental";
$user = "root";
$password = "root";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "Failed to connect to the database.";
    exit;
}

function getNumberOfUsers() {
    global $conn;

    // Perform the SQL query to get the count of users
    $query = "SELECT COUNT(*) FROM tblusers";
    $result = pg_query($conn, $query);

    if ($result) {
        // Fetch the result and return it
        $count = pg_fetch_result($result, 0);
        return $count; 
    } else {
        // Return an error message if the query fails
        return "Error: " . pg_last_error($conn);
    }
}
function showBrands() {
    global $conn;

    // Perform the SQL query to get the count of brands
    $query = "SELECT COUNT(*) FROM tblbrands";
    $result = pg_query($conn, $query);

    if ($result) {
        // Fetch the result and return it
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        // Return an error message if the query fails
        return "Error: " . pg_last_error($conn);
    }
}
function showVehicles(){
    global $conn;

    // Perform the SQL query to get the count of brands
    $query = "SELECT COUNT(*) FROM tblvehicles";
    $result = pg_query($conn, $query);

    if ($result) {
        // Fetch the result and return it
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        // Return an error message if the query fails
        return "Error: " . pg_last_error($conn);
    }
}

function showBookings(){
    global $conn;

    // Perform the SQL query to get the count of brands
    $query = "SELECT COUNT(*) FROM tblbooking";
    $result = pg_query($conn, $query);

    if ($result) {
        // Fetch the result and return it
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        // Return an error message if the query fails
        return "Error: " . pg_last_error($conn);
    }
}

function manageTestimonials(){
    global $conn;

    // Perform the SQL query to get the count of brands
    $query = "SELECT COUNT(*) FROM tbltestimonial";
    $result = pg_query($conn, $query);

    if ($result) {
        // Fetch the result and return it
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        // Return an error message if the query fails
        return "Error: " . pg_last_error($conn);
    }
}

function manageContactQueries(){
    global $conn;

    // Perform the SQL query to get the count of brands
    $query = "SELECT COUNT(*) FROM tblcontactusquery";
    $result = pg_query($conn, $query);

    if ($result) {
        // Fetch the result and return it
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        // Return an error message if the query fails
        return "Error: " . pg_last_error($conn);
    }
}

function regUsers(){
    global $conn;

    // Perform the SQL query to get the count of brands
    $query = "SELECT COUNT(*) FROM tblusers";
    $result = pg_query($conn, $query);

    if ($result) {
        // Fetch the result and return it
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        // Return an error message if the query fails
        return "Error: " . pg_last_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('recent-car-3.jpg'); /* Replace 'your-background-image.jpg' with the actual path to your image */
            background-size: cover; /* Cover the entire viewport */
            background-position: center center; /* Center the background image */
            background-attachment: fixed; /* Fixed background */
        }

        #sidebar {
            width: 200px;
            height: 100%;
            background-color: green;
            position: fixed;
            left: 0;
            top: 0;
            overflow-x: hidden;
            padding-top: 20px;
        }

        #content {
        text-align: center;
    }

    #content button {
        display: block;
        margin: 10px auto; /* Center the buttons */
    }

        #sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: block;
            transition: background-color 0.3s;
        }

        #sidebar a:hover {
            background-color: #555;
        }

        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    #sidebar {
        width: 200px;
        height: 100%;
        background-color: pink; /* Set background color to pink */
        position: fixed;
        left: 0;
        top: 0;
        overflow-x: hidden;
        padding-top: 20px;
    }

    

    #sidebar a {
        padding: 10px;
        text-decoration: none;
        font-size: 16px;
        color: white;
        display: block;
        transition: background-color 0.3s;
    }

    #sidebar a:hover {
        background-color: #555;
    }

    button {
        width: 150px; /* Set the width of the buttons */
        padding: 15px;
        margin: 10px;
        background-color: #3498db; /* Button color */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #2980b9; /* Button color on hover */
    }
        
    </style>
</head>
<body>

<div id="sidebar">
    <a href="?action=dashboard">Dashboard</a>
    <a href="brands.php">Brands</a>
    <a href="vehicles.php">Vehicles</a>
    <a href="?action=bookings">Bookings</a>
    <a href="?action=testimonials">Manage Testimonials</a>
    <a href="?action=contact_queries">Manage Conatctus Query</a>
    <a href="?action=reg_users">Reg Users</a>
    <a href="?action=manage_pages">Manage Pages</a>
    <a href="?action=update_contact">Update Contact Info</a>
    <a href="?action=subscribers">Manage Subscribers</a>
</div>

<div id="content">
    <!-- Content will be dynamically updated based on the menu selection -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
        $action = $_GET['action'];

        switch ($action) {
            case 'dashboard':
                // Display eight buttons for the dashboard
                echo '<button onclick="getNumberOfUsers()">Number of Users</button>';
                echo '<button onclick="showBrands()">Number of Brands</button>';
                echo '<button onclick="showVehicles()">Number of vehicles</button>';
                echo '<button onclick="showBookings()">Number of Bookings</button>';
                echo '<button onclick="manageTestimonials()">Number of Testimonials</button>';
                echo '<button onclick="manageContactQueries()">Number of Queries</button>';
                echo '<button onclick="regUsers()">Number of Subscribers</button>';
                
                break;

            // Add cases for other menu options if needed

            default:
                // Default content when no action is specified
                echo '<h2>Welcome to the Admin Dashboard</h2>';
                break;
        }
    } else {
        // Default content when no action is specified
        echo '<h2>Welcome to the Admin Dashboard</h2>';
    }
    ?>
</div>

<script>
    function getNumberOfUsers() {
        <?php
        // Call the function to get the number of users when the button is clicked
        $numberOfUsers = getNumberOfUsers();
        echo "alert('Total Users: $numberOfUsers');";
        ?>
    }

    

    // Implement other functions as needed
</script>

<script>
    function showBrands() {
        <?php
        $number = showBrands();
        echo "alert('Total Brands: $number');";
        ?>
    }
</script>


<script>
    function showVehicles() {
        <?php
        $number = showVehicles();
        echo "alert('Total Number of vehicles: $number');";
        ?>
    }
</script>

<script>
    function showBookings() {
        <?php
        $number = showBookings();
        echo "alert('Total Number of Bookings: $number');";
        ?>
    }
</script>

<script>
    function manageTestimonials() {
        <?php
        $number = manageTestimonials();
        echo "alert('Total Number of testimonials: $number');";
        ?>
    }
</script>

<script>
    function manageContactQueries() {
        <?php
        $number = manageContactQueries();
        echo "alert('Total Number of contact address: $number');";
        ?>
    }
</script>

<script>
    function regUsers() {
        <?php
        $number = regUsers();
        echo "alert('Total Number of subscribers: $number');";
        ?>
    }
</script>


</body>
</html>
