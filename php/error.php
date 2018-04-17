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
<body style="background-color: #294859; text-align: center; margin-top: 100px;">
<div class="frametext">
    <h1 class="frametext" style="color: white">Error</h1>
    <img src="../img/error.png">
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
    {
        echo $_SESSION['message'];  
        unset( $_SESSION['message'] );
    }
    else:
        //header( "location: index.php" );
    endif;
    ?>
    </p>     
    <a href="../index.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
