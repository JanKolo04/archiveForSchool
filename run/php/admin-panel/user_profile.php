<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
</head>
<body>

	<div id="allStuff">
		<h2 id="nameSurname"></h2>

		<form method='post' enctype="multipart/form-data">
			<div id="inputsDiv">
				<div id="inputsEditsDiv">
					<input type="text" name="editWork_name" placeholder="Change work name">
					<input type="text" name="editDescription" placeholder="Change description">
				</div>

				<div id="selectFileDiv">
					<div id="selectDiv">
						<select name="selectWorkToEdit" id="selectWorkToEdit">
							<option>--Select--</option>
						</select>
					</div>
					<div id="submitEditButtonDiv">
						<button type="submit" name="editSubmit">Edit</button>
					</div>
				</div>

				<div id="inputsFileTextDiv">
					<input type="text" name="work_name" placeholder="Work name...">
					<input type="text" name="description" placeholder="Description...">
				</div>
				<div id="inputFileSelectDiv">
					<input type="file" name="file">
					<button type="submit" name="submit">Add</button>
				</div>
			</div>
		</form>

		<div id="divTable">
			<table id="table">
				<tboody>
				</tboody>
			</table>
		</div>
	</div>



	<style type="text/css">

		/*-----STYLE FOR MAIN DIVS-------*/
		#allStuff {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}

		#inputsDiv {
			margin-top: 20px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}


		/*-----STYLE FOR EDITS INPUTS-------*/
		#selectFileDiv  {
			width: 100%;
			margin: 10px;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		#selectDiv {
			width: 50%;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		#submitEditButtonDiv {
			width: 50%;
			display: flex;
			justify-content: center;
			align-items: center;
		}


		/*-----STYLE FOR ADD INPUTS-------*/

		#inputsFileTextDiv {
			margin-top: 30px;
		}

		#inputFileSelectDiv {
			margin-top: 10px;
		}

		#divTable {
			margin-top: 40px;
		}

	</style>




	<?php

		include("../connection.php");

		if(isset($_POST['submit'])) {
			add_file_into_database_and_directory();
		}

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
			//return array with data for other function
			return $arrayWithDataFromQuery;
		}	

		get_id();


		function add_file_into_database_and_directory() {
			global $con;
			//get return value form prevous function
			$arrayWithDataFromQuery = get_id();

			//get work name
			$work_name = $_POST['work_name'];
			//get description for work
			$description = $_POST['description'];

			//id from returned array
			$id = $arrayWithDataFromQuery['id'];
			//user nam
			$name = $arrayWithDataFromQuery['Name'];
			//user last name
			$lastname = $arrayWithDataFromQuery['Lastname'];
			//user class
			$class = $arrayWithDataFromQuery['Class'];
			//and user profile
			$profil = $arrayWithDataFromQuery['Profile'];

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
				$dir = "../all/$profil/$class/$name $lastname/";
				//split file name 
				$explode = explode('.',$_FILES['file']['name']);
				//get file extension
				$fileExt = end($explode);

				//max file size 1048576 is a 1MB in bits
				$maxSize = 5*(1048576);
				//possible extensions
			    $extensions= array("jpg","png");

			    //if filename dosen't empty do code 
			    if(!empty($fileName)) {
			    	//if file exist show alert
				    if(file_exists($dir.$fileName)) {
				     	echo("<script>alert('File exist');</script>");
				    }
				    //if upload file extension dosen't be in extensions array return alert 
				    else if(!in_array($fileExt,$extensions)) {
				        echo("<script>alert('Different extensions, use JPG or PNG');</script>");
				    }
				    //if file size is bigger than max size return alert
	      			else if($fileSize > $maxSize) {
	        			echo("<script>alert('File is biger than 5MB');</script>");
	      			}
	      			//if code didn't return any alert upload file to direcotry and insert data to database
					else {
						move_uploaded_file($fileTmp,$dir.$fileName);
						//insert data into data base
						$sendSQL = "INSERT INTO user_works(Imie, Nazwisko, Klasa, id_user, file_name, Profil, work_name, description) VALUES('$name', '$lastname', '$class', '$id', '$fileName', '$profil', '$work_name', '$description')";
						$queryInsertWork = mysqli_query($con, $sendSQL);
						//uset file name	
						unset($fileName);
					}
				}
				//if any file didn't been selected return alert
				else {
					echo("<script>alert('No files has been selected');</script>");
				}

		   	}

		}


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

			if(arrayWorks != null) {
				//array works len
				let arrayWorksLen = arrayWorks.length;
				//loop exist for adding data into table
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
					viewButton.href = "../podglad/art.php?work="+arrayWorks[i]['id_work'];
					//set text
					viewButton.innerHTML = "View";
					//append button to data for button
					dataButton.appendChild(viewButton);

				}
			}
		}

		set_data();

	</script>

</body>
</html>











