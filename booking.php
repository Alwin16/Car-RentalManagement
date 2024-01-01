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
//echo $useremail;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['carId'])) {
    $carId = $_POST['carId'];

    $_SESSION['carId'] = $carId;
} elseif (isset($_SESSION['carId'])) {
    $carId = $_SESSION['carId'];

} else {
    echo "No car ID found";
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   
</head>
<style>

        body {
    font-family: Arial, sans-serif;
    background-image: url('carrental.jpg');
    background-size: cover; 
    background-position: center;
    background-repeat: no-repeat; 
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

h2 {
    color: #333;
    text-align: center;
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    color: #333;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

p {
    text-align: center;
    color: #333;
}

p.total-price {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    text-align: center;
    margin-top: 20px;
}

form.confirm-booking {
    text-align: center;
}

form.confirm-booking button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

form.confirm-booking button:hover {
    background-color: #2980b9;
}
div.confirm-details {
    background-color: #ecf0f1;
    padding: 10px;
    margin-top: 10px;
    text-align: center;
}

div.confirm-details p {
    margin: 5px 0;
    font-size: 14px;
    color: #333;
}
.confirmation-container {
    background-color: #ecf0f1;
    padding: 15px;
    margin-top: 15px;
    text-align: center;
    border-radius: 8px;
}

.confirmation-container p {
    margin: 8px 0;
    font-size: 16px;
    color: #333;
}

.confirm-button {
    background-color: #3498db;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.confirmation-container {
    margin-bottom: 20px;
}

form {
    width: 80%; 
    max-width: 800px; 
    margin: auto;
    padding: 40px;
    background-color: #fff;
    border-radius: 12px; 
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

label {
    font-size: 16px; 
}

input,
textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    box-sizing: border-box;
}
/* style.css */

body {
    font-family: Arial, sans-serif;
    background-image: url('carrental.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column; 
}


nav {
    background-color: #333;
    margin-top: 10px;
    width: 100%; 
    padding: 35px;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center; 
}

nav ul li {
    display: inline;
    margin-left: 30px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    padding: 10px 15px;
    transition: color 0.3s, background-color 0.3s;
}

nav ul li a:hover {
    color: #ffcc00;
    background-color: #555;
}

body > div {
    margin-top: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}







</style>

        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="carlisting.php">Car List</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="#footer">About Us</a></li>
            </ul>
        </nav>
       
            </div>
<body>

<script>
        function showAlert() {
            alert("Bookin Request sent! THANK YOU");
        }
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculatePrice'])) {
   
    handleFormSubmission();
} else {
    displayBookingForm();
}

function displayBookingForm() {
    echo '
    <form method="post">
        <label for="fromDate">From Date:</label>
        <input type="date" id="fromDate" name="fromDate" required>
        <label for="toDate">To Date:</label>
        <input type="date" id="toDate" name="toDate" required>
        <label for="message">Your message here:</label>
        <textarea id="message" name="message" required></textarea><br ><br>
        <button type="submit" name="calculatePrice">Calculate Total Price</button>
        
        
    </form>';
}

function handleFormSubmission() {
    global $carId;
    global $useremail;
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $message=$_POST['message'];

    if (!validateDates($fromDate, $toDate)) {
        echo "Invalid dates. Please enter valid date ranges.";
        return;
    }

    $totalPrice = calculateTotalPrice($fromDate, $toDate, $carId);
    
    updateBookingTable($useremail, $carId, $fromDate, $toDate, $totalPrice, $message);

  
  

    echo '<form method="post" class="confirmation-container">
              <input type="hidden" name="fromDate" value="' . $fromDate . '">
              <input type="hidden" name="toDate" value="' . $toDate . '">
              <input type="hidden" name="totalPrice" value="' . $totalPrice . '">
              <input type="hidden" name="carId" value="' . $carId . '">
              <p>From date: ' . $fromDate . '</p>
              <p>To date: ' . $toDate . '</p>
              <p>Total Price: $' . $totalPrice . '</p>
              <button type="submit" onclick="showAlert()" name="confirmBooking">Confirm Booking</button>
          </form>';
}



function validateDates($fromDate, $toDate) {
    return strtotime($fromDate) < strtotime($toDate);
}

function calculateTotalPrice($fromDate, $toDate, $carId) {
    $carId = (int)$carId;
    $host = "localhost";
    $port = "5432";
    $dbname = "carrental";
    $user = "postgres";
    $password = "postgres";

    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    if (!$conn) {
        return "Error: Unable to connect to the database.";
    }

    $query = "SELECT priceperday FROM tblvehicles WHERE id = $carId";
    $result = pg_query($conn, $query);

    if ($result) {
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            $basePricePerDay = $row['priceperday'];

            $fromDateTime = new DateTime($fromDate);
            $toDateTime = new DateTime($toDate);
            $interval = $fromDateTime->diff($toDateTime);
            $numberOfDays = $interval->days;

            $totalPrice = $numberOfDays * $basePricePerDay;

            pg_close($conn);

            return $totalPrice;
        } else {
            return "Error: Vehicle ID not found in the database.";
        }
    } else {
        $errorDetails = pg_last_error($conn);
        return "Error: $errorDetails";
    }
}

        function confirmBooking() {
            return confirm("Are you sure you want to confirm the booking?");
        }


function updateBookingTable($useremail, $carId, $fromDate, $toDate, $totalPrice, $message) {
    $carId = (int)$carId;
    $host = "localhost";
    $port = "5432";
    $dbname = "carrental";
    $user = "postgres";
    $password = "postgres";

    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    if (!$conn) {
        echo "Error: Unable to connect to the database.";
        return;
    }

    $query = "INSERT INTO tblbooking (useremail, vehicleid, fromdate, todate, totalprice,message) VALUES ($1, $2, $3, $4, $5,$6)";
    $params = array($useremail, $carId, $fromDate, $toDate, $totalPrice,$message);
    $result = pg_query_params($conn, $query, $params);

    if (!$result) {
        echo "Error: " . pg_last_error($conn);
    }
    else{
        
    }
    pg_close($conn);
}





?>
</body>
</html>
