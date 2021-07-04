<?php 
session_start();
include "../User.php";
$user = new User();
$my_patients = $user->get_my_patients("doctors_users", $_SESSION['myid']);

if (is_countable($my_patients) == true) { 
	 for ($i = 0; $i < count($my_patients); $i++) {  
	
		echo'<tr>
				<td>'. $my_patients[$i]['name'].'</td>
				<td>'. $my_patients[$i]['national_id'].'</td>
				<td>Delete &nbsp; &nbsp; '; ?>
				<a  onclick="return confirm('Are you sure you want to delete this item ?')" 
				<?php echo 'href="doctor_profile.php?id='.$my_patients[$i]['id'].'"><i class="far fa-trash-alt"></i></td></a>
			</tr>';

	}
}