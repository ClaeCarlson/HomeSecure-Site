<?php

require 'header.php';

session_start();

$id = $_SESSION['id'];

$Qresult = $mysqli->query("SELECT theme FROM preferences WHERE users_id = '$id'");

//$result = mysql_result($Qresult, 0);

$result = $Qresult->fetch_assoc();
$result = $result['theme'];




$theme = "";

switch ($result) {
	case "1":
		$theme = "default";
		break;
	case "2":
		$theme = "night";
		break;
	case "3":
		$theme = "leafgreen";
		break;
	default:
		$theme = $result;
		break;
}

echo $theme;

?>