<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $username ?></title>
  <?php include '../css/css.html'; ?>
  <style type="text/css">
    button {
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
}
  </style>
</head>

<body style="background-image: url('../img/sky.png')">
  <div style="text-align: center; margin-top: 200px; color: white">

          <h1>Welcome, <?php echo $username; ?></h1>
          
          <p>
          <?php 
     
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
          
          ?>
          </p>
          
          <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }
          else {
            echo '<div class="info">
            Account is verified<br>Redirecting to home page in 5s</div>';

           echo '<script type="text/javascript">
                  setTimeout(function(){
                  window.location="../index.php"
                  }, 5000);
                  </script>';
          }
          
          ?>
          
          <p><?= $email ?></p>
          
          <a href="logout.php"><button style="border-radius: 5px;" name="logout"/>Log Out</button></a>
          <a href="../index.php"><button/>Home</button></a>

    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
