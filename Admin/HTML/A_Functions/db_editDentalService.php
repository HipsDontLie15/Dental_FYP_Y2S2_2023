<?php
    include 'db_connection.php'; 

if (isset($_POST['edit'])) {
    //Treatment Info
    $id_ser = $_POST['id_ser'];
    $ser_name = $_POST['ser_name'];
    $ser_type = $_POST['ser_type'];    
    $ser_duration = $_POST['ser_duration'];
    $ser_price = $_POST['ser_price'];
    $ser_description = isset($_POST['ser_description']) ? $_POST['ser_description'] : '';

    // Check if a new image was uploaded
    if ($_FILES['ser_image']['size'] > 0) {
        $file = $_FILES['ser_image'];
        $fileName = $_FILES['ser_image']['name'];
        $fileTmpName = $_FILES['ser_image']['tmp_name'];
        $fileSize = $_FILES['ser_image']['size'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileSize < 500000) {
                $newImageName = $ser_name . "_" . date("Ymd") . "." . $fileActualExt; // Generate new image name
                $fileDestination = '../../Images/Dental_Services/' . $newImageName;

                move_uploaded_file($fileTmpName, $fileDestination);

                // Read the image data as binary and escape it to prevent SQL injection
                $ser_image = mysqli_real_escape_string($conn, file_get_contents($fileDestination));

                $update_query = "UPDATE services SET `ser_name` = '$ser_name', `ser_duration` = '$ser_duration', `ser_price` = '$ser_price', `ser_type` = '$ser_type', `ser_description` = '$ser_description', `ser_image` = '$ser_image' WHERE `id_ser` ='$id_ser' ";
            } else {
                echo "<script>
                    alert('Error: Your file is too big!');
                    var id_ser = '$id_ser'; 
                    window.location.href = '../A_EditDentalServices.php?editID_ser=' + id_ser;
                    </script>";
                exit; // Stop execution if there's an error
            }
        } else {
            echo "<script>
                alert('Error: only able to upload jpg, jpeg, png . . .');
                var id_ser = '$id_ser'; 
                window.location.href = '../A_EditDentalServices.php?editID_ser=' + id_ser;
                </script>";
            exit; // Stop execution if there's an error
        }
    } else {
        // If no new image was uploaded, keep the old image in the database
        $update_query = "UPDATE services SET `ser_name` = '$ser_name', `ser_duration` = '$ser_duration', `ser_price` = '$ser_price', `ser_type` = '$ser_type', `ser_description` = '$ser_description' WHERE `id_ser` ='$id_ser' ";
    }

    // Perform the update query
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>
            alert('Treatment details updated successfully!');
            </script>";
        header("Refresh: 0; url= ../A_DentalServicesList.php"); 
        exit();
    } else {
        echo "Error updating Treatment's details: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}


?>
