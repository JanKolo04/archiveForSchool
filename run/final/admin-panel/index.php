<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nawigacja</title>
</head>
<body>

	<h2>Nawigacja</h2>

	<a href="search_user_page.php">Szukaj ucznia</a><br>
	<a href="add_user.php">Dodaj ucznia</a>


	<?php

		session_start();

		if(!isset($_SESSION['login'])) {
			header("Location: login.php");
		}

	?>

</body>
</html>