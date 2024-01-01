<?php
$host = "localhost";
$port = "5432";
$dbname = "carrental";
$user = "postgres";
$password = "postgres";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contact_number'];
    $message = $_POST['message'];

    $query = "INSERT INTO tblcontactusquery (name, emailId, contactnumber, message) VALUES ($1, $2, $3, $4)";
     $params = array($name, $email, $contactNumber, $message);

    $result = pg_query_params($conn, $query,  $params );

    if ($result) {
        echo '<script>alert("query sent !!!");</script>';
        header("Location: contact.php");
        exit();
    } else {echo '<script>alert("Fail !!!");</script>';
        
        header("Location: contact.php");
        exit();
    }
}

pg_close($conn);
?>
