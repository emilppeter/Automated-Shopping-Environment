<?php 

	$myfile = fopen("read.txt", "w") or die("Unable to open file!");
	fwrite($myfile, '');	
	fclose($myfile);
	header("refresh:1 url=test2.php");
 
 ?>