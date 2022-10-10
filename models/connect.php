<?php
	$conn = mysqli_connect("localhost","root","","db_lifesound");
	mysqli_set_charset($conn,'utf8');
	session_start();
	if(mysqli_connect_error()){
		echo "Chê!!";
	}
?>