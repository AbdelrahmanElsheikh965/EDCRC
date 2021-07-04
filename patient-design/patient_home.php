<?php 
	session_start();
	include "../User.php";
	$user = new User();
	if (isset($_SESSION['email']) && $_SESSION['type'] == "patients" && isset($_SESSION['doctorInfo'])) {
		$doctorInfo = $_SESSION['doctorInfo'];	
		$doc_id =  $doctorInfo[0];
		$doc_name =  $doctorInfo[1];
		$appointments = $user->get_my_patients("appointments", $doc_id, "AND patient_id IS null");
		$email = $_SESSION['email'];
		$data = $user->read_data("patients", $email);
		$_SESSION['id'] = $data['id'];
		$results = $user->get_result($data['id']);
		$myAppointment = $user->get_my_appointment($data['id']);
		$my_sequence = $user->get_seq_name($email);
}else{
	header("Location: ../logout.php");
}
	// print_r($appointments);
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Patient Profile</title>
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
						<p>Home Page</p>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Content -->
							<section id="content" class="main">
								<span class="image main"><img src="../images/dna.jpg" alt="" /></span>
<!-- chat template -->			<h1 style="text-align: center; font-size: 25px;"> <p style="font-family:'Courier New'">Your Doctor : Dr.  <?= $doc_name ?> </p> </h1>
								<a style="float: right;" href="patient_chat.php" class="button icon solid">
								<i class="fas fa-envelope">&nbsp; Inbox </i></a> 
							<h3>Uploaded Sequence : <?= $my_sequence ?></h3>
							<form method="post" action="upload.php" enctype="multipart/form-data"> 
								<input type="file" name="seq"> <br> <br>
								<input type="submit" name="subSeq" class="button icon solid fa-upload" value="Upload file"></a>
							</form>

						 	<div class="row">
									<div class="col-6 col-12-medium">
										<h3>Personal Data</h3> <i> ( these data will be auto-filled. )</i>
										<ul class="alt"> 
											<li>Name 	:/ &nbsp;  <?= $data['name'] ?>   </li>
											<li>Email 	:/ &nbsp;  <?= $data['email'] ?>  </li>
											<li>Gender 	:/ &nbsp;  <?= $data['gender'] ?> </li>
											<li>Age 	:/ &nbsp;  <?= $data['age'] ?>    </li>
											<li></li>
										</ul>
									</div>
								</div>
										<form method="post" action="delete.php?id=<?= $myAppointment['id']; ?>">
										<button style="float: right;" class="btn_delete" name="">cancel</button>
										</form>
										<h4 style="float: right;">Upcoming Appointments : &nbsp;</h4>  
										<br> <br>
										<pre id="getUp" style="float: right; width: 300px; height: 157px;"></pre>
	
	<h2> Register An Appointment with your doctor. </h2>
						<div class="table-wrapper">
							<table class="alt" style="width: 80%;">
								<thead>
									<tr>
										<th>Date</th>
										<th>Time</th>
										<th>Location</th>
										<th>Reserve</th>
									</tr>
								</thead>
								<tbody id="appoint"> </tbody>
							</table>
						</div>
								
								
<h4>Result / Report</h4>
<pre id="res"></pre>

<hr>
											
							<a href="../logout.php" style="float: right;" class="button primary icon solidfa-download">Logout!</a>
							<br> <br>
						</div>
							</section>
					</div>



				<?php include '../footer.html' ?>

			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

			<script type="text/javascript">
				$(document).ready(function(){
					
					// $(document).on('click', '#btn_add', function(){  
			  //          var date = $('#date').text();  
			  //          var time = $('#time').text();  
			  //          var location = $('#location').text();  
			  //          $.ajax({  
			  //               url:"insert.php",  
			  //               method:"POST",  
			  //               data:{date:date, time:time, location:location},  
			  //               dataType:"text",  
			  //               success:function(data){  
			  //                   alert(data)
	    //            		 	}  
			  //          }); 
			  //     });

			  		function getupcoming(){
						$('#getUp').load('getupcoming.php');
					}
					getupcoming();
					t = setInterval(getupcoming,2000);

					//

  			  		function getres(){
						$('#res').load('getRes.php');
					}
					getres();
					t = setInterval(getres,2000);

					//

			  		function getappoint(){
						$('#appoint').load('regappoin.php');
					}
					getappoint();
					t = setInterval(getappoint,2000);

				$(document).on('click', '.btn_delete', function(){  
		           var id=$(this).data("id");  
		           if(confirm("Are you sure you want to delete this?"))  
		           {  
		                $.ajax({  
		                     url:"delete.php",  
		                     method:"POST",  
		                     data:{id:id},  
		                     dataType:"text",  
		                     success:function(data){
		                      	// 
		                     }  
		                });  
		           }  
		      });

			});

			</script>

	</body>
</html>