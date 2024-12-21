<?php 
include "db_connection.php";
include 'url.php';

session_set_cookie_params(0);
session_start();

  if (!(isset($_SESSION['admin_username']))) {
    echo "<script>alert('You are not logged in!'); 
            window.location='A_Login.php';
        </script>";
    exit;
  }

?>

<?php
  $admin_id = $_SESSION['admin_id'];

  // Fetch data from the database for the specified doctor
  $sql = "SELECT * FROM admins WHERE admin_id = '".$admin_id."' ";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
      // Fetch data
      $row = mysqli_fetch_array($result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/A_navbar.css">
    <link rel="icon" href="../../SharedImages/QualiteethRework_logo.png" type = "image/QT">
</head>


<header class="header">
    <div class = "Qcontainer">
        <div class="header-1">
            <div class="navTitle">
                <p>Administration System</p>
                <div>Qualiteeth Dental Clinic</div>
            </div>
        </div>
        <a class="imageLink" href="A_Dashboard.php">
            <img class = "logo" src="../../SharedImages/QualiteethRework_Transparent.png" alt="QT logo">
        </a>
        <div class="header-2">
            <div class="picadmin">
                <?php
                    echo "<img src='../Images/".$row['admin_image']."' title='".$row['admin_image']."' class='avatar'>";
                ?>
                <div class="txtBox">
                    <?php 
                    echo $_SESSION['admin_name'];
                    //$admin_id = $_SESSION['admin_id']; 
                    ?>
                    <!-- <a class="editP" href="A_ProfilePage.php?editID_admin=<?php //echo $admin_id; ?>">edit profile</a> -->
                </div>
            </div> 
            <div class="lgout">
                <a class="linking" href="<?php echo $A_Logout ?>">Log Out</a>
            </div>
        </div>
    </div>
</header>

<?php }?>
</html>
