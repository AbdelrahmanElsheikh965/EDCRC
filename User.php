<?php

include "db/dbConfig.php";

class user
{
	public $id;
	public $name;
	public $email; // unique
	public $password;
	public $gender;
	public $age;
	public $seq;

	function register($table, $name, $email, $password, $gender, $age){
		$conn = $GLOBALS['conn'];
		$this->name = $name;
		$this->email = $email;
		$password = md5($password);
		$this->password = $password;
		$this->gender = $gender;
		$this->age = $age;
		$query = "INSERT INTO $table (name, email, password, gender, age) VALUES ('$name', '$email', '$password', '$gender', $age)";
		$out = mysqli_query($conn, $query);
		if ($out) {
		 	return true;
		 }
		 return false;
		 mysqli_close($conn);
	}

	function login($table, $email, $password){
		$conn = $GLOBALS['conn'];
		$this->email = $email;
		$password = md5($password);
		$this->password =  $password;
		$query = "SELECT email, password FROM $table WHERE email = '$email' AND password = '$password'";
		$out = mysqli_query($conn, $query);
		if (mysqli_num_rows($out) == 1) {
		 	return true;
		 }
		 return false;
		 mysqli_close($conn);
	}    

	function generate_code($email){ // generate code for doctors.
		$conn = $GLOBALS['conn'];
		$this->email = $email;
		$check_code = mysqli_query($conn, "SELECT id FROM `doctors` WHERE code IS NULL AND email = '$email'");
		$res = mysqli_query($conn, "SELECT code FROM `doctors` WHERE email = '$email'");
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randstring = [];
	    for ($i = 0; $i < 15; $i++) {
	        $randstring[$i] = $characters[rand(0, strlen($characters)-1)];
	    }
		$code = implode("", $randstring);
		if (mysqli_num_rows($check_code) == 1) {
			$query = "UPDATE doctors SET code = '$code' WHERE email = '$email'";
			$out = mysqli_query($conn, $query);
			if ($out) {
			 	return $code;
			 }
		}else{
			return mysqli_fetch_row($res)[0];
		    mysqli_close($conn);
		}
	}

	function get_my_patients($table, $id, $cond=""){
		//get patients according to this doctor.
		$conn = $GLOBALS['conn'];
		$query = "SELECT * FROM $table WHERE doctor_id = $id $cond";
		$res = mysqli_query($conn, $query);
		$outRes = mysqli_fetch_all($res, MYSQLI_ASSOC);
		if (mysqli_num_rows($res) > 0) {
			return $outRes;
		}
		return false;
		mysqli_close($conn);
	}

	function read_data($table, $email){
		$conn = $GLOBALS['conn'];
		$this->email = $email;
		$query = "SELECT * FROM $table WHERE email = '$email'";
		$res = mysqli_query($conn, $query);
		$outRes = mysqli_fetch_assoc($res);
		if (mysqli_num_rows($res) == 1) {
			return $outRes;
		}
		return false;
		mysqli_close($conn);
	}

	function set_my_appointment($id, $location){
		// get all data of a patient by his id.
		$conn = $GLOBALS['conn'];
		$query = "UPDATE appointments SET patient_id = $id WHERE location = '$location'";
		$res = mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) == 1) {
			return true;
		}
		return false;
		mysqli_close($conn);
	}

	function get_my_appointment($id){
		// get all data of a patient by his id.
		$conn = $GLOBALS['conn'];
		$this->id = $id;
		$query = "SELECT * FROM appointments WHERE patient_id = $id";
		$res = mysqli_query($conn, $query);
		$outRes = mysqli_fetch_assoc($res);
		if (mysqli_num_rows($res) == 1) {
			return $outRes;
		}
		return false;
		mysqli_close($conn);
	}

	//
	function delete_my_appointment($id){
		// 
		$conn = $GLOBALS['conn'];
		$this->id = $id;
		$query = "UPDATE appointments SET patient_id = NULL WHERE id = $id";
		$res = mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) == 1) {
			return true;
		}
		return false;
		mysqli_close($conn);
	}


	function get_data($id){
		// get all data of a patient by his id.
		$conn = $GLOBALS['conn'];
		$this->id = $id;
		$query = "SELECT * FROM patients WHERE id = $id";
		$res = mysqli_query($conn, $query);
		$outRes = mysqli_fetch_assoc($res);
		if (mysqli_num_rows($res) == 1) {
			return $outRes;
		}
		return false;
		mysqli_close($conn);
	}

	function get_all($table){
		$conn = $GLOBALS['conn'];
		$query = "SELECT * FROM $table WHERE seq IS NOT NULL";
		$res = mysqli_query($conn, $query);
		$outRes = mysqli_fetch_all($res, MYSQLI_ASSOC);
		if (mysqli_num_rows($res) > 0) {
			return $outRes;
		}
		return false;
		mysqli_close($conn);
	}

	function insert_seq($seq, $email){
		// it is obviously known that only patients will upload their sequence.
		$conn = $GLOBALS['conn'];
		$this->seq =  $seq;
		$this->email = $email;
		$query = "UPDATE patients SET seq = '$seq' WHERE email = '$email'";
		$res = mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) == 1) {
			return true;
			mysqli_close($conn);
		}
		return false;
		mysqli_close($conn);
	}

	function insert_result($id, $content){
		$conn = $GLOBALS['conn'];
		$this->id = $id;
		$query = "UPDATE patients SET result = '$content' WHERE id = $id";
		$res = mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) == 1) {
			return true;
			mysqli_close($conn);
		}
		return false;
		mysqli_close($conn);
	}

	function get_result($patient_id){
		$conn = $GLOBALS['conn'];
		$query = "SELECT result FROM patients WHERE id = $patient_id";
		$res = mysqli_query($conn, $query);
		if ($res) {
			return mysqli_fetch_assoc($res);
			mysqli_close($conn);
		}
		return false;
		mysqli_close($conn);
	}

	function insert_message($sender, $doctor_id, $patient_id, $message){
		$conn = $GLOBALS['conn'];	 
		$message = addslashes($message);
		$query = "INSERT INTO chatting (sender, doctor_id, patient_id, message) VALUES ('$sender', $doctor_id, $patient_id, '$message')";
		$out = mysqli_query($conn, $query);
		if ($out) {
		 	return true;
		 }
		 return false;
		 mysqli_close($conn);
	}

	function read_message($doctor_id, $patient_id){
		$conn = $GLOBALS['conn'];
        $query = "SELECT created_at, sender, message FROM chatting JOIN doctors ON doctors.id = chatting.doctor_id  
							 					JOIN patients ON patients.id = chatting.patient_id 
							 					WHERE chatting.doctor_id = $doctor_id AND chatting.patient_id = $patient_id ORDER BY created_at DESC";
		$res = mysqli_query($conn, $query);
		$outRes = mysqli_fetch_all($res, MYSQLI_ASSOC);
		if (mysqli_num_rows($res) > 0) {
			return $outRes;
		}
		return false;
		mysqli_close($conn);
		
	}

	function recent_chats($id){ // this is almost patient_id.
		//get recent chats names and ids (no duplicates).
		$conn = $GLOBALS['conn'];	 
		$query = "SELECT doctors.id, doctors.name FROM chatting JOIN doctors ON doctors.id = chatting.doctor_id  
					JOIN patients ON patients.id = chatting.patient_id WHERE patient_id = $id";
		$res = mysqli_query($conn, $query);
		// $outRes = mysqli_fetch_all($res, MYSQLI_ASSOC);
		$ids =array();
		$names =array();
		if (mysqli_num_rows($res) > 0) {
			 while($row = mysqli_fetch_array($res)) {
				  $ids[] = $row['id'];
				  $names[] = $row['name'];
				}
			$ids = array_unique($ids);
			$names = array_unique($names);
			return array_combine($ids, $names);
		 }
		 return false;
		 mysqli_close($conn);
	}

	function last_message($patient_id, $doctor_id){
		$conn = $GLOBALS['conn'];
		$query = "SELECT message FROM chatting JOIN doctors ON doctors.id = chatting.doctor_id  
								  JOIN patients ON patients.id = chatting.patient_id 
								  WHERE patient_id = $patient_id AND doctor_id = $doctor_id ORDER BY created_at DESC LIMIT 1";
	  	$res = mysqli_query($conn, $query);
	  	if (mysqli_num_rows($res) > 0) {
	  		return mysqli_fetch_row($res);
	  	}
	  	return false;
	  	mysqli_close($conn);
	}

	function insert_patients($name, $national_id, $id){
		// enable each doctor to insert into doctors_users.
		$conn = $GLOBALS['conn'];	 
		$query = "INSERT INTO doctors_users (name, national_id, doctor_id) VALUES ('$name', '$national_id', $id)";
		$out = mysqli_query($conn, $query);
		if ($out) {
		 	return true;
		 }
		 return false;
		 mysqli_close($conn);
	}

	function delete($table, $id){
		// enable each doctor to insert into doctors_users.
		$conn = $GLOBALS['conn'];	 
		$query = "DELETE FROM $table WHERE id = $id";
		$out = mysqli_query($conn, $query);
		if ($out) {
		 	return true;
		 }
		 return false;
		 mysqli_close($conn);
	}

	function insert_appointments($date, $time, $location, $id){
		// enable each doctor to insert into appointments.
		$conn = $GLOBALS['conn'];	 
		$DATE = "date";
		$TIME = "time"; 
		$query = "INSERT INTO appointments ($DATE, $TIME, location, doctor_id) VALUES ('$date', '$time', '$location', $id)";
		$out = mysqli_query($conn, $query);
		if ($out) {
		 	return true;
		 }
		 return false;
		 mysqli_close($conn);
	}

	function get_reserved_paient($doctor_id, $id){
		//
		$conn = $GLOBALS['conn'];
		$query = "SELECT patients.name FROM patients JOIN appointments on appointments.patient_id = patients.id WHERE appointments.doctor_id = $doctor_id AND appointments.id = $id";
		$out = mysqli_query($conn, $query);
		$outRes = mysqli_fetch_all($out, MYSQLI_ASSOC);
		if (mysqli_num_rows($out) > 0) {
		 	return $outRes;
		 }
		 return false;
		 mysqli_close($conn);
	}

	function validate_user($national_id, $code, $email){
		$conn = $GLOBALS['conn'];
		$res_1 = mysqli_query($conn, "SELECT doctor_id, national_id FROM doctors_users WHERE national_id = '$national_id'");
		$res_2 = mysqli_query($conn, "SELECT code FROM doctors WHERE code = '$code'");
		if (mysqli_num_rows($res_1) > 0 && mysqli_num_rows($res_2) > 0) {
			$id = mysqli_fetch_row($res_1)[0];
			$res_3 = mysqli_query($conn, "SELECT doctors.name FROM doctors JOIN doctors_users 
										ON doctors_users.doctor_id = doctors.id WHERE doctors_users.doctor_id = $id");
			$doc_name =  mysqli_fetch_row($res_3)[0];
			$query = "UPDATE patients SET doctor_id = $id WHERE email = '$email'";
			$out = mysqli_query($conn, $query);
			if ($out) {
				$res = [$id, $doc_name];
				return $res;
			 }
		}
		 return false;
		 mysqli_close($conn);
	}

	function check_validity($email){
		//
		$conn = $GLOBALS['conn'];
		$this->email = $email;
		$query = "SELECT doctor_id FROM patients WHERE doctor_id IS NOT NULL AND email = '$email'";
		$out = mysqli_query($conn, $query);
		if (mysqli_num_rows($out) == 1) {
		 	return true;
		 }
		 return false;
		 mysqli_close($conn);
	}

	function get_seq_name($email){
		$conn = $GLOBALS['conn'];
		$query = "SELECT seq FROM patients WHERE email = '$email'";
		$res = mysqli_query($conn, $query);
		if ($res) {
			$res = mysqli_fetch_array($res)[0];
			$res = str_split($res);
			$out = "";
			for ($i = 0; $i < count($res); $i++) {
				if ($res[$i] != '|') {
					$out .= $res[$i]; 
				}else{
					break;
				}
			}
			return $out;
			mysqli_close($conn);
		}
		return false;
		mysqli_close($conn);

	}


	// function unset_docID(){
	// 	$conn = $GLOBALS['conn'];
	// 	$query = "SELECT seq FROM patients WHERE email = '$email'";
	// 	$res = mysqli_query($conn, $query);
		
	// }

	//SELECT id, national_id FROM patients WHERE national_id IS NULL AND email = "qwwe@mail.com" check if this user has national id or not.

	// return mysqli_fetch_row($res);

	// function __destruct(){
	// 	$conn = $GLOBALS['conn'];
	// 	mysqli_close($conn);
	// }
}
// $user = new user();
// echo($user->get_seq_name("nader@gmail.com"));
// $user->delete_my_appointment(7);
// $user->set_my_appointment(3, "SPACE");
// print_r($user->get_my_appointment(2));
// print_r($user->validate_user("78978978979", "JKzwBQfJpAV6D01"));
// echo "<pre>";
// print_r($user->get_reserved_paient(1, 1));
// echo "</pre>";
// print_r($user->get_my_patients("appointments", 1));
// $user->insert_appointments("12-415-asd896", "14:16", "NY", 1);
// $user->delete("doctors_users", 29);
// $user->delete("doctors_users", 24);
// echo $user->insert_patients("test1", "16541968489984", 1);
// echo "<pre>";
// print_r($user->get_my_patients(1));
// echo "</pre>";


// print_r($user->last_message(53, 15)[0]);

// session_start();
// print_r($_SESSION);
// $user = new User();
// echo "<pre>";
// print_r($user->recent_chats(53));
// echo "</pre>";
// echo $user->get_result(53)['result'];
// if ($user->insert_message("doctor", 15, 53, "okay")) {
// 	echo "ok";
// }else{
// 	echo "string";
// }


// echo "<pre>";
// print_r($user->read_message(15, 55));
// echo "</pre>";


// if ( $user->insert_result(53, "Asdasdasda")) {
//  	echo "ok";
//  }else{
//  	echo "string";
//  }
// print_r($user->get_result(48));
// if ($user->insert_result(95, 70, "sadadsada")) {
//  	echo "ok";
//  }else{
//  	echo "string";
//  }
// print_r($user->get_data(48));
// echo($user->get_sequence("pa1")[0]);
// print_r($user->read_data("doctors", "new@mail.com"));

// $p1 = new user();
// $output = $p1->get_all();
// for ($i = 0; $i < count($output); $i++) { 
// 	echo $output[$i]['name'];
// 	echo "<br>";
// 	echo $output[$i]['email'];
// 	echo "<br>";
// 	echo $output[$i]['age'];
// }


// if ($p1->insert_seq("HIASHDIAHDAHDASIHDA","pa1@mail.com")) {
//  	echo "ok";
//  }else{
//  	echo "string";
//  }
 	



// $p1 = new user();
// $out =  ($p1->read_data("patients", "pa18@mail.com"));
// print_r($out);


// $p1->register("patients", "pasdat1", "pat1@ayahoo.com", "passdsasword", "male", "89");
// if ($p1->register("patients", "qwe", "qwe@ayaashoo.com", "qwe", "male", "89")) {
// 	echo "Added";
// }else{
// 	echo "not registered";
// }

// if ($p1->check_mail("doctors", "newUser@ayaashoo.com")) {
//  	echo "validated";
//  } else{
//  	echo "not valid";
//  }

// echo "<br/>";

// if ($p1->login("doctors", "newUser@ayaashoo.com", "asd")) {
// 	echo "logged in";
// }else{
// 	echo "not logged in";
// }