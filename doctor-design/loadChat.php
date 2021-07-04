<?php 
session_start();
include "../User.php";
$user = new User();

$doctor_id = $_SESSION['myid'];
$patient_id = $_GET['pid'];
// echo($patient_id);
$data = $user->read_message($doctor_id, $patient_id);

 if (is_countable($data) == true) {

	for ($i = 0; $i < count($data); $i++) { 

	 	if ($data[$i]['sender'] == "doctor") {
				// <!-- Own Doctor Message -->
				echo'<div class="bubbleWrapper">
					<div class="inlineContainer own">
						<img class="inlineIcon" src="../images/icons/doc.png">
						<div class="ownBubble own">'.$data[$i]['message'].'</div>
					</div><span class="own">'.$data[$i]['created_at'].'</span>
				</div>';
			
			 } elseif ($data[$i]['sender'] == "patient") { 
				// <!-- Other Patient Message -->
					echo'<div class="bubbleWrapper">
						<div class="inlineContainer">
							<img class="inlineIcon" src="../images/icons/pat.png">
							<div class="otherBubble other">'.$data[$i]['message'].'</div>
						</div><span class="other">'.$data[$i]['created_at'].'</span>
					</div>';
					 } 		
				 } 
			 } 