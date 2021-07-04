<?php
session_start();
if (isset($_SESSION['type'])) {
	if ($_SESSION['type'] == "doctors") {
		header("Location: doctor-design/doctor_profile.php");
	}else if ($_SESSION['type'] == "patients") {
		header("Location: patient-design/patient_profile.php");
	}
}
?>
<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Early Detection of CRC</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="icon" type="image/png" href="images/icons/logo-min.ico"/>
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/icons/home_intro.ico" alt="" /></span>
						<h1>Early Detection of Colorecal Cancer</h1>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="#intro" class="active">Introduction</a></li>
							<li><a href="#first">Approach</a></li>
							<li><a href="#second">Statistics</a></li>
							<li><a href="#cta">Get Started</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Introduction -->
							<section id="intro" class="main">
								<div class="spotlight">
									<div class="content">
										<header class="major">
											<h2>Introduction</h2>
										</header>
										<p>Colorectal cancer (CRC) is one of the most common neoplasms
											in the world. This is especially true in developed
											countries where it is considered the third leading cause
											of cancer and the second leading cause of death in cancer
											patients. Globally, more than 850,000 people develop
											CRC annually, and more than 500,000 die from this
											disease. CRC represents 9.4% of all cancers in men and
											10.1% in women, but its frequency varies geographically.
											Incidence of CRC and deaths due to
											CRC increased between 1962 and 2005. (3) According to
											data from GLOBOCAN 2008, CRC ranks sixth in cancer initiated by mutations in the sequence of APC, K-RAS, and TP53 genes.</p>
										<ul class="actions">
											<li><a href="intro.html" class="button">Learn More</a></li>
										</ul>
									</div>
									<span class="image"><img src="images/cac.ico" alt="" /></span>
								</div>
							</section>

						<!-- First Section --> 
						<section id="first" class="main special"> 

							<header class="major"> <h2>Approach</h2> </header> 
								<ul class="features">
									<li> 
										<span class="icon solid major style1 fa-code"></span>
										<h3>Development</h3> 
										<p>We've used alot of advanced technologies to build, maintain and test this project
										(HTML5, CSS3, JS, jQuery, Ajax, Bootstrap) for front end development of the website
										(PHP, MySQL, Apache HTTP Server) for the backend of the website and tools i.e(XAMPP, sublime text editor, git-bash, github, PhpStorm).</p>
									</li>
									
									<li> 
										<span class="icon major style3 fa-copy"></span> 
										<h3>Approach</h3> 
										<p>TP53 sequencing analysis was successful in all 389 specimens. TP53 mutations were detected in 129 patients (33%). Three mutants had a median transcriptional activity > 75% and were classified as wildtype for the calculation. </p>
									 </li> 

									 <li> 
									 	<span class="icon major style5 fa-gem"></span>
									  	<h3>Core Process</h3>
									  	<p>the alignment of gene sequences of the registered patient with the SNPs of the TP53 mutation which could easily cause CRC is thr major part of  <br> <i> "how to detect crc early". </i> </p> 
									</li> 
								</ul> 
							<footer class="major">
									<ul class="actions special">
										 <li> <a href="appro.html" class="button"> Learn More </a> </li> 
									</ul> 
							</footer>
						</section>

<!-- 						 colorectal cancer is the third leading cause of cancer-related deaths. It is the third most common cancer in men and in women. -->

						<!-- Second Section -->
							<section id="second" class="main special">
								<header class="major">
									<h2>Statistics</h2>
									<p>This year, an estimated 149,500 adults will be diagnosed with colorectal cancer. These numbers include 104,270 new cases of colon cancer (52,590 men and 51,680 women) and 45,230 new cases of rectal cancer (26,930 men and 18,300 women).</p>
								</header>
								<ul class="statistics">
									
									<li class="style3">
										<span class="icon solid fa-signal"></span>
										<strong>67.4%</strong>
										The percentage of adults aged 50 to 75 years increased by 1.4% from 2016 to 2018.
									</li>

									<li class="style3">
										<span class="icon solid fa-signal"></span>
										<strong>4.2 million</strong>more adults aged 50 to 75 years were screened for CRC.
									</li>

									<li class="style3">
										<span class="icon solid fa-signal"></span>
										<strong>21.7 million</strong>Adults aged 50 to 75 years who have never been screened for CRC.
									</li>

									<li class="style3">
										<span class="icon solid fa-signal"></span>
										<strong>81%</strong>Of adults who have never been screened are people aged 50 to 64 years.
									</li>
									
								</ul>
								<p class="content">Use of Colorectal Cancer Screening Tests 2018 Behavioral Risk Factor Surveillance System The percentage of adults who are up-to-date with colorectal cancer screening is increasing.Colorectal cancer affects men and women of all racial and ethnic groups, and is most often found in people aged 50 years or older. Of cancers that affect both men and women, colorectal cancer is the second leading cancer killer, but it doesn’t have to be. Colorectal cancer screening saves lives.CDC scientists used data from the Behavioral Risk Factor Surveillance System (BRFSS) to ask people about their behaviors related to colon cancer screening.</p>
								<footer class="major">
									<ul class="actions special">
										<li><a href="stat.html" class="button">Learn More</a></li>
									</ul>
								</footer>
							</section>


					


						<!-- Get Started -->
							<section id="cta" class="main special">
								<header class="major">
									<h2>How about discovering what's beyond ?</h2>
									<p>login or register an account to get in .. </p>
								</header>
								<form method="post" action="login.php">
											<div class="row gtr-uniform" style="text-align: left;">
												<div class="col-6 col-12-xsmall">
													Email : <input type="email" value="<?= @$_COOKIE['email'] ?>" name="email" id="demo-email" value="" placeholder="Email" required="" />
												</div>
												<br> 
												<br>
												<div class="col-6 col-12-xsmall">
													Password : <input type="password" value="<?= @$_COOKIE['password'] ?>" name="password" id="demo-password" value="" placeholder="Password" required="" />
												</div>
												<br> <br>
												<div style="margin: 0 auto;" class="col-4 col-12-small">
													<input type="radio" id="demo-priority-low" value="doctors" name="type" required="">
													<label for="demo-priority-low">Doctor</label>
												</div>
												<div class="col-4 col-12-small">
													<input type="radio" id="demo-priority-normal" value="patients" name="type">
													<label for="demo-priority-normal">Patient</label>
												</div>
												
												<div class="col-6 col-12-small">
													<input type="checkbox" id="demo-human" name="remember_me">
													<label for="demo-human">Remember Me</label>
												</div>

												<a href="register.html" target="_blank">Do Not have an account ?</a>
											</div>
								<footer class="major">
									<ul class="actions special">
										<li> <input type="submit" name="subLog" value="Login" class="button primary"></li>
										<!-- <li><a href="generic.html" class="button">Learn More</a></li> -->
									</ul>
								</footer>
							</section>
						</form>
					</div>

					<?php include 'footer.html' ?>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>