<?php 
session_start();
include "../User.php";
$user = new User();
$my_patients_data = $user->get_my_patients("patients", $_SESSION['myid']);
 if (is_countable($my_patients_data) == true) { 
		 for ($i = 0; $i < count($my_patients_data); $i++) { 
			echo'<tr>
				<td>'.$my_patients_data[$i]['name'].'</td>
				<td><img style="width: 30px; height: 30px;" src="../images/true.png"></td>
				<td><img style="width: 30px; height: 30px;" src="../images/true.png"></td>
				<td>'.$my_patients_data[$i]['gender'].'</td>
				<td>'.$my_patients_data[$i]['age'].'</td>
				<td class="icons"><a href="doctor_detect.php?pid='.$my_patients_data[$i]['id'].'">
					<img style="width: 30px; height: 30px;" src="../images/cpu.svg"/></a></td>
				<td class="icons"><a href="doctor_chat.php?pid='.$my_patients_data[$i]['id'].'">
					<img style="width: 30px; height: 30px;" src="../images/chat-dots.svg"/></a></td>
			</tr>';
		 } 
	 } 