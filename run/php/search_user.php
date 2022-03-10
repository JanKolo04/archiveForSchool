<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!---------------JS ANS CSS FILES--------------->
	<link rel="stylesheet" type="text/css" href="style/style-mainPage.css">
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
	  referrerpolicy="no-referrer" />

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


	<!-------ICON------>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Main Page</title>
</head>
<body>

	<div id="baner">
		<div id="divLogo">
			<a href="mainPage.html"><img id="logo" src="images/logoZSK.png"></a>
		</div>
	</div>

	<!----
		add action to form
		action file will
		searchPage.html/php
						---->
	<form method="POST">
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
		    	<div class="col-sm-width">
		      		<a href="">Fotografie i grafiki</a>
		    	</div>
		    	<div class="col-sm-width">
		      		<a href="">Filmy i aplikacje</a>
		    	</div>
		  	
		    	<div class="col-sm-width">
		      		<a href="">Gry i aplikacje</a>
		    	</div>
		    	<div class="col-sm-width">
		      		<a href="">Inne</a>
		    	</div>
		  	
		    	<div class="col-sm-width longCol">
		      		<a href="">Projekty przedmiotowe</a>
		    	</div>
		    	<div class="col-sm-width longCol">
		      		<a href="">Konfiguracja własnej strony</a>
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
					<a href="https://www.facebook.com/SzkolyKreatywne"><img src="images/icons/facebook.png"></a>
					<a href=""><img src="images/icons/instagram.png"></a>
					<a href="https://szkolykreatywne.pl/"><img src="images/icons/google.png"></a>
					<a href=""><img src="images/icons/youtube.png"></a>
				</div>
			</div>
		</footer>

	</div>


	<?php

		include("connection-user.php");

		//function to search by input value
		function search_from_input() {
			global $con;
			//get value from input POST
			$searchValue = $_POST['searchInput'];

			if(strlen($searchValue) > 0) {
				//split value from input
				$arraySplit = explode(" ", $searchValue);

				$searchValue = "";
				//loop to add values to clear value
				for($i=0; $i<sizeof($arraySplit); $i++) {
					//append vlue to variable 
					$searchValue .= $arraySplit[$i];
					//if i isn't last value add comma after append value to var 
					if($i != sizeof($arraySplit)-1) {
						$searchValue .= "','";
					}
				}
				//search works
				$search = "SELECT DISTINCT users.Imie, users.Nazwisko, user_works.work_name, user_works.id FROM users INNER JOIN user_works ON users.id=user_works.id_user WHERE (users.Imie IN ('$searchValue') OR users.Nazwisko IN ('$searchValue') OR user_works.work_name IN ('$searchValue'))";

				//if class and profile isnt empty add commands with search in class and profile to sql query  
				if(!empty($_POST['class']) && !empty($_POST['profile'])) {
					$search .= " AND (users.Klasa='{$_POST['class']}' OR users.Profil='{$_POST['profile']}')";
				}
				//if class isn't empty add to search query command with search in class
				else if(!empty($_POST['class'])) {
					$search .= " AND users.Klasa='{$_POST['class']}'";
				}
				//if profile isn't empty add to search query command with search in profile
				else if(!empty($_POST['profile'])) {
					$search .= " AND users.Profil='{$_POST['profile']}'";
				}
				else if(!empty($_POST['tags'])) {
					//array with tags
					$options = $_POST['tags'];
					//empty variable for tags
					$tags = "";
					//loop get all elements from POST
					for($i=0; $i<sizeof($options); $i++) {
						//append vlue to variable 
						$tags .= $options[$i];
						//if i isn't last value add comma after append value to var 
						if($i != sizeof($options)-1) {
							$tags .= "','";
						}
					}
					//search students with tags
					$search .= " AND user_works.categories IN ('{$tags}')";
				}
				//if query is correct 
				if($querySearch = mysqli_query($con, $search)) {
					if($querySearch->num_rows > 0) {
						//append to array $row elements from query
						while ($row = mysqli_fetch_array($querySearch)) {
							//show results
							echo($row['Imie']." ".$row['Nazwisko'].' '.$row['work_name']." <a href='overview/work.php?work=".$row['id']."'>View</a><br>");	
						}
					}
				}
				//if in mysqli_query is error reutrn alert(error)
				else {
					echo "<script>alert('Error');</script>";
				}
			}
		}

		//function to search works by class
		function search_from_class_select() {
			global $con;
			//get value from select POST
			$class = $_POST['class'];
			
			if(strlen($_POST['searchInput']) == 0) {
				//search works by class
				$searchClass = "SELECT DISTINCT users.Imie, users.Nazwisko, user_works.work_name, user_works.id FROM users INNER JOIN user_works ON users.id=user_works.id_user WHERE users.Klasa='$class'";
				//if query is true do code
				if($querySerachClass = mysqli_query($con, $searchClass)) {
					//if rows in query is bigger tahn 0 do code
					if($querySerachClass->num_rows > 0) {
						//get all elements from query
						while ($row = mysqli_fetch_array($querySerachClass)) {
							//schow results
							echo($row['Imie']." ".$row['Nazwisko'].' '.$row['work_name']." <a href='overview/work.php?work=".$row['id']."'>View</a><br>");
						}	
					}
				}
				//if query is flase return aler(error)
				else {
					echo "<script>alert('Error');</script>";
				}
			}
		}

		//search works by porfiles
		function search_from_profile_select() {
			global $con;
			//get porfile form select POST
			$profile = $_POST['profile'];

			if(strlen($_POST['searchInput']) == 0) {
				//search works by profile
				$searchProfil = "SELECT DISTINCT users.Imie, users.Nazwisko, user_works.work_name, user_works.id FROM users INNER JOIN user_works ON users.id=user_works.id_user WHERE users.Profil='$profile'";
				//if query is true do code
				if($querySerachProfil = mysqli_query($con, $searchProfil)) {
					//if query have more rows than 0 do code
					if($querySerachProfil->num_rows > 0) {
						//get all elemts from query
						while ($row = mysqli_fetch_array($querySerachProfil)) {
							//show results
							echo($row['Imie']." ".$row['Nazwisko'].' '.$row['work_name']." <a href='overview/work.php?work=".$row['id']."'>View</a><br>");
						}
					}
				}
				//if query is false reutrn alert(error)
				else {
					echo "<script>alert('Error');</script>";
				}	
			}
		}

		//search works by porfiles
		function search_from_tags_select() {
			global $con;
			//array with tags
			$options = $_POST['tags'];
			//empty variable for tags
			$tags = "";
			//loop get all elements from POST
			for($i=0; $i<sizeof($options); $i++) {
				//append vlue to variable 
				$tags .= $options[$i];
				//if i isn't last value add comma after append value to var 
				if($i != sizeof($options)-1) {
					$tags .= "','";
				}
			}

			if(strlen($_POST['searchInput']) == 0) {
				//search works by profile
				$searchProfil = "SELECT DISTINCT users.Imie, users.Nazwisko, user_works.work_name, user_works.id FROM users INNER JOIN user_works ON users.id=user_works.id_user WHERE user_works.categories IN ('$tags')";
				//if query is true do code
				if($querySerachProfil = mysqli_query($con, $searchProfil)) {
					//if query have more rows than 0 do code
					if($querySerachProfil->num_rows > 0) {
						//get all elemts from query
						while ($row = mysqli_fetch_array($querySerachProfil)) {
							//show results
							echo($row['Imie']." ".$row['Nazwisko'].' '.$row['work_name']." <a href='overview/work.php?work=".$row['id']."'>View</a><br>");
						}
						header("Location: ");
					}
				}
				//if query is false reutrn alert(error)
				else {
					echo "<script>alert('Error');</script>";
				}	
			}
		}




		if(isset($_POST['searchInput'])) {
			search_from_input();
		}
		if(isset($_POST['class'])) {
			search_from_class_select();
		}
		if(isset($_POST['profile'])) {
			search_from_profile_select();
		}
		if(isset($_POST['tags'])) {
			search_from_tags_select();
		}




	?>




	<style type="text/css">
		.img {
			margin-top: 20px;
			width: 50px;
		}
	</style>





</body>
</html>






















