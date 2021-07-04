<?php 
session_start();
include "../User.php";
$user = new User();
if (isset($_SESSION['email']) && $_SESSION['type'] == "doctors") {
	$email = $_SESSION['email'];
	$data = $user->read_data("doctors", $email);
	$_SESSION['myid'] = $data['id']; // current doctor id
	$my_patients_data = $user->get_my_patients("patients", $_SESSION['myid']);
	// print_r($my_patients_data);
	$my_patients = $user->get_my_patients("doctors_users", $_SESSION['myid']);
	$my_appointments = $user->get_my_patients("appointments", $_SESSION['myid']);

	// $patients_data = $user->get_all("patients");
	$mycode = $user->generate_code($email);

	if (isset($_GET['id'])) {
		$user->delete("doctors_users", $_GET['id']);
		// 
	}else{
		unset($_GET['id']);
	}

	if (isset($_GET['aid'])) {
		$user->delete("appointments", $_GET['aid']);
	}else{
		unset($_GET['id']);
	}

}else{
	header("Location: ../index.php");
}

// print_r($_SESSION);

if (isset($_POST['submit_Report'])) {
	$message = $_POST['message'];
	// echo $_SESSION['patient_id'];
	$res = $user->insert_result($_SESSION['patient_id'], $message);
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Doctor Profile</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	    <link rel="icon" type="image/png" href="../images/icons/doc.ico"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">


<!-- Header -->
	<header id="header">
		<h1>Doctor</h1>
		<p>Profile Home</p>
	</header>

<!-- Main -->
	<div id="main">

		<!-- Content -->
			<section id="content" class="main">
				<span class="image main"><img src="../images/dp.jpg" alt="" /></span>
										<h3 style="float: right; margin-right: 236px;">Your Code :/</h3> 
										<br> <br>
										<pre style="float: right; width: 350px; height: 81px;"><code>
<?= $mycode ?>
</code></pre>

			<div class="row">
				<div class="col-6 col-12-medium">
					<h3>Personal Data</h3> <i> ( these data will be auto-filled. )</i>
					<ul class="alt"> 
						<li>Name 	:/ &nbsp; <?= $data['name'] ?>   </li> 
						<li>Email 	:/ &nbsp; <?= $data['email'] ?>  </li>
						<li>Gender 	:/ &nbsp; <?= $data['gender'] ?> </li>
						<li>Age 	:/ &nbsp; <?= $data['age'] ?>    </li>
						<li></li>
					</ul>
				</div>
			</div>

			<h3>Add your Patients</h3>
						<form method="" action="">
							<div class="row gtr-uniform" >
								<div class="col-6 col-12-xsmall" >
									Name : <input style="height: 38px; border: 1px solid black; border-radius: 0;" type="text" name="name" id="patient_name" value="" placeholder="Name" required="" />
								</div>
								<div class="col-6 col-12-xsmall">
								<br>
									National ID : <input style="width: 389px;" type="number" name="nid" id="patient_national_id" value="" placeholder="National ID" required="" />
								</div> 
								<div class="col-6 col-12-xsmall">
										<input style="width: 489px;" type="submit" name="Add" value="Add" id="add" class="button primary">
								</div>
							</div>
						</form>

			<h3>Belonged Patients</h3>
					<div class="table-wrapper" id="bp">
						<table class="alt" style="width: 70%;">
							<thead>
								<tr>
									<th>Name</th>
									<th>National ID</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody id="table"> </tbody> 
						</table>
					</div>

				<h3>Activated Patients <i> (who uploaded their sequences)</i> </h3>
						<div class="table-wrapper">
							<table class="table-wrapper">
								<thead>
									<tr>
										<th>Name</th> 
										<th>Check National ID</th> 
										<th>Check Code</th> 
										<th>Gender</th>
										<th>Age</th>
										<th>Sequence</th>
										<th>Chat</th>
									</tr>
								</thead>
								<tbody id="my_pat"> </tbody>
							</table>
						</div>

						<h3>Add Your Appointments</h3>
						<form method="" action="">
							<div class="row gtr-uniform" >
								<div class="col-6 col-12-xsmall" >
									Date : <input style="width: 389px;" type="date" name="Date" id="date" value="" placeholder="date" required="" />
								</div>
								<div class="col-6 col-12-xsmall">
									Time : <input style="width: 389px;" type="time" name="Time" id="time" value="" placeholder="time" required="" />
								</div>
								<div class="col-6 col-12-xsmall">
									Location : <input style="margin-left: 46px; height: 38px; width: 389px; border: 1px solid black; border-radius: 0;" type="text" name="Location" id="location" value="" placeholder="location" required="" />
								</div> 
								<div class="col-6 col-12-xsmall">
										<br>
										<input style="margin-left: 46px; width: 389px;" type="submit" name="subReg" value="Add" id="addAppointment" class="button primary">
								</div>
							</div>
						</form>

						<h3>Appointments</h3>
										<div class="table-wrapper">
											<table>
												<thead>
													<tr>
														<th>Date</th>
														<th>Time</th>
														<th>Location</th>
														<th>According Patient</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody id="appoin"> </tbody>
											</table>


			<a href="../logout.php" style="float: right;" class="button primary icon solidfa-download">Logout!</a>
			<br>
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
					function getdata(){
						$('#table').load('belonged_patients.php');
					}
					getdata();
					t = setInterval(getdata,2000);

					function getappoin(){
						$('#appoin').load('appointments.php');
					}
					getappoin();
					t = setInterval(getappoin,2000);
					

					function getpat(){
						$('#my_pat').load('activated.php');
					}
					getappoin();
					t = setInterval(getpat,2000);
					

					$('#add').click(function(){
						var name = $('#patient_name').val();
						var national_id = $('#patient_national_id').val();
						$.ajax({
							url: 'process.php',
							type: 'POST',
							data:{
								name : name,
								national_id : national_id
							},
							success:function(data){
								alert(data);
							}
						});
					});

					$('#addAppointment').click(function(){
						var date = $('#date').val();
						var time = $('#time').val();
						var location = $('#location').val();
						$.ajax({
							url: 'process.php',
							type: 'POST',
							data:{
								date : date,
								time : time,
								location : location
							},
							success:function(data){
								alert(data);
							}
						});
					});
				});
					
					// $(document).on('click', '.btn_delete', function(){  
		   //         var id=$(this).data("id");  
		   //         if(confirm("Are you sure you want to delete this?"))  
		   //         {  
		   //              $.ajax({  
		   //                   url:"delete.php",  
		   //                   method:"POST",  
		   //                   data:{id:id},  
		   //                   dataType:"text",  
		   //                   success:function(data){
		   //                    	// 
		   //                   }  
		   //              });  
			  //          }  
			  //     });
			</script>

	</body>
</html>