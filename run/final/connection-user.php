<?php
  
$servername = "192.168.101.62";
$username = "labzsk_serwerWWW";
$password = "KhL9Fn7h+g-=";
$database = "labzsk_portfolia";

//connectiong with database
$con = mysqli_connect($servername, $username, $password, $database);


//checking conection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>