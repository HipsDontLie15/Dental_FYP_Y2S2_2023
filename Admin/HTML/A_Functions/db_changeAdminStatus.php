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
	

	$sql6=mysqli_query($conn,"select * from admins");  
	//Get Update id and status  
	if (isset($_GET['admin_id']) && isset($_GET['status'])) {  
		
		$id=$_GET['admin_id'];  
		$status=$_GET['status'];

			
		if ($status === "active") {
			$updatequery = "UPDATE admins SET `status` ='$status' WHERE `admin_id` ='$id'";
		} elseif ($status === "deactivate") {
			$updatequery = "UPDATE admins SET `status` ='$status' WHERE `admin_id` ='$id'";
		}
	
		if (mysqli_query($conn, $updatequery)) {
			$response = array('success' => true);
		} else {
			$response = array('success' => false);
		}
	
		// Return the response as JSON
		echo json_encode($response);
		exit;
	}
?>