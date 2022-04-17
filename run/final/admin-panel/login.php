<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-login.css">

	<!-----PLUGINS----->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Login</title>
</head>
<body>

	<div id="baner">
		<div id="divLogo">
			<img id="logo" src="../images/logoZSK.png">
		</div>
	</div>

	<div id="main">
		<div id="holder">
			<div id="textHolder">
				<h1>Login</h1>
			</div>
			<form method='POST'>
				<div id="inputsHolder">
					<div>
						<input type='text' name='login' id='login' placeholder='Login...'>
					</div>

					<div id="passwordHolder">
						<input type='password' name='password' id='passsword' placeholder='Password...'>
						<i class='bi bi-eye-slash' id='togglePassword'></i>
					</div>
				</div>

				<div id="buttonHolder">
					<button type='submit' name='loginButton' id="button">Submit</button>
				</div>
			</form>
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
				<a href="https://www.facebook.com/SzkolyKreatywne"><img src="../images/icons/facebook.png"></a>
				<a href=""><img src="../images/icons/instagram.png"></a>
				<a href="https://szkolykreatywne.pl/"><img src="../images/icons/google.png"></a>
				<a href=""><img src="../images/icons/youtube.png"></a>
			</div>
		</div>
	</footer>


	<script>
		let button = document.getElementById('togglePassword');
		let input = document.getElementById('passsword');

		button.onclick = function() {
			if(input.type == 'password') {
				input.setAttribute('type', 'text');
				button.className = 'bi bi-eye';
			}
			else {
				input.setAttribute('type', 'password');
				button.className = 'bi bi-eye-slash';
			}
		}
	</script>

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