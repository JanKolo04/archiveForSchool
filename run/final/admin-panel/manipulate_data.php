<?php

	include("../connection.php");

	if(isset($_POST['array_user_id'])) {
		delete_user();
	}

	if(isset($_POST['work_id'])) {
		delete_work();
	}

	if(isset($_POST['work'])) {
		add_work();
	}

	function delete_user() {
		global $con;
		//get user_id from POST
		$user_id = $_POST['array_user_id'];

		for($i=0; $i<sizeof($user_id); $i++) {
			//get user dir
			$getDirSQL = "SELECT * FROM users WHERE id='$user_id[$i]'";
			//query
			$getDataQuery = mysqli_query($con, $getDirSQL);

			//append all needed elements to path
			//path
			$path = "../data";
			while($row = mysqli_fetch_array($getDataQuery)) {
				//append data
				$path .= '/'.$row['Klasa'].'/'.$row['Profil'].'/'.$row['Imie'].' '.$row['Nazwisko'];
			}


			//SQL delete
			$delete = "DELETE FROM users WHERE id='$user_id[$i]'";
			//query delete
			$query_delete = mysqli_query($con, $delete);

			//delete user dir and all conntents
			array_map('unlink', glob("$path/*.*"));
			rmdir($path);
		}
	}


	function delete_work() {
		global $con;
		//get work id from POST
		$work_id = $_POST['work_id'];
		
		for($i=0; $i<sizeof($work_id); $i++) {
			//get work name
			$getWorkNameSQL = "SELECT users.Imie, users.Nazwisko, users.Klasa, users.Profil, user_works.file_name FROM user_works INNER JOIN users ON user_works.id_user=users.id WHERE user_works.id='$work_id[$i]'";

			$getWorkNameQuery = mysqli_query($con, $getWorkNameSQL);

			
			//path
			$path = "../data/";
			while($row = mysqli_fetch_array($getWorkNameQuery)) {
				//path to file
				$path .= $row['Klasa'].'/'.$row['Profil'].'/'.$row['Imie'].' '.$row['Nazwisko'].'/'.$row['file_name'];
			}

			//remove work
			$removeSQL = "DELETE FROM user_works WHERE id='$work_id[$i]'";
			$removeQuery = mysqli_query($con, $removeSQL);

			//unsent file
			//unlink($path);

		}

	}


	function add_work() {
		global $con;

		//get array from post
		$arrayWork = $_POST['work'];

		//set default timezone for date
		date_default_timezone_set("Europe/Warsaw");
		//set current date
		$date = date("d.m.y h:i:s");

		$fileNameDate = $date.'.'.$arrayWork['fileExt'];
		//inset work to server
		move_uploaded_file($arrayWork['fileTmp'],$arrayWork['dir'].$fileNameDate);

		//insert data into data base
		$sendSQL = "INSERT INTO user_works(id_user, file_name, work_name, category, description) VALUES('{$arrayWork['id']}', '$fileNameDate', '{$arrayWork['work_name']}', 'Inne', '{$arrayWork['description']}')";
		$queryInsertWork = mysqli_query($con, $sendSQL);
		
		/*---------APPEND LOGS TO .adminLogs.txt---------*/
		//data to append adminLog
		$data = "Admin added work for user $name $lastname $class $profile at $date\n";
		//append $data to function which append data into .adminLog.txt
		append_data_into_adminLog($data);

		header("user_profile_page.php?user={$arrayWork['id']}");
	}


	function append_data_into_adminLog($data) {
		//set default timezone for date
		date_default_timezone_set("Europe/Warsaw");
		//set current date
		$date = date("d.m.y h:i:s");

		//open file to write
		$file = fopen(".adminLogs.txt", "a");

		//write file
		fwrite($file, $data);
		//clode file
		fclose($file);
	}


?>




