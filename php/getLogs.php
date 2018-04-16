<?php

require 'header.php';

$result = $mysqli->query("SELECT * FROM logs ORDER BY time DESC");


echo '<tr><th>Status</th><th>Time</th><th>User</th></tr>';

while($row = $result->fetch_assoc()){

    $time = $row['time'];
    $status = $row['status'];
    $uid = $row['users_id'];

    $message = "";
    $username = "";

    $userResult = $mysqli->query("SELECT username FROM users WHERE id = '$uid'");
    $username = $userResult->fetch_assoc();
    $username = $username['username'];

    if ($status == 1) {

    	$message = "ARMED";

    }
    else {

    	$message = "DISARMED";

    }

    echo '<tr><td>' . $message . '</td><td>' . $time . '</td><td>' . $username . '</td></tr>';

}




?>