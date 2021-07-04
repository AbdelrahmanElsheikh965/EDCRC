<?php 
session_start();
include "../User.php";
$user = new User();
$my_appointments = $user->get_my_patients("appointments", $_SESSION['myid']);
 if (is_countable($my_appointments) == true) {
	 for ($i = 0; $i < count($my_appointments); $i++) { 
					echo'<tr>
							<td>'. $my_appointments[$i]['date'].'</td>
							<td>'. $my_appointments[$i]['time'].'</td>
							<td>'. $my_appointments[$i]['location'].'</td>
							<td>'. @implode("", $user->get_reserved_paient($_SESSION['myid'], $my_appointments[$i]['id'])[0]).'</td>
							<td>Delete &nbsp; &nbsp;'; ?>
							<a onclick="return confirm('Are you sure you want to delete this item ?')" 
							<?php echo 'href="doctor_profile.php?aid='.$my_appointments[$i]['id'].'"><i class="far fa-trash-alt"></i>
							</a> </td>
						</tr>';
			 } 
		 } 