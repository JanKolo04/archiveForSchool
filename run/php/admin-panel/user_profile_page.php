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

	else if(isset($_POST['removeButton'])) {
		remove_work();
	}

	function user_profile_page() {
		//run function with data arrays
		echo "

			<div id='allStuff'>
				<h2 id='nameSurname'></h2>

				<form method='post' enctype='multipart/form-data'>
					<div id='allInputs'>
						<div id='changeDiv'>
							<div id='chnageInputsDiv'>
								<input type='text' name='changeName' id='changeName' placeholder='Chnage name...'>
								<input type='text' name='changeLastname' id='changeLastname' placeholder='Chnage Lastname...'>
							</div>

							<div id='changeSelectDiv'>
								<div id='selectClassDiv'>
									<select name='changeClass' id='changeClass'>
										<option disabled selected value>Select class</option>
										<option value='3a'>3a</option>
										<option value='3b'>3b</option>
										<option value='3c'>3c</option>
									</select>
								</div>
								<div id='selectProfileDiv'>
									<select name='changeProfile' id='changeProfile'>
										<option disabled selected value>Select profile</option>
										<option value='Informatyka'>Informatyka</option>
										<option value='Grafika'>Grafika</option>
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

				<div id='divTable'>
					<table id='table'>
						<tboody>
						</tboody>
					</table>
				</div>
				</form>
			</div>

		";
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
		$arrayWithDataFromQuery = get_data_about_user();

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
		$profile = $arrayWithDataFromQuery['Profile'];

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
						$sendSQL = "INSERT INTO user_works(id_user, file_name, work_name, description) VALUES('$id', '$fileName', '$work_name', '$description')";
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

		/*---------APPEND LOGS TO .adminLogs.txt---------*/
		//set default timezone for date
		date_default_timezone_set("Europe/Warsaw");
		//set current date
		$date = date("d.m.y h:i:s");

		//open file to write
		$file = fopen(".adminLogs.txt", "a");
		//data to append
		$data = "Admin chnaged user data ".$arrayOldData['Name']." ".$arrayOldData['Lastname']." ".$arrayOldData['Class']." ".$arrayOldData['Profile']." at $date\n\tChnages:\n\t\t".$arrayOldData['Name']." => $name,\n\t\t".$arrayOldData['Lastname']." => $lastname,\n\t\t".$arrayOldData['Class']." => $class, \n\t\t".$arrayOldData['Profile']." => $profile\n";
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
















