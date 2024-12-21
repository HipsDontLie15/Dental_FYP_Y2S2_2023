<?php
include "db_connection.php";
if (isset($_GET['c_id'])) {
$id = $_GET['c_id'];
$delete = 'removed';

//delete
$sql4 = "DELETE FROM customers WHERE c_id ='$id'";     //disable this for testing
// $sql4 = "SELECT * FROM customers";      //enable this for testing

//backup deleted
$rmv = "INSERT INTO `customers_delete` (c_email, c_password, c_firstname, c_lastname, c_gender, c_dob, c_phone, c_image, c_status, timestamp)
SELECT `c_email`, `c_password`, `c_firstname`, `c_lastname`, `c_gender`, `c_dob`, `c_phone`, `c_image`, '$delete' as `c_status`, `timestamp`
FROM `customers` WHERE `c_id` = $id";

$result_insert = mysqli_query($conn, $rmv);
if (mysqli_query($conn, $sql4)) {
    // If the update operation is successful, send a JSON response with success flag and redirect URL
    $deleteURL = "A_CustomersList.php";
    echo json_encode(['success' => true, 'redirectURL' => $deleteURL]);
} else {
    // If there's an error during the update, send a JSON response with the error message
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
}
?>
