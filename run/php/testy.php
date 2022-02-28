<?php

	//plik z połączeniem do bazy danych
	//TEN PLIK STQORZYŁEM WAM JAK COS
	include('connection.php');

	function add_file_into_database_and_directory() {
		//pobiera zmienna z pliku connection.php;
		global $con;

		//DANE O UZYTKOWNIKU

		//user name
		$name = "Borys";
		//user last name
		$lastname = "Spulikowski";
		//user class
		$class = "3b";
		//and user profile
		$profil = "Grafika";

		//if isset file
	   	if(isset($_FILES['file'])) {
	   		//arry for erorrs
			$errors = [];
			//get name form file
			$fileName = $_FILES['file']['name'];
			//get file size
			$fileSize = $_FILES['file']['size'];
			//tmp file
			$fileTmp = $_FILES['file']['tmp_name'];
			//path to dircetory
			//TUTAJ WPISZ TUTAJ SCIEZKE GDZIE MA SIE DODAC PLIK 
			//chodzi tutaj sciezko do folderu na kompie
			$dir = "../images/$profil/$class/$name $lastname/";
			//split file name 
			$explode = explode('.',$_FILES['file']['name']);
			//get last index of explode
			$fileExt = end($explode);

			//max file size 1048576 is a 1MB in bits
			$maxSize = 3*(1048576);
			//possible extensions
		    $extensions= array("jpg","png");

		    $counter = 0;
		    while($counter < 1) {
			    //if filename dosen't empty do code 
			    if(!empty($fileName)) {
			    	//if file exist show alert
				    if(file_exists($dir.$fileName)) {
				     	echo("<script>alert('File exist');</script>");
				     	break;
				    }
				
				    //if upload file extension dosen't be in extensions array return alert 
				    else if(!in_array($fileExt,$extensions)) {
				        echo("<script>alert('Different extensions, use JPG or PNG');</script>");
				        break;
				    }
				    //if file size is bigger than max size return alert
	      			else if($fileSize > $maxSize) {
	        			echo("<script>alert('File is biger than 5MB');</script>");
	        			break;
	        		}
	      			
	      			//if code didn't return any alert upload file to direcotry and insert data to database
					else {
						move_uploaded_file($fileTmp,$dir.$fileName);
						//insert data into data base
						//gdzie jest user_works wpisz nazwe tabeli z bazy danych gdzie beda przetrzymywane prace
						$sendSQL = "INSERT INTO user_works(Imie, Nazwisko, Klasa, file_name, Profil) VALUES('$name', '$lastname', '$class', '$fileName', '$profil')";
						$queryInsertWork = mysqli_query($con, $sendSQL);
						//add counter
						//uset file name	
						unset($fileName);
						break;
					}
					
				}
				//if any file didn't been selected return alert
				else {
					echo("<script>alert('No files has been selected');</script>");
					break;
				}
			}

	   	}

	}
?>