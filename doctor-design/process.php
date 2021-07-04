<?php
session_start();
include "../User.php";
$user = new User();
if ( isset($_POST['name']) && isset($_POST['national_id']) ) {
	$name = $_POST['name'];
	$national_id = $_POST['national_id'];
	if ($user->insert_patients($name, $national_id, $_SESSION['myid'])) {
			echo "Data Inserted";
		}else{
			echo "Data Not inserted";
		}
}


if (isset($_POST['date']) && isset($_POST['time']) && isset($_POST['time'])) {
	$date 		= $_POST['date'];
	$time 		= $_POST['time'];
	$location 	= $_POST['location'];
	if ($user->insert_appointments($date, $time, $location, $_SESSION['myid'])) {
		echo "Data Inserted";
	}else{
		echo "Data Not inserted";
	}
}