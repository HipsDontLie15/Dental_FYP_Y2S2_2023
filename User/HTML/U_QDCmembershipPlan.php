<?php
    $membership = array(
        '1' => 'Free twice yearly hygiene visits',
        '2' => 'Free twice yearly full clinical examinations',
        '3' => 'All intra-oral x-rays',
        '4' => '10% Discount on all dental treatments',
    );

    include "./Functions/U_url.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_QDCmembershipPlan.css">
    <title>Your QDC Loyalty Program Plan | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>

<body>
<?php
    include "U_NavBar.php";
    $checkMember_result = null; // Initialize the variable to avoid the undefined warning

if (isset($_SESSION['c_email'])) {
    $c_email = $_SESSION['c_email'];
    $checkMember = "SELECT * FROM `customermembership` WHERE c_email = '$c_email' ORDER BY created_at DESC LIMIT 1;";
    $checkMember_result = mysqli_query($conn, $checkMember);

    $typeMember = "SELECT * FROM `paymentmembership` WHERE c_email = '$c_email' ORDER BY c_email ASC LIMIT 1;";
    $typeMember_result = mysqli_query($conn, $typeMember);
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
        <h2>Your QDC Membership Plan : </h2>
        <p>Enjoy seamless access to premium content, discount prices, and priority services.</p>
    </div>
<div class="columns">
    <ul class="price">
        <li class="li_header" id="header_Pro">
            <div class="coltitle">Membership</div>
            <?php
                if ($typeMember_result && mysqli_num_rows($typeMember_result) > 0) {
                    $row = mysqli_fetch_assoc($typeMember_result); 
                    $c_typeMember = $row['c_typeMember'];
                    $c_payment = $row['c_payment'];
                    if($c_typeMember == 'Children'){ ?>
                        <div class="pricing"><?php echo $c_typeMember; ?> : RM<?php echo $c_payment; ?> / year</div>
                    <?php }else{ ?>
                        <div class="pricing"><?php echo $c_typeMember; ?> : RM<?php echo $c_payment; ?> / year</div>
                    <?php }
            }?>
        </li>
        <div class="rowLi">
        <?php
            if ($checkMember_result && mysqli_num_rows($checkMember_result) > 0) {
                $row = mysqli_fetch_assoc($checkMember_result); 
                $c_hygiene = $row['c_hygiene'];
                $c_examination = $row['c_examination']; 
                $hygiene_class = ($c_hygiene > 0) ? "valid" : "novalid";
                $examination_class = ($c_examination > 0) ? "valid" : "novalid";
            ?>
        <li class="<?php echo $hygiene_class; ?>" id="hygieneItem" >
            <div><?php echo $membership[1]; ?></div>
            <div class="remainer">
                <div>( </div><p><?php echo $c_hygiene; ?></p><div> / 2 )</div>
            </div>
        </li>
        <li class="<?php echo $examination_class; ?>" id="examinationItem" >
            <div><?php echo $membership[2]; ?></div>
            <div class="remainer">
                <div>( </div><p><?php echo $c_examination; ?></p><div> / 2 )</div>
            </div>
        </li>
            <?php }
        ?>
        <li class="valid"><div><?php echo $membership[3]; ?></div></li>
        <li class="valid"><div><?php echo $membership[4]; ?></div></li>
        </div>
    </ul>
</div>
</section>
<?php
    include 'U_Footer.php';
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var hygieneItem = document.getElementById("hygieneItem");
    var examinationItem = document.getElementById("examinationItem");

    // Initial check for hygiene validity
    updateValidity(hygieneItem);

    function updateValidity(item) {
        var pElement = item.querySelector("p");
        var value = parseInt(pElement.textContent);

        if (value <= 0) {
            item.classList.remove("valid");
            item.classList.add("novalid");
        } else {
            item.classList.remove("novalid");
            item.classList.add("valid");
        }
    }
});
</script>

</body>
</html>


