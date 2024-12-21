<?php
    include 'Function_ConnectSQL.php';
    $rejectURL = '../U_AppointmentReject.php';
    $successfulURL = '../U_AppointmentSuccess.php';
    session_start();

if (isset($_POST['edit'])) {
    $app_id = $_POST['app_id'];
    $app_email = $_POST['app_email'];
    $app_care = implode(', ', $_POST['ser_type']);
    $app_doc = $_POST['doc_name'];
    $app_loc = $_POST['doc_station'];
    $app_date = $_POST['app_date'];
    $app_time = $_POST['app_time'];
    $app_description = isset($_POST['app_description']) ? $_POST['app_description'] : '' ;

// Retrieve data from the table for the selected app_type
$matching_data_query = "SELECT * FROM doctors WHERE doc_name = '$app_doc'";
$matching_data_result = mysqli_query($conn, $matching_data_query);

$app_type = '';

if ($matching_data_result && mysqli_num_rows($matching_data_result) > 0) {
    while ($row = mysqli_fetch_assoc($matching_data_result)) {
        if ($row['doc_name'] === $app_doc) {
            $app_type = $row['doc_role'];
            break; // Found the matching role, no need to continue the loop
        }
    }
}

    
    $availability_query = "SELECT * FROM appointment_info WHERE app_doc = '$app_doc' AND app_date = '$app_date' AND app_time = '$app_time' ";
    $availability_result = mysqli_query($conn, $availability_query);
        
    if(mysqli_num_rows($availability_result) > 0) {
        // booked
        header("location: ".$rejectURL);
        exit;
    }else{
        $update_query = "UPDATE appointment_info SET `app_care` = '$app_care', `app_doc` = '$app_doc', `app_loc` = '$app_loc', `app_date` = '$app_date', `app_time` = '$app_time', `app_description` = '$app_description' WHERE `app_id` ='$app_id' ";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            // Update successful Points
			$_SESSION['successType'] = 'updateAppointment';
        
            header("location: ".$successfulURL);
            exit;

        } else {
            echo "Error updating Appointment's details: " . mysqli_error($conn);
        }
        
    }

    mysqli_close($conn);

}

?>