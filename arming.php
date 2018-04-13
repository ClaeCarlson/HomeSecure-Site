<?php
	$host = 'localhost';
	$user = 'homesecure';
	$pass = 'aurora';
	$db = 'homesecure';
  	$mysqli = mysqli_connect($host, $user, $pass, $db) or die($mysqli->error);

  	if ($mysqli->connect_error) {
  		die("Failed:" . $conn->connection_error);
  	}


  	//while (true){

  		//sleep(2);

  		$result = $mysqli->query("SELECT status FROM system WHERE id=1");

		$status = $result->fetch_assoc();

		if ($status['status'] == 0){
			echo "system is disarmed";
			//continue;
		}
		else {
			/*
			exec("curl -X GET -H 'x-ha-access: aurorahome' \
       -H 'Content-Type: application/json' http://localhost:8123/api/states", $output);

			print_r($output);
			*/

			$json = file_get_contents("http://172.19.20.41:8123/api/states?api_password=aurorahome");
			$data = json_decode($json);

			$length  = count($data);

			for ($i = 0; $i < $length; $i++){
			if ($data[$i]->"friendly_name" == "Z-Uno Door") {
				echo "door found";
				echo ($data[$i]->state);
			}
			}





			/*

			if a door is opened, send email
			wait 30 seconds
			continue
			*/


		}
  		
  	//}


 ?>