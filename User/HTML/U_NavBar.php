<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_navBar.css">
    <link rel="icon" href="../../SharedImages/QualiteethRework_logo.png" type = "image/QT">
</head>
<header class="header">
    <div class = "container">
        <div class="header-1">
            <a href="U_Home.php" class="logo" >
                <img src="../../SharedImages/QualiteethRework_Transparent.png" alt="Qualiteeth_Logo" height="100">
            </a>
            <div class="header-2">
                <nav class="navbar">
                    <a href="U_About.php">About Us</a>
                    <a href="U_OurDocs.php">Our Doctors</a>
                    <a href="U_OurServices.php">Services</a>
                    <a href="U_LProgram.php">Loyalty Program</a>
                    <a href="U_ContactUs.php">Contact us</a>
                </nav>
            </div>
        </div>
        <div class="header-2">
            <nav class="navbar-2" id="navBarIOO">
                <?php
                    include './Functions/Function_NavBar_IOO.php';
                ?>
            <a href="U_appointment.php" class="btn_a">
                <button type="button" class="button2">Appointment</button>
            </a>
            </nav>
        </div>
        
    </div>
</header>
</html>