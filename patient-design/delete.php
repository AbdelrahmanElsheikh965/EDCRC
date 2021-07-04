<?php
	session_start();
	include "../User.php";
	$user = new User();
	$id = $_GET['id'];
	$user->delete_my_appointment($id);
	// header("location : patient_home.php");
	echo "<script> javascript:history.go(-1) </script>";