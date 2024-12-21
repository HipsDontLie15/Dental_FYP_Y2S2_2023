<?php
    include 'db_connection.php'; 

if (isset($_POST['Edit'])) {
    //Customer Info
    $c_id = $_POST['c_id'];
    $c_email = $_POST['c_email'];
    $c_firstname = $_POST['c_firstname'];
    $c_lastname = $_POST['c_lastname'];
    $c_gender = $_POST['c_gender'];
    $c_dob = $_POST['c_dob'];
    $c_phone = $_POST['c_phone'];
    $c_password = $_POST['c_password'];

    // If no new image was uploaded, keep the old image in the database
    $update_query = "UPDATE customers SET `c_email` = '$c_email', `c_firstname` = '$c_firstname', `c_lastname` = '$c_lastname', `c_gender` = '$c_gender', `c_dob` = '$c_dob', `c_phone` = '$c_phone', `c_password` = '$c_password' WHERE `c_id` ='$c_id' ";

    // Perform the update query
    $update_result = mysqli_query($conn, $update_query);
    if ($update_result) {
        echo "<script>
            alert('Customer's details updated successfully!');
        </script>";
        header("Refresh: 0; url= ../A_CustomersList.php"); 
        exit();
    } else {
        echo "Error updating Customer's details: " . mysqli_error($conn);
        echo "<script>
            alert('Customer's details updated successfully!');
            var c_id = '$c_id'; 
            window.location.href = '../A_EditCustomer.php?editID_cus=' + c_id;
            </script>";
        exit();
    }

    mysqli_close($conn);

}


?>