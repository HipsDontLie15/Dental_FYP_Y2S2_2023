<?php
    include "./Functions/U_url.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_QDCmembershipPlan.css">
    <title>Your QDC SmilePoints Balance | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>

<body>
<?php
    include "U_NavBar.php";
    $checkMember_result = null; // Initialize the variable to avoid the undefined warning

if (isset($_SESSION['c_email'])) {
    $c_email = $_SESSION['c_email'];
    $checkMember = "SELECT * FROM `customermembership` WHERE c_email = '$c_email' ORDER BY created_at DESC LIMIT 1;";
    $checkMember_result = mysqli_query($conn, $checkMember);
}
?>

<section class = "bkMid">
    <div class="backSearch">
        <a class="arrow" href="javascript:history.back()">
            <div class="al">
                <i class="fas">&#xf060;</i> Go back
            </div>
        </a>
    </div>
    <div class="bkMidTitle">
        <h2>QDC SmilePoints Balance : </h2>
        <p>Your QDC SmilePoints Balance indicates how many points you currently have available for redemption.</p>
    </div>
<div class="columns">
    <ul class="price">
        <div class="rowLi" id="smilepoint">
        <?php
            if ($checkMember_result && mysqli_num_rows($checkMember_result) > 0) {
                $row = mysqli_fetch_assoc($checkMember_result); 
                $c_points = $row['c_points'];
            ?>
        <li><div class="bigtext">Total QDC SmilePoints : <b><?php echo $c_points; ?></b> points</div></li>
            <?php }
        ?>
        </div>
    </ul>
</div>
</section>
<?php
    include 'U_Footer.php';
?>

</body>
</html>


