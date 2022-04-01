<?php

	include("../connection.php");

	function delete_user() {
		global $con;
		//get user_id from POST
		$user_id = $_POST['array_user_id'];

		for($i=0; $i<sizeof($user_id); $i++) {
			//SQL delete
			$delete = "DELETE FROM users WHERE id='$user_id[$i]'";
			//query delete
			$query_delete = mysqli_query($con, $delete);
		}
	}

	if(isset($_POST['array_user_id'])) {
		delete_user();
	}


?>