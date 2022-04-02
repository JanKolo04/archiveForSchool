<?php

	include("../connection.php");

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

	if(isset($_POST['array_user_id'])) {
		delete_user();
	}


?>