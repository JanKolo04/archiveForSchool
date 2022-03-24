<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-categoryPage.css">

	<!------------------PLUGINS------------------>
	<!-------BOOSTRAP------>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-------ICON------>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Category</title>
</head>
<body>

	<div id="baner">
		<div id="divLogo">
			<a href="../mainPage.php"><img id="logo" src="../images/logoZSK.png"></a>
		</div>
	</div>

	<div id="backDiv">
		<a href="../mainPage.php" id="backButton"><i class="fa fa-long-arrow-left"></i> Wróć</a>
	</div>

	<div id="main">
		<div id="categoryDiv">
			<div class="container">
				<div class="row d-flex justify-content-around">
			    	<div class="longCol" id="newWorks" onclick="location.href='galeryPage.php';">Najnowsze prace</div>

			    	<div class="longCol" onclick="location.href='contestPage.php';">Konkursy i Wystawy</div>

			    	<div class="longCol" onclick="location.href='../searchPage.php';">Lista prac</div>
			  	</div>
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
	</div>


	<?php

		session_start();

		$_SESSION['categorySearch'] = true;

	?>

</body>
</html>








