<?php

require 'header.php';

$result = $mysqli->query("SELECT status FROM system WHERE id=1");

$status = $result->fetch_assoc();

if ($status['status'] == 0)
	echo "DISARMED <i class='fas fa-unlock', style='font-size: 50px;'></i>";
else
	echo "ARMED <i class='fas fa-lock', style='font-size: 50px;'></i>";


?>