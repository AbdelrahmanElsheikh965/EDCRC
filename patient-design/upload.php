<?php
session_start();
$targetDir = 'sequeces/';
$allowed = ["FASTA", "txt", "fna"];
include "../User.php";
$user = new User();
$email = $_SESSION['email'];

if (isset($_POST['subSeq'])){
 if (!empty($_FILES['seq']['name'])) {
		$fileName = basename($_FILES['seq']['name']);
		$fileTargetPath = $targetDir . $fileName;
		$fileType = pathinfo($fileTargetPath, PATHINFO_EXTENSION); 
		if (in_array($fileType, $allowed)) {
			move_uploaded_file($_FILES['seq']['tmp_name'], $fileTargetPath);
			$seq = $fileName . "||";
			$seq .=  file_get_contents($targetDir.$fileName);
			if ($user->insert_seq($seq, $email)) {
				echo '<script language="javascript"> alert("sequence file uploaded successfully") </script>';
				echo '<p>
					<a style style="text-align: center; font-size: 45px;" href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a>
				</p>';
				// header("Location : patient-design/patient_home.php");
				// include "patient_profile.php";
			 }
		}else{
			echo "Not Allowed filetype." . "<br>";
			echo '<p>
				<a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a>
			</p>';
		}
	}else{
		echo '<script language="javascript">';
		echo 'alert("No files uploaded")';
		echo '</script>	';
		// header("Location : patient-design/patient_profile.php"); // gives internal server error!
		echo '<p>
			<a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a>
		</p>';
	}
}
// print_r($_SESSION);

?>

