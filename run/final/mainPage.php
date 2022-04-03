<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!---------------JS ANS CSS FILES--------------->
	<link rel="stylesheet" type="text/css" href="css/style-mainPage.css">
	<!-------AJAX------>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!------------------PLUGINS------------------>
	<!-------BOOSTRAP------>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
	  referrerpolicy="no-referrer"/>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


	<!-------ICON------>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Main Page</title>
</head>
<body>

	<!-----------Google analitics----------->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-SC930026W4"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){window.dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-SC930026W4');
	</script>

	<div id="baner">
		<div id="divLogo">
			<a href="mainPage.php"><img id="logo" src="images/logoZSK.png"></a>
		</div>
	</div>

	<!----
		add action to form
		action file will
		searchPage.html/php
						---->
	<form method="POST" action="searchPage.php">
		<div id="searchMenu">
			<div class="container">
				<div class="row d-flex justify-content-center align-items-center" id="searchRow">
					<input type="text" id="input" name="searchInput" class="form-control" placeholder="Wyszukaj użytkownika...">
					<button type="submit" id="searchButton" class="btn btn-primary" name="search">Szukaj <i class="fa fa-search"></i></button>
				</div>

				<div class="row d-flex justify-content-center align-items-center" id="selectRow">
					<select class="selectpicker" name="profile[]" title="Wybierz specjalizacje" multiple aria-label="size 3 select example">
						<option value="Grafika komputerowa">Grafika komputerowa</option>
						<option value="Tworzenie gier">Tworzenie gier</option>
						<option value="Fotografia kreatywna">Fotografia kreatywna</option>
						<option value="Animacja komputerowa">Animacja komputerowa</option>
					</select>

					<select id="tags" class="selectpicker" title="Wybierz katgorie" multiple aria-label="size 3 select example" name="tags[]">
						<option value="Fotografia">Fotografia</option>
						<option value="Grafika">Grafika</option>
						<option value="Animacja">Animacja</option>
						<option value="Film">Film</option>
						<option value="Gra">Gra</option>
						<option value="Aplikacja">Aplikacja</option>
						<option value="Strona">Strona</option>
						<option value="Dźwięk">Dźwięk</option>
						<option value="Makieta">Makieta</option>
						<option value="Rzeźba">Rzeźba</option>
						<option value="Tekst">Tekst</option>
						<option value="Inne">Inne</option>
					</select>

					<select class="selectpicker" aria-label="size 3 select example" title="Wybierz klase" multiple name="class[]" id="class">
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
				</div>
			</div>
		</div>
	</form>


	<div id="holderDiv">
		<div class="container">
			<div class="row d-flex">
		    	<div class="col-sm-width" onclick="location.href='underpages/categoryPage.php';">Fotografie i grafiki</div>

		      	<div class="col-sm-width" onclick="location.href='underpages/categoryPage.php';">Filmy i aplikacje</div>
		  	
		    	<div class="col-sm-width" onclick="location.href='underpages/categoryPage.php';">Gry i aplikacje</div>		    	

		      	<div class="col-sm-width" onclick="location.href='underpages/categoryPage.php';">Inne</div>
		  	
		    	<div class="col-sm-width longCol" onclick="location.href='underpages/categoryPage.php';">Projekty przedmiotowe</div>
		    	<div class="col-sm-width longCol" onclick="location.href='http://labzsk.webd.pro/pkucharczyk/';">Konfiguracja własnej strony</div>

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
					<a href="https://www.facebook.com/SzkolyKreatywne"><img src="images/icons/facebook.png"></a>
					<a href=""><img src="images/icons/instagram.png"></a>
					<a href="https://szkolykreatywne.pl/"><img src="images/icons/google.png"></a>
					<a href=""><img src="images/icons/youtube.png"></a>
				</div>
			</div>
		</footer>

	</div>

	<?php

		session_start();

		$_SESSION['categorySearch'] = "mainPage";

	?>




</body>
</html>






















