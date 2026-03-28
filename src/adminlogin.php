<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include 'connection.php';

// Query to select the admin details from the signinAdmin table
$sql = "SELECT * FROM signinadmin WHERE id = '" . $_SESSION['admin_id'] . "'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $username = $row['username'];
    $email = $row['email'];
    $apass = $row['apass'];
} else {
    header('Location: login.php');
    exit;
}

?>

<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
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
        <h2>Admin Details</h2>
        <table border="2">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $apass; ?></td>
                <td>
                    <button><a href="edit.php?id=<?php echo $id; ?>">Edit</a></button>
                    <button><a href="delete.php?id=<?php echo $id; ?>">Delete</a></button>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>