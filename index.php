<?php 
/* Main page with two forms: sign up and log in */
require 'php/header.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="img/favicon.png">
	<title>HomeSecure</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans" rel="stylesheet">
	<link id="css" rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/fontawesome-all.js"></script>
	<script src="js/homesecure.js"></script>
    <script>
    	// set Theme

    	// camUrl = "";

    	$(document).ready(function(){

    	$("#stage").on('load', function () { 

    		if (firstLoad){
    			select(1);
    			firstLoad = 0;
    		}

    		$("#topoverlay").hide();
    		$("#overlay").hide('slow');
    		$("#overlayContent").hide('slow');  

    		setTimeout(function(){

			var frame = document.getElementById("stage"); 
			frame.contentWindow.postMessage(themeSrc, '*'); 

    		}, 50);
    		
    	});

    	window.addEventListener('message', function(event) { 
    		if (event.data == "livecam"){
				//$("#imgBig").attr("src",$(this).prop('src'));

				$("#overlayFrame").attr('src', camUrl);
				$("#overlayFrame").attr('src', $("#overlayFrame").attr('src'));
    			$("#overlay").show('slow');
    			$("#overlayContent").show('slow');
    			$("#topoverlay").show();

    		}
    		else {
    			$("#css").attr("href", event.data);
    			themeSrc = event.data;
    			var frame = document.getElementById("stage"); 
				frame.contentWindow.postMessage(themeSrc, '*'); 
				select(6);
    			//alert(event.data);
    		}
    	});

    	$("#topoverlay").click(function(){
    		//alert("top clicked");
    		$("#topoverlay").hide();
    		$("#overlay").hide();
    		$("#overlayContent").hide();  
    	});




      });
    </script>
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'php/login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'php/register.php';
        
    }
}
?>

<body onload="select(1)" class="main" id="body">

	<div id="topoverlay"></div>
	<div id="overlay"></div>
	<div id="overlayContent">
		<div class="wrap">
    	<iframe class="overlayFrame" id="overlayFrame" src="" style="border: none"></iframe>
    	</div>

	</div>





	<div class="header">
        <img id="icon" class ="icon" src="img/icon_blue.png" height=50px width=80px alt="">
	HOMESECURE <span class="about" onclick="about()"><i class="fas fa-question-circle"></i></span>


   
    <?php 
      if( !isset($_SESSION['logged_in']) )
        {

        }
      else
        { 
          if( $_SESSION['active'] == 0)
          {
            header("location: php/profile.php");
          }
          echo '<a href="php/logout.php"><button class="logoutbutton" name="logout"/>Log Out</button></a>';
          echo "<span class='userheader'><div>" . $_SESSION["username"] . "</div></span>";
        }
      ?>

	</div>

	<div class="modal" id="modal">
		<div class="modal-content">
			<div class="modal-header" style="text-align: center;">
    		<span class="close" onclick="closeModal()">&times;</span>
    		<h2 style="text-align: center">HomeSecure<br></h2> <h3>Personalized Home Security and Monitoring</h3>
  			</div>
  			<div class="modal-body">
  				<p><strong>CSC 4990 Spring 2018</strong></p>
  				<p>A home security project using the Home Assistant RESTful API, Hassio Motion, hosted on a Raspberry Pi</p>
  				<p style="font-size: 12px">Clae Carlson, Bryce Renninger, Edward C Champion</p>
  			</div>
		</div>
	</div>
        <div id="id02" class="modal">
      <span onclick="document.getElementById('id02').style.display='none'" class="closeSignup" title="Close Modal">&times;</span>
      <form class="modal-content" action="index.php" method="post" autocomplete="off">
        <div class="container">
          <h1>Sign Up</h1>
          <p>Please fill in this form to create an account.</p>
          <hr>
          <input type="text" placeholder="Enter Email" name='email' required />

          <input type="text" placeholder="Enter Username" name='username' required />

          <input type="password" placeholder="Enter Password" name="psw" required />

          <input type="password" placeholder="Repeat Password" name="psw-repeat" required />

          <div class="clearfix">
            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
             <button type="submit" class="button button-block" name="register" />Register</button>
          </div>
        </div>
      </form>
    </div>
    <?php

      if(isset($_SESSION['logged_in']))
      {

    ?>


	<div>

		<div class="sidenav" id="sidenav">
			<!--<ul>
				<li>Hur</li>
			</ul>!-->
		<div id="op1" onclick="load(1)"><i class="fas fa-info-circle", class="fontawesome1"></i>  Sensor Info</div>
		<div id="op2" onclick="load(2)"><i class="fas fa-video"></i>  Live Cam</div>
		<div id="op3" onclick="load(3)"><i class="fas fa-file-video"></i>  Recordings</div>
		<div id="op4" onclick="load(4)"><i class="fas fa-lightbulb"></i>  Lights</div>
		<div id="op5" onclick="load(5)"><i class="fas fa-lock"></i>  Arm/Disarm</div>
		<div id="op6" onclick="load(6)"><i class="fas fa-cog"></i>  Settings</div>

	</div>

		<iframe name="stage" id="stage" class="frame2" src="sensor_info.html">
			
		</iframe>

	</div>

</body>

<?php
  }
  else
  {
?>
<div class="mainLogin">
<form class="modal-content animate" action="index.php" method="post" autocomplete="off">
        <div class="imgcontainer">
          <img src="img/icon_blue.png" height=100px width=150px alt="Avatar" class="icon">
        </div>

        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>
          <button name="login" class="loginbutton">Login</button>
          <div class="signup" onclick=" document.getElementById('id02').style.display='block'">Sign Up</div>
          <p class="forgot"><a href="php/forgot.php">Forgot Password?</a></p>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>
      </form>
    </div>
<script type="text/javascript">
  var num = parseInt(Math.random() * 6);

  var bgimg = "";

  switch (num) {
    case 0:
    bgimg = "img/night_house.png";
    break;
    case 1:
    bgimg = "img/night_trees.jpg";
    break;
    case 2:
    bgimg = "img/night_mount.jpg";
    break;
    case 3:
    bgimg ="img/night_cat.jpg"
    break;
    case 4:
    bgimg ="img/moon.jpg"
    break;
    case 5:
    bgimg ="img/star.jpg"
    break;
  }
  document.body.style.backgroundImage = "url(" + bgimg + ")";
  //document.body.style.backgroundSize = "1200px 1200px";
</script>


</div>

<?php
}
?>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
// Get the modal
var modal2 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}
</script>
</html>
