<?php

$conn = mysqli_connect("localhost", "root", "", "test");

if (!$conn) {
	return mysqli_connect_error();
}
return "nOpe";