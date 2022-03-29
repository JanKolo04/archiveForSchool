<?php
	
	session_start();

	include("../connection.php");

	function set_view_count() {
		global $con;
		//get work id from session
		$work_id = $_SESSION['work_id'];

		//check variable in view
		$sqlCheck = "SELECT view FROM user_works WHERE id='$work_id'";
		$queryCheck = mysqli_query($con, $sqlCheck);
		//add queryCheck into array
		$arrayCheck = mysqli_fetch_array($queryCheck);
		//if view equals NULL set 1
		if($arrayCheck['view'] == NULL) {
			//inset view data
			$sql = "UPDATE user_works SET view=1 WHERE id='$work_id'";
			//send query
			$query = mysqli_query($con, $sql);	
		}
		//but if view equals some number plus 1
		else {
			//inset view data
			$sql = "UPDATE user_works SET view=view+1 WHERE id='$work_id'";
			//send query
			$query = mysqli_query($con, $sql);
		}
	}

	if(isset($_POST['view'])) {
		set_view_count();
	}


?>