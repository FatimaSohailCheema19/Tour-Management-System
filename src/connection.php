<?php
$servername = 'localhost';
$username = 'root';
$pass ='';
$database ='tour management system';
$connection = mysqli_connect($servername,$username,$pass,$database);
if ($connection) {
	echo "Connected to DataBase<br>";
}


?>