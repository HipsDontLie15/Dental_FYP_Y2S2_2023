<?php 
    include "./Functions/U_url.php";
    include $notLoggedIn;
    include $Function_ProfilePage;
    include "./Functions/Function_UpdateProfilePage.php";
    include $Function_UpdateProfilePage;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
    <link rel="stylesheet" href="../CSS/U_profilePage.css">
</head>


<body>
<?php
    include "U_NavBar.php";
?>
    <div class = "overall-box">
        <div class="border-container">
            <div class="inner-boxtop">
                <div class="left-section">
                    <div class ="text1">
                        <h2>User Details</h2>
                    </div>
                    <div class = "ssbox">
                        <div class="text2" id ="textleft">
                            <h4>You are able to modify your existing details and update them.</h4>
                        </div>
                    </div>
                </div>
                <?php ProfilePage(); ?>
            </div>
        </div>        
    </div>
<?php
    include 'U_Footer.php';
?>
<script src="../JS/U_signInPw_validator.js"></script>
<script src="../JS/U_signInEmail_validator.js"></script>
<script src="../JS/U_signInDOB_validator.js"></script>
<script src="../JS/U_signInPhone_validator.js"></script>
<script src="../JS/U_verticalTabs.js"></script>
<script src="../JS/U_genderRB.js"></script>


<script>
// pw visibility
function togglePW() {
    var passwordInput = document.getElementById("pwd");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
</script>

</body>
</html>


