<?php
session_start();
include "../User.php";
$user = new User();
$id = $_GET['id'];
$user->delete("doctors_users", $id);
unset($id);
echo "<script> javascript:history.go(-1) </script>";