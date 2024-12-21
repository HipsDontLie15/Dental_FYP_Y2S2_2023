<?php include './Functions/U_url.php';?>

<script>
    var loginURL = 'U_LoginSignUp.php';

    // Set the countdown duration in seconds
    const countdownDuration = 8;
    let remainingTime = countdownDuration;

    // Function Appointment
    function updateCountdown() {
        if (remainingTime > 0) {
            const countdownElement = document.getElementById("countdown");
            countdownElement.textContent = " " + remainingTime.toFixed(1);
            
            remainingTime -= 0.1; // Decrement by 0.1 seconds
            setTimeout(updateCountdown, 100); // Update every 100 milliseconds (0.1 seconds)
        } else {
            // Redirect to the specified URL after countdown ends
            if (countdownElement = document.getElementById("countdown")){
                window.location.href = loginURL;
            }
        }
    }

    // Call the updateCountdown function when the page loads
    window.addEventListener("load", function() {
        updateCountdown();
    });
    
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_appSucRej.css">
    <title>Successfully Sign Up | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>
<body>
<?php include 'U_NavBar.php'; ?>
<div class = "outer_bkBox">
    <div class = "bannerbkBox_Bg">
            <img src="../../SharedImages/signup_1.png" alt="signup_1">
        </div>
        <section class = "inner_bkBox">
            <div class = "bkTitle">
                        <h2>Congratulations on Registering!</h2>
                        <h3>Please login first before making your reservation.</h3>
                    </div>
            <div class="bkText">
                <div class="time">
                    <p>Remaining Time:</p><div class="jsCount"><p id="countdown"></p><p class="sec">seconds</p></div>
                </div>
                <p class="bkInfo">You will be automatic redirected to the login page once remainig time reaches 0 . . . </p>
            </div>
            <div class="txt_1">
                <p>Or click the button below to redirect without waiting</p>
                <div class="btnEachBox">
                    <a href="<?php echo $loginSignUp?>" class="serBTN" ><div class="btnBox">Login</div></a>
                </div>
            </div>
        </section>
</div>
    <?php
        session_unset();
        session_destroy();
    ?>
<?php include 'U_Footer.php'; ?>
</body>
</html>