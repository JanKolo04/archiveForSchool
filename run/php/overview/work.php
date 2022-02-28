<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style-work-view.css">
	<title>Main</title>
</head>
<body>

	<div id="holder">
		<h2 class="work_name"></h2>	
		<p class="student"></p>
		<p class="description"></p>
		<img class="img">

	</div>

	<?php

		include("../connection.php");

		function get_data() {
			global $con, $arrayImportDataToJS;
			//get id from url
			$id_work = $_GET['work'];

			//get all data from row where id=id_work
			$findWorks = "SELECT * FROM user_works WHERE id='$id_work'";
			$findWorksQuery = mysqli_query($con, $findWorks);

			//loop to push works to arrayWorks
			$arrayWorks = [];
			foreach($findWorksQuery as $key=>$value) {
				$arrayWorks[] = $value;
			}

			//user id
			$user_id = $arrayWorks[0]['id_user'];
			//find user woth id=user_id
			$findUser = "SELECT * FROM users WHERE id='$user_id'";
			$findUserQuery = mysqli_query($con, $findUser);

			//loop to push user data to arrayUser
			$arrayUser = [];
			foreach($findUserQuery as $key=>$value) {
				$arrayUser[] = $value;
			}


			//path where we have our image
			$path = "../images/{$arrayUser[0]['Profil']}/{$arrayUser[0]['Klasa']}/{$arrayUser[0]['Imie']} {$arrayUser[0]['Nazwisko']}/{$arrayWorks[0]['file_name']}";


			//this array is importing to JS for better show 
			//data in website
			$arrayImportDataToJS = [
				"path"=>$path,
				"work_name"=>$arrayWorks[0]['work_name'],
				"description"=>$arrayWorks[0]['description'],
				"studentName"=>$arrayUser[0]['Imie'],
				"studentLastname"=>$arrayUser[0]['Nazwisko']
			];

		}
		get_data();

	?>


	<script type="text/javascript">
		//function for show data on webiste form PHP
		function show_img() {
			//get importing array from PHP
			const arrayImportDataFromPHP = <?php echo json_encode($arrayImportDataToJS); ?>;
			//work name h2
			let work_name = document.querySelector(".work_name");
			work_name.innerHTML = arrayImportDataFromPHP['work_name'];
			//student p
			let student = document.querySelector('.student');
			student.innerHTML = arrayImportDataFromPHP['studentName']+" "+arrayImportDataFromPHP['studentLastname'];
			//description
			let description = document.querySelector('.description');
			description.innerHTML = arrayImportDataFromPHP['description'];
			//set src for img
			let img = document.querySelector(".img");
			img.src = arrayImportDataFromPHP["path"];
		}

		show_img();

	</script>

</body>
</html>