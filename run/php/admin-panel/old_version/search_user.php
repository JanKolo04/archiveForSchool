<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search</title>
</head>
<body>

	<form method="post">
		<input type="text" name="searchInput">
		<button type="submit" name="submit">Search</button>
	</form>

	<?php

		include('../connection.php');

		if(isset($_POST['submit'])) {
			search_from_input();
		}

		function search_from_input() {
			global $con;
			//input post
			$searchValue = $_POST['searchInput'];
			//if input len is biger then 0 do code
			if(strlen($searchValue) > 0) {
				//split input
				$arraySplit = explode(" ", $searchValue);

				//clear input
				$searchValue = "";
				//loop to append vlaues to string
				for($i=0; $i<sizeof($arraySplit); $i++) {
					//append value from explode to var
					$searchValue .= $arraySplit[$i];
					if($i != sizeof($arraySplit)-1) {
						//add comma after value but after vlaue if
						//value is not last
						$searchValue .= "','";
					}
				}
				//
				$search = "SELECT * FROM users WHERE Imie IN ('$searchValue') OR Nazwisko IN ('$searchValue')";
				if($querySearch = mysqli_query($con, $search)) {
					if($querySearch->num_rows > 0) {
						//append to array $row elements from query
						while ($row = mysqli_fetch_array($querySearch)) {
							//show results in results will be 
							//Name, Lastname, and buton with link
							//to page with user management
							echo($row['Imie']." ".$row['Nazwisko']." <a href='user_profile.php?user_id=".$row['id']."'>Zarzadzaj</a><br>");
						}
					}
					else {
						echo "<script>alert('Error');</script>";
					}
				}
				else {
					echo "<script>alert('Error');</script>";
				}
			}
		}

	?>

</body>
</html>