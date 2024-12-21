<?php
    include 'db_connection.php'; 

if (isset($_POST['edit'])) {
    //Doctor Info
    $doc_id = $_POST['doc_id'];
    $doc_name = $_POST['doc_name'];
    $doc_role = isset($_POST['doc_role']) ? $_POST['doc_role'] : '';
    $doc_startWorkDate = isset($_POST['doc_startWorkDate']) ? $_POST['doc_startWorkDate'] : '';
    $doc_description = isset($_POST['doc_description']) ? $_POST['doc_description'] : '';
    $doc_station = isset($_POST['doc_station']) ? $_POST['doc_station'] : '';

    // Escape single quotes in the description
    $doc_description = mysqli_real_escape_string($conn, $doc_description);

    //Doctor Image
     // Check if a new image was uploaded
    if ($_FILES['doc_image']['size'] > 0) {
    $file = $_FILES['doc_image'];

    $fileName = $_FILES['doc_image']['name'];
    $fileTmpName = $_FILES['doc_image']['tmp_name'];
    $fileSize = $_FILES['doc_image']['size'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg','jpeg','png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileSize < 500000) {
            $newImageName = $doc_name . "_" . date("Ymd"). "." . $fileActualExt; // Generate new image name
            $fileDestination = '../../Images/Doctors/' . $newImageName;

            move_uploaded_file($fileTmpName, $fileDestination);

            // Read the image data as binary and escape it to prevent SQL injection
            $doc_image = mysqli_real_escape_string($conn, file_get_contents($fileDestination));

            // $update_query = "UPDATE doctors SET `doc_image` = '$doc_image' WHERE `id_doc` = '$doc_id' ";
            $update_query = "UPDATE doctors SET `doc_name` = '$doc_name', `doc_role` = '$doc_role', `doc_startWorkDate` = '$doc_startWorkDate', `doc_description` = '$doc_description', `doc_image` = '$doc_image', `doc_station` = '$doc_station' WHERE `id_doc` ='$doc_id' ";
            
        } else {
                echo "<script>
                    alert('Error: Your file is too big!');
                    var doc_id = '$doc_id'; 
                    window.location.href = '../A_EditDoctors.php?editID_doc=' + doc_id;
                    </script>";
                exit;
            }
        } else {
            echo "<script>
                alert('Error: only able to upload jpg, jpeg, png . . .');
                var doc_id = '$doc_id'; 
                window.location.href = '../A_EditDoctors.php?editID_doc=' + doc_id;
                </script>";
            exit;
        }
    } else {
        // If no new image was uploaded, keep the old image in the database
        $update_query = "UPDATE doctors SET `doc_name` = '$doc_name', `doc_role` = '$doc_role', `doc_startWorkDate` = '$doc_startWorkDate', `doc_description` = '$doc_description', `doc_station` = '$doc_station' WHERE `id_doc` ='$doc_id' ";
    }

    // Perform the update query
    $update_result = mysqli_query($conn, $update_query);
    if ($update_result) {
        echo "<script>
            alert('Doctor's details updated successfully!');
            </script>";
        header("Refresh: 0; url= ../A_DoctorsList.php"); 
        exit();
    } else {
        echo "Error updating doctor's details: " . mysqli_error($conn);
    }

    mysqli_close($conn);

}


?>