<?php
$host = "localhost";
$port = "5432";
$dbname = "carrental";
$user = "postgres";
$password = "postgres";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST['email'];
    $feedback = pg_escape_string($conn, $_POST['feedback']);

    $query = "INSERT INTO tbltestimonial (useremail, testimonial) VALUES ($1, $2)";
    $params = array($useremail, $feedback);

    $result = pg_query_params($conn, $query, $params);

    if ($result) {
        header("Location: home.php");
        exit();
    } else {
        echo '<script>alert("Error submitting feedback: ' . pg_last_error($conn) . '");</script>';
        exit();
    }
}

pg_close($conn);
?>
