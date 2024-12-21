<script>
	var redirectURL = '../A_DentalServicesList.php';
</script>
<?php
include 'db_connection.php';

if (isset($_POST['submit'])) {
    $ser_name = $_POST['ser_name'];
    $ser_type = $_POST['ser_type'];
    $ser_duration = $_POST['ser_duration'];
    $ser_price = $_POST['ser_price'];
    $ser_description = $_POST['ser_description'];
    $created_at = date('Y-m-d H:i:s');
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $status = "active";
    
    $file = $_FILES['ser_image'];

    $fileName = $_FILES['ser_image']['name'];
    $fileTmpName = $_FILES['ser_image']['tmp_name'];
    $fileSize = $_FILES['ser_image']['size'];
    

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg','jpeg','png');

//avoid duplicate data in database
$check_query = "SELECT * FROM services WHERE ser_name = '$ser_name' and ser_type = '$ser_type' ";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Error: Service with the same name already exists.');
                window.location.href = redirectURL;
              </script>";
        exit(); // Stop execution if duplicate record found
    }else{


    //insert into database
    if (in_array($fileActualExt, $allowed)) {
        if ($fileSize < 500000) {
            $newImageName = $ser_name . "_" . date("Ymd"). "." . $fileActualExt;    // Generate new image name
            $fileDestination = '../../Images/Dental_Services/' . $newImageName;

            move_uploaded_file($fileTmpName, $fileDestination);

            // Read the image data as binary and escape it to prevent SQL injection
            $ser_image = mysqli_real_escape_string($conn, file_get_contents($fileDestination));

            // Insert the data into the database
            $insert_query = "INSERT INTO services (`ser_name`, `ser_duration`, `ser_description`, `created_at`, `status`, `ser_price`, `ser_image`, `ser_type`) 
                VALUES ('$ser_name', '$ser_duration', '$ser_description', '$created_at', '$status', '$ser_price', '$ser_image', '$ser_type')";
            $insert_result = mysqli_query($conn, $insert_query);

            if ($insert_result) {
                echo "<script>
                        alert('Successfully Added Into System.');
                        window.location.href = redirectURL;
                    </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        } else {
            echo "<script>
                    alert('Error: Your file is too big!');
                    window.location.href = redirectURL;
                    </script>";
        }
    } else {
        echo "<script>
                alert('Error: only able to upload jpg, jpeg, png . . .');
                window.location.href = redirectURL;
              </script>";
    }

    mysqli_close($conn);
}

}
?>
