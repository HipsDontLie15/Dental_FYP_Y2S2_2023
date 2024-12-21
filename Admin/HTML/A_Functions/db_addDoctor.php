<script>
	var redirectURL = '../A_DoctorsList.php';
</script>
<?php
include 'db_connection.php';

if (isset($_POST['submit'])) {
    $doc_name = $_POST['doc_name'];
    $doc_role = $_POST['doc_role'];
    $doc_description = $_POST['doc_description'];
    $doc_startWorkDate = $_POST['doc_startWorkDate'];
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $created_at = date('Y-m-d H:i:s');
    $status = "active";
    $doc_station = $_POST['doc_station'];
    
    $file = $_FILES['doc_image'];

    $fileName = $_FILES['doc_image']['name'];
    $fileTmpName = $_FILES['doc_image']['tmp_name'];
    $fileSize = $_FILES['doc_image']['size'];
    

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg','jpeg','png');

    
//avoid duplicate data into database
$check_query = "SELECT * FROM doctors WHERE doc_name = '$doc_name' AND doc_role = '$doc_role'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "<script>
            alert('Error: Doctor with the same name and role already exists.');
            window.location.href = redirectURL;
          </script>";
    exit(); // Stop execution if duplicate record found
}


//insert into database
    if (in_array($fileActualExt, $allowed)) {
        if ($fileSize < 500000) {
            $newImageName = $doc_name . "_" . date("Ymd"). "." . $fileActualExt;    // Generate new image name
            $fileDestination = '../../Images/Doctors/' . $newImageName;

            move_uploaded_file($fileTmpName, $fileDestination);

            // Read the image data as binary and escape it to prevent SQL injection
            $doc_image = mysqli_real_escape_string($conn, file_get_contents($fileDestination));

            // Insert the data into the database
            $insert_query = "INSERT INTO doctors (`doc_name`, `doc_role`, `doc_description`, `created_at`, `status`, `doc_startWorkDate`, `doc_image`, `doc_station`) 
                VALUES ('$doc_name', '$doc_role', '$doc_description', '$created_at', '$status', '$doc_startWorkDate', '$doc_image', '$doc_station' )";
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
?>
