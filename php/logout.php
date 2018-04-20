<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <script type="text/javascript">
  	setTimeout(function(){
    window.location="../index.php"
	}, 5000);
  </script>
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

<body style="background-image: url('../img/night_trees.jpg')">
    <div style="text-align: center; margin-top: 200px; color: white">
          <h1>Thanks for stopping by</h1>
              
          <p><?= 'You have been logged out!'; ?></p>
          <br>
          <p> You will be redirected to the main page in 5 seconds </p>
          
          <a href="../index.php"><button class="button button-block"/>Home</button></a>

    </div>
</body>
</html>
