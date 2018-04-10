<?php

require 'header.php';

$status = $_POST['status'];

$result = $mysqli->query("UPDATE system SET status = '$status' WHERE id=1");


?>