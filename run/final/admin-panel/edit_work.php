<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-edit-work.css">
	<title>Edit work</title>
</head>
<body>

	<form method="post">
		<div id="allStuff">
			<h2>Edit work</h2>
			<div id="inputsDiv">
				<div id="inputsEditsDiv">
					<input type="text" name="editWork_name" id="editWork_name" placeholder="Change work name">
					<input type="text" name="editDescription" id="editDescription" placeholder="Change description">

					<select id="tags" multiple name="tags[]">
						<option id="Fotografia" value="Fotografia">Fotografia</option>
						<option id="Grafika" value="Grafika">Grafika</option>
						<option id="Animacja" value="Animacja">Animacja</option>
						<option id="Film" value="Film">Film</option>
						<option id="Gra" value="Gra">Gra</option>
						<option id="Aplikacja" value="Aplikacja">Aplikacja</option>
						<option id="Strona" value="Strona">Strona</option>
						<option id="Dźwięk" value="Dźwięk">Dźwięk</option>
						<option id="Makieta" value="Makieta">Makieta</option>
						<option id="Rzeźba" value="Rzeźba">Rzeźba</option>
						<option id="Tekst" value="Tekst">Tekst</option>
						<option id="Inne" value="Inne">Inne</option>
					</select>
				</div>

				<div id="submitAndback">
					<div id="backButtonDiv"></div>

					<div id="submitEditButtonDiv">
						<button type="submit" name="editSubmit">Edit</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php

		session_start();

		include('../connection.php');


		if(!isset($_SESSION['login'])) {
			header("Location: login.php");
		}

		if(isset($_POST['editSubmit'])) {
			change_work_name_or_description();
		}

		function get_works() {
			global $con, $arrayWithWorks;
			$works_id = $_GET['work'];

			$getDataFromSQLWorks = "SELECT work_name, description, id_user, category FROM user_works WHERE id='$works_id'";
			//if query data == true do code else return error
			if($queryDataWorks = mysqli_query($con, $getDataFromSQLWorks)) {
				//if query return zero record code will return error
				if($queryDataWorks->num_rows > 0) {
					//array for data from query
					$arrayWithWorks = [];
					while($row = mysqli_fetch_array($queryDataWorks)) {
						//append data into array
						$arrayWithWorks = [
							"description"=>$row['description'],
							"work_name"=>$row['work_name'],
							"user_id"=>$row['id_user'],
							"category"=>$row['category']
						];
					}
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}
			
		}

		get_works();


		function change_work_name_or_description() {
			global $con;
			//get data from edit inputs
			$work_id = $_GET['work'];
			//work name input
			$workNameEdit = $_POST['editWork_name'];
			//description input
			$descriptionEdit = $_POST['editDescription'];

			//array with tags
			$options = $_POST['tags'];
			//empty variable for tags
			$tags = "";
			//loop get all elements from POST
			for($i=0; $i<sizeof($options); $i++) {
				//append vlue to variable 
				$tags .= $options[$i];
				//if i isn't last value add comma after append value to var 
				if($i != sizeof($options)-1) {
					$tags .= ",";
				}
			}

			//sql query
			$sqlCheck = "SELECT user_works.work_name, user_works.description, user_works.category, users.Imie, users.Nazwisko, users.Klasa, users.Profil FROM user_works INNER JOIN users ON user_works.id_user=users.id WHERE user_works.id='$work_id'";

			if($queryCheck = mysqli_query($con, $sqlCheck)) {
				//array for data from sqlCheck
				$arrayWithCheckData = [];
				while($row = mysqli_fetch_array($queryCheck)) {
					//append data
					$arrayWithCheckData = [
						"work_name"=>$row['work_name'],
						"description"=>$row['description'],
						"category"=>$row['category'],
						"Name"=>$row['Imie'],
						"Lastname"=>$row['Nazwisko'],
						"Profile"=>$row['Profil'],
						"Class"=>$row['Klasa']
					];
				}

				//if work is different or description then data in db do update db
				if($arrayWithCheckData['work_name'] != $workNameEdit || $arrayWithCheckData['description'] != $descriptionEdit || $arrayWithCheckData['category'] != $tags) {
					//update data
					$sqlChange = "UPDATE user_works SET work_name='$workNameEdit', description='$descriptionEdit', category='$tags' WHERE id='$work_id'";
					$queryChange = mysqli_query($con, $sqlChange);

					/*---------APPEND LOGS TO .adminLogs.txt---------*/
					//set default timezone for date
					date_default_timezone_set("Europe/Warsaw");
					//set current date
					$date = date("d.m.y h:i:sa");

					//open file to write
					$file = fopen(".adminLogs.txt", "a");
					//data to append
					$data = "Admin edited work for {$arrayWithCheckData['Name']} {$arrayWithCheckData['Lastname']} {$arrayWithCheckData['Class']} {$arrayWithCheckData['Profile']} at $date\n\tChnages:\n\t\tWork name: {$arrayWithCheckData['work_name']} => $workNameEdit,\n\t\tDescription: {$arrayWithCheckData['description']} => $descriptionEdit\n\n";
					//write file
					fwrite($file, $data);
					//clode file
					fclose($file);
				}


				//if data is same code will return alert
				else if(($arrayWithCheckData['work_name'] == $workNameEdit) && ($arrayWithCheckData['description'] == $descriptionEdit) && ($arrayWithCheckData['category'] == $tags)) {
					//alert
					echo "<script>alert('Data are same');</script>";
				}
				//if error return alert with error
				else {
					echo "<script>alert('Error');</script>";
				}
				
			}
			else {
				echo "<script>alert('Error');</script>";
			}

		}
	?>

	<script type="text/javascript">
		
		function set_value_for_input() {
			//get array with work data
			const worksArray = <?php echo json_encode($arrayWithWorks);?>;
			//inputs
			if(worksArray != null) {
				let editWork_name = document.querySelector('#editWork_name');
				let editDescription = document.querySelector('#editDescription');
				//tags select
				let editCategory = document.querySelector('#tags');

				//div for back button
				let backButtonDiv = document.querySelector('#backButtonDiv');
				//create back button
				let backButton = document.createElement("a");
				//class name
				backButton.className = "backButton";
				//set text
				backButton.innerHTML = "Back";
				//set href
				backButton.href = "user_profile_page.php?user="+worksArray['user_id'];
				//append button to div
				backButtonDiv.appendChild(backButton);


				//split category
				let splitCategory = worksArray['category'].split(',');
				//loop to select category options
				for(let i=0; i<splitCategory.length; i++) {
					//select option
					editCategory.options.namedItem(splitCategory[i]).selected = "selected";
				}
				

				//set value for input work name
				editWork_name.value = worksArray['work_name'];
				//set value for input description
				editDescription.value = worksArray['description'];
			}
		}		

		window.onload = function() {
			set_value_for_input();
		}

	</script>


</body>
</hmtl>







