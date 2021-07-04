<?php

echo "<title> Login Authentication </title>";

include "User.php";
$user = new User();

if (isset($_POST['subLog'])) {
	$type 		= $_POST['type'];
	$email 		= $_POST['email'];
	$password 	= $_POST['password'];
	if ($type == "doctors" && $user->login($type, $email, $password)) {
		echo "logged in successfully";
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['type'] = $type; 
		if (! empty($_POST['remember_me'])) {
			// cookies last for 2 days.
			setcookie("email", $email, time() +  2 * 24 * 60 * 60);
			setcookie("password", $password, time() + 2 * 24 * 60 * 60);
		}
		header( "refresh:1;url=doctor-design/doctor_profile.php");
		exit;
	}else if ($type == "patients" && $user->login($type, $email, $password)){
		echo "logged in successfully";
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['type'] = $type; 
		if (! empty($_POST['remember_me'])) {
			// cookies last for 2 days.
			setcookie("email", $email, time() +  2 * 24 * 60 * 60);
			setcookie("password", $password, time() + 2 * 24 * 60 * 60);
		}
		header( "refresh:1;url=patient-design/patient_profile.php");
		exit;
	}else{
		echo '<script language="javascript">';
		echo 'alert("Wrong Email or Password!")';
		echo '</script>';	
		include "index.php";
	}
}