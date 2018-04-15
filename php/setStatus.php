<?php

require 'header.php';

$status = $_POST['status'];
$user = $_SESSION['username']

$result = $mysqli->query("UPDATE system SET status = '$status' WHERE id=1");
$userResult = $mysqli->query("SELECT id FROM users WHERE username='$user'");
$mysqli->query("INSERT INTO logs (status, user_id, system_id) VALUES('$status', '$userResult', 1)");


?>