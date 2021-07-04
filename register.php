<?php

echo "<title> Register Authentication </title>";

include "User.php";
$user = new User();

if (isset($_POST['subReg'])) {
	$name	 	= $_POST['name'];
	$email 		= $_POST['email'];
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];
	$age 		= $_POST['age'];
	$gender 	= $_POST['gender'];
	$type 		= $_POST['type'];
	if ($password_1 == $password_2) {
		if ($user->register($type, $name, $email, $password_1, $gender, $age)) {
			echo "registered successfully";
			header( "refresh:1;url=index.php");
		}else{
			echo '<script language="javascript"> alert("Email entered already exists!") </script>';
			header( "refresh:1;url=register.html");
			echo 'You\'ll be redirected in about 1 secs.';
		}
	}else{
		echo '<script language="javascript">';
		echo 'alert("Password do not match!")';
		echo '</script>';	
		include "register.php";
	}
}	
