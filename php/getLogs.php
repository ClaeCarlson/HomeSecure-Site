<?php

require 'header.php';

$result = $mysqli->query("SELECT * FROM logs ORDER BY time DESC");


echo '<tr><th>Status</th><th>Time</th><th>Sensor</th><th>User</th></tr>';

while($row = $result->fetch_assoc()){

    $time = $row['time'];
    $status = $row['status'];
    $uid = $row['users_id'];
    $sensor = $row['sensors_id'];

    $message = "";
    $username = "";
    $sensorName = "";

    $checkArmed == 0;

    if ($sensor != NULL) {
    $sensorResult = $mysqli->query("SELECT name FROM sensors WHERE id = '$sensor'");
    $sensorName = $sensorResult->fetch_assoc();
    $sensorName = $sensorName['name'];
    }
    else {
        $sensorName = "N/A";
    }

    if ($uid != NULL) {
    $userResult = $mysqli->query("SELECT username FROM users WHERE id = '$uid'");
    $username = $userResult->fetch_assoc();
    $username = $username['username']; 
    $checkArmed = 1;

    }
    else {
        $username == "N/A";
    }


    if ($checkArmed) {
       if ($status == 1) {

            $message = "ARMED";

        }
        else {

            $message = "DISARMED";

        } 
    }
    else {
        if ($status == 1) {

            $message = "On";

        }
        else {

            $message = "Off";

        }    
    }



    

    echo '<tr><td>' . $message . '</td><td>' . $time . '</td><td>' . $sensorName . '</td><td>' . $username . '</td></tr>';

}




?>