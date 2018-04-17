<?php
	sleep(60);
	$host = 'localhost';
	$user = 'homesecure';
	$pass = 'aurora';
	$db = 'homesecure';
  	$mysqli = mysqli_connect($host, $user, $pass, $db) or die($mysqli->error);

  	if ($mysqli->connect_error) {
  		die("Failed:" . $conn->connection_error);
  	}
  	$url = "http://172.19.20.41:8123/api/states?api_password=aurorahome";
  	$lastdoor1 = "";
	$lastdoor2 = "";
	$laststatus = "";
	$sendMessage1 = 0;
	$sendMessage2 = 0;
	$sendMessageSmoke = 0;
	$sendMessageCO = 0;
	$insertCO = 0;
	$insertSmoke = 0;


  	while (true)
  	{

  		sleep(2);
  		$result = $mysqli->query("SELECT status FROM system WHERE id=1");
		$status = $result->fetch_assoc();
		$usersQ = $mysqli->query("SELECT email FROM users");
		$useremails = array();
		while($emails = $usersQ->fetch_assoc())
		{
			array_push($useremails, $emails['email']);
		}
		$message = "";
		$subject = "";

		$json = file_get_contents($url);
		$data = json_decode($json);
		$length  = count($data);
		for ($i = 0; $i < $length; $i++)//Logging for Door2
		{
			if ($data[$i]->entity_id == 'binary_sensor.sensor')//check if it is correct door by entity.
			{
				if(($data[$i]->state) != $lastdoor2)//Check if last door state equals current door state
				{
					$lastdoor2 = $data[$i]->state;
					if ($lastdoor2 === "off")
					{
						$lastdoor2 = 0;
						$mysqli->query("INSERT INTO logs (status, sensors_id, system_id) VALUES('$lastdoor2', 3, 1)");
						$lastdoor2 = "off";
					}
					elseif($lastdoor2 === "on")
					{
						$lastdoor2 = 1;
						$mysqli->query("INSERT INTO logs (status, sensors_id, system_id) VALUES('$lastdoor2', 3, 1)");
						$lastdoor2 = "on";
					}
				}
			}
		}
		for ($i = 0; $i < $length; $i++) //Logging for Door1
		{
			if ($data[$i]->entity_id == 'binary_sensor.zwaveme_zuno_sensor_24')//check if it is correct door by entity.
			{
				if(($data[$i]->state) != $lastdoor1)//Check if last door state equals current door state
				{
					$lastdoor1 = $data[$i]->state;
					if ($lastdoor1 === "off")//If statement to check if last door state equals string value. 
					{
						$lastdoor1 = 0;//Set lastdoor1 to int for DB
						$mysqli->query("INSERT INTO logs (status, sensors_id, system_id) VALUES('$lastdoor1', 2, 1)"); 
						$lastdoor1 = "off";//Change back to string to check for last value
					}
					elseif($lastdoor1 === "on")
					{
						$lastdoor1 = 1;
						$mysqli->query("INSERT INTO logs (status, sensors_id, system_id) VALUES('$lastdoor1', 2, 1)");
						$lastdoor1 = "on";
					}
				}
			}
		}
		if ($status['status'] == 0)
		{
			echo "system is disarmed";
			if ($laststatus == 1)
			{
				$sendMessage1 = 0;
				$sendMessage2 = 0;
				$sendMessageSmoke = 0;
				$sendMessageCO = 0;
				$laststatus = 0;
			}
			//continue;
		}
		else 
		{
			$laststatus = 1;
			for ($i = 0; $i < $length; $i++)
			{
				if ($data[$i]->entity_id == "binary_sensor.zwaveme_zuno_sensor_24") 
				{
					if ((($data[$i]->state) == "on" && $sendMessage1 == 0) || $sendMessage1 == 1)//Checks to make sure the sensor is actiaved and that the message has gone through only max twice
					{
						if ($sendMessage1 == 0)
							exec('sudo python /var/www/html/python/DoorSound.py');
						$message = "Possible intrusion! Door 1 was opened while system was armed!";
						$sendMessage1++;
						$subject = "INTRUSION";
						echo "door1";
						echo $sendMessage1;
					}
				}
				if ($data[$i]->entity_id == "binary_sensor.sensor") 
				{
					if ((($data[$i]->state) == "on" && $sendMessage2 == 0) || $sendMessage2 == 1)//Checks to make sure the sensor is actiaved and that the message has gone through only max twice
					{
						if ($sendMessage2 == 0)
							exec('sudo python /var/www/html/python/DoorSound.py');
						$message = "Possible intrusion! Door 2 was opened while system was armed!";
						$sendMessage2++;
						$subject = "INTRUSION";
						echo "door2";
						echo $sendMessage2;
					}
				}
			}
  		
  		}
  		for ($i = 0; $i < $length; $i++) 
		{
			if ($data[$i]->entity_id == "binary_sensor.zwaveme_zuno_sensor_25") 
			{
				if ((($data[$i]->state) == "on" && $sendMessageSmoke == 0) || $sendMessageSmoke == 1)//Checks to make sure the sensor is actiaved and that the message has gone through only max twice
				{
					if ($sendMessageSmoke == 0)
					{
						$mysqli->query("INSERT INTO logs (status, sensors_id, system_id) VALUES(1, 5, 1)");
						exec('sudo python /var/www/html/python/SmokeSound.py'); 
					}
					$message = "Smoke detected!";
					$sendMessageSmoke++;
					$subject = "Smoke Alarm";
					echo "smoke";
					echo $sendMessageSmoke;
				}
				elseif (($data[$i]->state) == "off" && $sendMessageSmoke != 0 && $insertSmoke == 0) 
				{
					$mysqli->query("INSERT INTO logs (status, sensors_id, system_id) VALUES(0, 5, 1)");
					$insertSmoke++;
				}

			}
			if ($data[$i]->entity_id == "binary_sensor.sensor_24") 
			{
				if ((($data[$i]->state) == "on" && $sendMessageCO == 0) || $sendMessageCO == 1)//Checks to make sure the sensor is actiaved and that the message has gone through only max twice
				{
					if ($sendMessageCO == 0)
					{
						$mysqli->query("INSERT INTO logs (status, sensors_id, system_id) VALUES(1, 6, 1)"); 
						exec('sudo python /var/www/html/python/SmokeSound.py');
					}
					$message = "Carbon Monoxide detected!";
					$sendMessageCO++;
					$subject = "CO Alarm";
					echo "CO";
					echo $sendMessageCO;
					
				}
				elseif (($data[$i]->state) == "off" && $sendMessageCO != 0 && $insertCO == 0) 
				{
					$mysqli->query("INSERT INTO logs (status, sensors_id, system_id) VALUES(0, 6, 1)");
					$insertCO++;
				}
			}
		}

		if ($sendMessage1 == 1 or $sendMessage2 == 1 or $sendMessageCO == 1 or $sendMessageSmoke == 1) //This makes sure the user is only sent one email for each sensor activated instead of a user getting an email for each loop. 
		{
			for ($i = 0; $i < count($useremails); $i++)
			{
				echo $useremails[$i];
				$to = $useremails[$i];
				mail( $to, $subject, $message );
				echo "Email SEnt";


			}
			sleep(15);
		}
  	}
 ?>