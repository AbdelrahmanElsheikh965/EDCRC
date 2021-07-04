<?php 
	session_start();
	include "../User.php";
	$user = new User();
	$doctorInfo = $_SESSION['doctorInfo'];	
	$doc_id =  $doctorInfo[0];
	$doc_name =  $doctorInfo[1];
	$appointments = $user->get_my_patients("appointments", $doc_id, "AND patient_id IS null");
	 if (is_countable($appointments) == true) { 
		 for ($i = 0; $i < count($appointments); $i++) {  
			echo'<tr>
				<td id="date" contenteditable="">'. $appointments[$i]['date'].'</td>
				<td id="time" contenteditable="">'. $appointments[$i]['time'].'</td>
				<td id="location" contenteditable="">'. $appointments[$i]['location'].'</td>
				<td><a id="btn_add" href="insert.php?location='.$appointments[$i]['location'] .'" type="submit" name="submit">Get Appointment</a></td>
			</tr>';
	 		} 
		 }else{ 
						echo'<tr>
							<td colspan="4" style="text-align: center;">Data not found</td>
						</tr>';
			 }