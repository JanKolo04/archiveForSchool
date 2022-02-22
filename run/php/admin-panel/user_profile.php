<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
</head>
<body>

	<div id="div">
		<h2 id="nameSurname"></h2>
		<table id="table">
			<tboody>
			</tboody>
		</table>
	</div>



	<?php

		include("../connection.php");

		function get_id() {
			global $con, $arrayWithDataFromQuery, $arrayWithWorks;
			//get user id from url
			$user_id = $_GET['user_id'];
			//select all data from user table where id is user_id
			$getDataFromSQL = "SELECT * FROM users WHERE id='$user_id'";
			//if query data == true do code else return error
			if($queryData = mysqli_query($con, $getDataFromSQL)) {
				//if query return zero record code will return error
				if($queryData->num_rows > 0) {
					//array for data from query
					$arrayWithDataFromQuery = [];
					while($row = mysqli_fetch_array($queryData)) {
						//append data into array
						$arrayWithDataFromQuery = [
							"Name"=>$row['Imie'],
							"Lastname"=>$row['Nazwisko'],
							"Class"=>$row['Klasa'],
							"Profile"=>$row['Profil']
						];
					}
				}
				else {
					echo "<script>alert('Error');</script>";
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}



			$getDataFromSQLWorks = "SELECT * FROM user_works WHERE id_user='$user_id'";
			//if query data == true do code else return error
			if($queryDataWorks = mysqli_query($con, $getDataFromSQLWorks)) {
				//if query return zero record code will return error
				if($queryDataWorks->num_rows > 0) {
					//array for data from query
					$arrayWithWorks = [];
					$counter = 0;
					while($row = mysqli_fetch_array($queryDataWorks)) {
						//append data into array
						$arrayWithWorks[$counter] = [
							"id_work"=>$row['id'],
							"work_name"=>$row['work_name']
						];
						$counter++;
					}
				}
				else {
					echo "<script>alert('Error');</script>";
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}

			/*
			//path to direcotry
			$pathToDirectory = "../all/{$arrayWithDataFromQuery['Profile']}/{$arrayWithDataFromQuery['Class']}/{$arrayWithDataFromQuery['Name']} {$arrayWithDataFromQuery['Lastname']}";

			//array with paths to works
			$arrayWorks = [];
			if($d = opendir($pathToDirectory)) {
				//wczytywanie zdjec dopóki nie wczyta wszystkich
				while($file = readdir($d)) {
					//jesli zdjecie nie ma nazwy . lub .. to twórz
					if($file != '.' && $file != '..' && $file != '.DS_Store') {
						//dodawanie nazwy zdjecia do scieżki
						$exist = $pathToDirectory."/".$file;
						//tworzenie zdjęcia
						$arrayWorks[] = $exist;
					}
				}
				//zamykanie folderu
				closedir($d);
			}
			*/
		}	

		get_id();


	?>


	<script type="text/javascript">
		
		function set_data() {
			//array with data
			const arrayData = <?php echo json_encode($arrayWithDataFromQuery);?>;
			const arrayWorks = <?php echo json_encode($arrayWithWorks);?>;
			//table
			let table = document.querySelector('#table');
			//name and surname(headerText)
			let headerText = document.querySelector('#nameSurname');
			//add name and lastname into header
			headerText.innerHTML = arrayData['Name']+" "+arrayData['Lastname'];

			//len of array with works
			let arrayWorksLen = arrayWorks.length;
			for(let i=0; i<arrayWorksLen; ++i) {
				let record = document.createElement('tr');
				record.className = "record";
				table.appendChild(record);

				//data with name
				let dataName = document.createElement('td');
				//set class name
				dataName.className = 'data';
				//set text
				dataName.innerHTML = arrayData['Name'];
				//append data to rwo
				record.appendChild(dataName);

				//data with Lastname
				let dataLastName = document.createElement('td');
				//set class name
				dataLastName.className = 'data';
				//set text
				dataLastName.innerHTML = arrayData['Lastname'];
				//append data to rwo
				record.appendChild(dataLastName);


				//data with Class
				let dataClass = document.createElement('td');
				//set class name
				dataClass.className = 'data';
				//set text
				dataClass.innerHTML = arrayData['Class'];
				//append data to rwo
				record.appendChild(dataClass);


				//data with profile
				let dataProfile = document.createElement('td');
				//set class name
				dataProfile.className = 'data';
				//set text
				dataProfile.innerHTML = arrayData['Profile'];
				//append data to rwo
				record.appendChild(dataProfile);


				//data with work name
				let dataWorkName = document.createElement('td');
				//set class name
				dataWorkName.className = 'data';
				//set text
				dataWorkName.innerHTML = arrayWorks[i]['work_name'];
				//append data to rwo
				record.appendChild(dataWorkName);

				//data with work name
				let dataButton = document.createElement('td');
				//set class name
				dataButton.className = 'data';
				//append data to rwo
				record.appendChild(dataButton);

				//view button
				let viewButton = document.createElement('a');
				//set class name
				viewButton.className = "viewButton";
				//set href for button
				viewButton.href = "../overview/work.php?work="+arrayWorks[i]['id_work'];
				//set text
				viewButton.innerHTML = "View";
				//append button to data for button
				dataButton.appendChild(viewButton);

			}


		}

		set_data();

	</script>

</body>
</html>











