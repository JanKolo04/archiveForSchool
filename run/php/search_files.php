<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create</title>
</head>
<body>
	<p>Podsatwowa lokalizajca to <b>home/</b></p>

	<?php

		//global wartość do ustawiania value w inpucie
		$dir = "all/";


		if(isset($_POST['submit'])) {
			open();
		}

		function open() {
			global $dir;
			//pobieranie wartości z input
			$dir = $_POST['lokalizacja'];

			//jeśli nie istnieje taki flolder to wraca na all/
			if(!is_dir($dir)) {
				$dir = 'all/';
			}
		} 



		//folder kreator
		/*
		function create() {
			//pobranie nazwy katalogu
			$nazwa_katalogu = $_POST['name'];
			//lokalizaacja katalogu
			$lokalizacja = $_POST['lokalizacja'];

			//jesli ostatni znak jest to /
			//to wtedy dodaje shlesha
			if(substr($lokalizacja, -1) == '/') {
				//jelsi folder nie istnieje to tworzy go
				if(!is_dir($lokalizacja."/".$nazwa_katalogu)) {
					mkdir($lokalizacja."/".$nazwa_katalogu, 0777, true);
				}
				//jesli folder istnieje to wtedy pokazuje sie alert
				else {
					echo "<script> alert('Folder juz instnieje'); </script>";
				}
			}
			//jesli na konu lokalizacji ktos juz dał shlesh to wtedy 
			//nie dodaje shlesha i wykonuje sie kod tak samo jak powyżej 
			else {
				if(!is_dir($lokalizacja.$nazwa_katalogu)) {
					mkdir($lokalizacja.$nazwa_katalogu, 0777, true);
				}
				else {
					echo "<script> alert('Folder juz instnieje'); </script>";
				}	
			}
		}
		*/

	?>
	<form method="post">
		<input type="text" name="lokalizacja" value="<?php echo $dir;?>">
		<button type="submit" name="submit">Open</button>
	</form>



	<?php
		if(isset($_POST['submit'])) {
			run();
		}

		function run() {
			//pobiera wartość z input
			$dir = $_POST['lokalizacja'];
			//sprawdza czy podana siezka jest folderem
			if(is_dir($dir)) {
				//otwiera folder
				if($dh=opendir($dir)) {
					//przypisuje wartości do zmiennej i sprawdza czy instnieje
			    	while (($file = readdir($dh)) !== false) {
			    		//jesli plik ma nazwe którąś to nie pokazuje go
			    		if($file != '.' AND $file != '..' AND $file != '.DS_Store') {
			    			//jesli wartość to directory to pokazuje direcotry
				    		if(is_dir($dir.'/'.$file)) {
				    			echo "Directory: ".$file."<br>";
				    		}
				    		//jesli nie jest to pokazuje jako plik
				    		else if(!is_dir($file)){
				    			echo "Filename: ".$file."<br>";
				    		}
			    		}
			    	}
			    	//zamyka folder
			    	closedir($dh);
			  	}
			}
			//jesli wpisana złą ścieżke to wtedy pokazuje sie alert
			else {
				echo "<script> alert('Nie insteneje taki folder');</script>";
			}
		}

	?>

</body>
</html>