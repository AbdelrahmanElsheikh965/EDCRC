<?php 
session_start();
include "../User.php";
$user = new User();
	$email = $_SESSION['email'];
		$data = $user->read_data("patients", $email);
		$_SESSION['id'] = $data['id'];
		$results = $user->get_result($data['id']);
		$myAppointment = $user->get_my_appointment($data['id']);
		echo'<code>Date: '. $myAppointment['date'] .' <br>';
		echo'Time: '. $myAppointment['time'] .' <br>';
		echo'Location: '. $myAppointment['location'] .'</code>';