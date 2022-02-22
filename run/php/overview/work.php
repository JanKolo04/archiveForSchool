<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main</title>
</head>
<body>

	<div id="holder">
		<h2 class="work_name"></h2>	
		<p class="student"></p>
		<img class="img">

	</div>

	<?php

		include("../connection.php");

		function get_data() {
			global $con, $arrayImportDataToJS;
			//get id from url
			$id_work = $_GET['work'];
			//get all data from row where id=id_work
			$findUser = "SELECT * FROM user_works WHERE id='$id_work'";
			$findUserQuery = mysqli_query($con, $findUser);

			//loop to push data to arrayData
			$arrayData = [];
			foreach($findUserQuery as $key=>$value) {
				$arrayData[$key] = $value;
			}

			//path where we have our image
			$path = "../all/{$arrayData[0]['Profil']}/{$arrayData[0]['Klasa']}/{$arrayData[0]['Imie']} {$arrayData[0]['Nazwisko']}/{$arrayData[0]['work_name']}";

			/*
				-------INFOR ABOUT THIS LOOP-----
				this loop is for get file name.
				Yes we can use expload but if 
				student use dot in file name so code won't
				get correct file name

			*/
			$fileName = "";
			//length of file name
			$lenWorkName = strlen($arrayData[0]['work_name']);
			//last fot variable 
			$lastDot;
			for($i=$lenWorkName - 1; $i>=0; $i--) {
				//when loop will encounter dot break the loop and
				//save dot position 
				if($arrayData[0]['work_name'][$i] == '.') {
					$lastDot = $i;
					break;
				}
			}

			//and last loop append other chars into var
			for($i=0; $i<$lastDot; $i++) {
				$fileName .= $arrayData[0]['work_name'][$i];
			}

			//this array is importing to JS for better show 
			//data in website
			$arrayImportDataToJS = [
				"path"=>$path,
				"work_name"=>$fileName,
				"studentName"=>$arrayData[0]['Imie'],
				"studentLastname"=>$arrayData[0]['Nazwisko']
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
			//set src for img
			let img = document.querySelector(".img");
			img.src = arrayImportDataFromPHP["path"];
		}

		show_img();

	</script>

	<style type="text/css">
		#holder {
			display: flex;
			justify-content: center;
			text-align: center;
			flex-direction: column;
			width: 100%;
		}

		.work_name {
			text-align: center;
		}

		.img {
			margin: auto;
			width: 300px;
		}

	</style>

</body>
</html>