<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!---------------JS ANS CSS FILES--------------->
	<link rel="stylesheet" type="text/css" href="css/style-user-page.css">
	<script type="text/javascript" src="js/script-user-profile.js"></script>

	<!-------BOOSTRAP------>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-------AJAX------>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-------ICON------>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>User profile</title>
</head>
<body>

	<div id="allStuff">
		<a href="javascript: window.history.back()" id="backButton" style="margin-top: 20px;">Wróć</a>
		<h2 id="nameSurname" style="font-size: 25px !important; margin-top: 20px;"></h2>

		<form method="post" enctype="multipart/form-data">
			<div id="allInputs">
				<div id="changeDiv">
					<div id="chnageInputsDiv">
						<input type="text" name="changeName" id="changeName" placeholder="Zmień imie...">
						<input type="text" name="changeLastname" id="changeLastname" placeholder="Zmień nazwisko...">
					</div>

					<div id="changeSelectDiv">
						<div id="selectClassDiv">
							<select name="changeClass" id="changeClass">
								<option disabled selected value>Zmien klase</option>
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

						<div id="selectProfileDiv">
							<select name="changeProfile" id="changeProfile">
								<option disabled selected value>Zmien profil</option>
								<option value="Grafika komputerowa">Grafika komputerowa</option>
								<option value="Tworzenie gier">Tworzenie gier</option>
								<option value="Fotografia kreatywna">Fotografia kreatywna</option>
								<option value="Animacja komputerowa">Animacja komputerowa</option>
							</select>
						</div>
					</div>

					<div id="submitChangeDiv">
						<button type="submit" name="submitChange">Zmień</button>
					</div>
				</div>

				<div id="inputsDiv">
					<div id="inputsFileTextDiv">
						<input type="text" name="work_name" id="work_name" placeholder="Tytuł pracy..." value="<?php echo $_POST['work_name'];?>">
						<textarea name="description" id="description" placeholder="Opis pracy..." value="<?php echo $_POST['description'];?>" style="width: 240px; height: 60px;"></textarea>

						<div id="list">
							<p>Lista możliwych plików</p>

							<ol id="extensionsList">
								<li class="element">jpg</li>
								<li class="element">png</li>
								<li class="element">gif</li>
								<li class="element">mp4</li>
								<li class="element">mp3</li>
								<li class="element">zip</li>
							</ol>
						</div>
					</div>
					<div id="inputFileSelectDiv">
						<input type="file" name="file">
						<button type="submit" name="submitAddFile">Dodaj</button>
					</div>
				</div>
			</div>
		</form>

		<div id="mainDiv">
			<form method="POST">
				<div id="tableDiv">
					<div id="holderTable">
						<div id="actionMenuTable">
							<button type="submit" name="delete" onclick="delete_work()"><i class='fa fa-user-times'></i> Usuń</button>
						</div>
						<table id="table" class="table-striped">
							<thead>
						    	<tr>
						    		<th scope="col"></th>
						      		<th scope="col">Imię Nazwisko</th>
						      		<th scope="col">Klasa</th>
						      		<th scope="col">Profil</th>
						      		<th scope="col">Nazwa pracy</th>
									<th scope="col">Podgląd</th>
						      		<th scope="col">Edycja</th>
						    	</tr>
						  	</thead>
						  	<tbody id="tableBody">

							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
	</div>


	<?php

		session_start();

		include("../connection.php");

		$success_add_work = 0;
		$arrayWorks = [];

		if(!isset($_SESSION['login'])) {
			header("Location: login.php");
		}

		if(isset($_POST['submitAddFile'])) {
			add_file_into_database_and_directory();
		}

		else if(isset($_POST['editSubmit'])) {
			change_work_name_or_descriptoin();
		}

		else if(isset($_POST['submitChange'])) {
			chnage_user_data();
		}


		function check_get_data() {
			//this function exist because after great added user
			//show alert with information

			//if isset add variabel in url show alert
			if(isset($_SESSION['addUser'])) {
				//show alert 
				echo "<script>alert('uczeń został dodany!');</script>";
				//delete session vairbale
				unset($_SESSION['addUser']);
			}
		}

			
		function get_data_about_user() {
			global $con, $arrayWithDataFromQuery;
			//get user id from url
			$user_id = $_GET['user'];
			//select all data from user table where id is user_id
			$getDataFromSQL = "SELECT * FROM users WHERE id='$user_id'";
			//if query data == true do code else return error
			if($queryData = mysqli_query($con, $getDataFromSQL)) {
				//if query return zero record code will return error
				if($queryData->num_rows > 0) {
					//array for data from query
					while($row = mysqli_fetch_array($queryData)) {
						//append data into array
						$arrayWithDataFromQuery = [
							"id"=>$row['id'],
							"Name"=>$row['Imie'],
							"Lastname"=>$row['Nazwisko'],
							"Class"=>$row['Klasa'],
							"Profile"=>$row['Profil']
						];
					}
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}

			//return array with data for other function
			return $arrayWithDataFromQuery;
		}

		function get_all_user_works() {
			global $con, $arrayWithWorks;
			//get user id from url
			$user_id = $_GET['user'];
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
							"description"=>$row['description'],
							"work_name"=>$row['work_name']
						];
						$counter++;
					}
				}
			}
			else {
				echo "<script>alert('Error');</script>";
			}
		}


		function add_file_into_database_and_directory() {
			global $con, $success_add_work, $arrayWorks;
			//get return value from get_data_about_user function
			$userDataArray = get_data_about_user();

			//get work name
			$work_name = $_POST['work_name'];
			//get description for work
			$description = $_POST['description'];

			//id from returned array
			$id = $userDataArray['id'];
			//user nam
			$name = $userDataArray['Name'];
			//user last name
			$lastname = $userDataArray['Lastname'];
			//user class
			$class = $userDataArray['Class'];
			//and user profile
			$profile = $userDataArray['Profile'];

			//if isset file
		   	if(isset($_FILES['file'])) {
				//get name form file
				$fileName = $_FILES['file']['name'];
				//get file size
				$fileSize = $_FILES['file']['size'];
				//tmp file
				$fileTmp = $_FILES['file']['tmp_name'];
				//path to dircetory
				$dir = "../data/$class/$profile/$name $lastname/";
				//split file name 
				$explode = explode('.',$_FILES['file']['name']);
				//get file extension
				$fileExt = end($explode);

				//max file size 1048576b is a 1MB
				$maxSize = 15*(1048576);
				//possible extensions
			    $extensions = array("jpg", "gif", "png", "mp3", "mp4", "zip");

			    $counter = 0;
			    while($counter < 1) {
				    //if filename dosen't empty do code 
				    if(!empty($fileName)) {
					    //if upload file extension dosen't be in extensions array return alert 
					    if(!in_array($fileExt,$extensions)) {
					        echo("<script>alert('Different extensions, use JPG or PNG');</script>");
					        break;
					    }
					    //if file size is bigger than max size return alert
		      			else if($fileSize > $maxSize) {
		      				//add work data to array
		      				$arrayWorks = [
		      					"id"=>$id,
		      					"fileName"=>$fileName,
		      					"work_name"=>$work_name,
		      					"description"=>$description,
		      					"fileSize"=>$fileSize,
		      					"fileExt"=>$fileExt,
		      					"fileTmp"=>$fileTmp,
		      					"dir"=>$dir
		      				];
		        			break;
		        		}
		      			
		      			//if code didn't return any alert upload file to direcotry and insert data to database
						else {
							//set default timezone for date
							date_default_timezone_set("Europe/Warsaw");
							//set current date
							$date = date("d.m.y h:i:s");

							$fileNameDate = $date.'.'.$fileExt;
							//inset work to server
							move_uploaded_file($fileTmp,$dir.$fileNameDate);
		
							//insert data into data base
							$sendSQL = "INSERT INTO user_works(id_user, file_name, work_name, category, description) VALUES('$id', '$fileNameDate', '$work_name', 'Inne', '$description')";
							$queryInsertWork = mysqli_query($con, $sendSQL);
							
							/*---------APPEND LOGS TO .adminLogs.txt---------*/
							//data to append adminLog
							$data = "Admin added work for user $name $lastname $class $profile at $date\n";
							//append $data to function which append data into .adminLog.txt
							append_data_into_adminLog($data);
							$success_add_work = 1;

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


		function chnage_user_data() {
			global $con;
			//array with old user data
			$arrayOldData = get_data_about_user();

			//get user id
			$user_id = $_GET['user'];
			//name
			$name = $_POST['changeName'];
			//lastname
			$lastname = $_POST['changeLastname'];
			//class
			$class = $_POST['changeClass'];
			//major
			$major = $_POST['changeProfile'];

			$updateSQL = "UPDATE users SET Imie='$name', Nazwisko='$lastname', Klasa='$class', Profil='$major' WHERE id='$user_id'";
			//quert add user
			$updateQuery = mysqli_query($con, $updateSQL);

			$path = "../data/{$arrayOldData['Class']}/{$arrayOldData['Profile']}/{$arrayOldData['Name']} {$arrayOldData['Lastname']}";
			/*---------CHANGE DIRECTORY SETTINGS---------*/
			//if class dir dosent exist create dirvetory
			if(!file_exists("../data/$class")) {
				//create class dir
				mkdir("../data/$class", 0777);
			}

			//if major dir dosent exist create directory
			if(!file_exists("../data/$class/$major")) {
				//create direcotry
				mkdir("../data/$class/$major", 0777);
			}

			//move to other directory or rename directory
			rename($path, "../data/$class/$major/$name $lastname");

			//data to append
			$data = "Admin chnaged user data {$arrayOldData['Name']} {$arrayOldData['Lastname']} {$arrayOldData['Class']} {$arrayOldData['Profile']} at $date\n\tChnages:\n\t\tName: {$arrayOldData['Name']} => $name,\n\t\tLastname: {$arrayOldData['Lastname']} => $lastname,\n\t\tClass: {$arrayOldData['Class']} => $class, \n\t\tProfile: {$arrayOldData['Profile']} => $major\n\n";
			//append $data to function which append data into .adminLog.txt
			append_data_into_adminLog($data);


		}


		function append_data_into_adminLog($data) {
			//set default timezone for date
			date_default_timezone_set("Europe/Warsaw");
			//set current date
			$date = date("d.m.y h:i:s");

			//open file to write
			$file = fopen(".adminLogs.txt", "a");

			//write file
			fwrite($file, $data);
			//clode file
			fclose($file);
		}

		check_get_data();
		get_data_about_user();
		get_all_user_works();

	?>

	<script type="text/javascript">

		function clear_inputs_fileds_after_success_add_work() {
			let success = <?php echo json_encode($success_add_work);?>;
			let backButton = <?php echo json_encode($backButton); ?>;

			if(success == 1) {
				document.querySelector("#work_name").value = "";
				document.querySelector("#description").value = "";
			}
		}
		
		function set_data() {
			//array with data about user
			const arrayData = <?php echo json_encode($arrayWithDataFromQuery);?>;
			const arrayWorks = <?php echo json_encode($arrayWithWorks);?>;
			//table
			let table = document.querySelector('tbody');
			//name and surname(headerText)
			let headerText = document.querySelector('#nameSurname');
			//add name and lastname into header
			headerText.innerHTML = arrayData['Name']+" "+arrayData['Lastname'];

			//get select 
			let select = document.querySelector("#selectWorkToEdit");

			if(arrayWorks != null) {
				//array works len
				let arrayWorksLen = arrayWorks.length;
				//loop exist for adding data into table
				for(let i=0; i<arrayWorksLen; ++i) {

					//crete recodr
					let record = document.createElement('tr');
					//set class name for record
					record.className = "record";
					//append record into table
					table.appendChild(record);


					//data with remove button
					let dataCheckBox = document.createElement('td');
					//set class name
					dataCheckBox.className = 'data';
					//append data to row
					record.appendChild(dataCheckBox);

					//create checkBox 
					let checkBox = document.createElement("input");
					//set type for input
					checkBox.type = "checkbox";
					//set class name
					checkBox.className = "check";
					//set value
					checkBox.value = arrayWorks[i]['id_work'];
					//append checkbox into td
					dataCheckBox.appendChild(checkBox);

					/*
					//remove button
					let removeButton = document.createElement('BUTTON');
					//set class name
					removeButton.className = "removeButton";
					//set text
					removeButton.innerHTML = "X";
					//set id
					removeButton.id = "removeB";
					//set type
					removeButton.type = "submit";
					removeButton.name = "remove";
					//set value
					removeButton.value = arrayWorks[i]['id_work'];

					//function for removeButton to remove work
					removeButton.addEventListener("click", function() {
						//work id
						let work_id = removeButton.value;

						//confirm alert
						let confirmAlert = confirm("Are you want delete this work?");
						//if confirm return true do code
						if(confirmAlert == true) {
						    $.ajax({
						    	type: "POST",
						    	url: "manipulate_data.php",
						      	data: {work_id, userData:arrayData},
						      	success: function() {
						        	return true;
						      	}
						    });
						}
					});
					//append button to data for button
					document.querySelector('body').appendChild(removeButton);
					*/


					//data with name and lastname
					let dataName = document.createElement('td');
					//set class name
					dataName.className = 'data';
					//set text
					dataName.innerHTML = arrayData['Name']+' '+arrayData['Lastname'];
					//append data to row
					record.appendChild(dataName);


					//data with Class
					let dataClass = document.createElement('td');
					//set class name
					dataClass.className = 'data';
					//set text
					dataClass.innerHTML = arrayData['Class'];
					//append data to row
					record.appendChild(dataClass);


					//data with profile
					let dataProfile = document.createElement('td');
					//set class name
					dataProfile.className = 'data';
					//set text
					dataProfile.innerHTML = arrayData['Profile'];
					//append data to row
					record.appendChild(dataProfile);


					//data with work name
					let dataWorkName = document.createElement('td');
					//set class name
					dataWorkName.className = 'data';
					//set text
					dataWorkName.innerHTML = arrayWorks[i]['work_name'];
					//append data to row
					record.appendChild(dataWorkName);

					//data with view button
					let dataButtonView = document.createElement('td');
					//set class name
					dataButtonView.className = 'data';
					//append data to row
					record.appendChild(dataButtonView);

					//view button
					let viewButton = document.createElement('a');
					//set class name
					viewButton.className = "viewButton";
					//set value for button
					viewButton.href = "previewPage.php?work="+arrayWorks[i]['id_work'];
					//set text
					viewButton.innerHTML = "Podgląd";
					//append button to data for button
					dataButtonView.appendChild(viewButton);


					//data with edit button 
					let dataButtonEdit = document.createElement('td');
					//set class name
					dataButtonEdit.className = 'data';
					//append data to row
					record.appendChild(dataButtonEdit);

					//view button
					let editButton = document.createElement('a');
					//set class name
					editButton.className = "editButton";
					//set href for button
					editButton.href = "edit_work.php?work="+arrayWorks[i]['id_work'];
					//set text
					editButton.innerHTML = "Edytuj";
					//append button to data for button
					dataButtonEdit.appendChild(editButton);

				}
			}
		}


		function append_data_into_chnage_inputs_user_data() {
			//array with data about user
			const arrayData = <?php echo json_encode($arrayWithDataFromQuery);?>;

			//get input with change name
			let nameChangeInput = document.querySelector('#changeName');
			//set value for input name
			nameChangeInput.value = arrayData['Name'];

			//get input with change lastname
			let lastnameChangeInput = document.querySelector('#changeLastname');
			//set value for input lasname
			lastnameChangeInput.value = arrayData['Lastname'];


			//get select with class
			let selectClass = document.querySelector('#changeClass');
			//get select with profile
			let selectProfile = document.querySelector('#changeProfile');

			//select this value
			selectClass.value = arrayData['Class'];

			//select this value
			selectProfile.value = arrayData['Profile'];

		}


		function alert_confirm_work() {
			//variable with file size
			let arrayWorks = <?php echo json_encode($arrayWorks); ?>;

			//if file size id bigger than 15MB and ext == png || jpg || gif
			//show confirm alert for photo file
			if((arrayWorks['fileSize'] > 15*(1048576)) && (arrayWorks['fileExt']=='png' || arrayWorks['fileExt']=='jpg' || arrayWorks['fileExt']=='gif')) {
				let confirmAlert = confirm("Plik jest większy niż 15MB czy napewno chcesz dodać ?");
				//if confirm return true send data to PHP by AJAX
				if(confirmAlert == true) {
					$.ajax({
				    	type: "POST",
				    	url: "manipulate_data.php",
				      	data: {work: arrayWorks},
				      	success: function(res) {
				        	return res;
				      	}	
					});
				}
			}
			
			//if file size id bigger than 200MB and ext == mp3 || mp4
			//show confirm alert for audio file
			else if((arrayWorks['fileSize'] >= 200*(1048576)) && (arrayWorks['fileExt']=='mp3' || arrayWorks['fileExt']=='mp4')) {
				let confirmAlert = confirm("Plik jest większy niż 200MB czy napewno chcesz dodać ?");
				//if confirm return true send data to PHP by AJAX
				if(confirmAlert == true) {
					$.ajax({
				    	type: "POST",
				    	url: "manipulate_data.php",
				      	data: {work: arrayWorks},
				      	success: function(res) {
				        	return res;
				      	}	
					});
				}
			}
			//if file size id bigger than 500MB and ext == mp3 || mp4
			//show confirm alert for audio file
			else if((arrayWorks['fileSize'] >= 500*(1048576)) && (arrayWorks['fileExt']=='zip')) {
				let confirmAlert = confirm("Plik jest większy niż 200MB czy napewno chcesz dodać ?");
				//if confirm return true send data to PHP by AJAX
				if(confirmAlert == true) {
					$.ajax({
				    	type: "POST",
				    	url: "manipulate_data.php",
				      	data: {work: arrayWorks},
				      	success: function(res) {
				        	return res;
				      	}	
					});
				}
			}
			//else file is bigger than 5GB
			else if(arrayWorks['fileSize'] > 5000*(1048576)) {
				alert("Plik jest za duży i nie możesz go przesłać !");
			}

			
		}

		window.onload = function() {
			set_data();
			append_data_into_chnage_inputs_user_data();
			clear_inputs_fileds_after_success_add_work();
			alert_confirm_work();
		}

	</script>


</body>
</html>













