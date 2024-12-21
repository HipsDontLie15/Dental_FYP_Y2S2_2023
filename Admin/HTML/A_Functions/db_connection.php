<?php  

//variable declaration
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname= "fyp_dental";

// Create connection
$conn = mysqli_connect($servername,
$dbusername, $dbpassword,$dbname);

// Check connection
if (!$conn) { 
die("Connection failed:" . 
mysqli_connect_error()); }
//echo "Connected successfully<br>";

?>