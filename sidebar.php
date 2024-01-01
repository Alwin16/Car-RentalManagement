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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    <style>
        

        #sidebar {
            width: 200px;
            height: 100%;
            background-color: red;
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

        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    #sidebar {
        width: 200px;
        height: 100%;
        background-color: red; 
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




</body>
</html>
