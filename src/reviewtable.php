<?php
include 'connection.php';

$sql ="Create table review(
name varchar (255),
email varchar (255),
tour varchar (255),
rating int (255),
comments varchar (255)


) ";
if ($connection -> query($sql) ) {
	echo "<br>Table created successfully";
}
else{
	echo "Table not created";
}


?>