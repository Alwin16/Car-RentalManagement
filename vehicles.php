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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    
    <style>
       body {
        font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('bg.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
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
        }

        #summa-table {
            width: 100%;
            border-collapse: collapse;
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
            $query = "SELECT * FROM tblvehicles";
            $result = pg_query($conn, $query);

            if ($result) {
                if (pg_num_rows($result) > 0) {
                    echo "<h2>Vehicles:</h2>";
                    echo "<table border='1'>";
                    echo "<tr>";
                    $row = pg_fetch_assoc($result);
                    foreach ($row as $key => $value) {
                        echo "<th style='background-color:#4caf50;'>$key</th>";
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

    <div id="addFormContainer">
        
            <h2>Insert Vehicle Details</h2>
            <form id="updateForm" method="post" action="">
                <label for="VehiclesTitle">Vehicles Title:</label>
                <input type="text" id="VehiclesTitle" name="VehiclesTitle" required>
    
                <label for="VehiclesBrand">Vehicles Brand:</label>
                <input type="int" id="VehiclesBrand" name="VehiclesBrand" required>
    
                <label for="vehiclesoverview">Vehicles Overview:</label>
                <textarea id="vehiclesoverview" name="vehiclesoverview" required></textarea>
    
                <label for="priceperday">Price Per Day:</label>
                <input type="int" id="priceperday" name="priceperday" required>
    
                <label for="fueltype">Fuel Type:</label>
                <input type="text" id="fueltype" name="fueltype" required>
    
                <label for="modelyear">Model Year:</label>
                <input type="int" id="modelyear" name="modelyear" required>
    
                <label for="seatingcapacity">Seating Capacity:</label>
                <input type="int" id="seatingcapacity" name="seatingcapacity" required>
    
                <label for="airconditioner">Air Conditioner:</label>
                <input type="int" id="airconditioner" name="airconditioner" required>
    
                <label for="powerdoorlocks">Power Door Locks:</label>
                <input type="int" id="powerdoorlocks" name="powerdoorlocks" required>
    
                <label for="antilockbrakingsystem">Anti-lock Braking System:</label>
                <input type="int" id="antilockbrakingsystem" name="antilockbrakingsystem" required>
    
                <label for="brakeassist">Brake Assist:</label>
                <input type="int" id="brakeassist" name="brakeassist" required>
    
                <label for="powersteering">Power Steering:</label>
                <input type="int" id="powersteering" name="powersteering" required>
    
                <label for="driverairbag">Driver Airbag:</label>
                <input type="int" id="driverairbag" name="driverairbag" required>
    
                <label for="passengerairbag">Passenger Airbag:</label>
                <input type="int" id="passengerairbag" name="passengerairbag" required>
    
                <label for="powerwindows">Power Windows:</label>
                <input type="int" id="powerwindows" name="powerwindows" required>
    
                <label for="cdplayer">CD Player:</label>
                <input type="int" id="cdplayer" name="cdplayer" required>
    
                <label for="centrallocking">Central Locking:</label>
                <input type="int" id="centrallocking" name="centrallocking" required>
    
                <label for="crashsensor">Crash Sensor:</label>
                <input type="int" id="crashsensor" name="crashsensor" required>
    
                <label for="leatherseats">Leather Seats:</label>
                <input type="int" id="leatherseats" name="leatherseats" required>
    
                
    
    
                <label for="id">ID:</label>
                <input type="int" id="id" name="id" required>
    
                <button type="submit">Insert Details</button>
            </form>
    </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $VehiclesTitle = $_POST['VehiclesTitle'];
    $VehiclesBrand = $_POST['VehiclesBrand'];
    $vehiclesoverview = $_POST['vehiclesoverview'];
    $priceperday = $_POST['priceperday'];
    $fueltype = $_POST['fueltype'];
    $seatingcapacity=$_POST['seatingcapacity'];
    $airconditioner=$_POST['airconditioner'];
    $powerdoorlocks=$_POST['powerdoorlocks'];
    $antilockbrakingsystem=$_POST['antilockbrakingsystem'];
    $brakeassist=$_POST['brakeassist'];
    $powersteering=$_POST['powersteering'];
    $driverairbag=$_POST['driverairbag'];
    $passengerairbag=$_POST['passengerairbag'];
    $powerwindows=$_POST['powerwindows'];
    $cdplayer=$_POST['cdplayer'];
    $centrallocking=$_POST['centrallocking'];
    $crashsensor=$_POST['crashsensor'];
    $leatherseats=$_POST['leatherseats'];


    $id = $_POST['id'];

    $insertQuery = "INSERT INTO tblvehicles (
        VehiclesTitle,
        VehiclesBrand,
        vehiclesoverview,
        priceperday,
        fueltype,
        seatingcapacity,
        airconditioner,
        powerdoorlocks,
        antilockbrakingsystem,
        brakeassist,
        powersteering,
        driverairbag,
        passengerairbag,
        powerwindows,
        cdplayer,
        centrallocking,
        crashsensor,
        leatherseats,
id
    ) VALUES (
        '$VehiclesTitle',
        '$VehiclesBrand',
        '$vehiclesoverview',
        '$priceperday',
        '$fueltype',
        '$seatingcapacity',
        '$airconditioner',
        '$powerdoorlocks',
        '$antilockbrakingsystem',
        '$brakeassist',
        '$powersteering',
        '$driverairbag',
        '$passengerairbag',
        '$powerwindows',
        '$cdplayer',
        '$centrallocking',
        '$crashsensor',
        '$leatherseats',
'$id'
    )";

$insertResult = pg_query($conn, $insertQuery);

if ($insertResult) {
echo "New vehicle details inserted successfully!";
} else {
echo "Error inserting new vehicle details: " . pg_last_error($conn);
}
}
?>


    </div>
</body>
</html>
