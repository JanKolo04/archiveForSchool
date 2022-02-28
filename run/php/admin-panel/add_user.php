<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add user</title>
</head>
<body>

	<form method="post">
		<input type="text" name="imie" placeholder="Name" required>
		<input type="text" name="nazwisko" placeholder="Lastname" required>
		<select name="klasa">
			<option disabled selected value>--Select--</option>
			<option>3a</option>
			<option>3b</option>
		</select>
		<select name="sepcjalizacja">
			<option disabled selected value>--Select--</option>
			<option>Informatyka</option>
			<option>Grafika</option>
		</select>

		<button type="submit" name="add">Add</button>
	</form>

	<?php

		include("../connection.php");

		if(isset($_POST['add'])) {
			add();
		}

		function add() {
			global $con;

			//name
			$name = $_POST['imie'];
			//lastname
			$lastname = $_POST['nazwisko'];
			//class
			$class = $_POST['klasa'];
			//profile
			$profile = $_POST['sepcjalizacja'];

			//path to user directory
			$path = "../images/$profile/$class/$name $lastname";
			//if directory dosen't exist create user and create directory
			if(!file_exists($path)) {
				//insert data into user
				$insertSQL = "INSERT INTO users(Imie, Nazwisko, Klasa, Profil) VALUES('$name', '$lastname', '$class', '$profile')";
				//quert add user
				$insertQuery = mysqli_query($con, $insertSQL);

				//create direcotry in local
				mkdir($path, 0777);

				//create folder on hosting
				//create_directory_for_user_in_ftp_server($path);

				/*---------APPEND LOGS TO .adminLogs.txt---------*/
				//set default timezone for date
				date_default_timezone_set("Europe/Warsaw");
				//set current date
				$date = date("d.m.y h:i:s");

				//open file to write
				$file = fopen(".adminLogs.txt", "w");
				//data to append
				$data = "Admin created user $name $lastname $class $profile at $date\n";
				//write file
				fwrite($file, $data);
				//clode file
				fclose($file);
			}
			//else show alert
			else {
				echo "<script>alert('User exist!');</script>";
			}
		}


		function create_directory_for_user_in_ftp_server($path) {
			//username
			$usernameFtp = "***";
			//password
			$passwordFtp = "**";
			//sername
			$servername = "**";

			//set up basic connection
			$ftp = ftp_connect($servername);

			//login with username and password
			$login_result = ftp_login($ftp, $usernameFtp, $passwordFtp);

			//if directory create echo Sucessfully
			if(ftp_mkdir($ftp, $path)) {
				echo "Successfully";
			}
			//else echo error
			else {
				echo "Error";
			}

		}

	?>

</body>
</html>









