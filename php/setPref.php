<?php

require 'header.php';

session_start();

$theme = $_POST['theme'];
$themeString = "";

$id = $_SESSION['id'];

switch ($theme) {
	case 1:
		$themeString = "Default";
		break;
	case 2:
		$themeString = "Night";
		break;
	case 3:
		$themeString = "Leaf Green";
		break;
	
	default:
		# code...
		break;
}



$result = $mysqli->query("SELECT * FROM preferences WHERE users_id='$id'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $sql = "UPDATE preferences SET theme = '$theme' WHERE users_id='$id'";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['message'] =
                
                 "Saved preferences successfully!";

        echo '<script type="text/javascript"> window.top.location.reload(); </script>';

    }

    else {
        $_SESSION['message'] = 'Saving preferences failed!' . $sql . " and " . $mysqli->error;
        header("location: error.php");
    }
    
}

else {
	$sql = "INSERT INTO preferences (theme, notifications, users_id) " 
            . "VALUES ('$theme', '0', '$id')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['message'] =
                
                 "Saved preferences successfully!";

        echo '<script type="text/javascript"> window.top.location.reload(); </script>';
        //header("location: profile.php"); 

    }

    else {
        $_SESSION['message'] = 'Saving preferences failed!' . $sql . " and " . $mysqli->error . "USER ID = " . $id;
        header("location: error.php");
    }
}


?>