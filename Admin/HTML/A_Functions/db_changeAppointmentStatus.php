<?php
	
if (isset($_GET['delete_action'])) {
    if ($_GET['delete_action'] == "success") {
        $response = array('success' => true);
    } else {
        $response = array('success' => false);
    }

    // Return the response as JSON
    echo json_encode($response);
    exit;
}
	

	$sql6=mysqli_query($conn,"select * from appointment_info");  
	//Get Update app_id and status  
	if (isset($_GET['app_id']) && isset($_GET['status'])) {  
		
		$app_id=$_GET['app_id'];  
		$status=$_GET['status'];
		
		if ($status === "Booked" || $status === "Freed") {
			$updatequery = "UPDATE appointment_info SET `status` = '$status' WHERE `app_id` = '$app_id'";
			
			if (mysqli_query($conn, $updatequery)) {
				$response = array('success' => true);
			} else {
				$response = array('success' => false);
			}
		} else {
			$response = array('success' => false);
		}
	
		// Return the response as JSON
		echo json_encode($response);
		exit;
	}
?>