<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add user</title>
</head>
<body>

	<form method="post">
		<input type="text" name="imie">
		<input type="text" name="nazwisko">
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
			$profil = $_POST['sepcjalizacja'];

			//insert data into user
			$insertSQL = "INSERT INTO users(Imie, Nazwisko, Klasa, Profil) VALUES('$name', '$lastname', '$class', '$profil')";
			//quert add user
			$insertQuery = mysqli_query($con, $insertSQL);
		}

	?>

</body>
</html>