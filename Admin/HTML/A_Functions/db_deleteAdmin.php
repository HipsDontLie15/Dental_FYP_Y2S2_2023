<?php
include("db_connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = 'removed';

    //delete
$sql4 = "DELETE FROM admins WHERE admin_id ='$id'";     //disable this for testing
// $sql4 = "SELECT * FROM admins";      //enable this for testing

//backup deleted
$rmv = "INSERT INTO `admins_delete` (admin_username, admin_password, admin_name, admin_image, superAdmin, created_at, status)
SELECT `admin_username`, `admin_password`, `admin_name`, `admin_image`, `superAdmin`, `created_at`, '$delete' as `status`
FROM `admins` WHERE `admin_id` = $id";

$result_insert = mysqli_query($conn, $rmv);

    if (mysqli_query($conn, $sql4)) {
        // If the delete operation is successful, send a JSON response with success flag and redirect URL
        $redirectURL = "SA_AdminList.php";
        echo json_encode(['success' => true, 'redirectURL' => $redirectURL]);
    } else {
        // If there's an error during the delete, send a JSON response with the error message
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
}
?>
