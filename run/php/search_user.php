<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main</title>
</head>
<body>

	<form method="post">
		<input type="text" name="text">
		<select name="klasa">
			<option>--Select--</option>
			<option>3b</option>
		</select>
		<select name="profil">
			<option>--Select--</option>
			<option>Grafika</option>
			<option>Informatyka</option>
		</select>
		<button type="submit" name="submit">Search</button>
	</form>

	<div id="div"></div>


	<?php

		include("connection.php");

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

		function search_from_input() {
			global $con;
			$searchValue = $_POST['text'];
			if(strlen($searchValue) > 0) {
				$arraySplit = explode(" ", $searchValue);

				$searchValue = "";
				for($i=0; $i<sizeof($arraySplit); $i++) { 
					$searchValue .= $arraySplit[$i];
					if($i != sizeof($arraySplit)-1) {
						$searchValue .= "','";
					}
				}

				$search = "SELECT * FROM user_works WHERE Imie IN ('$searchValue') OR Nazwisko IN ('$searchValue') OR work_name IN ('$searchValue')";
				if($querySearch = mysqli_query($con, $search)) {
					if($querySearch->num_rows > 0) {
						//append to array $row elements from query
						while ($row = mysqli_fetch_array($querySearch)) {
							echo($row['Imie']." ".$row['Nazwisko'].' '.$row['work_name']."<br>");
						}
					}
					else {
						echo "<script>alert('Error');</script>";
					}
				}
				else {
					echo "<script>alert('Error');</script>";
				}
			}
		}

		function search_from_class_select() {
			global $con;
			$class = $_POST['klasa'];

			if($class != "--Select--") {
				$searchClass = "SELECT * FROM user_works WHERE Klasa='$class'";
				if($querySerachClass = mysqli_query($con, $searchClass)) {
					if($querySerachClass->num_rows > 0) {
						//append to array $row elements from query
						while ($row = mysqli_fetch_array($querySerachClass)) {
							echo($row['Imie']." ".$row['Nazwisko'].' '.$row['work_name']."<br>");
						}	
					}
					else {
						echo "<script>alert('Error');</script>";
					}
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}
			
		}


		function search_from_profile_select() {
			global $con;
			$profil = $_POST['profil'];

			if($profil != "--Select--") {
				$searchProfil = "SELECT * FROM user_works WHERE Profil='$profil'";
				if($querySerachProfil = mysqli_query($con, $searchProfil)) {
					if($querySerachProfil->num_rows > 0) {
						//append to array $row elements from query
						while ($row = mysqli_fetch_array($querySerachProfil)) {
							echo($row['Imie']." ".$row['Nazwisko'].' '.$row['work_name']."<br>");
						}
					}
					else {
						echo "<script>alert('Error');</script>";
					}
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}
		}



		if(isset($_POST['text'])) {
			search_from_input();
		}

		if(isset($_POST['klasa'])) {
			search_from_class_select();
		}

		if(isset($_POST['profil'])) {
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






















