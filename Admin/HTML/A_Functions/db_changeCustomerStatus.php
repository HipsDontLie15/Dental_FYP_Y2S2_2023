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
	

	$sql6=mysqli_query($conn,"select * from customers");  
	//Get Update id and status  
	if (isset($_GET['c_id']) && isset($_GET['c_status'])) {  
		
		$id=$_GET['c_id'];  
		$status=$_GET['c_status'];
		
		if ($status === "Active" || $status === "Deactivate") {
			$updatequery = "UPDATE customers SET `c_status` = '$status' WHERE `c_id` = '$id'";
			
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