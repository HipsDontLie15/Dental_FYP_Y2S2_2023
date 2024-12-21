<script>
	var loginURL = '../A_Login.php';
</script>

<?php
  include 'db_connection.php';
  include 'url.php';

  session_start();
  $error='';
  
  
  if (isset($_POST['login'])) {
  
    $admin_username=$_POST['admin_username'];
    $admin_password=$_POST['admin_password'];

    $query = mysqli_query($conn,"select * from admins where admin_password='$admin_password' AND admin_username='$admin_username'");
    $rows = mysqli_fetch_assoc($query);
    $num=mysqli_num_rows($query);

    if ($num == 1) {
      
      $status= $rows['status'];
      if($status == 'deactivate'){
        $error = "Account has been deactivated";
        echo
        "
        <script>
        alert('Account Deactivated : Please locate your supervisor . . .');
        document.location.href = loginURL;
        </script>
        ";
      }else{

        $_SESSION['admin_id']=$rows['admin_id'];
        $_SESSION['admin_username']=$rows['admin_username'];
        $_SESSION['admin_name']=$rows['admin_name'];
        $_SESSION['admin_image']=$rows['admin_image'];
        $_SESSION['superAdmin']=$rows['superAdmin'];
        $error = "Logging you in..";
        echo
        "
        <script>
        alert('Logging in now . . .');
        </script>
        ";
        
        header( "Refresh:0; url= $A_Dashboard"); 
      }

    } 
    else 
    {	
      $error = "Username or Password is invalid";
      echo
        "
        <script>
        alert('Username or Password is invalid . . .');
        document.location.href = loginURL;
        </script>
        ";
    }
    mysqli_close($conn); 
  }
?>