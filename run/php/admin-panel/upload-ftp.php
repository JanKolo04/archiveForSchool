<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>test</title>
</head>
<body>

	<?php
		function upload_file($dir) {
			//get name form file
			$fileName = "add_user.php";
			
			//username
			$usernameFtp = "jkolodziej@labzsk.webd.pro";
			//password
			$passwordFtp = "sq8++PHyK+JU";
			//sername
			$servername = "ftp.labzsk.webd.pro";

			//set up basic connection
			$ftp = ftp_connect($servername);

			//login with username and password
			$login_result = ftp_login($ftp, $usernameFtp, $passwordFtp);



			//upload a file
			if (ftp_put($ftp, $dir, $fileName, FTP_ASCII)) {
				echo "successfully uploaded $fileName\n";
			} 
			else {
				echo "There was a problem while uploading $fileName\n";
			}

			//close the connection
			ftp_close($ftp);
		}

	?>

</body>
</html>