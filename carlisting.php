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
  <link rel="stylesheet" href="carlisting.css">
    <title>Car List</title>
</head>
<body>
<style>

body{
    background-image:url("bgg.jpg");
    background-size: cover; 
            background-position: center; 
            background-repeat: repeat;
            margin: 0; 
            height: 100vh;
}
header {
        
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }


.logo img{
    width:100%;
    height: auto;
}
h1 {
        text-align: center;
        color: white;
        margin: 0;
    }
</style>


        
        

 

    <header>
    <div class="logo">
            <img src="logo.png" alt="Your Car Rental Logo">
        </div>
        <h1>Vehicle Hire</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="carlisting.php">Car List</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
        <div class="search-bar">
         
        </div>
    </header>

    <main>
        <h2>Car List</h2>
        
        <div class="car-grid">
     
            <?php foreach ($cars as $car): ?>
                <div class="car-box">
                <?php
$vehicleTitle = $car['vehiclestitle']; 
?>


                    <h2><?php echo $car['vehiclestitle']; ?></h2>
                    <p><?php echo $car['vehiclesoverview']; ?></p>
                    <button onclick="getDetails(<?php echo $car['id']; ?>, this)">Get Details</button>
                    <div class="expanded-details">

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

    
</div>

                        <p>Price Per Day: <?php echo $car['priceperday']; ?></p>
                        <p>Fuel Type: <?php echo $car['fueltype']; ?></p>
                        <p>Model Year: <?php echo $car['modelyear']; ?></p>
                        <form method="post" action="booking.php">
                        <input type="hidden" name="carId" value="<?php echo $car['id']; ?>">
                    <button type="submit">Book Now</button></form>
                       


                    </div>
                </div>
            <?php endforeach; ?>

     
        </div>
    </main>

    <footer>
    </footer>
   <style>
    font-family: Arial, sans-serif;

    body {
    font-family: 'Arial', sans-serif;
    margin-left: 1000px;
    padding: 0100px;
}

header {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo img {
    max-height: 50px;
}

nav ul {
    list-style-type: none;
    display: flex;
    gap: 20px;
}

nav a {
    text-decoration: none;
    color: #fff;
}

.search-bar {
    display: flex;
    gap: 10px;
}


main {
    padding: 20px;
    text-align: center;
}

h1 {
    text-align: center;
}
.center-div {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.car-grid {
    .car-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-left:1000px  ; 
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

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
</style>

   

    <script>
   function getDetails(carId, button) {
    const expandedDetails = button.parentElement.querySelector('.expanded-details');

    if (expandedDetails.style.display === 'block') {
        expandedDetails.style.display = 'none';
    } else {
        expandedDetails.style.display = 'block';

        if (!expandedDetails.dataset.loaded) {
            fetch('carList.php?carId=' + carId)
                .then(response => response.json())
                .then(data => {
                    for (const key in data.details) {
                        const detailElement = document.createElement('p');
                        detailElement.innerHTML = `${key}: ${data.details[key]}`;
                        expandedDetails.appendChild(detailElement);
                    }

                    const bookButton = document.createElement('button');
                    bookButton.innerHTML = 'Book';
                    bookButton.onclick = function () {
                        redirectToBooking(carId);
                    };
                    expandedDetails.appendChild(bookButton);

                    expandedDetails.dataset.loaded = 'true';
                })
                .catch(error => console.error('Error:', error));
        }
    }
}

function redirectToBooking(vehicleId) {
    console.log('Redirecting to booking.php with Vehicle ID: ' + vehicleId);
    window.location.href = 'booking.php?vehicleId=' + vehicleId;
}

    function openBookingBox(carId) {
    window.location.href = 'booking.php?carId=' + carId;
}
</script>


</script>



</body>
</html>