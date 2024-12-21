<?php

    include 'Function_ConnectSQL.php';
    $redirectURL = '../U_UpdateProfileSuccess.php';
    
    if (isset($_POST['edit'])) {
        //Customer Info
        $c_id = $_POST['c_id'];
        $c_email = $_POST['c_email'];
        $c_password = $_POST['c_password'];
        $c_firstname = $_POST['c_firstname'];
        $c_lastname = $_POST['c_lastname'];
        $c_gender = $_POST['c_gender'];
        $c_dob = $_POST['c_dob'];
        $c_phone = $_POST['c_phone'];

     
        //Customer Image
         // Check if a new image was uploaded
        if ($_FILES['c_image']['size'] > 0) {
            $file = $_FILES['c_image'];
        
            $fileName = $_FILES['c_image']['name'];
            $fileTmpName = $_FILES['c_image']['tmp_name'];
            $fileSize = $_FILES['c_image']['size'];
        
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg','jpeg','png');
        
            if (in_array($fileActualExt, $allowed)) {
                if ($fileSize < 500000) {
                    $newImageName = $c_email . "_" . date("Ymd"). "." . $fileActualExt; // Generate new image name
                    $fileDestination = '../../Images/Customer_ProfilePicture/' . $newImageName;
        
                    move_uploaded_file($fileTmpName, $fileDestination);
        
                    // Read the image data as binary and escape it to prevent SQL injection
                    $c_image = mysqli_real_escape_string($conn, file_get_contents($fileDestination));
        
                    $update_query = "UPDATE customers SET `c_firstname` = '$c_firstname', `c_lastname` = '$c_lastname', `c_gender` = '$c_gender', `c_dob` = '$c_dob', `c_phone` = '$c_phone', `c_image` = '$c_image', `c_password` = '$c_password' WHERE `c_id` ='$c_id'";
                    
                    } else {
                            echo "<script>
                                alert('Error: Your file is too big!');
                                var c_id = '$c_id'; 
                                window.location.href = '../U_ProfilePage.php?editID_customer=' + c_id;
                                </script>";
                            exit;
                    }
                } else {
                    echo "<script>
                        alert('Error: only able to upload jpg, jpeg, png . . .');
                        var c_id = '$c_id'; 
                        window.location.href = '../U_ProfilePage.php?editID_customer=' + c_id;
                        </script>";
                    exit;
                }

        } else {
            // If no new image was uploaded, keep the old image in the database
            $update_query = "UPDATE customers SET `c_firstname` = '$c_firstname', `c_lastname` = '$c_lastname', `c_gender` = '$c_gender', `c_dob` = '$c_dob', `c_phone` = '$c_phone', `c_password` = '$c_password' WHERE `c_id` ='$c_id'";
        }
    
            // echo "Query: $update_query<br>";

        // Perform the update query
        $update_result = mysqli_query($conn, $update_query);
        if ($update_result) {
            $_SESSION['successType'] = 'updateProfile';

            header("location: ".$redirectURL);
			exit;
        } else {
            // echo "Error updating Customers's details: " . mysqli_error($conn);
            header("location: ".$redirectURL);
            exit;
        }
    
        mysqli_close($conn);
    
    
    }   // end of isset($_POST['Submit'])


?>