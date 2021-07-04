<?php 
session_start();
include "../User.php";
$user = new User();

$doctorInfo = $_SESSION['doctorInfo'];	
$doc_id =  $doctorInfo[0];
$doc_name =  $doctorInfo[1];
$myid =  $_SESSION['id'];
$data = $user->read_message($doc_id, $myid);
//
if (isset($_POST['msg'])) {
	$message = $_POST['msg'];
	$user->insert_message("patient", $doc_id, $myid, $message);
	$data = $user->read_message($doc_id, $myid);
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Patient Chat</title>
		<!-- <meta http-equiv="refresh" content="1"> -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/chat.css" />
        <link rel="icon" type="image/png" href="../images/icons/pat.ico"/>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>

	</head>
	<body class="is-preload">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<div id="wrapper">
			<div id="main">
					<!-- <section id="content" class="main"> -->
					<!-- <div class="page-content page-container" id="page-content"> -->
					<!-- <div class="padding"> -->
						<div class="row container d-flex justify-content-center">
					    <div class="col-md-6">
					        <div class="card card-bordered">
					            <div class="card-header">
					                <h4 class="card-title"><strong>Chat with your Doctors </strong></h4>
					            </div>

								<div class="chat_main" id="conv" style="height: 450px; width: 1150px; margin-left: 25px;"> </div>
						
							</div>
				<form method="post" action="patient_chat.php">
						 <div class="publisher bt-1 border-light" id="trgt"> 
						 	<img class="avatar avatar-xs" src="../images/icons/pat.png" alt="..."> 
						 	<textarea class="publisher-input" id="msg" placeholder="Write something" required=""></textarea>
					 		<input type="submit" class="btn btn-success" id="add" value="send">
					 	</div>
		            </form>
				</div>
							<br> <br>
							<a href="patient_home.php" style="margin-left: 65rem;" id="edge" class="button primary icon solidfa-download">Go Back</a>
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
					// function updateScroll(){
					// 	// var conv = document.getElementById("conv");
					// 	// var y = conv.scrollHeight;
					// 	// var x = conv.scrollWidth;
					// 	$("#conv").animate({ scrollTop: $('#conv').height()});
					// 	// $('#conv').animate({ scrollTop:"45446874897" }, 1000);
					// 	// $('#conv').animate({ scrollTop:400000000 }, 1000);
					// 	// $('#conv').scrollTop($('#conv')[0].y);
					// }

					$(function(){startRefresh();});
				    // function startRefresh() {
					   //      // setTimeout(startRefresh,0);
					   //      var wtf    = $('#conv');
						  //   var height = wtf[0].scrollHeight;
						  //   wtf.scrollTop(height);
				    // }
						function getdata(){
					        $.get('loadChat.php', function(data) {
					            $('#conv').html(data);
					        });
					    }
					
					
					// getdata();
					// updateScroll();

					$('#add').click(function(){
						var msg = $('#msg').val();
						$.ajax({
							url: 'patient_chat.php',
							type: 'POST',
							data:{msg:msg}
						});
						// getdata();
						// updateScroll();
					});
					
					t = setInterval(getdata,0);					

				});

			</script>

	</body>
</html>