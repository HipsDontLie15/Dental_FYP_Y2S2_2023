<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_home.css">
    <title>Homepage | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>
<body>
    <?php
        include "U_NavBar.php";
    ?>
    <section class="home_categories">
        <div class="homeTopCont">
            <div class="txt_1">
                <h4 class="upText_title">Patient satisfaction is our top priority</h4>
                <h1>Say NO to dental phobia!</h1>
                <p>Strives to change the community's perception towards dentistry, putting patient comfort as our top priority by providing painless and gentle dental treatment.</p>
                <a href="U_OurDocs.php" class="docBTN"><div class="btnBox">Meet our team of doctors</div></a>
            </div>
            <div class="img_1">
                <img src="../Images/homeTop_1.jpeg" alt="homeTop_1" class="slide-from-left">
            </div>
        </div>
    </section>
        <?php
        $listItems = array(
            'Affordable' => array(
                'content' => 'Affordable dental treatment to all our customers without compromising the quality.',
                'image' => 'imageList_1.jpeg'
            ),
            'Open 7 days a week' => array(
                'content' => 'Catering to patients schedule, our service is available from 9am - 9pm on weekdays and 9am-7pm on weekends.',
                'image' => 'imageList_2.jpeg'
            ),
            'Reputable and honest review from our patients' => array(
                'content' => 'More than 2000 reviews from our patients in providing affordable and quality dental treatment.',
                'image' => 'imageList_3.jpeg'
            ),
            'Make an appointment' => array(
                'content' => 'Freely make an appointment with your preferred dentist, care, time, and date at your nearest location.',
                'image' => 'imageList_4.jpeg'
            )
        );
        ?>
        <section class="home_cat2">
            <div class="whyQBox">
                <h1>Why Choose To Go Qualiteeth Dental Clinics</h1>
                <!-- Generate unordered list -->
                <ul class="ulMainBox">
                    <?php foreach ($listItems as $item => $data): ?>
                        <li class="liBoxes">
                            <div class="ImageBox">
                                <img src="../Images/<?php echo $data['image']; ?>" alt="<?php echo $item; ?>">
                            </div>
                            <div class="ulContentBox">
                                <h3><?php echo $item; ?></h3>
                                <p><?php echo $data['content']; ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <section class="home_cat3">
            <div class="homecat3_top">
                <div class="img_2">
                    <img src="../Images/homeTop_2.jpeg" alt="homeTop_2">
                </div>
                <div class="txt_1">
                    <h4 class="upText_title">Our Services in All Our Dental Clinics</h4>
                    <h1>Comprehensive Solutions for Your Oral Health</h1>
                    <p>Our dental care clinic offers a wide range of services to ensure your oral health needs are met with excellence and convenience.</p>
                    <a href="U_OurServices.php" class="serBTN"><div class="btnBox">Our Services</div></a>
                </div>
            </div>
            <div class="homecat3_bottom">
                <div class="img_2">
                    <img src="../Images/homeTop_3.jpeg" alt="homeTop_3">
                </div>
                <div class="txt_1">
                        <h4 class="upText_title">Our Services in All Our Dental Clinics</h4>
                        <h1>Comprehensive Solutions for Your Oral Health</h1>
                        <p>Our dental care clinic offers a wide range of services to ensure your oral health needs are met with excellence and convenience.</p>
                    <div class="btnEachBox">
                        <a href="U_ContactUs.php" class="serBTN" ><div class="btnBox" id="cat3_btnTop">Contact Us</div></a>
                        <a href="U_appointment.php" class="serBTN"><div class="btnBox" id="cat3_btnBottom">Make an appointment</div></a>
                    </div>
                </div>
            </div>
        </section>
    <?php
        include 'U_Footer.php';
    ?>



</body>
</html>