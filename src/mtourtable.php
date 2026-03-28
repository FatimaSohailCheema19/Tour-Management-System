<?php
include 'connection.php';

$sql ="Create table managetour(
id INT AUTO_INCREMENT PRIMARY KEY,
country varchar (255),
city varchar (255),
transport varchar (255),
duration varchar (255),
languages varchar (255),
price int


) ";
if ($connection -> query($sql) ) {
	echo "<br>Table created successfully";
}
else{
	echo "Table not created";
}


?>