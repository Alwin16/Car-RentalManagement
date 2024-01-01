<?php
$host = "localhost";
$port = "5432";
$dbname = "carrental";
$user = "postgres";
$password = "postgres";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "Failed to connect to the database";
    exit;
}
session_start();
$useremail = $_SESSION['useremail'];

if (isset($_GET['carId'])) {
    $carId = $_GET['carId'];

    $query = "SELECT * FROM tblvehicles WHERE id = $carId";
    $result = pg_query($conn, $query);
    $details = pg_fetch_assoc($result);

    // Exclude VehiclesOverview from the details
    unset($details['vehiclesoverview']);

    echo json_encode(['details' => $details]);
    exit;
}

$query = "SELECT * FROM tblvehicles";
$result = pg_query($conn, $query);
$cars = pg_fetch_all($result);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Car List</title>
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

        .search-bar {
            float: right;
            padding: 15px;
        }

        main {
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .car-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center items horizontally */
            align-items: center; /* Center items vertically */
        }

        .car-box {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 15px;
            width: 300px;
            text-align: center;
            background-color: #f7f7f7;
            border-radius: 8px;
        }

        .car-box img {
            max-width: 100%;
            height: auto;
        }

        .expanded-details {
            display: none;
            margin-top: 15px;
        }

        .expanded-details p {
            margin: 8px 0;
            font-size: 14px;
            color: #333;
        }

        .expanded-details button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

/* Add more styles as needed */


/* Add more styles as needed */

</style>
</head>
<body>

    <header>
        <div class="logo">
            <img src="your-logo.png" alt="Your Car Rental Logo">
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="carlisting.php">Car List</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="#footer">About Us</a></li>
            </ul>
        </nav>
        <div class="search-bar">
           
            
        </div>
    </header>

    <main>
        <h1>Car List</h1>
        <div class="car-grid">
            <?php foreach ($cars as $car): ?>
                <div class="car-box">
                <?php
$vehicleTitle = $car['vehiclestitle']; // Replace this with your actual variable or data
?>
//<img src="your-image-source.jpg" alt="<?php echo htmlspecialchars($vehicleTitle); ?>">

                    <h2><?php echo $car['vehiclestitle']; ?></h2>
                    <p><?php echo $car['vehiclesoverview']; ?></p>
                    <button onclick="getDetails(<?php echo $car['id']; ?>, this)">Get Details</button>
                    <div class="expanded-details">
                        <!-- Additional details will be displayed here -->

    <p>ID: <?php echo $car['id']; ?></p>
    <p>Vehicles Title: <?php echo $car['vehiclestitle']; ?></p>
    <p>Vehicles Brand: <?php echo $car['vehiclesbrand']; ?></p>
    <p>Price Per Day: <?php echo $car['priceperday']; ?></p>
    <p>Fuel Type: <?php echo $car['fueltype']; ?></p>
    <p>Model Year: <?php echo $car['modelyear']; ?></p>
    
    <p>Air Conditioner: <?php echo $car['airconditioner']; ?></p>
    <p>Power Door Locks: <?php echo $car['powerdoorlocks']; ?></p>
    <p>Anti-lock Braking System: <?php echo $car['antilockbrakingsystem']; ?></p>
    <p>Brake Assist: <?php echo $car['brakeassist']; ?></p>
    <p>Power Steering: <?php echo $car['powersteering']; ?></p>
    <p>Driver Airbag: <?php echo $car['driverairbag']; ?></p>
    <p>Passenger Airbag: <?php echo $car['passengerairbag']; ?></p>
    <p>Power Windows: <?php echo $car['powerwindows']; ?></p>
    <p>CD Player: <?php echo $car['cdplayer']; ?></p>
    <p>Central Locking: <?php echo $car['centrallocking']; ?></p>
    <p>Crash Sensor: <?php echo $car['crashsensor']; ?></p>
    <p>Leather Seats: <?php echo $car['leatherseats']; ?></p>
    <p>Registration Date: <?php echo $car['regdate']; ?></p>
    <p>Updation Date: <?php echo $car['updationdate']; ?></p>

    <!-- Add the "Book" button -->
    
</div>

                        <!-- Additional details will be displayed here -->
                        <!-- Example: -->
                        <p>Price Per Day: <?php echo $car['priceperday']; ?></p>
                        <p>Fuel Type: <?php echo $car['fueltype']; ?></p>
                        <p>Model Year: <?php echo $car['modelyear']; ?></p>
                        <!-- Add other details as needed -->
                        <form method="post" action="booking.php">
                        <input type="hidden" name="carId" value="<?php echo $car['id']; ?>">
                    <button type="submit">Book Now</button></form>
                       


                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <!-- Your footer content goes here -->
    </footer>
   

   

    <script>
    function getDetails(carId, button) {
        const expandedDetails = button.parentElement.querySelector('.expanded-details');

        // Toggle the display state
        if (expandedDetails.style.display === 'block') {
            expandedDetails.style.display = 'none';
        } else {
            expandedDetails.style.display = 'block';

            // Example using Fetch API
            fetch('carList.php?carId=' + carId)
                .then(response => response.json())
                .then(data => {
                    // Display all details in the expanded-details div
                    for (const key in data.details) {
                        expandedDetails.innerHTML += `<p>${key}: ${data.details[key]}</p>`;
                    }

                    // Add the "Book" button
                    expandedDetails.innerHTML += `<button onclick="redirectToBooking(${carId})">Book</button>`;
                })
                .catch(error => console.error('Error:', error));
        }
    }
  
    function redirectToBooking(vehicleId) {
        console.log('Redirecting to booking.php with Vehicle ID: ' + vehicleId);
        window.location.href = 'booking.php?vehicleId=' + vehicleId;
    }
    function openBookingBox(carId) {
    // Display the booking form in a modal or a custom box
    // Here, I'm just redirecting to booking.php with the carId
    window.location.href = 'booking.php?carId=' + carId;
}
</script>


</script>



</body>
</html>
