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
    <title>Success Page | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
    <link rel="stylesheet" href="../CSS/U_appSucRej.css">
</head>

<script>
    var HomeURL = 'U_Home.php';
    var dashURL = 'U_DashBoard.php';

    // Set the countdown duration in seconds
    const countdownDuration = 8;
    let remainingTime = countdownDuration;

    // Function Appointment
    function updateCountdown() {
        if (remainingTime > 0) {
            const countdownElement = document.getElementById("countdown") || document.getElementById("countdownPP");
            countdownElement.textContent = " " + remainingTime.toFixed(1);
            
            remainingTime -= 0.1; // Decrement by 0.1 seconds
            setTimeout(updateCountdown, 100); // Update every 100 milliseconds (0.1 seconds)
        } else {
            // Redirect to the specified URL after countdown ends
            if (countdownElement = document.getElementById("countdown")){
                window.location.href = dashURL;
            }else{window.location.href = HomeURL;}
        }
    }

    // Call the updateCountdown function when the page loads
    window.addEventListener("load", function() {
        updateCountdown();
    });
    
</script>


<body>
<?php
    include "U_NavBar.php";
?>
    <div class = "outer_bkBox">
        
            
            <?php
session_start();
$successType = isset($_SESSION['successType']) ? $_SESSION['successType'] : '';

if ($successType === 'appointment') {
    // Default content if referred from an unknown page or directly ?>
    <div class = "bannerbkBox_Bg">
            <img src="../../SharedImages/appointment_1.png" alt="appointment_1">
        </div>
        <section class = "inner_bkBox">
    <div class = "bkTitle">
                <h2>Congratulations</h2>
                <h3>You have successfully booked an appointment!</h3>
            </div>
    <div class="bkText">
        <div class="time">
            <p>Remaining Time:</p><div class="jsCount"><p id="countdown"></p><p class="sec">seconds</p></div>
        </div>
        <p class="bkInfo">You will be automatic redirected to your dashboard once remainig time reaches 0 . . . </p>
    </div>
    <div class="txt_1">
        <p>Or click the button below to redirect without waiting</p>
        <div class="btnEachBox">
            <a href="<?php echo $dashboard?>" class="serBTN" ><div class="btnBox">Dashboard</div></a>
        </div>
    </div>
<?php } elseif($successType === 'appointmentWithPoints') {
    // Membership content ?>
    <div class = "bannerbkBox_Bg">
            <img src="../../SharedImages/points_1.png" alt="points_1">
        </div>
        <section class = "inner_bkBox">
    <div class = "bkTitle">
                <h2>Congratulations</h2>
                <h3>You have successfully booked an appointment by using QDC SmilePoints</h3>
            </div>
    <div class="bkText">
        <div class="time">
            <p>Remaining Time:</p><div class="jsCount"><p id="countdown"></p><p class="sec">seconds</p></div>
        </div>
        <p class="bkInfo">You will be automatic redirected to your dashboard once remainig time reaches 0 . . . </p>
    </div>
    <div class="txt_1">
        <p>Or click the button below to redirect without waiting</p>
        <div class="btnEachBox">
            <a href="<?php echo $dashboard?>" class="serBTN" ><div class="btnBox">Dashboard</div></a>
        </div>
    </div>
<?php } elseif($successType === 'updateAppointment') {
    // Membership content ?>
    <div class = "bannerbkBox_Bg">
            <img src="../../SharedImages/update_1.png" alt="update_1">
        </div>
        <section class = "inner_bkBox">
    <div class = "bkTitle">
                <h2>Congratulations</h2>
                <h3>You have successfully modify your previous appointment!</h3>
            </div>
    <div class="bkText">
        <div class="time">
            <p>Remaining Time:</p><div class="jsCount"><p id="countdown"></p><p class="sec">seconds</p></div>
        </div>
        <p class="bkInfo">You will be automatic redirected to your dashboard once remainig time reaches 0 . . . </p>
    </div>
    <div class="txt_1">
        <p>Or click the button below to redirect without waiting</p>
        <div class="btnEachBox">
            <a href="<?php echo $dashboard?>" class="serBTN" ><div class="btnBox">Dashboard</div></a>
        </div>
    </div>
<?php } elseif($successType === 'membership') {
    // Membership content ?>
    <div class = "bannerbkBox_Bg">
            <img src="../../SharedImages/patient_3.png" alt="patient_3">
        </div>
        <section class = "inner_bkBox">
    <div class = "bkTitle">
                <h2>Congratulations</h2>
                <h3>You have successfully UPGRADED into Our Loyalty Program!</h3>
            </div>
    <div class="bkText">
        <div class="time">
            <p>Remaining Time:</p><div class="jsCount"><p id="countdown"></p><p class="sec">seconds</p></div>
        </div>
        <p class="bkInfo">You will be automatic redirected to your dashboard once remainig time reaches 0 . . . </p>
    </div>
    <div class="txt_1">
        <p>Or click the button below to redirect without waiting</p>
        <div class="btnEachBox">
            <a href="<?php echo $dashboard?>" class="serBTN" ><div class="btnBox">Dashboard</div></a>
        </div>
    </div>
<?php } else {
    
    // Display content related to ProfilePage ?>

<div class = "bannerbkBox_Bg">
            <img src="../Images/appointmentSuccess_1.jpeg" alt="appointmentSuccess_1">
        </div>
        <section class = "inner_bkBox">
    <div class = "bkTitle">
                <h2>Congratulations</h2>
                <h3>You have successfully edit your profile!</h3>
            </div>
    <div class="bkText">
        <div class="time">
            <p>Remaining Time:</p><div class="jsCount"><p id="countdownPP"></p><p class="sec">seconds</p></div>
        </div>
        <p class="bkInfo">You will be automatic redirected to our homepage once remainig time reaches 0 . . . </p>
    </div>
    <div class="txt_1">
        <p>Or click the button below to redirect without waiting</p>
        <div class="btnEachBox">
            <a href="<?php echo $homepage?>" class="serBTN" ><div class="btnBox">Homepage</div></a>
        </div>
    </div>
<?php }
?>

        </section>
    </div>
<?php
    include 'U_Footer.php';
?>
</body>
</html>


