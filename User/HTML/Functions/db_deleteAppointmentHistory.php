<?php
include "Function_ConnectSQL.php";
if (isset($_POST['Submit'])) {

    $app_id = $_POST['app_id'];
    $app_email = $_POST['app_email'];
    $app_type = $_POST['app_type'];
    $app_care = $_POST['app_care'];
    $app_doc = $_POST['app_doc'];
    $app_loc = $_POST['app_loc'];
    $app_date = $_POST['app_date'];
    $app_time = $_POST['app_time'];
    $app_description = isset($_POST['app_description']) ? $_POST['app_description'] : '' ;
    $delete = "remove";
    $remove_by = "Customer";
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$timestamp = date('Y-m-d H:i:s');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

//delete
$sql4 = "DELETE FROM appointment_info WHERE `app_id` = $app_id";     //disable this for testing
// $sql4 = "SELECT * FROM services";      //enable this for testing

//backup deleted
$rmv = "INSERT INTO `appointment_delete` (app_email, app_type, app_care, status, app_doc, app_loc, app_date, app_time, app_description, book_by, timestamp)
SELECT `app_email`, `app_type`, `app_care`, '$delete' as `status`, `app_doc`, `app_loc`, `app_date`, `app_time`, `app_description`, `book_by`, timestamp
FROM `appointment_info` WHERE `app_id` = $app_id";


$result_insert = mysqli_query($conn, $rmv);
if (mysqli_query($conn, $sql4)) {
    echo '<script>alert("Successfully deleted . . . ")</script>';
    header("Refresh: 0; url= ../U_AppHistory_RemoveSuccess.php"); 
    exit();

} else {
    echo '<script>alert("There is an error . . . ")</script>';
    header("Refresh: 0; url= ../U_DashBoard.php"); 
    exit();
}
mysqli_close($conn); 
}
?>
