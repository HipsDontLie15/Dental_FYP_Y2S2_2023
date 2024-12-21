<script>
    var redirectURL = "../A_AddCustomersMemberPoints.php";
</script>

<?php
include 'db_connection.php';

if (isset($_POST['submit'])) {
    $app_id = $_POST['app_id'];
    $c_email = $_POST['app_email'];
    $c_id = $_POST['c_id'];
    $c_hygiene = $_POST['c_hygiene'];
    $c_examination = $_POST['c_examination'];
    $active = "active";
    $total_Points = $_POST['total_Points'];
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $created_at = date('Y-m-d H:i:s');
    $Freed = "Freed";
    
    

    // Check if the Appointment already exists in the database
    $check_query = "SELECT * FROM appointment_info WHERE app_id = '$app_id' AND status = '$Freed' ";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Appointment already exists
        echo '<script>
            alert("The Appointment already completed . . . ");
            window.location.href = "../A_CustomersMemberList.php";
            </script>';
        exit();
    } 
    else {
        $update = "UPDATE appointment_info SET `status` = '$Freed' WHERE `app_id` = '$app_id'";
        $query = "INSERT INTO `customermembership`(`c_id`, `c_email`, `c_hygiene`,`c_examination`, `c_points`,`status`,`created_at`) 
            VALUES ('$c_id','$c_email','$c_hygiene','$c_examination','$total_Points','$active','$created_at')";

        if (mysqli_query($conn, $query) && mysqli_query($conn, $update)) {
            echo '<script>
                alert("Successfully added points . . . ")
                window.location.href = redirectURL;
                </script>';
            exit();
        }else{
            echo "<script>
                    alert('Error: no database connected');
                    window.location.href = redirectURL;
                </script>";
            exit();
        }
    }
    mysqli_close($conn); 
}

?>