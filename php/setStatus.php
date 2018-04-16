<?php

require 'header.php';
session_start();

$status = $_POST['status'];
$user = $_SESSION['username'];


$result = $mysqli->query("UPDATE system SET status = '$status' WHERE id=1");


$userID = $_SESSION['id'];

$mysqli->query("INSERT INTO logs (status, user_id, system_id) VALUES('$status', '$userID', 1)");

echo "test";


?>