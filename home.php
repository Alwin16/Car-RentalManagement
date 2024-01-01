<?php
$host = "localhost";
$port = "5432";


$dbname = "carrental";
$user = "postgres";
$password = "postgres";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

session_start();
$useremail = $_SESSION['useremail']; 

 $isSubscriber = false;

$queryCheckSubscriber = "SELECT COUNT(*) FROM tblsubscribers WHERE subscriberemail = '$useremail'";
$resultCheckSubscriber = pg_query($conn, $queryCheckSubscriber);

if ($resultCheckSubscriber) {
    $count = pg_fetch_row($resultCheckSubscriber)[0];
    $isSubscriber = ($count > 0);
}


?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['subscribe'])) {
        $useremail = $_SESSION['useremail']; 

        $querySubscribe = "INSERT INTO tblsubscribers (subscriberemail) VALUES ($1)";
        $paramsSubscribe = array($useremail);

        $resultSubscribe = pg_query_params($conn, $querySubscribe, $paramsSubscribe);

        if (!$resultSubscribe) {
            echo '<script>alert("Error subscribing: ' . pg_last_error($conn) . '");</script>';
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Your Car Rental</title>
   

</head>

<body>
    <style>

.logo img{
    width:10%;
    height: auto;
}

</style>

    <header>
        <div class="logo">
            <img src="logo.png" alt="Your Car Rental Logo" >
            <h1 style="text-align: center; color: white; margin: 0;">Vehicle Hire Management</h1>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="carlisting.php">Car List</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="#footer">About Us</a></li>
            </ul>
        </nav>
       
            </div>
       
            <div class="search-bar">

            <?php
            $useremail = pg_escape_string($conn, $useremail);

            $query = "SELECT fullName FROM tblusers WHERE EmailId = '$useremail'";
            $result = pg_query($conn, $query);
            
            if ($result && pg_num_rows($result) > 0) {
                $user = pg_fetch_assoc($result);
            
                $fullName = $user['fullname'];} 
                
                
                
                
                
                ?>



              
                <button onclick="window.location.href='profile.php'"><?php echo" $fullName"?></button>
                <button type="button" onclick="openLoginDialog()">Logout</button>
            </div>
        
    </header>

    <main>
    <h1>Welcome to Your Car Rental</h1>
    <p>At Your Car Rental, we strive to redefine your travel experience by offering a diverse fleet of vehicles to cater to your unique needs. Whether you're planning a weekend getaway, a family road trip, or a business journey, we have the perfect ride for you.</p>

    <h2>Why Choose Us?</h2>
    <p>1. <strong>Extensive Selection:</strong> Explore a wide range of vehicles, from compact cars to spacious SUVs and luxury models.</p>
    <p>2. <strong>Easy Booking:</strong> Our user-friendly platform allows you to quickly and securely book the vehicle of your choice.</p>
    <p>3. <strong>Quality Assurance:</strong> Each car in our fleet undergoes regular maintenance to ensure safety and reliability.</p>
    <p>4. <strong>Customer Satisfaction:</strong> We prioritize your satisfaction, aiming to make your journey as smooth as possible.</p>

    <h2>Get Started Today</h2>
    <p>Ready to embark on your next adventure? Browse our car listings, choose your ideal vehicle, and experience the freedom of the open road with Your Car Rental.</p>
</main>


    <footer id="footer">
    <div class="feedback-section">
            <h2>Leave a Feedback</h2>
            <form action="process_feedback_form.php" method="post">
               
                <input type="hidden" name="email" value="<?php echo $useremail; ?>"><br><br>
                <label for="feedback">Your Feedback:</label>
                <textarea id="feedback" name="feedback" required></textarea>

                <button type="submit">Submit Feedback</button>
            </form>
        </div>

         <?php if (!$isSubscriber): ?>
        <div class="subscribe-section">
            <h2>Subscribe to Our Newsletter</h2>
            <form action="home.php" method="post">
                <input type="hidden" name="subscribe" value="true">
                <button type="submit">Subscribe</button>
            </form>
        </div>
        <?php else: ?>
        <p>You are already subscribed!</p>
        <?php endif; ?>
       
        

        <p>&copy; 2023 Your Car Rental</p>

        <p style="color: #333; background-color: #f4f4f4; padding: 10px; border-radius: 5px;">PROJECT DONE BY: LOGESH, ALWIN</p>

       
    </footer>
   

    <script>
        function openLoginDialog() {
            window.location.href = 'index1.php';
        }

    </script>
</body>
</html>
