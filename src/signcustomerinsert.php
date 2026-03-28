<?php
include 'connection.php';

// Fetch form data
$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$cpass = $_REQUEST['cpass'];

// Proceed with the registration
$stmt = $connection->prepare("INSERT INTO signincustomer (username, email, cpass) VALUES (?, ?, ?)");

if ($stmt === false) {
    die('Error in prepare statement: ' . $connection->error);
}

// Bind parameters and execute the statement
$stmt->bind_param("sss", $username, $email, $cpass);

if ($stmt->execute()) {
    echo "Customer account created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

// Re-execute the SELECT query to get the updated list of admins
$checkQuery = $connection->prepare("SELECT * FROM signincustomer");
$checkQuery->execute();
$result = $checkQuery->get_result();
$checkQuery->close();

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
        <h2>customer Login Details</h2>
        <?php 
        if ($result->num_rows > 0) {
            echo "<table border='2'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['username'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['cpass'] . "</td>
                </tr>";
                
                
            }
            echo "</table>";

            echo '<div class="button-container">';
            echo '<button class="signcustomerupdate.html"><a href="signcustomerupdate.html">Update</a></button>';
            echo '<button class="signcustomerdelete"><a href="signcustomerdelete.html">Delete</a></button>';
            echo '<button><a href="home.html">Next</a></button>';
            echo '</div>';

        } else {
            echo "No result found.";
        }
        ?>
    </div>
    </body>
</html>