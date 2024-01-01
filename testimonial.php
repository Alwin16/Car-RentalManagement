<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands Page</title>
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
            height: 100%;
            background-color: red; /* Set background color to pink */
            position: fixed;
            left: 0;
            top: 0;
            overflow-x: hidden;
            padding-top: 20px;
            overflow-x: hidden;
            padding-top: 20px;
            z-index: 0; /* Ensure the sidebar is below the pseudo-element */
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
            margin-left: 200px; /* Adjusted to accommodate the sidebar width */
        }

        /* Your existing table styles */
        table {
            margin: 50px 0 0;
            border-collapse: collapse;
            width: 80%; /* Adjust the width as needed */
            position: relative;
            z-index: 1; /* Ensure the table is above the pseudo-element */
            margin-left: 200px; /* Adjust the margin to move the table to the right of the sidebar */
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
        <!-- Add other sidebar links as needed -->
    </div>
    <div class="main-content">
        <?php
        // Connect to your database
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

        // Query to retrieve all rows from tbltestimonial
        $query = "SELECT * FROM tbltestimonial";
        $result = pg_query($conn, $query);

        if (!$result) {
            echo "Error retrieving testimonials: " . pg_last_error($conn);
            exit;
        }

        // Check if there are rows in the result
        if (pg_num_rows($result) > 0) {
            echo "<h2>Testimonials:</h2>";
            echo "<table border='1'>";
            
            // Display column headers
            echo "<tr>";
            $row = pg_fetch_assoc($result);
            foreach ($row as $key => $value) {
                echo "<th style='background-color:#4caf50;'>$key</th>";
            }
            echo "</tr>";

            // Display data rows
            pg_result_seek($result, 0); // Reset result set pointer to the beginning
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "No testimonials found.";
        }

        // Close the database connection
        pg_close($conn);
        ?>
    </div>
</body>

</html>
