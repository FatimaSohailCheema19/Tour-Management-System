<?php
include 'connection.php';

// Fetch form data
$country = $_REQUEST['country'];
$city = $_REQUEST['city'];
$transport = $_REQUEST['transport'];
$duration = $_REQUEST['duration'];
$language = $_REQUEST['languages'];
$price = $_REQUEST['price'];

// Prepare and execute the INSERT statement
$stmt = $connection->prepare("INSERT INTO managetour (country, city, transport, duration, languages, price) VALUES (?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die('Error in prepare statement: ' . $connection->error);
}

// Bind parameters and execute the statement
$stmt->bind_param("ssssss", $country, $city, $transport, $duration, $language, $price);

if ($stmt->execute()) {
    echo "Data Inserted";
} else {
    echo "Error inserting data: " . $stmt->error;
}

$stmt->close();

// Prepare and execute the SELECT statement
$selectStmt = $connection->prepare("SELECT * FROM managetour");

if ($selectStmt === false) {
    die('Error in prepare statement: ' . $connection->error);
}

$selectStmt->execute();
$result = $selectStmt->get_result();
$selectStmt->close();

// Close the database connection after fetching results
$connection->close();
?>

<html>
<head>
    <link rel="stylesheet" href="styleinsert.css">
</head>
<body>
    <div class="main">
        <div class="nav">
            <ul class="ul" style="display: block;">
                <li class="li-logo"><img src="logo1.png" alt="" height="70vh" width="75vh"></li>
                <li class="li-login"><a href="login.html"><img src="login-icon.png" alt="Login" height="40vh" width="40vh" style="float: right; margin-top: 15px; margin-right: 20px;"></a></li>
                <li class="li"><a href="contact.html" style="margin-right: 400px;">Contact</a></li>
                <li class="li"><a href="blog.html">Blog</a></li>
                <li class="li"><a href="tour.html">Tour</a></li>
                <li class="li"><a href="home.html">Home</a></li>
            </ul>
        </div>
        <img src="1.webp" alt="" width="100%" height="800px">
    </div>
    
    <div class="textblock2">
        <h2>Managing Tour Package Details</h2>
        <?php 
        if ($result->num_rows > 0) {
            echo "<table border='2'>
            <tr>
                <th>ID</th>
                <th>Country</th>
                <th>City</th>
                <th>Transport</th>
                <th>Duration</th>
                <th>Language</th>
                <th>Price</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . ($row['id']) . "</td>
                <td>" . ($row['country']) . "</td>
                <td>" . ($row['city']) . "</td>
                <td>" . ($row['transport']) . "</td>
                <td>" . ($row['duration']) . "</td>
                <td>" . ($row['languages']) . "</td>
                <td>" . ($row['price']) . "</td>
                </tr>";
            }
            echo "</table>";

            echo '<div class="button-container">';
            echo '<button><a href="mtourupdate.html">Update</a></button>';
            echo '<button><a href="mtourdelete.html">Delete</a></button>';
            
            echo '</div>';

        } else {
            echo "No results found.";
        }
        ?>
    </div>
</body>
</html>