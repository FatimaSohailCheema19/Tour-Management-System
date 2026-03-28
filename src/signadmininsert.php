<?php
include 'connection.php';

// Fetch form data
$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$apass = $_REQUEST['apass'];

// Check if an Admin already exists
$checkQuery = $connection->prepare("SELECT * FROM signinadmin");
$checkQuery->execute();
$result = $checkQuery->get_result();

if ($result->num_rows > 0) {
    // Admin already exists
    echo "An Admin account already exists. Only one admin can be registered.";
} else {
    // Proceed with the registration
    $stmt = $connection->prepare("INSERT INTO signinadmin (username, email, apass) VALUES (?, ?, ?)");
    
    if ($stmt === false) {
        die('Error in prepare statement: ' . $connection->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sss", $username, $email, $apass);
    
    if ($stmt->execute()) {
        echo "Admin account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

    // Re-execute the SELECT query to get the updated list of admins
    $checkQuery->execute();
    $result = $checkQuery->get_result();
}

$checkQuery->close();
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
        <h2>Admin Login Details</h2>
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
                <td>" . $row['apass'] . "</td>
                
                </tr>";
            }
            echo "</table>";

            echo '<div class="button-container">';
            echo '<button class="signadminupdate.html"><a href="signadminupdate.html">Update</a></button>';
            echo '<button class="signadmindelete"><a href="signadmindelete.html">Delete</a></button>';
            echo '<button><a href="admin.html">Next</a></button>';
            echo '</div>';

        } else {
            echo "No result found.";
        }

        // Close the database connection
        $connection->close();
        ?>
    </div>
</body>
</html>