<?php
	session_start();
	include "../User.php";
	$user = new User();
	$email = $_SESSION['email'];
	$data = $user->read_data("patients", $email);
	$_SESSION['id'] = $data['id'];
	$results = $user->get_result($data['id']);
	echo'<code>'. $results['result'] . '</code>';