<?php 
session_start();
include "../User.php";
$user = new User();

$doctorInfo = $_SESSION['doctorInfo'];	
$doc_id =  $doctorInfo[0];
$doc_name =  $doctorInfo[1];
$myid =  $_SESSION['id'];
$data = $user->read_message($doc_id, $myid);

 if (is_countable($data) == true) {

	 for ($i = 0; $i < count($data); $i++) {

		 if ($data[$i]['sender'] == "patient") {
			
			// <!-- Own Doctor Message -->
			echo'<div class="bubbleWrapper">
				<div class="inlineContainer own">
					<img class="inlineIcon" src="../images/icons/pat.png">
					<div class="ownBubble own">'.$data[$i]['message'].'</div>
				</div><span class="own">'.$data[$i]['created_at'] .'</span>
			</div>';
	
		  }elseif ($data[$i]['sender'] == "doctor") {
			// <!-- Other Patient Message -->
			echo'<div class="bubbleWrapper">
				<div class="inlineContainer">
					<img class="inlineIcon" src="../images/icons/doc.png">
					<div class="otherBubble other">'.$data[$i]['message'].'</div>
				</div><span class="other">'.$data[$i]['created_at'].'</span>
			</div>';
			 }		
		 }
	}