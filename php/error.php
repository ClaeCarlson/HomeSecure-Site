<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <?php include '../css/css.html'; ?>
</head>
<body style="background-color: #eee; text-align: center; margin-top: 20px;">
<div class="frametext">
    <h1 class="frametext" style="color: #294859; font-size: 50px; margin-bottom: 0;">Something went wrong</h1>
    <img height="500" width="350" src="../img/error.png">
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
    {
        echo $_SESSION['message'];  
        unset( $_SESSION['message'] );
    }
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>     
    <a href="../index.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
