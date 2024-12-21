<?php
	include './A_Functions/db_connection.php';
	$appInfoQuery = "SELECT * FROM appointment_info WHERE status = 'Booked' ";
	$pmInfoQuery = "SELECT * FROM paymentmembership";
	$serInfoQuery = "SELECT * FROM services";

	$appInfoResult = $conn->query($appInfoQuery);
	$pmInfoResult = $conn->query($pmInfoQuery);
	$serInfoResult = $conn->query($serInfoQuery);
	
?>