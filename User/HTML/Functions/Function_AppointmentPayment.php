<?php
$successfulURL = '../U_AppointmentSuccess.php';
$failURL = '../U_AppointmentFail.php';

include 'Function_ConnectSQL.php';
session_start();



if(isset($_POST['submitPayment']))
{
	//customer details
	$app_email=$_POST['c_email'];
	$c_id=$_POST['c_id'];

	//selected details
	$app_type=$_POST['app_type'];
	if (isset($_POST['app_care']) && is_array($_POST['app_care'])) {
		$app_care = implode(", ", $_POST['app_care']);
	} else {
		// Handle the case when app_care is not an array
		$app_care = $_POST['app_care'];
	}
	$app_doc = $_POST['app_doc'];
	$app_loc = $_POST['app_loc'];
	$app_date=$_POST['app_date'];
	$app_time=$_POST['app_time'];
	$app_description=$_POST['app_description'];
	$book_by = "Customer";
	$select_status = "Booked";
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$timestamp = date('Y-m-d H:i:s');

	
    //Customer payment
    $c_payment = 20;
    $c_cardname = isset($_POST['c_cardname']) ? $_POST['c_cardname'] : '' ;
    $c_cardnum = isset($_POST['c_cardnum']) ? $_POST['c_cardnum'] : '' ;
    $c_cardexpire = isset($_POST['c_cardexpire']) ? $_POST['c_cardexpire'] : '' ;
    $c_cardcode = isset($_POST['c_cardcode']) ? $_POST['c_cardcode'] : '' ;
	$payment_status = "paid";


	//membership details
	$usePoints = isset($_POST['usePoints']) ? $_POST['usePoints'] : 'No' ;
	$active_status = "active";
	// $c_hygiene = isset($_POST['c_hygiene']) ? intval($_POST['c_hygiene']) : 0; // Convert to integer
	$c_hygiene = isset($_POST['c_hygiene']) ? intval($_POST['c_hygiene']) : 0; // Convert to integer

	// Adjust points based on checkbox state
	if (isset($_POST['c_hygiene_checkbox']) && $_POST['c_hygiene_checkbox'] == 'Yes') {
		// Subtract 1 only if the checkbox is checked
		$adjusted_c_hygiene = max(0, $c_hygiene - 1);
	} else {
		// Keep the original value if the checkbox is not checked
		$adjusted_c_hygiene = $c_hygiene;
	}
	
	$c_examination = isset($_POST['c_examination']) ? intval($_POST['c_examination']) : 0;
	
	// Adjust points based on checkbox state
	if (isset($_POST['c_examination_checkbox']) && $_POST['c_examination_checkbox'] === 'Yes') {
		// Subtract 1 only if the checkbox is checked
		$adjusted_c_examination = max(0, $c_examination - 1);
	} else {
		// Keep the original value if the checkbox is not checked
		$adjusted_c_examination = $c_examination;
	}
	

	// Get QDC SmilePoints from user input if available, else use the value from the database
	$c_points = isset($_POST['c_points']) ? intval($_POST['c_points']) : 0;

	// Ensure the adjusted points don't go below zero
	$adjusted_c_points = max(0, $c_points - $c_payment);

	
	
	$insert_appInfo = "INSERT INTO appointment_info (app_email, app_type, app_care, app_doc, app_loc, app_date, app_time, app_description, status, book_by, timestamp)
			VALUES ('$app_email', '$app_type', '$app_care', '$app_doc', '$app_loc', '$app_date', '$app_time', '$app_description', '$select_status', '$book_by', '$timestamp')";

	$insert_appPayCard = "INSERT INTO appointment_payment (c_id, c_email, c_usePoints, c_payment, c_cardname, c_cardnum, c_cardexpire, c_cardcode, status, created_at)
			VALUES ('$c_id', '$app_email', '$usePoints', '$c_payment', '$c_cardname', '$c_cardnum', '$c_cardexpire', '$c_cardcode', '$payment_status', '$timestamp')";
	
	$insert_appPayPoints = "INSERT INTO appointment_payment (c_id, c_email, c_usePoints, c_payment, c_points, c_hygiene, c_examination, status, created_at)
	VALUES ('$c_id', '$app_email', '$usePoints', '$c_payment', '$adjusted_c_points', '$adjusted_c_hygiene', '$adjusted_c_examination', '$payment_status', '$timestamp')";

	$insert_membership = "INSERT INTO customermembership (c_id, c_email, c_hygiene, c_examination, c_points, status, created_at)
	VALUES ('$c_id', '$app_email', '$adjusted_c_hygiene', '$adjusted_c_examination', '$adjusted_c_points', '$active_status', '$timestamp')";
	
		// !booked
		if($usePoints == "Yes"){
			if(($conn->query($insert_appInfo) === TRUE) && ($conn->query($insert_membership) === TRUE) && ($conn->query($insert_appPayPoints) === TRUE)){
				// Insertion successful Points
				$_SESSION['successType'] = 'appointmentWithPoints';

				header("location: ".$successfulURL);
				exit;
			
			}
		} elseif ($usePoints == "No"){
			if (($conn->query($insert_appInfo) === TRUE) && ($conn->query($insert_appPayCard) === TRUE)) {
			// Insertion successful Cards
			$_SESSION['successType'] = 'appointment';

			header("location: ".$successfulURL);
			exit;
			}
			
			
		} else {
			// Error occurred during insertion
			header("location: ".$failURL);
			exit;
		}

		mysqli_close($conn);
		
	}
?>