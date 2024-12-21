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
    <title>Fail Appointment | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
    <link rel="stylesheet" href="../CSS/U_appSucRej.css">
</head>
<body>
<?php
    include "U_NavBar.php";
?>
    <div class = "outer_bkBox">
        <div class = "bannerbkBox_Bg">
            <img src="../Images/appointmentFail_1.jpeg" alt="appointmentFail_1">
        </div>
        <section class = "inner_bkBox">
            <div class = "bkTitle">
                <h2>Apologies</h2>
                <h4>Fail to booked appointment: System Encounter An Error</h4>
            </div>
            <?php
                $previous = "javascript:history.go(-1)";
                if(isset($_SERVER['HTTP_REFERER'])) {
                    $previous = $_SERVER['HTTP_REFERER'];
                }
            ?>
            <div class="txt_2">
                <p>Click this back button to redirect back to the previous page</p>
                <div class="btnEachBox"><a href="<?= $previous ?>" class="serBTN" ><div class="btnBox">Back</div></a></div>
            </div>
        </section>
    </div>
<?php
    include 'U_Footer.php';
?>
</body>
</html>


