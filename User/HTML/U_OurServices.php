<?php
    include './Functions/Function_DisplayServices_G.php';
    include './Functions/Function_DisplayServices_S.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_ourServ.css">
    <title>Our Services | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>
<body>
    <?php
        include "U_NavBar.php";
    ?>
    <section class="home_categories">
        <div class="serTopTitle">
            <div class="serTitleText">
                <h4>Our Service</h4>
                <h1>Wide Range Of Comprehensive Services</h1>
                <p>At Qualiteeth Dental, we prioritize personalized treatment plans, involving patients in decision-making. We believe in informing patients about all options and treating them like family.</p>
            </div>
            <div class="secImageBox">
                <img src="../Images/ourservices_1.jpeg" alt="ourservices_1">
            </div>
        </div>
    </section>
    <section class="allSerBox">
        <div class="SerBoxDiv">
        <?php
            displayServices_G();
        ?>
        </div>
    </section>
    <section class="allSerBox">
        <div class="SerBoxDiv">
        <?php
            displayServices_S();
        ?>
        </div>
    </section>
    <?php include 'U_Footer.php'; ?>
    
</body>
</html>
