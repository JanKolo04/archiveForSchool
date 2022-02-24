<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search</title>
</head>
<body>


	<?php
		//imports files
		include('../connection.php');
		include("user_profile_page.php");
		include("search_user_page.php");

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
							echo($row['Imie']." ".$row['Nazwisko']." <a href='search_user_admin.php?user_id=".$row['id']."'>Zarzadzaj</a><br>");
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

		//function to select page
		function wich_page() {
			//if isset user_id show user profile
			if(isset($_GET['user_id'])) {
				user_profile_page();
				get_id();
			}
			//if user_id dosent exist show search page
			else {
				//search user page
				search_user_page();
				//if you click submit button function with
				//show users will run
				if(isset($_POST['submitSearch'])) {
					search_from_input();
				}
			}
		}

		wich_page();

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
					let viewButton = document.createElement('a');
					//set class name
					viewButton.className = "viewButton";
					//set href for button
					viewButton.href = "../overview/work.php?work="+arrayWorks[i]['id_work'];
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


		function set_value_for_input(event) {
			//get array with work data
			const worksArray = <?php echo json_encode($arrayWithWorks);?>;
			//value from target
			let optionValue = event.target.value;
			//inputs
			let editWork_name = document.querySelector('#editWork_name');
			let editDescription = document.querySelector('#editDescription');

			//this loop is for checking wich option has cliked
			for(let i=0; i<worksArray.length; ++i) {
				//if option isn't --Select-- set value for inputs	
				if(optionValue == worksArray[i]['id_work']) {
					//set value for input work name
					editWork_name.value = worksArray[i]['work_name'];
					//set value for input description
					editDescription.value = worksArray[i]['description'];
				}
			}
		}

		
		set_data();
		

	</script>

</body>
</html>