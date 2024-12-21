<?php
	include './Functions/Function_DisplayDocs.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Doctors | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
    <link rel="stylesheet" href="../CSS/U_ourDocs.css">
</head>

<script src="../JS/U_docToggleDesc.js"></script>

<body>
    <?php
        include "U_NavBar.php";
    ?>
    <section class="home_categories">
        <div class="docTopTitle">
           <h1>Meet our doctors</h1>
            <p>By combining new technology with extensive experience, we continue to sharpen our skills in our dentistry.</p>
        </div>
        <div class="docInfo">
            <?php
                generateDoctorBoxes();
            ?>
        </div>
    </section>
    <section class="ReservaLayer">
        <div class= "boxobox">
            <div class="bookNOW_Box">
                <h4 class="upText_title">Our Services in All Our Dental Clinics</h4>
                <h1>Come and see our wide array of services we offer.</h1>
            </div>
            <a href="U_OurServices.php" class="bookBTN"><div class="btnBox">Explore our diverse range of services</div></a>
        </div>
    </section>
    <?php
        include 'U_Footer.php';
    ?>

</body>
</html>