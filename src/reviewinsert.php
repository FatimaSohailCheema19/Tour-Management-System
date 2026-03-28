<?php
include 'connection.php';

// Fetch form data
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$tour = $_REQUEST['tour'];
$rating = $_REQUEST['rating'];
$comments = $_REQUEST['comments'];

// Prepare and execute the INSERT statement
$stmt = $connection->prepare("INSERT INTO review (name, email, tour, rating, comments) VALUES (?, ?, ?, ?, ?)");

if ($stmt === false) {
    die('Error in prepare statement: ' . $connection->error);
}

// Bind parameters and execute the statement
$stmt->bind_param("sssis", $name, $email, $tour, $rating, $comments);

if ($stmt->execute()) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error inserting data: " . $stmt->error;
}

$stmt->close();

// Prepare and execute the SELECT statement
$selectStmt = $connection->prepare("SELECT * FROM review");

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
    <div class="nav">
        <ul class="ul">
            <li class="li-logo"><img src="logo1.png" alt="" height="70vh" width="75vh"></li>
            <li class="li"><a href="contact.html">Contact</a></li>
            <li class="li"><a href="blog.html">Blog</a></li>
            <li class="li"><a href="tour.html">Tour</a></li>
            <li class="li"><a href="home.html">Home</a></li>
        </ul>
    </div>

    <div class="pic">
        <img src="1.webp" alt="" width="100%" height="800px">
        
      
    </div>

    <div class="textblock2">
        <h2>Feedback Details</h2>
        <?php 
        if ($result->num_rows > 0) {
            echo "<table border='2'>
            <tr>
              
                <th>Name</th>
                <th>Email</th>
                <th>Tour</th>
                <th>Rating</th>
                <th>Comments</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
               
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['tour']) . "</td>
                <td>" . htmlspecialchars($row['rating']) . "</td>
                <td>" . htmlspecialchars($row['comments']) . "</td>
                </tr>";
            }
            echo "</table>";

        } else {
            echo "No feedback found.";
        }
        ?>
    </div>

   

</body>
</html>