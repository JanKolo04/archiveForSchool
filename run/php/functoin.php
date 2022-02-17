<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main</title>
</head>
<body>

	<form method="post">
		<input type="text" name="input">
		<select name="select">
			<option>--Select--</option>
			<option>3b</option>
		</select>
		<button type="submit" name="submit">Search</button>
	</form>

	<div id="div"></div>


	<?php

		include("connection.php");

		//jesli klikniemy przycisk Search to funckja run sie uruchomi
		if(isset($_POST['submit'])) {
			search();
		}

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
						/*
							---------FUNCKJA PODMIANY ROZSZERZEN-------
							ta funkcja jest potrzebna poniewaz php nie obsługuje 
							rozszerzen JPEG wiec jest potrzebna ta funkcja
						*/
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
						//tutaj dodajemy Profil i Klase
						$arrayCheck["Profil"] = $arrayAll[$i]['Profil'];
						$arrayCheck["Klasa"] = $arrayAll[$i]['Klasa'];
					}
				}
			}

			//sprawdzamy czy dane zosatły dopasowane czy nie
			if(empty($arrayCheck)) {
				echo "User dosent exist";
			}


			//wyświetlanie wszytskich zdjec ucznia
			//tworzenie sciezki
			$path = "../{$arrayCheck['Profil']}/{$arrayCheck['Klasa']}/{$arrayCheck['Imie']} {$arrayCheck['Nazwisko']}/{$arrayCheck['work_name']}";
			echo "<img src='$path' class='img'>";


			/*
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

			*/



		}

		/*
			--------TO DO-------
			1.Stworzyć zabezpieczenie jeśli dane zostaną wprowadzone niepoprawnie to wtedy zwróci alert 'Dane zostały wprowadzone niepoprawnie',
			
			2.Stworzyć metode pobierania pojeduńczych zdjęć (wrzucenie do ścieżki nazwe pliku i stworzenie zdjecia)

		*/

	?>

	<style type="text/css">
		.img {
			margin-top: 20px;
			width: 50px;
		}
	</style>



</body>
</html>






















