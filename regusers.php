<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    
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

        #users-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        #users-table th, #users-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        #users-table th {
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
    <a href="contactusquery.php">Manage Conatctus Query</a>
    <a href="regusers.php">Reg Users</a>

    <a href="continfo.php">Update Contact Info</a>
    <a href="subscribers.php">Manage Subscribers</a>
</div>

<div class="main-content">
    <h2>Registered Users:</h2>
    <table id="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email ID</th>
                <th>Contact No</th>
                <th>DOB</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>Registration Date</th>
                <th>Updation Date</th>
            </tr>
        </thead>
        <tbody>
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

               
                $query = "SELECT * FROM tblusers";
                $result = pg_query($conn, $query);

                if ($result && pg_num_rows($result) > 0) {
                    while ($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['fullname']}</td>";
                        echo "<td>{$row['emailid']}</td>";
                        echo "<td>{$row['contactno']}</td>";
                        echo "<td>{$row['dob']}</td>";
                        echo "<td>{$row['address']}</td>";
                        echo "<td>{$row['city']}</td>";
                        echo "<td>{$row['country']}</td>";
                        echo "<td>{$row['regdate']}</td>";
                        echo "<td>{$row['updationdate']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No data found</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
