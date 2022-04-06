<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-index.css">
</head>
<body>

	<div id="baner">
		<div id="divLogo">
			<a href="mainPage.php"><img id="logo" src="images/logoZSK.png"></a>
		</div>
	</div>

	<?php

		$strona = 'mainPage';
		if(isset($_GET['page'])) {
			$strona = $_GET['page'];
		}

	?>

	<div id="holderDiv">
		<?php include($strona.".php"); ?>
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
				<a href="https://www.facebook.com/SzkolyKreatywne"><img src="images/icons/facebook.png"></a>
				<a href=""><img src="images/icons/instagram.png"></a>
				<a href="https://szkolykreatywne.pl/"><img src="images/icons/google.png"></a>
				<a href=""><img src="images/icons/youtube.png"></a>
			</div>
		</div>
	</footer>


</body>
</html>