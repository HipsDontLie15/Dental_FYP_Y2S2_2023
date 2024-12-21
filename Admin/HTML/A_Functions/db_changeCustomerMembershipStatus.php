<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_id = $_POST['app_id'];
    $status = $_POST['status'];
    
	
    // Perform the database update
    $updatequery = "UPDATE appointment_info SET `status` = '$status' WHERE `app_id` = '$app_id'";
    
    // Execute the query
    if (mysqli_query($conn, $updatequery)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
