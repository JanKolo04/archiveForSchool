<?php

	include("../connection.php");

	function delete_user() {
		global $con;
		//get user_id from POST
		$user_id = $_POST['user_id'];

		//SQL delete
		$delete = "DELETE FROM users WHERE id='$user_id'";
		//query delete
		$query_delete = mysqli_query($con, $delete);

		header("Refresh:0");
	}

	if(isset($_POST['user_id'])) {
		delete_user();
	}


?>