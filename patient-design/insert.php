<?php
	session_start();
	include "../User.php";
	$user = new User();
	$id = $_SESSION['id'];
	$location = $_GET['location'];
	$user->set_my_appointment($id, $location);
	// echo($location);
	echo "<script> javascript:history.go(-1) </script>";
?>