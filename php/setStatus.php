<?php

require 'header.php';
session_start();

$status = $_POST['status'];
$user = $_SESSION['username'];


$result = $mysqli->query("UPDATE system SET status = '$status' WHERE id=1");


$userID = $_SESSION['id'];

$sql = "INSERT INTO logs (status, users_id, system_id) VALUES('$status', '$userID', 1)";

if ($mysqli->query($sql) == TRUE) {
} else {
	echo "Error: " . $mysqli->error;
}


?>