<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>test</title>
</head>
<body>

	<?php
		//get name form file
		$fileName = "add_user.php";
		//path to dircetory
		$dir = "test/".$fileName;
		
		//username
		$usernameFtp = "username";
		//password
		$passwordFtp = "***";
		//sername
		$servername = "servername";

		//set up basic connection
		$ftp = ftp_connect($servername);

		//login with username and password
		$login_result = ftp_login($ftp, $usernameFtp, $passwordFtp);



		// upload a file
		if (ftp_put($ftp, $dir, $fileName, FTP_ASCII)) {
		 echo "successfully uploaded $fileName\n";
		} else {
		 echo "There was a problem while uploading $fileName\n";
		}

		// close the connection
		ftp_close($ftp);
	?>

</body>
</html>