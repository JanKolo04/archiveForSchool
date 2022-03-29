<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!---------------JS ANS CSS FILES--------------->
	<link rel="stylesheet" type="text/css" href="css/style-previewPage.css">
	<script type="text/javascript" src="viewCounter/timer-for-view.js"></script>
	<!-------AJAX------>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!------------------PLUGINS------------------>
	<!-------BOOSTRAP------>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-------ICON------>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>View</title>
</head>
<body>

	<div id="baner">
		<div id="divLogo">
			<a href="mainPage.php"><img id="logo" src="images/logoZSK.png"></a>
		</div>
	</div>

	<div id="main">
		<div id="mainInfoDiv">
			<div id="textsDiv">
				<div id="headerDiv">
					<div id="backDiv">
						<a id="backButton" href="javascript: window.history.back()"><i class="fa fa-long-arrow-left"></i> wróć</a>
					</div>
					<div id="workNameDiv">
						<h2 id="work_name"></h2>
					</div>
				</div>

				<div id="nameLastnameDiv">
					<p id="nameLastname"></p>
				</div>

				<div id="descriptionDiv">
					<p id="description"></p>
				</div>
			</div>

			<div id="workDiv">
				<img id="work">
			</div>
		</div>


		<footer id="footer">
			<div id="infoDiv">
				<p><strong>Administrator</strong><br>
				Filip Mozol<br>
				fmozol@technikumkreatywne.pl</p>
			</div>

			<div  id="autorAndIconsDiv">
				<div id="autorDiv">
					<p id="autor"><strong>Autor Jan Kołodziej</strong></p>
				</div>

				<div id="iconsDiv">
					<a href="https://www.facebook.com/SzkolyKreatywne"><img src="images/icons/facebook.png"></a>
					<a href=""><img src="images/icons/instagram.png"></a>
					<a href="https://szkolykreatywne.pl/"><img src="images/icons/google.png"></a>
					<a href=""><img src="images/icons/youtube.png"></a>
				</div>
			</div>
		</footer>
	</div>


	<?php

		session_start();

		include("connection.php");

		//varibale to import to upload-data.php
		$_SESSION['work_id'] = $_GET['work'];

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
			$path = "data/{$arrayUser[0]['Klasa']}/{$arrayUser[0]['Profil']}/{$arrayUser[0]['Imie']} {$arrayUser[0]['Nazwisko']}/{$arrayWorks[0]['file_name']}";

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
			let work_name = document.querySelector("#work_name");
			work_name.innerHTML = arrayImportDataFromPHP['work_name'];
			//student p
			let student = document.querySelector('#nameLastname');
			student.innerHTML = arrayImportDataFromPHP['studentName']+" "+arrayImportDataFromPHP['studentLastname'];
			//description
			let description = document.querySelector('#description');
			description.innerHTML = arrayImportDataFromPHP['description'];

			//set src for img
			let img = document.querySelector("#work");
			img.src = arrayImportDataFromPHP["path"];
	
		}

		show_img();

	</script>

</body>
</html>














