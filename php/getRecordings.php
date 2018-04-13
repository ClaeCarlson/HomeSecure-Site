<?php
$dir = "../recordings/";

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
    	if ($file != '.' && $file != '..' && $file != '.DS_Store')
      		echo "<div class='recordingDiv' onclick=\"loadVid('" . $file . "')\">" . $file . "</div>";
    }
    for ($i = 0; $i < 6; $i++)
    	echo "<div></div>";
    closedir($dh);
  }
}
?>