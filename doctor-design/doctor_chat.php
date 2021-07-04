<?php 
session_start();
include "../User.php";
$user = new User();

$doctor_id = $_SESSION['myid'];
$patient_id = $_GET['pid'];
// echo $doctor_id;
// echo $patient_id;
$data = $user->read_message($doctor_id, $patient_id);
// echo ($data);
// if (is_countable($data) == true) {
 	
//  }else{

//  }
if (isset($_POST['msg'])) {
	$message = $_POST['msg'];
	$user->insert_message("doctor", $doctor_id, $patient_id, $message);
	// $data = $user->read_message($doctor_id, $patient_id);
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Doctor Chat</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/chat.css" />
	    <link rel="icon" type="image/png" href="../images/icons/doc.ico"/>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>

	</head>
	<body class="is-preload" id="all">		
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<!-- <header id="header">
						<h1>Doctor Chat</h1>
						<p>Doctor with the patients</p>
					</header> -->

				<!-- Main -->
					<div id="main">

						<!-- Content -->
							<!-- <section id="content" class="main"> -->
								<!-- <span class="image main"><img src="../images/dp.jpg" alt="" /></span> -->
								

					<!-- chat template -->
					<!-- <div class="page-content page-container" id="page-content"> -->
					<!-- <div class="padding"> -->
						<div class="row container d-flex justify-content-center">
					    <div class="col-md-6">
					        <div class="card card-bordered">
					            <div class="card-header">
					                <h4 class="card-title"><strong>Chat with your Patients </strong></h4>
					            </div>
								
								<div class="chat_main" id="conv" style="height: 450px; width: 1150px; margin-left: 25px;"> </div>		
							
							</div>
					<form method="post" action="doctor_chat.php?pid=<?= $patient_id ?>">
						 <div class="publisher bt-1 border-light" id="trgt"> 
						 	<img class="avatar avatar-xs" src="../images/icons/doc.png" alt="..."> 
						 	<textarea class="publisher-input" id="msg" placeholder="Write something" required=""></textarea>
					 		<input type="submit" class="btn btn-success" id="add" value="send">
					 	</div>
             	   </form>
	            </div>


							<br><br>
							<a href="doctor_profile.php" style="margin-left: 65rem;" class="button primary icon solidfa-download">Go Back</a>
							<br><br>
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
					// function updateScroll(){
					// 	$('#conv').animate({ scrollTop:"45446874897" }, 1000);
					// 	// $(".chat_main").scrollTop($(".chat_main")[0].scrollheight);
					// }

					// $(function(){startRefresh();});
				    // function startRefresh() {
					   //      // setTimeout(startRefresh,200);
					   //      var wtf    = $('#conv');
						  //   var height = wtf[0].scrollHeight;
						  //   wtf.scrollTop(height);
				    // }

					function getdata(){
				        $.get('loadChat.php?pid=<?= $patient_id ?>', function(data) {
				            $('#conv').html(data);
				        });
				    }
					getdata();
						// startRefresh();

					$('#add').click(function(){
						var msg = $('#msg').val();
						$.ajax({
							url: 'doctor_chat.php?pid=<?= $patient_id ?>',
							type: 'POST',
							data:{msg:msg}
						});
						// getdata();
						// startRefresh();
					});
					
					t = setInterval(getdata,0);

				});

			</script>

	</body>
</html>