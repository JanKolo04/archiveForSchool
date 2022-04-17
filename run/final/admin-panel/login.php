<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-login.css">
	<title>Login</title>
</head>
<body>

	<div id="holder">
		<div id="textHolder">
			<h1>Login</h1>
		</div>
		<form method='POST'>
			<div id="inputsHolder">
				<input type='text' name='login' id='login' placeholder='Login...'>
				<input type='password' name='password' id='passsword' placeholder='Password...'>
			</div>

			<div id="buttonHolder">
				<button type='submit' name='loginButton' id="button">Submit</button>
			</div>
		</form>
	</div>

	<?php

		session_start();

		include("../connection.php");

		$logged = 0;

		if(isset($_POST['loginButton'])) {
			check_user();
		}



		function check_user() {
			global $con, $logged;
			//get login
			$login = $_POST['login'];
			//get password
			$password = $_POST['password'];

			//check if admin exist
			$sqlCheck = "SELECT login, password FROM admin WHERE login='$login'";
			if($queryCheck = mysqli_query($con, $sqlCheck)) {
				if($queryCheck->num_rows > 0) {
					while($row = mysqli_fetch_array($queryCheck)) {
						if($row['password'] == $password) {
							$_SESSION['login'] = true;
							header("Location: index.php");
							echo "Successfully";
						}
						else {
							echo "<script>alert('Wrong password!');</script>";
						}
					}
				}
				else {
					echo "<script>alert('Wrong login!');</script>";
				}
			}
		}

	?>

</body>
</html>