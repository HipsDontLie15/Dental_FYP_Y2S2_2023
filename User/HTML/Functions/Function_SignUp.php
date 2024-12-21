<?php
    include 'Function_ConnectSQL.php';
    $successfulURL = '../U_SignUp_success.php';


    /* Register the customer's information*/
    if (isset($_POST['signup'])) {
        $c_email = $_POST['c_email'];
        $c_firstname = $_POST['c_firstname'];
        $c_lastname = $_POST['c_lastname'];
        $c_gender = $_POST['c_gender'];
        $c_dob = $_POST['c_dob'];
        $c_phone = $_POST['c_phone'];
        $c_status = "Active";
        $c_password = $_POST['c_password'];
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $timestamp = date('Y-m-d H:i:s');
        
        $fileDestination = '../../Images/user.png';
        $c_image = mysqli_real_escape_string($conn, file_get_contents($fileDestination));

        // Check if the email already exists in the database
        $check_query = "SELECT * FROM customers WHERE c_email = '$c_email'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Email already exists
            echo '<script>alert("The email entered already exists, please try logging in; If forgotten password, please contact Qualiteeth via Phone . . . ")</script>';
            header("Refresh: 0; url= ../U_LoginSignUp.php"); 
            exit();
        } else {

            $query = "INSERT INTO `customers`(`c_email`, `c_firstname`, `c_lastname`,`c_gender`, `c_dob`,`c_phone`,`c_status`,`c_password`,`timestamp`, `c_image`) 
                VALUES ('$c_email','$c_firstname','$c_lastname','$c_gender','$c_dob','$c_phone','$c_status','$c_password','$timestamp', '$c_image')";

            if (mysqli_query($conn, $query)) {

				header("location: ".$successfulURL);
				exit;
            }
        }
        mysqli_close($conn); 
    }
    
?>