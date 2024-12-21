<?php
include ("db_connection.php");
if (isset($_GET['id'])) {
$id = $_GET['id'];
$delete = 'removed';

//delete
$sql4 = "DELETE FROM services WHERE id_ser ='$id'";     //disable this for testing
// $sql4 = "SELECT * FROM services";      //enable this for testing

//backup deleted
$rmv = "INSERT INTO `services_delete` (ser_name, ser_duration, ser_price, status, ser_description, created_at, ser_image)
SELECT `ser_name`, `ser_duration`, `ser_price`, '$delete' as `status`, `ser_description`, `created_at`, `ser_image`
FROM `services` WHERE `id_ser` = $id";

$result_insert = mysqli_query($conn, $rmv);
if (mysqli_query($conn, $sql4)) {
    // If the update operation is successful, send a JSON response with success flag and redirect URL
    $deleteURL = "A_DentalServicesList.php";
    echo json_encode(['success' => true, 'redirectURL' => $deleteURL]);
} else {
    // If there's an error during the update, send a JSON response with the error message
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
}
?>
