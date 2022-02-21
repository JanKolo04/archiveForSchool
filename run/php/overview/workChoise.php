<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Podglad</title>
</head>
<body>

	<form method="post">
		<button name="submit" type="submit">Submit</button>
	</form>

	<?php

		include("../connection.php");

		if(isset($_POST['submit'])) {
			run();
		}

		function run() {
			global $con;

			$all = "SELECT * FROM works";
			$queryAll = mysqli_query($con, $all);

			while($row = mysqli_fetch_array($queryAll)) {
				echo ("<tr><td>".$row['Imie']." </td><td>".$row['Nazwisko']." </td><td>".$row['Klasa']." </td><td><a href='work.php?work=".$row['id']."'>Podgląd</a></tr><br>");
			}
		}



	?>

</body>
</html>