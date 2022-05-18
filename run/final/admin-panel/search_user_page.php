<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!---------------JS ANS CSS FILES--------------->
	<link rel="stylesheet" type="text/css" href="../css/style-searchPage.css">
	<link rel="stylesheet" type="text/css" href="css/style-search-page.css">
	<script type="text/javascript" src="js/script-search-user-page.js"></script>
	<!-------AJAX------>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
	<title>Search</title>
</head>
<body>

	<div id="baner">
		<div id="divLogo">
			<a href="index.php"><img id="logo" src="../images/logoZSK.png"></a>
		</div>
	</div>

	<div id="backDiv">
		<a href="javascript: window.history.back()" id="backButton"><i class="fa fa-long-arrow-left"></i> Wróć</a>
	</div>

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

	<div id="mainDiv">
		<form method="POST">
			<div id="tableDiv">
				<div id="holderTable">
					<div id="actionMenuTable">
						<a href="add_user.php"><i class='fa fa-user-plus'></i> Dodaj</a>
						<button type="submit" name="delete" onclick="delete_user()"><i class='fa fa-user-times'></i> Usuń</button>
					</div>
					<table id="table" class="table-striped">
						<thead>
					    	<tr>
					    		<th scope="col"></th>
					      		<th scope="col">Imię Nazwisko</th>
					      		<th scope="col">Klasa</th>
					      		<th scope="col">Podgląd</th>
					    	</tr>
					  	</thead>
					  	<tbody id="tableBody">

						</tbody>
					</table>
				</div>
			</div>
		</form>

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

		include("../connection.php");

		$arrayWithResults = [];


		if(!isset($_SESSION['login'])) {
			header("Location: login.php");
		}

		if(isset($_POST['delete'])) {
			header("Location: search_user_page.php");
		}


		function AdaptFilter($arrayOfFilterValues, $dbColumName) {
			if(empty($arrayOfFilterValues)) $resultValue = "AND 1";
				else {
					$resultValue = "AND ( $dbColumName =";
					//loop get all elements from POST
					for($i=0; $i<sizeof($arrayOfFilterValues); $i++) {
						//append vlue to variable 
						$resultValue .= "\"$arrayOfFilterValues[$i]\"";
						//if i isn't last value add comma after append value to var 
						if($i != sizeof($arrayOfFilterValues)-1) {
							$resultValue .= " OR $dbColumName = ";
						}
					}
					$resultValue.= ") ";
				}
				return $resultValue;
		}

		function AdaptTextPhrase($arrayOfPhases, $dbColumnName) {
			$value = "$dbColumnName LIKE ";
			for($i=0; $i < sizeof($arrayOfPhases); $i++) {
				$value .= "'%". $arrayOfPhases[$i]."%'";
				if($i != sizeof($arrayOfPhases)-1) {
					$value .= " OR $dbColumnName LIKE ";
				}
				
			}
			return $value;
		}

		function MultipleSearch() {
			global $con, $arrayWithResults;

			$searchValue = $_POST['searchInput'];
			$classValue = AdaptFilter($_POST['class'], "users.Klasa");
			$profileValue = AdaptFilter($_POST['profile'], "users.Profil");

			if(empty($searchValue)) {
				$searchValue = "1";
			}
			else {
				if(strlen($searchValue) > 0) {
					$arraySplit = explode(" ", $searchValue);
					$searchValue = AdaptTextPhrase($arraySplit, "users.Imie") . 
					' OR ('.  AdaptTextPhrase($arraySplit, "users.Nazwisko").
					')';
					
				}
			}
			
			$search = "SELECT DISTINCT * FROM users WHERE $searchValue $classValue $profileValue";

			 ///////////////////////////////////////////////////////////////////////////////////////
			 if($querySearch = mysqli_query($con, $search)) {
				$counter = 0;
				while ($row = mysqli_fetch_array($querySearch)) {
					//append results into array
					$arrayWithResults[$counter] = [
						"Name"=>$row['Imie'],
						"Lastname"=>$row['Nazwisko'],
						"user_id"=>$row['id'],
						"Class"=>$row['Klasa']
					];
					$counter++;
				}
				
			}
			else {
				echo "<script>alert('Error');</script>";
			}
		}

		
		MultipleSearch();
 		

	?>



	<script type="text/javascript">
		
		function append_rows_into_table() {
			//array with results
			const arrayResults = <?php echo json_encode($arrayWithResults);?>;
			//table 
			const tableBody = document.querySelector('#tableBody');


			//for loop inserting data from arrayResults to table
			for(let i=0; i<arrayResults.length; ++i) {
				//create row
				let row = document.createElement("tr");
				//append row into table
				tableBody.appendChild(row);

				//create column with chcekboxs
				let dataCheckBox = document.createElement('td');
				//set classname
				dataCheckBox.className = "checkBoxData";
				//append data to row
				row.appendChild(dataCheckBox);

				//create checkBox 
				let checkBox = document.createElement("input");
				//set type for input
				checkBox.type = "checkbox";
				//set class name
				checkBox.className = "check";
				//set value
				checkBox.value = arrayResults[i]['user_id'];
				//append checkbox into td
				dataCheckBox.appendChild(checkBox);

				
				//create data with name and lastname
				let dataNameLastname = document.createElement('td');
				//set class name for data name
				dataNameLastname.className = "nameLastname";
				//set innerHTML
				dataNameLastname.innerHTML = arrayResults[i]['Name']+' '+arrayResults[i]['Lastname'];
				//append data to row
				row.appendChild(dataNameLastname);

				//create data with class
				let dataClass = document.createElement('td');
				//set class name for data name
				dataClass.className = "classData";
				//set innerHTML
				dataClass.innerHTML = arrayResults[i]['Class'];
				//append data to row
				row.appendChild(dataClass);

				//create data with preview button
				let dataButton = document.createElement('td');
				//set class name for data name
				dataButton.className = "buttonData";
				//append data to row
				row.appendChild(dataButton);

				//create preview button
				let menagmentButton = document.createElement("a");
				//set class name
				menagmentButton.className = "buttonView";
				//set innerHTML
				menagmentButton.innerHTML = "Zarządzaj";
				//set href for a
				menagmentButton.href = "user_profile_page.php?user="+arrayResults[i]['user_id'];
				//append button into dataButton
				dataButton.appendChild(menagmentButton);


			}
			
		}

		append_rows_into_table();

	</script>


</body>
</html>











