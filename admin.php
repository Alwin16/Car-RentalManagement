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

function getNumberOfUsers() {
    global $conn;

    $query = "SELECT COUNT(*) FROM tblusers";
    $result = pg_query($conn, $query);

    if ($result) {
        $count = pg_fetch_result($result, 0);
        return $count; 
    } else {
        return "Error: " . pg_last_error($conn);
    }
}
function showBrands() {
    global $conn;

    $query = "SELECT COUNT(*) FROM tblbrands";
    $result = pg_query($conn, $query);

    if ($result) {
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        return "Error: " . pg_last_error($conn);
    }
}
function showVehicles(){
    global $conn;

    $query = "SELECT COUNT(*) FROM tblvehicles";
    $result = pg_query($conn, $query);

    if ($result) {
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        return "Error: " . pg_last_error($conn);
    }
}

function showBookings(){
    global $conn;

    $query = "SELECT COUNT(*) FROM tblbooking";
    $result = pg_query($conn, $query);

    if ($result) {
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        return "Error: " . pg_last_error($conn);
    }
}

function manageTestimonials(){
    global $conn;

    $query = "SELECT COUNT(*) FROM tbltestimonial";
    $result = pg_query($conn, $query);

    if ($result) {
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        return "Error: " . pg_last_error($conn);
    }
}

function manageContactQueries(){
    global $conn;

    $query = "SELECT COUNT(*) FROM tblcontactusquery";
    $result = pg_query($conn, $query);

    if ($result) {
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
        return "Error: " . pg_last_error($conn);
    }
}

function regUsers(){
    global $conn;

    $query = "SELECT COUNT(*) FROM tblusers";
    $result = pg_query($conn, $query);

    if ($result) {
        $count = pg_fetch_result($result, 0);
        return $count;
    } else {
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
            background-image: url('car2.jpg'); 
            background-size: cover; 
            background-position: center center; 
            background-attachment: fixed;
        }
        h2 {
            font-size: 3em;
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin-right: 20%;
            color: black; 
            animation: fadeInUp 1.5s ease-in-out;
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
        

        #content {
        text-align: center;
    }

    #content button {
        display: block;
        margin: 10px auto; 
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
        background-color:red; 
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
        align-items:center;
        width: 200px; 
        padding: 15px;
        margin: 10px;
        background-color: green; 
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: red;
    }
        
    </style>
</head>
<body>

<div id="sidebar">
    <a href="?action=dashboard">Dashboard</a>
    <a href="brands.php">Brands</a>
    <a href="vehicles.php">Vehicles</a>
    <a href="bookings.php">Bookings</a>
    <a href="?action=testimonials">Manage Testimonials</a>
    <a href="contactusquery.php">Manage Conatctus Query</a>
    <a href="regusers.php">Reg Users</a>

    <a href="continfo.php">Update Contact Info</a>
    <a href="subscribers.php">Manage Subscribers</a>
</div>

<div id="content">
   
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
        $action = $_GET['action'];

        switch ($action) {
            case 'dashboard':
                
                echo '<button onclick="getNumberOfUsers()">Number of Users</button>';
                echo '<button onclick="showBrands()">Number of Brands</button>';
                echo '<button onclick="showVehicles()">Number of vehicles</button>';
                echo '<button onclick="showBookings()">Number of Bookings</button>';
                echo '<button onclick="manageTestimonials()">Number of Testimonials</button>';
                echo '<button onclick="manageContactQueries()">Number of Queries</button>';
                echo '<button onclick="regUsers()">Number of Subscribers</button>';
                
                break;


            default:
                echo '<h2 style=>Welcome to the Admin Dashboard</h2>';
                break;
        }
    } else {
        echo '<h2>Welcome to the Admin Dashboard</h2>';
    }
    ?>
</div>

<script>
    function getNumberOfUsers() {
        <?php
        $numberOfUsers = getNumberOfUsers();
        echo "alert('Total Users: $numberOfUsers');";
        ?>
    }

    

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
