<?php

require 'header.php';

$result = $mysqli->query("SELECT status FROM system WHERE id=1");

$status = $result->fetch_assoc();

if ($status['status'] == 0)
	echo "DISARMED";
else
	echo "ARMED";


?>