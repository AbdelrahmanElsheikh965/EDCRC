<?php
session_start();
include "../User.php";
$user = new User();
$email = $_SESSION['email'];
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Patient Authentication</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/chat.css" />
	    <link rel="icon" type="image/png" href="../images/icons/pat.ico"/>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1>Patient</h1>
						<p>Validation phase</p>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Content -->
							<section id="content" class="main">
								<span class="image main"><img src="../images/dna.jpg" alt="" /></span>
								<form method="post" action="">
									<div class="row gtr-uniform">
										<div class="col-6 col-12-xsmall">
											National ID <br>
											<input style="width: 389px;" type="number" name="nid" id="demo-name" value="" placeholder="National ID" required="" />
										</div>
										<div class="col-6 col-12-xsmall">
											Code
											<input style="height: 40px; width: 389px; border: 1px solid black; border-radius: 0;" type="text" name="code" id="demo-email" value="" placeholder="Code" required="" />
										</div>
										<div class="col-6 col-12-xsmall">
											<input type="submit" name="activate" class="button primary" value="Activate Your Connection with your doctor">
											&nbsp; &nbsp; &nbsp;
											<!-- <p style="font-size: 30px;"> status : //
											<img style="width: 20px; height: 20px;" src="../images/greenlight.png">   Connected</p> -->

											<!-- <p style="font-size: 30px;"> status : //
											<img style="width: 20px; height: 20px;" src="../images/redlight.png">   Disconnected</p> -->
											<!-- <br> <br> -->
										</div>
									</div>
								</form>
										<a href="../logout.php" style="float: right;" class="button primary icon solidfa-download">Logout!</a>

								<br> <hr>

								<?php 
									//888888888888
									//$user->check_validity($email)
									if (isset($_SESSION['doctorInfo'])) {
										header("location: patient_home.php");
									}else{
										if (isset($_POST['nid']) && isset($_POST['code'])) {
											$national_id = $_POST['nid'];
											$code 		 = $_POST['code'];

											if ($doctorInfo = $user->validate_user($national_id, $code, $email)) {
												header("location: patient_home.php");
												$_SESSION['doctorInfo'] = $doctorInfo;
											}
										}
									}
								 ?>
							</section>
						</div>
					</div>
				</body>
				</html>

								