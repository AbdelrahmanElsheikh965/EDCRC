<?php
session_start();
if (isset($_SESSION['email'])) {
	session_destroy();
	setcookie("email", "");
	setcookie("password", "");
	header("Location: index.php");
	exit;
}
