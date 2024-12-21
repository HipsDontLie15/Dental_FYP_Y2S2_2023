<?php 
	include './Functions/Function_ConnectSQL.php';    
    // session_start();
    $sql = "SELECT * FROM appointment_info WHERE app_email = '".$_SESSION['c_email']."' ";
    $result = $conn->query($sql);	//execute query connection
    $search_result = mysqli_query($conn, $sql);

?>