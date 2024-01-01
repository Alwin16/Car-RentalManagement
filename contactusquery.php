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
    
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your existing head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        #sidebar {
            width: 200px;
            background-color: red;
            padding-top: 20px;
            height: 100vh; /* Set sidebar height to full viewport height */
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
    <a href="?action=reg_users">Reg Users</a>
    <a href="?action=manage_pages">Manage Pages</a>
    <a href="?action=update_contact">Update Contact Info</a>
    <a href="?action=subscribers">Manage Subscribers</a>
</div>


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

        #summa-table-contain {
            overflow-x: auto;
            white-space: nowrap;
            margin: 20px 0; 
        }

        #summa-table {
            width: 100%;
            border-collapse: collapse;
            
        }

        #summa-table th, #summa-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        #summa-table th {
            background-color: #4caf50;
            color: white;
        }

        #addFormContainer {
            max-width: 600px;
            margin-top: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #updateForm {
            display: grid;
            gap: 15px;
        }

        #updateForm label {
            font-weight: bold;
        }

        #updateForm input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        #updateForm button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #updateForm button:hover {
            background-color: #45a049;
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
    <div id="summa-table-contain">
        <div id="summa-table">
            <?php
            $query = "SELECT * FROM tblcontactusquery";
            $result = pg_query($conn, $query);

            if ($result) {
                if (pg_num_rows($result) > 0) {
                    echo "<h2>Contact US:</h2>";
                    echo "<table border='1'>";
                    echo "<tr>";
                    $row = pg_fetch_assoc($result);
                    foreach ($row as $key => $value) {
                        echo "<th>$key</th>";
                    }
                    echo "</tr>";

                    pg_result_seek($result, 0);
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
        </div>
    </div>

    



</body>
</html>
