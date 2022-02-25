<?php
  
$servername = "localhost";
$username = "user";
$password = "user123";
$database = "testArch";

//connectiong with database
$con = mysqli_connect($servername, $username, $password, $database);


//checking conection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>