<?php
  
$servername = "localhost";
$username = "root";
$password = "";
$database = "testArch";

//connectiong with database
$con = mysqli_connect($servername, $username, $password, $database);


//checking conection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>