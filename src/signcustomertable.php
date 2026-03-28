<?php

include "connection.php";

// SQL query to create a table with the specified columns if it doesn't already exist
$sql = "CREATE TABLE  signincustomer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    cpass VARCHAR(255) NOT NULL
)";

if ($connection->query($sql) === TRUE) {
    echo "<br>Table created successfully";
} else {
    echo "Table not created: " . $connection->error;
}

?>