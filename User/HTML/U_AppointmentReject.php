<?php 
    include "./Functions/U_url.php";
    include $notLoggedIn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Appointment | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
    <link rel="stylesheet" href="../CSS/U_appSucRej.css">
</head>
<body>
<?php
    include "U_NavBar.php";
?>
    <div class = "outer_bkBox">
        <div class = "bannerbkBox_Bg">
            <img src="../Images/appointmentReject_1.jpeg" alt="appointmentReject_1">
        </div>
        <section class = "inner_bkBox">
            <div class = "bkTitle">
                <h2>Apologies</h2>
                <h4>Fail to booked appointment: Booked By Other Customers</h4>
                <!-- <p>You will be redirected to back to the booking page in a moment . . . </p> -->
            </div>
            <?php
                //header("Refresh: 3.5; url=".$appointmentPage);
                $previous = "javascript:history.go(-1)";
                if(isset($_SERVER['HTTP_REFERER'])) {
                    $previous = $_SERVER['HTTP_REFERER'];
                }
            ?>
            <div class="txt_2">
                <p>Click this back button to redirect back to the previous directory</p>
                <div class="btnEachBox"><a href="<?= $previous ?>" class="serBTN" ><div class="btnBox">Back</div></a></div>
            </div>
        </section>
    </div>
<?php
    include 'U_Footer.php';
?>
</body>
</html>


