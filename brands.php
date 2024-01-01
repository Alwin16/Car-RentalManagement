


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands Page</title>
    <style>
       

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
            margin-left: 200px; 
            
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

    
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('bg.jpg'); 
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-color: rgba(255, 255, 255, 0.8);
}

        

        #content {
        text-align: center;
    }

    #content button {
        display: block;
        margin: 10px auto; 
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
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('bg.jpg'); 
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-color: rgba(255, 255, 255, 0.8); 
}


    #sidebar {
        width: 200px;
        height: 100%;
        background-color:red;
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

    button {
        width: 150px; 
        padding: 15px;
        margin: 10px;
        background-color: #3498db; 
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #2980b9;
    }

        #addFormContainer {
        margin: 20px 0;
        background-color: rgba(255, 255, 255, 1); 
            border-radius: 10px;
            padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: flex-start; 
    opacity: 10.0;
}

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

    $query = "SELECT * FROM tblbrands";
    $result = pg_query($conn, $query);

    if ($result) {
        if (pg_num_rows($result) > 0) {
            echo "<h2>Brands:</h2>";
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
    <div id="addFormContainer">
        <h2>Add New Brand</h2>
        <form id="addForm" method="post" action="">
            <label for="brand_name">Brand Name:</label>
            <input type="text" id="brand_name" name="brand_name" required>

            

            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required>

            <button type="submit">Add Brand</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $brandName = $_POST['brand_name'];
        
        $id = $_POST['id'];


        $insertQuery = "INSERT INTO tblbrands (brandname,  id) VALUES ('$brandName',  '$id')";
        $insertResult = pg_query($conn, $insertQuery);

        if ($insertResult) {
            echo "<script>alert('Brand added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding brand: " . pg_last_error($conn) . "');</script>";
        }
    }
    ?>
</body>

</html>

