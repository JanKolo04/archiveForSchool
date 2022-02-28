<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style-edit-work.css">
	<title>Edit work</title>
</head>
<body>

	<?php

		include('../connection.php');

		if(isset($_POST['editSubmit'])) {
			change_work_name_or_descriptoin();
		}

		function edit_page() {
			echo "
				<form method='post'>
					<div id='allStuff'>
						<h2>Edit work</h2>
						<div id='inputsDiv'>
							<div id='inputsEditsDiv'>
								<input type='text' name='editWork_name' id='editWork_name' placeholder='Change work name'>
								<input type='text' name='editDescription' id='editDescription' placeholder='Change description'>
							</div>

							<div id='submitAndback'>
								<div id='backButtonDiv'></div>

								<div id='submitEditButtonDiv'>
									<button type='submit' name='editSubmit'>Edit</button>
								</div>
							</div>
						</div>
					</div>
				</form>

			";
		}

		edit_page();

		function get_works() {
			global $con, $arrayWithWorks;
			//get works id from 
			$works_id = $_GET['work'];

			$getDataFromSQLWorks = "SELECT * FROM user_works WHERE id='$works_id'";
			//if query data == true do code else return error
			if($queryDataWorks = mysqli_query($con, $getDataFromSQLWorks)) {
				//if query return zero record code will return error
				if($queryDataWorks->num_rows > 0) {
					//array for data from query
					$arrayWithWorks = [];
					$counter = 0;
					while($row = mysqli_fetch_array($queryDataWorks)) {
						//append data into array
						$arrayWithWorks[$counter] = [
							"id_work"=>$row['id'],
							"description"=>$row['description'],
							"work_name"=>$row['work_name'],
							"user_id"=>$row['id_user']
						];
						$counter++;
					}
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}
		}

		get_works();


		function change_work_name_or_descriptoin() {
			global $con;
			//get data from edit inputs
			//work name input
			$workNameEdit = $_POST['editWork_name'];
			//description input
			$descriptionEdit = $_POST['editDescription'];

			//optoin value
			$work_id = $_GET['work'];

			//sql query
			$sqlCheck = "SELECT work_name, description FROM user_works WHERE id='$work_id'";
			if($queryCheck = mysqli_query($con, $sqlCheck)) {
				if($queryCheck->num_rows > 0) {
					//array for data from sqlCheck
					$arrayWithCheckData = [];
					while($row = mysqli_fetch_array($queryCheck)) {
						//append data
						$arrayWithCheckData = [
							"work_name"=>$row['work_name'],
							"description"=>$row['description']
						];
					}

					//if work is different or description then data in db do update db
					if($arrayWithCheckData['work_name'] != $workNameEdit || $arrayWithCheckData['description'] != $descriptionEdit) {
						//update data
						$sqlChange = "UPDATE user_works SET work_name='$workNameEdit', description='$descriptionEdit' WHERE id='$work_id'";
						$queryChange = mysqli_query($con, $sqlChange);

						/*---------APPEND LOGS TO .adminLogs.txt---------*/
						//set default timezone for date
						date_default_timezone_set("Europe/Warsaw");
						//set current date
						$date = date("d.m.y h:i:sa");

						//open file to write
						$file = fopen(".adminLogs.txt", "a");
						//data to append
						$data = "Admin edited work for $name $lastname $class $profile at $date\n";
						//write file
						fwrite($file, $data);
						//clode file
						fclose($file);
					}


					//if data is same code will return alert
					else if(($arrayWithCheckData['work_name'] == $workNameEdit) && ($arrayWithCheckData['description'] == $descriptionEdit)) {
						//alert
						echo "<script>alert('Data is same');</script>";
					}
					//if error return alert with error
					else {
						echo "<script>alert('Error');</script>";
					}
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}

		}

	?>



	<script type="text/javascript">

		function set_value_for_input(event) {
			//get array with work data
			const worksArray = <?php echo json_encode($arrayWithWorks);?>;
			//inputs
			let editWork_name = document.querySelector('#editWork_name');
			let editDescription = document.querySelector('#editDescription');

			//div for back button
			let backButtonDiv = document.querySelector('#backButtonDiv');
			//create back button
			let backButton = document.createElement("a");
			//class name
			backButton.className = "backButton";
			//set text
			backButton.innerHTML = "Back";
			//set href
			backButton.href = "search_user_admin.php?user_id="+worksArray[0]['user_id'];
			//append button to div
			backButtonDiv.appendChild(backButton);


			//set value for input work name
			editWork_name.value = worksArray[0]['work_name'];
			//set value for input description
			editDescription.value = worksArray[0]['description'];
			
		}
		set_value_for_input();
	</script>


</body>
</html>