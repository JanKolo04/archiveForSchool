<!DOCTYPE html>
<html lang="pl-PL">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add user</title>
</head>
<body>

	<form method="post">
<<<<<<< HEAD
		<input type="text" name="name" placeholder="Name" id="name" required value="<?php echo $_POST['name']?>">
		<input type="text" name="lastname" placeholder="Lastname" id="lastname" required value="<?php echo $_POST['lastname']?>">
		<select name="class" id="class">
=======
		<input type="text" name="imie" placeholder="Name" required>
		<input type="text" name="nazwisko" placeholder="Lastname" required>
		<select name="klasa">
>>>>>>> f3eb130f0a0f20fcc226b07391ce8419a3e16729
			<option disabled selected value>Select class</option>
			<option value="1a">1a</option>
			<option value="1b">1b</option>
			<option value="1c">1c</option>

			<option value="2a">2a</option>
			<option value="2b">2b</option>
			<option value="2c">2c</option>

			<option value="3a">3a</option>
			<option value="3b">3b</option>
			<option value="3c">3c</option>
			<option value="3d">3d</option>
			<option value="3e">3e</option>
			<option value="3f">3f</option>
			<option value="3g">3g</option>
			<option value="3h">3h</option>

			<option value="4a">4a</option>
			<option value="4b">4b</option>
			<option value="4c">4c</option>

			<option value="absolwenci">Absolwenci</option>
		</select>
		
<<<<<<< HEAD
		<select name="major" id="major">
=======
		<select name="sepcjalizacja">
>>>>>>> f3eb130f0a0f20fcc226b07391ce8419a3e16729
			<option disabled selected value>Select profile</option>
			<option value="Grafika komputerowa">Grafika komputerowa</option>
			<option value="Tworzenie gier">Tworzenie gier</option>
			<option value="Fotografia kreatywna">Fotografia kreatywna</option>
			<option value="Animacja komputerowa">Animacja komputerowa</option>
		</select>

		<button type="submit" name="add" id="add">Add</button>
	</form>


	<?php

		session_start();

		include("../connection.php");

		$success = 0;

		if(!isset($_SESSION['login'])) {
			header("Location: login.php");
		}

		if(isset($_POST['add'])) {
			add();
		}

		function add() {
			global $con, $success, $class, $major;

			//name
			$name = $_POST['name'];
			//lastname
			$lastname = $_POST['lastname'];
			//class
<<<<<<< HEAD
			$class = $_POST['class'];
			//major
			$major = $_POST['major'];
=======
			$class = $_POST['klasa'];
			//major
			$major = $_POST['sepcjalizacja'];
>>>>>>> f3eb130f0a0f20fcc226b07391ce8419a3e16729

			//path to user directory
			$path = "../data/$class/$major/$name $lastname";
			//if directory dosen't exist create user and create directory
			if(!file_exists($path)) {
				$success = 1;
				//insert data into user
				$insertSQL = "INSERT INTO users(Imie, Nazwisko, Klasa, Profil) VALUES('$name', '$lastname', '$class', '$major')";
				//quert add user
				$insertQuery = mysqli_query($con, $insertSQL);

				//if class dir dosent exist create dirvetory
				if(!file_exists("../data/$class")) {
					//create class dir
					mkdir("../data/$class", 0777);
				}
				//if major dir dosent exist create directory
				if(!file_exists("../data/$class/$major")) {
					//create direcotry
					mkdir("../data/$class/$major", 0777);
				}
				//create surdent directory
				mkdir($path, 0777);

				/*---------APPEND LOGS TO .adminLogs.txt---------*/
				//set default timezone for date
				date_default_timezone_set("Europe/Warsaw");
				//set current date
				$date = date("d.m.y h:i:sa");

				//open file to write
				$file = fopen(".adminLogs.txt", "a");
				//data to append
				$data = "Admin created user $name $lastname $class $major at $date\n";
				//write file
				fwrite($file, $data);
				//clode file
				fclose($file);
			}
			//else show alert
			else {
				$success = 2;
				echo "<script>alert('User exist!');</script>";
			}
		}

	?>
<<<<<<< HEAD


	<script type="text/javascript">
		
		function clear_inputs_fileds_after_success_add_work() {
			//get success value from php
			let success = <?php echo json_encode($success);?>;

			//get value from class select
			let selectClassValue = <?php echo json_encode($class);?>;
			//get value from major select
			let selectMajorValue = <?php echo json_encode($major);?>;

			//if success is 1 clear all inputs
			if(success == 1) {
				//clear inputs
				document.querySelector("#name").value = "";
				document.querySelector("#lastname").value = "";
			}
			else if(success == 2) {
				//select value if success is 0
				document.querySelector('#class').value = selectClassValue;
				document.querySelector('#major').value = selectMajorValue;
			}
		}

		window.onload = function() {
			clear_inputs_fileds_after_success_add_work();
		}

	</script>
=======
>>>>>>> f3eb130f0a0f20fcc226b07391ce8419a3e16729

</body>
</html>









