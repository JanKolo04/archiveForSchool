<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-user-page.css">
	<title>User profile</title>
</head>
<body>

	<div id="allStuff">
		<h2 id="nameSurname"></h2>

		<form method="post" enctype="multipart/form-data">
			<div id="allInputs">
				<div id="changeDiv">
					<div id="chnageInputsDiv">
						<input type="text" name="changeName" id="changeName" placeholder="Chnage name...">
						<input type="text" name="changeLastname" id="changeLastname" placeholder="Chnage Lastname...">
					</div>

					<div id="changeSelectDiv">
						<div id="selectClassDiv">
							<select name="changeClass" id="changeClass">
								<option disabled selected value>Select class</option>
								<option value="3a">3a</option>
								<option value="3b">3b</option>
								<option value="3c">3c</option>
							</select>
						</div>

						<div id="selectProfileDiv">
							<select name="changeProfile" id="changeProfile">
								<option value="Grafika komputerowa">Grafika komputerowa</option>
								<option value="Tworzenie gier">Tworzenie gier</option>
								<option value="Fotografia kreatywna">Fotografia kreatywna</option>
								<option value="Animacja komputerowa">Animacja komputerowa</option>
								<option value="Informatyka">
									Informatyka
								</option>
							</select>
						</div>
					</div>

					<div id="submitChangeDiv">
						<button type="submit" name="submitChange">Change</button>
					</div>
				</div>

				<div id="inputsDiv">
					<div id="inputsFileTextDiv">
						<input type="text" name="work_name" placeholder="Work name...">
						<input type="text" name="description" placeholder="Description...">
					</div>
					<div id="inputFileSelectDiv">
						<input type="file" name="file">
						<button type="submit" name="submitAddFile">Add</button>
					</div>
				</div>
			</div>

		<div id="divTable">
			<form method="POST">
				<table id="table">
					<tboody>
					</tboody>
				</table>
			</form>
		</div>
		</form>
	</div>


	<?php

		include("../connection.php");
		//auto run functions
		get_data_about_user();
		get_all_user_works();

		if(isset($_POST['submitAddFile'])) {
			add_file_into_database_and_directory();
		}

		else if(isset($_POST['editSubmit'])) {
			change_work_name_or_descriptoin();
		}

		else if(isset($_POST['submitChange'])) {
			chnage_user_data();
		}

		else if(isset($_POST['removeButton'])) {
			remove_work();
		}


			
		function get_data_about_user() {
			global $con, $arrayWithDataFromQuery;
			//get user id from url
			$user_id = $_GET['user_id'];
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
			$user_id = $_GET['user_id'];
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
			global $con;
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
				$dir = "../images/$profile/$class/$name $lastname/";
				//split file name 
				$explode = explode('.',$_FILES['file']['name']);
				//get file extension
				$fileExt = end($explode);

				//max file size 1048576 is a 1MB in bits
				$maxSize = 3*(1048576);
				//possible extensions
			    $extensions = array("jpg","png");

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
							echo("<script>alert('File is bigger than 3MB');</script>");
		        			break;
		        		}
		      			
		      			//if code didn't return any alert upload file to direcotry and insert data to database
						else {
							move_uploaded_file($fileTmp,$dir.$fileName);
							//insert data into data base
							$sendSQL = "INSERT INTO user_works(id_user, file_name, work_name, category, description) VALUES('$id', '$fileName', '$work_name', 'Inne', '$description')";
							$queryInsertWork = mysqli_query($con, $sendSQL);
							
							/*---------APPEND LOGS TO .adminLogs.txt---------*/
							//set default timezone for date
							date_default_timezone_set("Europe/Warsaw");
							//set current date
							$date = date("d.m.y h:i:sa");

							//open file to write
							$file = fopen(".adminLogs.txt", "a");
							//data to append
							$data = "Admin added work for user $name $lastname $class $profile at $date\n";
							//write file
							fwrite($file, $data);
							//clode file
							fclose($file);

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
			$user_id = $_GET['user_id'];
			//name
			$name = $_POST['changeName'];
			//lastname
			$lastname = $_POST['changeLastname'];
			//class
			$class = $_POST['changeClass'];
			//profile
			$profile = $_POST['changeProfile'];

			$updateSQL = "UPDATE users SET Imie='$name', Nazwisko='$lastname', Klasa='$class', Profil='$profile' WHERE id='$user_id'";
			//quert add user
			$updateQuery = mysqli_query($con, $updateSQL);

			$path = "../images/{$arrayOldData['Profile']}/{$arrayOldData['Class']}/{$arrayOldData['Name']} {$arrayOldData['Lastname']}";
			/*---------CHANGE DIRECTORY SETTINGS---------*/
			//move to other directory or rename directory
			rename($path, "../images/$profile/$class/$name $lastname");

			/*---------APPEND LOGS TO .adminLogs.txt---------*/
			//set default timezone for date
			date_default_timezone_set("Europe/Warsaw");
			//set current date
			$date = date("d.m.y h:i:s");

			//open file to write
			$file = fopen(".adminLogs.txt", "a");
			//data to append
			$data = "Admin chnaged user data {$arrayOldData['Name']} {$arrayOldData['Lastname']} {$arrayOldData['Class']} {$arrayOldData['Profile']} at $date\n\tChnages:\n\t\tName: {$arrayOldData['Name']} => $name,\n\t\tLastname: {$arrayOldData['Lastname']} => $lastname,\n\t\tClass: {$arrayOldData['Class']} => $class, \n\t\tProfile: {$arrayOldData['Profile']} => $profile\n\n";
			//write file
			fwrite($file, $data);
			//clode file
			fclose($file);

		}

		//function to remove work
		function remove_work() {
			global $con;
			//array with data about user
			$arrayWithUserData = get_data_about_user();
			//get value from button
			$removeButton = $_POST['removeButton'];

			//get work name
			$getWorkNameSQL = "SELECT file_name FROM user_works WHERE id='$removeButton'";
			$getWorkNameQuery = mysqli_query($con, $getWorkNameSQL);
			//append reslut to variable
			$arrayWithFile_name = mysqli_fetch_array($getWorkNameQuery);

			//remove work
			$removeSQL = "DELETE FROM user_works WHERE id='$removeButton'";
			$removeQuery = mysqli_query($con, $removeSQL);


			//path to file
			$pathToFile = "../images/".$arrayWithUserData["Profile"]."/".$arrayWithUserData['Class']."/".$arrayWithUserData['Name']." ".$arrayWithUserData['Lastname']."/".$arrayWithFile_name['file_name'];

			//if code cant delete file return error
			if(!unlink($pathToFile)) {
				echo "<script> alert('Error'); </script>";
			}
		}

	?>

	<script type="text/javascript">
		
		function set_data() {
			//array with data about user
			const arrayData = <?php echo json_encode($arrayWithDataFromQuery);?>;
			const arrayWorks = <?php echo json_encode($arrayWithWorks);?>;
			//table
			let table = document.querySelector('#table');
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
					let dataButtonRemove = document.createElement('td');
					//set class name
					dataButtonRemove.className = 'data';
					//append data to row
					record.appendChild(dataButtonRemove);

					//remove button
					let removeButton = document.createElement('BUTTON');
					//set class name
					removeButton.className = "removeButton";
					//set text
					removeButton.innerHTML = "X";
					//set name
					removeButton.name = "removeButton";
					//set value
					removeButton.value = arrayWorks[i]['id_work'];
					//append button to data for button
					dataButtonRemove.appendChild(removeButton);


					//data with name
					let dataName = document.createElement('td');
					//set class name
					dataName.className = 'data';
					//set text
					dataName.innerHTML = arrayData['Name'];
					//append data to row
					record.appendChild(dataName);

					//data with Lastname
					let dataLastName = document.createElement('td');
					//set class name
					dataLastName.className = 'data';
					//set text
					dataLastName.innerHTML = arrayData['Lastname'];
					//append data to row
					record.appendChild(dataLastName);


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
					let viewButton = document.createElement('BUTTON');
					//set class name
					viewButton.className = "viewButton";
					//set value for button
					viewButton.value = arrayWorks[i]['id_work'];
					//set name
					viewButton.name = "viewButton"
					//set text
					viewButton.innerHTML = "View";
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
					editButton.innerHTML = "Edit";
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

		window.onload = function() {
			set_data();
			append_data_into_chnage_inputs_user_data();
		}

	</script>


</body>
</html>













