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
    <title>Your QDC SmilePoints Transaction History | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>

<body>
<?php
    include "U_NavBar.php";
    $checkMember_result = null; // Initialize the variable to avoid the undefined warning

if (isset($_SESSION['c_email'])) {
    $c_email = $_SESSION['c_email'];
    $checkMember = "SELECT * FROM `customermembership` WHERE c_email = '$c_email' ORDER BY `customermembership`.`cm_id` DESC ";
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
        <h2>QDC SmilePoints Transaction History : </h2>
        <p>The SmilePoints Transaction History help you track your point accumulation and understand how you've utilized your rewards within the QDC loyalty program.</p>
    </div>
    <div class="columns">
        <table id="myTable">
            <thead>
                <tr>
                    <th>Latest (current) to Oldest (previous)</th>
                    <th>Points</th>
                </tr>
            </thead>
            
        <!-- <div class="rowLi" id="smilepoint"> -->
        <?php
            if ($checkMember_result && mysqli_num_rows($checkMember_result) > 0) {
                while ($row = mysqli_fetch_assoc($checkMember_result)) {
                    $c_points = $row['c_points'];
                    $created_at = $row['created_at'];
                    ?>
                <tr>
                    <td align="center" class="bigtext"><?php echo $created_at; ?></td>
                    <td align="center" class="bigtext"><b><?php echo $c_points; ?></b></td>
                </tr>
                    <?php
                }
            }
            
                ?>
        </table>

        </div>
</div>
</section>
<?php
    include 'U_Footer.php';
?>

</body>
</html>


