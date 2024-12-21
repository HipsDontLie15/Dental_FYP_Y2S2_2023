<?php
    include 'Function_ConnectSQL.php';
    session_start();
    
    if (isset($_POST['login'])) {
        $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);
        $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);

        $query = "SELECT * FROM customers WHERE c_email='$c_email' AND c_password='$c_password'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_assoc($result);
        
        $num = mysqli_num_rows($result);
        if ($num == 1) {

            $status= $rows['c_status'];
            if($status == 'Deactivate' || $status == 'deactivate'){
                $error = "Account has been deactivated";
                echo
                "
                <script>
                alert('Account Deactivated: Failed to log in . . .');
                </script>
                ";
                header("Refresh: 0; url= ../U_LoginSignUp.php"); 
                exit();

            } else {
                $_SESSION['c_email'] = $c_email;
                $_SESSION['c_id'] = $rows['c_id'];
                $_SESSION['c_firstname'] = $rows['c_firstname'];
                $_SESSION['c_lastname'] = $rows['c_lastname'];
                $_SESSION['c_gender'] = $rows['c_gender'];
                echo '<script>alert("Logging you in . . . ")</script>';
                header("Refresh: 0; url= ../U_Home.php"); 
                exit();
            }
            
        } 
        else 
        {	
            echo '<script>alert("Login fail: Password not match . . . ")</script>';
            header("Refresh: 0; url= ../U_LoginSignUp.php"); 
        }
        
        mysqli_close($conn); 
    }
?>