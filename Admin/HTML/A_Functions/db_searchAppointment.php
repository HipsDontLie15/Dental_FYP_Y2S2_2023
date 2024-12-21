<?php
	include './A_Functions/db_connection.php';
	$sql = "SELECT * FROM appointment_info";
	$result = $conn->query($sql);	//execute query connection
	$search_result = mysqli_query($conn, $sql);
?>