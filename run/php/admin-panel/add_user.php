<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add file</title>
</head>
<body>

	<form method="post" enctype="multipart/form-data">
		<select name="users" id="users">
			<option>--Select--</option>
		</select>
		<input type="file" name="file">
		<button name="submit" type="submit">Get</button>
	</form>

	<?php

		include("../connection.php");

		if(isset($_POST['submit'])) {
			send();
		}

		function get_user() {
			global $con, $arrayAll;

			$get = "SELECT * FROM users";
			$queryGet = mysqli_query($con, $get);

			$arrayAll = [""];
			$i = 0;
			while($row = mysqli_fetch_array($queryGet)) {
				foreach($queryGet as $key=>$value) {
					$arrayAll[$i] = $value;
					$i++;
				}
			}
		}

		function send() {
			global $con;

			$selected = $_POST['users'];
			$arrayData = explode(" ",$selected);
			$id = $arrayData[0];
			$name = $arrayData[1];
			$lastname = $arrayData[2];
			$class = $arrayData[3];
			$profil = $arrayData[4];

		   	if(isset($_FILES['file'])) {
				$errors= array();
				$fileName = $_FILES['file']['name'];
				$fileSize =$_FILES['file']['size'];
				$fileTmp =$_FILES['file']['tmp_name'];
				$dir = '../all/';

				$explode = explode('.',$_FILES['file']['name']);
				$fileExt = end($explode);

				//max file size
				$maxSize = 5*(1048576);
			    $extensions= array("jpg","png");

			    while(empty($errors)) {
				    if(file_exists($dir.$fileName)) {
				    	$errors[] = 'File exist';
				     	echo("<script>alert('File exist');</script>");
				     	break;

				    }
				      
				    else if(!in_array($fileExt,$extensions)) {
				        $errors[] = 'Different extensions, use JPG or PNG';
				        echo("<script>alert('Different extensions, use JPG or PNG');</script>");
				        break;
				    }

	      			else if($fileSize > $maxSize) {
	        			$errors[] = 'File is biger than 3MB';
	        			echo("<script>alert('File is biger than 3MB');</script>");
	        			echo $fileSize;
	        			break;
	      			}

					else if(empty($errors)) {
						move_uploaded_file($fileTmp,$dir.$fileName);

						$sendSQL = "INSERT INTO works(Imie, Nazwisko, Klasa, id_user, work_name, Profil) VALUES('$name', '$lastname', '$class', '$id', '$fileName', '$profil')";
						$queryInsertWork = mysqli_query($con, $sendSQL);
						break;

					}
				}

		   	}

		}

		get_user();

	?>

	<script type="text/javascript">
		
		function print_all_data() {
			const arrayAll = <?php echo json_encode($arrayAll); ?>;

			const select = document.querySelector('#users');

			let len = arrayAll.length;
			for(let i=0; i<len; ++i) {
				let text = arrayAll[i]["id"]+" "+arrayAll[i]['Imie']+" "+arrayAll[i]['Nazwisko']+" "+arrayAll[i]['Klasa']+" "+arrayAll[i]['Profil'];

				let option = document.createElement("option");
				option.class = "option";
				option.innerHTML = text;
				select.appendChild(option);
			}
		}

		print_all_data();

	</script>

</body>
</html>