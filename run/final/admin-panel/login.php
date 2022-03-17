<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>

	<form method='POST'>
		<input type='text' name='login' id='login' placeholder='Login...'>
		<input type='password' name='password' id='passsword' placeholder='Password...'>

		<button type='submit' name='loginButton'>Submit</button>
	</form>

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
							echo "Worng password";
						}
					}
				}
				else {
					echo "Wrong login";
				}
			}
		}

	?>

</body>
</html>