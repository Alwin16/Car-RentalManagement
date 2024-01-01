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

$query = "SELECT * FROM tblsubscribers";
$result = pg_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers</title>
    
    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('bg.jpg'); 
    background-size: cover;
    
    background-repeat: no-repeat;
    background-color: rgba(255, 255, 255, 0.8); 
}

        #sidebar {
            width: 200px;
            background-color: red;
            padding-top: 20px;
            height: 100vh; 
            position: fixed;
            left: 0;
            top: 0;
            overflow-x: hidden;
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

        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 200px; 
        }

        #subscribers-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        #subscribers-table th, #subscribers-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        #subscribers-table th {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>

<div id="sidebar">
    <a href="admin.php">Dashboard</a>
    <a href="brands.php">Brands</a>
    <a href="vehicles.php">Vehicles</a>
    <a href="bookings.php">Bookings</a>
    <a href="testimonial.php">Manage Testimonials</a>
    <a href="contactusquery.php">Manage Contact Us Query</a>
    <a href="regusers.php">Reg Users</a>
    <a href="continfo.php">Update Contact Info</a>
    <a href="subscribers.php">Manage Subscribers</a>
</div>

<div class="main-content">
    <h2>Subscribers:</h2>
    <table id="subscribers-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result && pg_num_rows($result) > 0) {
                    while ($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['subscriberemail']}</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No subscribers found</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
