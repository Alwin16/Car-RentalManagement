<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands Page</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden; 
        }   

body {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    height: 100vh; 
}

table {
    margin: 50px 0 0;
    border-collapse: collapse;
    width: 80%; 
    position: relative;
    z-index: 1; 
}


        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('recent-car-6.jpg'); 
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            opacity: 0.5; 
            z-index: -1;
        }

body {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    height: 100vh; 
}

table {
    margin: 50px 0 0;
    border-collapse: collapse;
    width: 80%; 
    position: relative;
    z-index: 1; 
    margin-left: 100px; 
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

        /* Your existing styles for the sidebar */
    
        /* Add additional styles as needed */
    </style>
</head>

<body>
<div id="sidebar">
    <a href="admin.php">Dashboard</a>
    <a href="brands.php">Brands</a>
    <a href="?action=vehicles">Vehicles</a>
    <a href="?action=bookings">Bookings</a>
    <a href="?action=testimonials">Manage Testimonials</a>
    <a href="?action=contact_queries">Manage Conatctus Query</a>
    <a href="?action=reg_users">Reg Users</a>
    <a href="?action=manage_pages">Manage Pages</a>
    <a href="?action=update_contact">Update Contact Info</a>
    <a href="?action=subscribers">Manage Subscribers</a>
</div>
    <?php
    // Retrieve contents of the brands table and display them
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

    // Query to retrieve all columns and rows from the brands table
    $query = "SELECT * FROM tblbrands";
    $result = pg_query($conn, $query);

    if ($result) {
        // Check if there are rows in the result
        if (pg_num_rows($result) > 0) {
            echo "<h2>Brands:</h2>";
            echo "<table border='1'>";
            // Display column headers
            echo "<tr>";
            $row = pg_fetch_assoc($result);
            foreach ($row as $key => $value) {
                echo "<th>$key</th>";
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
            echo "No data found in the brands table.";
        }
    } else {
        echo "Error: " . pg_last_error($conn);
    }
    ?>
</body>

</html>