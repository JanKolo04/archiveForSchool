<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="script.js"></script>
	<title>Main</title>
</head>
<body>

	<form method="post">
		<input type="text" name="searchInput" placeholder="Search user...">
		<select name="class" id="class">
			<option disabled selected>Select class</option>
		</select>
		<select name="profile">
			<option disabled selected>Select Profile</option>
			<option>Grafika</option>
			<option>Informatyka</option>
		</select>
		<button type="submit" name="search">Search</button>
	</form>


	<?php

		include("connection-user.php");

		/*
		function search() {
			global $con;
			//dane z inputa
			$data = $_POST['input'];
			//klasa
			$class = $_POST['select'];

			//wybranie wssyztskich elementów 
			$sqlAll = "SELECT * FROM works WHERE Klasa='$class'";
			$queryAll = mysqli_query($con, $sqlAll);

			//tablica z danymi
			$arrayAll = [""];
			//licznik
			$i=0;
			//wstawanie wszytskuch wyników do tablicy
			while ($row = mysqli_fetch_row($queryAll)) {
				foreach($queryAll as $key=>$value) {
					$arrayAll[$i] = $value;
					$i++;
				}
			}
			//podzielenie stringa na wyrazy które stworzą tablice

			$arrayText = explode(" ", $data);
			
			//jesli uzytkownik nie wpisze 3 wyrazów i nie wybierze klasy to pokaże sie alert
			//z Error
			if(sizeof($arrayText) != 3 || $class=='--Select--') {
				echo "<script>alert('Błąd')</script>";
			}
			//jesli wpisał 3 to wykonuje sie kod dalej
			else {
				//tablica z poprawnymi wynikami
				$arrayCheck = [];
				//petla do sprawdzania czy dany wyraz pasuje do klucza
				//pierwsza pętla zajmuje sie tym zeby przejsc po kazdej tablicy w tablicy wielowymiarowej
				for($i=0; $i<sizeof($arrayAll); $i++) {
					//druga jest od tego żeby sprawdzic czy Imie, Nazwisko i Zdjecie mają dopasowanie
					for($y=0; $y<3; $y++) {
						//porówanie danych czy Imie pasuje do wartości która wpisaliśmy
						if($arrayAll[$i]['Imie'] == $arrayText[$y]) {
							//tutaj tworze klucz Imie w tablicy arrayCheck i dodaje kluczowi wartość
							$arrayCheck["Imie"] = $arrayText[$y];
						}
						//tutaj jest to samo porównanie co powyżej tylko że tutaj do nazwiska
						else if($arrayAll[$i]['Nazwisko'] == $arrayText[$y]) {
							$arrayCheck["Nazwisko"] = $arrayText[$y];
						}
						//tutaj do nazwy pracy
						else if($arrayAll[$i]['work_name'] == $arrayText[$y]) {
							
								//---------FUNCKJA PODMIANY ROZSZERZEN-------
								//ta funkcja jest potrzebna poniewaz php nie obsługuje 
								//rozszerzen JPEG wiec jest potrzebna ta funkcja
							
							//zniemnne do zmiany rozszerzenia gdy zdjecie jest jpeg
							//zmienna rozszerzenie
							$roz = "";
							//sama nazwa bez rozszerzenia
							$only_work_name = "";
							//zmienna z work_name
							$text = $arrayText[$y];
							//pelta odpowiedzialna za znalezienie kropki
							for($x=0; $x<strlen($text); $x++) {
								//jeśli znak w zmiennej text jest kropka to tworzy zmienna 
								//z lokalizacja kropki
								if($text[$x] == '.') {
									//zmienna kropka
									$dot=$x;
								}
							}
							//pelta odpowiedzialna za dodanie do zmiennej only_work_name
							//samej nazwy bez rozszerzenia
							for($a=0; $a<$dot; $a++) {
								//nadpisywanie zmiennej
								$only_work_name.=$text[$a];
							}
							//petla która dodaje do zmiennej roz
							//nazwe rozszerzenia
							for($z=$dot+1; $z<strlen($text); $z++) {
								//nadpisywanie zmiennje
								$roz.=$text[$z];
							}
							//jesli rozszerzenie jest jpeg to zmienia je na jpg
							if($roz == 'jpeg') {
								//podmiana
								$roz ='jpg';
								//przypisywanie wartości do klucza
								$arrayCheck["work_name"] = $only_work_name.".".$roz;
							}
							//jesli rozszerzenie nie jest jpeg to przypisuje wartośc 
							//work_name bez zmian
							else {
								//przypisywanie wartości do klucza
								$arrayCheck['work_name'] = $arrayText[$y];
							}
							//tutaj dodajemy Profil
							$arrayCheck["Profil"] = $arrayAll[$i]['Profil'];
							//dodawanie klasy
							$arrayCheck["Klasa"] = $class;
						}
					}
				}
				//sprawdzamy czy dane zosatły dopasowane czy nie
				//jesli dane nie zostały dopasowane to wtedy pokazuje
				//sie alert ze nie ma takiego uzytkownika
				if(empty($arrayCheck)) {
					echo "<script>alert('Taki użytkownik nie istnieje');</script>";
				}
				else if(empty($arrayCheck['Imie']) || empty($arrayCheck['Nazwisko']) || empty($arrayCheck['Klasa']) || empty($arrayCheck['Profil']) || empty($arrayCheck['work_name'])) {
					echo "<script>alert('Dane zostały źle wpisane');</script>";
				}
				else {
					//wyświetlanie wszytskich zdjec ucznia
					//tworzenie sciezki
					$path = "../{$arrayCheck['Profil']}/{$arrayCheck['Klasa']}/{$arrayCheck['Imie']} {$arrayCheck['Nazwisko']}/{$arrayCheck['work_name']}";
					echo "<img src='$path' class='img'>";
				}
			}


		
			//wyświetlanie każdego zdjęcia z folderu ucznia
			//funkcja sprawdzająca czy otworzy sie folder
			if($d = opendir($path)) {
				//wczytywanie zdjec dopóki nie wczyta wszystkich
				while($file = readdir($d)) {
					//jesli zdjecie nie ma nazwy . lub .. to twórz
					if($file != '.' && $file != '..' && $file==$arrayCheck['work_name']) {
						//dodawanie nazwy zdjecia do scieżki
						$exist = $path."/".$file;
						//tworzenie zdjęcia
						echo "<img src='$exist' class='img'>";
					}
				}
				//zamykanie folderu
				closedir($d);
			}

			



		}
		*/

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
				echo $search;

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



		if(isset($_POST['searchInput'])) {
			search_from_input();
		}
		if(isset($_POST['class'])) {
			search_from_class_select();
		}
		if(isset($_POST['profile'])) {
			search_from_profile_select();
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






















