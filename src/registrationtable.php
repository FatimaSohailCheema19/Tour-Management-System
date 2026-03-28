<?php
include 'connection.php';

$sql ="Create table registration(
id INT AUTO_INCREMENT PRIMARY KEY,
name varchar (255),
email varchar (255),
phone varchar (255),
tourdate varchar (255),
participants int,
message varchar (255)


) ";
if ($connection -> query($sql) ) {
	echo "<br>Table created successfully";
}
else{
	echo "Table not created";
}


?>