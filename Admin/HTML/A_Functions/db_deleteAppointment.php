<?php
include ("db_connection.php");
if (isset($_GET['app_id'])) {
$id = $_GET['app_id'];
$delete = 'removed';

//delete
$sql4 = "DELETE FROM appointment_info WHERE app_id ='$id'";

//backup deleted
$rmv = "INSERT INTO `appointment_delete` (app_email, app_type, app_care, status, app_doc, app_loc, app_date, app_time, app_description)
SELECT `app_email`, `app_type`, `app_care`, '$delete' as `status`, `app_doc`, `app_loc`, `app_date`, `app_time`, `app_description`
FROM `appointment_info` WHERE `app_id` = $id";

$result_insert = mysqli_query($conn, $rmv);
if (mysqli_query($conn, $sql4)) {
    // If the update operation is successful, send a JSON response with success flag and redirect URL
    $deleteURL = "A_AppointmentList.php";
    echo json_encode(['success' => true, 'redirectURL' => $deleteURL]);
} else {
    // If there's an error during the update, send a JSON response with the error message
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
}
?>
