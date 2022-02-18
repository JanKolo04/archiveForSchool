<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add file</title>
</head>
<body>

	<form method="post">
		<select name="users" id="users">
			<option>--Select--</option>
		</select>
		<button name="submit" type="submit">Get</button>
	</form>

	<?php

		include("../connection.php");

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
		
		/*

			-----TOD DO-----
			1.Pobranie pierwszej wartości z optin czyli !!!ID!!!

		*/

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