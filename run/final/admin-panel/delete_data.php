<?php

	include("../connection.php");

	if(isset($_POST['array_user_id'])) {
		delete_user();
	}

	if(isset($_POST['work_id'])) {
		delete_work();
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

			//delete user dir
			rmdir($path);
		}
	}


	function delete_work() {
		global $con;
		//get work id from POST
		$work_id = $_POST['work_id'];
		//get array with user data from POST
		$arrayWithUserData = $_POST['userData'];
		
		//get work name
		$getWorkNameSQL = "SELECT file_name FROM user_works WHERE id='$work_id'";
		$getWorkNameQuery = mysqli_query($con, $getWorkNameSQL);
		//append reslut to variable
		$arrayWithFile_name = mysqli_fetch_array($getWorkNameQuery);

		//remove work
		$removeSQL = "DELETE FROM user_works WHERE id='$work_id'";
		$removeQuery = mysqli_query($con, $removeSQL);


		//path to file
		$pathToFile = "../data/".$arrayWithUserData["Class"]."/".$arrayWithUserData['Profile']."/".$arrayWithUserData['Name']." ".$arrayWithUserData['Lastname']."/".$arrayWithFile_name['file_name'];

		//if code cant delete file return error
		if(!unlink($pathToFile)) {
			echo "<script> alert('Error'); </script>";
		}

	}




?>




