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
	

	$sql6=mysqli_query($conn,"select * from services");  
	//Get Update id and status  
	if (isset($_GET['id_ser']) && isset($_GET['status'])) {  
		
		$id=$_GET['id_ser'];  
		$status=$_GET['status'];

			
		if ($status === "active") {
			$updatequery = "UPDATE services SET `status` ='$status' WHERE `id_ser` ='$id'";
		} elseif ($status === "deactivate") {
			$updatequery = "UPDATE services SET `status` ='$status' WHERE `id_ser` ='$id'";
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