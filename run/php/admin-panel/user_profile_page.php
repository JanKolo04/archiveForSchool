<?php

	include("../connection.php");

	if(isset($_POST['submitAddFile'])) {
		add_file_into_database_and_directory();
	}

	else if(isset($_POST['editSubmit'])) {
		change_work_name_or_descriptoin();
	}

	else if(isset($_POST['submitChange'])) {
		chnage_user_data();
	}

	function user_profile_page() {
		echo "
			<div id='allStuff'>
				<h2 id='nameSurname'></h2>

				<form method='post' enctype='multipart/form-data'>
					<div id='allInputs'>
						<div id='changeDiv'>
							<div id='chnageInputsDiv'>
								<div id='nameInputDiv'>
									<input type='text' name='changeName' id='changeName' placeholder='Chnage name...'>
								</div>
								<div id='lastnameInputDiv'>
									<input type='text' name='changeLastname' id='changeLastname' placeholder='Chnage Lastname...'>
								</div>
							</div>

							<div id='changeSelectDiv'>
								<div id='selectClassDiv'>
									<select name='changeClass' id='changeClass'>
										<option disabled selected value>Select class</option>
									</select>
								</div>
								<div id='selectProfileDiv'>
									<select name='changeProfile' id='changeProfile'>
										<option disabled selected value>Select profile</option>
									</select>
								</div>
							</div>

							<div id='submitChangeDiv'>
								<button type='submit' name='submitChange'>Change</button>
							</div>
						</div>

						<div id='inputsDiv'>
							<div id='inputsFileTextDiv'>
								<input type='text' name='work_name' placeholder='Work name...'>
								<input type='text' name='description' placeholder='Description...'>
							</div>
							<div id='inputFileSelectDiv'>
								<input type='file' name='file'>
								<button type='submit' name='submitAddFile'>Add</button>
							</div>
						</div>
					</div>
				</form>

				<div id='divTable'>
					<table id='table'>
						<tboody>
						</tboody>
					</table>
				</div>
			</div>



			<style type='text/css'>

				/*-----STYLE FOR MAIN DIVS-------*/
				#allStuff {
					display: flex;
					justify-content: center;
					align-items: center;
					flex-direction: column;
				}

				#allInputs {
					width: 100%;
				}

				#inputsDiv {
					margin-top: 20px;
					display: flex;
					justify-content: center;
					align-items: center;
					flex-direction: column;
				}


				/*-----STYLE FOR CHANGE DATA IN USER----*/
				#changeDiv {
					margin-top: 30px;
					width: 100%;
					display: flex;
					justify-content: center;
					align-items: center;
					flex-direction: column;
				}

				#chnageInputsDiv {
					width: 100%;
					display: flex;
					justify-content: center;
					align-items: center;
					flex-direction: row;
				}

				#chnageInputsDiv div {
					width: 50%;
					display: flex;
					justify-content: center;
					align-items: center;
				}

				#changeSelectDiv {
					margin-top: 10px;
					width: 100%;
					display: flex;
					justify-content: center;
					align-items: center;
					flex-direction: row;	
				}

				#changeSelectDiv div {
					width: 50%;
					display: flex;
					justify-content: center;
					align-items: center;
				}

				#submitChangeDiv {
					margin-top: 10px;
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

		";
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

	function change_work_name_or_descriptoin() {
		global $con;
		//get data from edit inputs
		//work name input
		$workNameEdit = $_POST['editWork_name'];
		//description input
		$descriptionEdit = $_POST['editDescription'];

		//optoin value
		$optionValue = $_POST['selectWorkToEdit'];

		//sql query
		$sqlCheck = "SELECT work_name, description FROM user_works WHERE id='$optionValue'";
		if($queryCheck = mysqli_query($con, $sqlCheck)) {
			if($queryCheck->num_rows > 0) {
				//array for data from sqlCheck
				$arrayWithCheckData = [];
				while($row = mysqli_fetch_array($queryCheck)) {
					//append data
					$arrayWithCheckData = [
						"work_name"=>$row['work_name'],
						"description"=>$row['description']
					];
				}

				//if work is different or description then data in db do update db
				if($arrayWithCheckData['work_name'] != $workNameEdit || $arrayWithCheckData['description'] != $descriptionEdit) {
					//update data
					$sqlChange = "UPDATE user_works SET work_name='$workNameEdit', description='$descriptionEdit' WHERE id='$optionValue'";
					$queryChange = mysqli_query($con, $sqlChange);
				}


				//if data is same code will return alert
				else if(($arrayWithCheckData['work_name'] == $workNameEdit) && ($arrayWithCheckData['description'] == $descriptionEdit)) {
					//alert
					echo "<script>alert('Data is same');</script>";
				}
				//if error return alert with error
				else {
					echo "<script>alert('Error');</script>";
				}
			}
		}
		else {
			echo "<script>alert('Error');</script>";
		}

	}


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
			$dir = "../images/$profil/$class/$name $lastname/";
			//split file name 
			$explode = explode('.',$_FILES['file']['name']);
			//get file extension
			$fileExt = end($explode);

			//max file size 1048576 is a 1MB in bits
			$maxSize = 3*(1048576);
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


	function chnage_user_data() {
		global $con;
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

	}


?>


