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
		
		<select name="sepcjalizacja">
			<option disabled selected value>Select profile</option>
			<option value="Grafika komputerowa">Grafika komputerowa</option>
			<option value="Tworzenie gier">Tworzenie gier</option>
			<option value="Fotografia kreatywna">Fotografia kreatywna</option>
			<option value="Animacja komputerowa">Animacja komputerowa</option>
		</select>

		<button type="submit" name="add">Add</button>
	</form>


	<?php

		session_start();

		include("../connection.php");

		if(!isset($_SESSION['login'])) {
			header("Location: login.php");
		}

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
			$path = "../data/$class/$profile/$name $lastname";
			//if directory dosen't exist create user and create directory
			if(!file_exists($path)) {
				//insert data into user
				$insertSQL = "INSERT INTO users(Imie, Nazwisko, Klasa, Profil) VALUES('$name', '$lastname', '$class', '$profile')";
				//quert add user
				$insertQuery = mysqli_query($con, $insertSQL);

				//create direcotry in local
				//mkdir($path, 0777);

				//create folder on hosting
				create_directory_for_user_in_ftp_server($path);

				/*---------APPEND LOGS TO .adminLogs.txt---------*/
				//set default timezone for date
				date_default_timezone_set("Europe/Warsaw");
				//set current date
				$date = date("d.m.y h:i:sa");

				//open file to write
				$file = fopen(".adminLogs.txt", "a");
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

		//function to check if student class exist or others dir exists
		function check_if_folders_exists($path, $ftp_connection) {			
			//split path to chech if 
			$splitPath = explode('/', $path);

			//class var from split
			$class = $splitPath[2];
			//profile var from split
			$profile = $splitPath[3];

			//if dosent exist 
			if(!ftp_nlist($ftp_connection, $class) === false) {
				ftp_mkdir($ftp_connection, '../data/'.$class);
				ftp_chmod($ftp_connection, 0777, $class);
			}

			if(!ftp_nlist($ftp_connection, $profile) === false) {
				ftp_mkdir($ftp_connection, '../data/'.$class.'/'.$profile);
				ftp_chmod($ftp_connection, 0777, $profile);
			}
			print_r($splitPath);

		}


		function create_directory_for_user_in_ftp_server($path) {
			//username
			$usernameFtp = "jkolodziej@labzsk.webd.pro";
			//password
			$passwordFtp = "sq8++PHyK+JU";
			//sername
			$servername = "ftp.labzsk.webd.pro";

			//set up basic connection
			$ftp = ftp_connect($servername);

			//login with username and password
			$login_result = ftp_login($ftp, $usernameFtp, $passwordFtp);

			//maybe we will useing this in future
			//$folder_exists = is_dir('ftp://user:password@example.com/some/dir/path');

			//split path to chech if 
			$splitPath = explode('/', $path);

			//class var from split
			$class = "../data/$splitPath[2]";
			//profile var from split
			$profile = "../data/$class/$splitPath[3]";

			//create class dir
			ftp_mkdir($ftp, $class);
			//set chmod for class dir
			ftp_chmod($ftp, 0777, $class);
			
			//create profile dir
			ftp_mkdir($ftp, $profile);
			//set chmod for profile dir
			ftp_chmod($ftp, 0777, $profile);
			

			//if direcotry with name and last name dosent exist return error
			if(ftp_mkdir($ftp, $path)) {
				ftp_chmod($ftp, 0777, $path);
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









