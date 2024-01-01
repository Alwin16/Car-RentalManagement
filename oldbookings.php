
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
            background-image: url('recnt-car-6.jpg'); 
            background-size: cover;
            background-attachment: fixed;
            opacity: 1;
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

        

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #sidebar {
    width: 200px;
    height: 100%;
    background-color: red; /* This line sets the background color to red */
    position: fixed;
    left: 0;
    top: 0;
    overflow-x: hidden;
    padding-top: 20px;
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

        /* Styles for the form container */
        #addFormContainer {
            margin: 20px 0;
            background-color: rgba(255, 255, 255, 1); /* Adjust the opacity of the form container */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align the form to the left */
            opacity: 10.0; /* Adjust the opacity of the form */
        }

        /* Styles for the form */
        #addForm label {
            display: block;
            margin-bottom: 10px;
        }

        #addForm input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        #addForm button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #addForm button:hover {
            background-color: #45a049;
        }

        #a{
            font-size:10px;
            text-align:bottom;
        }
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('bg.jpg'); /* Replace 'your-background-image.jpg' with your actual image file */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-color: rgba(255, 255, 255, 0.8); /* Adjust the last parameter (0.8) for the desired opacity (0 to 1) */
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

    <?php
    // Retrieve contents of the brands table and display them
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

    // Query to retrieve all columns and rows from the brands table
    $query = "SELECT * FROM tblbooking";
    $result = pg_query($conn, $query);

    if ($result) {
        // Check if there are rows in the result
        if (pg_num_rows($result) > 0) {
            echo "<h2>Booking:</h2>";
            echo "<table border='1'>";
            // Display column header
            echo "<tr>";
            $row = pg_fetch_assoc($result);
            foreach ($row as $key => $value) {
               echo "<th style='background-color:#4caf50;'>$key</th>";
            }
            // Additional columns for confirm and cancel buttons
            echo "<th style='background-color:#4caf50;'>Confirm</th>";
            echo "<th style='background-color:#4caf50;'>Cancel</th>";
            echo "</tr>";

            // Display data rows with confirm and cancel buttons
            pg_result_seek($result, 0); // Reset result set pointer to the beginning
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                // Confirm and cancel buttons
                echo "<td><button onclick=\"confirmAction('$row[id]', this, this.parentNode.children[4])\">Confirm</button></td>";
                echo "<td><button onclick=\"cancelAction('$row[id]', this.parentNode.parentNode)\">Cancel</button></td>";
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
    
    

    

    <script>
        // JavaScript function to handle confirm action
        function confirmAction(id, confirmButton, cancelButton) {
            // You can implement the logic to confirm the action (e.g., update status in the database)
            // For demonstration, let's show a tick mark and hide the buttons
            alert("Confirm action for ID: " + id);

            // Example: Update UI to show a tick mark
            confirmButton.innerHTML = '&#10004;'; // Checkmark symbol
            
            cancelButton.style.display = 'none';
        }

        // JavaScript function to handle cancel action
        function cancelAction(id, row) {
            // You can implement the logic to cancel the action (e.g., delete row from the database)
            if (confirm("Are you sure you want to cancel?")) {
                // Send an AJAX request to delete the row from the database
                // Update the table in the callback to remove the row from the UI

                // Example: Delete the row from the UI
                
                var firstFieldValue = row.cells[0].innerHTML; // Assuming the first cell has the desired value
                row.remove();


                
                                // Now you can use the variable firstFieldValue as needed
                
                
                // JavaScript code on the same page
        

// Create a form and an input field dynamically
var form = document.createElement("form");
form.method = "post";
form.action = "";

var hiddenInput = document.createElement("input");
hiddenInput.type = "hidden";
hiddenInput.name = "phpVariable";
hiddenInput.value = firstFieldValue;

// Append the input field to the form
form.appendChild(hiddenInput);

// Append the form to the body
document.body.appendChild(form);

// Submit the form
form.submit();

                // Example: Send an AJAX request to delete the row from the database
                // Adjust the URL and parameters based on your backend implementation
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "delete_row.php?id=" + id, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response from the server if needed
                        alert("Row deleted from the database");
                    }
                };
                xhr.send();
            }
        }
    </script>
    <?php
    // Your PHP code to retrieve data and connect to the database
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

    // Query to retrieve all columns and rows from the brands table
    



// PHP code on the same page

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Access the value sent from JavaScript
    $phpVariable = $_POST["phpVariable"];

    // Use prepared statement to delete the row based on email
    $query = "DELETE FROM tblbooking WHERE useremail = $1";
    $result = pg_prepare($conn, "", $query); // Prepare the statement
    $result = pg_execute($conn, "", array($phpVariable)); // Execute the statement with parameter
}
?>
</body>
</html>
