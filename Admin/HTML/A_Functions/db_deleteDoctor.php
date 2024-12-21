<?php
include ("db_connection.php");
if (isset($_GET['id'])) {
$id = $_GET['id'];
$delete = 'removed';

//delete
$sql4 = "DELETE FROM doctors WHERE id_doc ='$id'";     //disable this for testing
// $sql4 = "SELECT * FROM doctors";      //enable this for testing

//backup deleted
$rmv = "INSERT INTO `doctors_delete` (doc_name, doc_role, doc_description, status, doc_startWorkDate, created_at, doc_image)
SELECT `doc_name`, `doc_role`, `doc_description`, '$delete' as `status`, `doc_startWorkDate`, `created_at`, `doc_image`
FROM `doctors` WHERE `id_doc` = $id";

$result_insert = mysqli_query($conn, $rmv);
if (mysqli_query($conn, $sql4)) {
    // If the update operation is successful, send a JSON response with success flag and redirect URL
    $deleteURL = "A_DoctorsList.php";
    echo json_encode(['success' => true, 'redirectURL' => $deleteURL]);
} else {
    // If there's an error during the update, send a JSON response with the error message
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
}
?>
