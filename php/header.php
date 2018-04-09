<?php
	$host = 'localhost';
	$user = 'homesecure';
	$pass = 'aurora';
	$db = 'homesecure';
  	$mysqli = mysqli_connect($host, $user, $pass, $db) or die($mysqli->error);

  	if ($mysqli->connect_error) {
  		die("Failed:" . $conn->connection_error);
  	}
 ?>