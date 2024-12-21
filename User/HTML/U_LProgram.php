<?php
    $QDC_SmilePoints = array(
        array(
            'title' => 'What is QDC SmilePoints?',
            'content' => 'QDC SmilePoints is the official Qualiteeth Dental Clinic Loyalty Program that rewards members with privileges and loyalty points (SmilePoints) where offered by participating any branches of Qualiteeth Dental Clinic.'
        ),
        array(
            'title' => 'Who is eligible to apply?',
            'content' => 'Anyone with the starting age of 12 years old and above.'
        ),
        array(
            'title' => 'Is there a membership fee?',
            'content' => '<strong>Adults (18 years old and above) : </strong>RM200 for a 1-year membership.<br><br><strong>Children (under 18 years old) : </strong>RM100 for a 1-year membership.'
        ),
        array(
            'title' => 'What is the validity of the membership?',
            'content' => 'QDC SmilePoints is valid for 1-year from the date your application is accepted or the date your membership is renewed.'
        ),
        array(
            'title' => 'How do I earn QDC SmilePoints?',
            'content' => 'QDC SmilePoints are points earned when once completing a dental visit and fully paid the amount of the dental visit. QDC SmilePoints are earned at the rate of RM1 spent = 0.01 SmilePoints. Please ensure that you ask the recepient for your SmilePoints receipt as proof of SmilePoints Earning Transaction.'
        ),
        array(
            'title' => 'How do I use/rebate my SmilePoints?',
            'content' => 'Redemption of SmilePoints can be done as long as you have sufficient SmilePoints. You may use/rebate your SmilePoints during payment of a dental visit or payment while in the process of making an appointment.'
        ),
        array(
            'title' => 'How do I check my SmilePoints balance & transaction history?',
            'content' => 'Login to your account and click on the dashboard to check.'
        ),
        array(
            'title' => 'Are my SmilePoints transferable?',
            'content' => 'No, you may not transfer your SmilePoints to other members.'
        )
    );

    $membership = array(
        '1' => 'Free twice yearly hygiene visits',
        '2' => 'Free twice yearly full clinical examinations',
        '3' => 'All intra-oral x-rays',
        '4' => '10% Discount on all dental treatments',
    );

    $no_member = array(
        '1' => 'None free hygiene visits',
        '2' => 'None free full clinical examinations',
        '3' => 'Limited intra-oral x-rays',
        '4' => '0% Discount on all dental treatments',
    );

    include "./Functions/U_url.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_LProgram.css">
    <title>Loyalty Program | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>

<body>
<?php
    include "U_NavBar.php";
    $checkMember_result = null; // Initialize the variable to avoid the undefined warning

if (isset($_SESSION['c_email'])) {
    $checkMember = "SELECT * FROM `customermembership` WHERE c_email = '".$_SESSION['c_email']."' ";
    $checkMember_result = mysqli_query($conn, $checkMember);
}
?>
<section class = "bkTop">
    <div class = "bkTitle_bg">
        <img src="../Images/LProgram_1.jpeg" alt="LProgram_1">
    </div>
    <div class = "bkTitle">
        <div class = "groupTitle">
            <h4>Loyalty Program</h4>
            <h2>Introducing the Qualiteeth Dental Clinic Loyalty Program!</h2>
        </div>
        <p>We value our patients' trust and commitment to their oral health, and we believe in giving back. With our loyalty program, you'll unlock exclusive benefits and rewards as a token of our appreciation. 
            From point rebates on treatments to priority scheduling, your loyalty means everything to us. <br><br>Join the Qualiteeth family today and experience dental care that goes beyond expectations. Your smile deserves the best, and with our loyalty program, it's our pleasure to make your dental journey even more rewarding.</p>
    </div>
</section>

<section class = "bkMid">
    <div class="column_flex">

    <div class="columns">
    <ul class="price" id="basic_P">
        <li class="li_header"><div class="coltitle">Basic</div><div class="pricing">Free / year<br><br></div></li>
        <?php foreach($no_member as $ms): ?>
            <li class="novalid"><?php echo $ms; ?></li>
        <?php endforeach; ?>

        <?php
        if (isset($_SESSION['c_email'])) {
            // Check if session variable exists before using it
            if ($checkMember_result) {
                if (mysqli_num_rows($checkMember_result) > 0) {
                    // User's email exists in the database ?>
                        <li class="grey" id="li_current">You have Upgraded to Membership!</li>
                    <?php
                } else { // User's email doesn't exist in the database ?>
                    <li class="grey" id="li_current">Current</li>
                <?php }
            } else { 
                echo "Query failed: " . mysqli_error($conn);
            }
        } else {
            // Session variable not found, ignore and do nothing
        }
        ?>
    </ul>
</div>

<div class="columns">
    <ul class="price">
        <li class="li_header" id="header_Pro"><div class="coltitle">Membership</div><div class="pricing">Adult: RM200 / year<br>Children: RM100 / year</div></li>
        <?php foreach($membership as $ms): ?>
            <li class="valid"><?php echo $ms; ?></li>
        <?php endforeach; ?>

        <?php
        if (isset($_SESSION['c_email'])) {
            // Check if session variable exists before using it
            if ($checkMember_result) {
                if (mysqli_num_rows($checkMember_result) > 0) {
                    // User's email exists in the database
                    echo '<li class="grey" id="li_nt">Current</li>';
                } else { // User's email doesn't exist in the database
                    if (isset($_SESSION['c_email'])) {
                        // User is logged in, show "Upgrade Now" button
                        echo '<a href="U_SignMembership.php?editID_customer=' . $row['c_id'] . '" class="button"><li class="grey" id="li_nt">Upgrade Now</li></a>';
                    } else {
                        // User is not logged in, show "Log in to Upgrade" button
                        echo '<a href="'. $loginSignUp .'" class="button"><li class="grey" id="li_nt">Log in to Upgrade</li></a>';
                    }
                }
            } else { 
                echo "Query failed: " . mysqli_error($conn);
            }
        } else {
            // Session variable not found, ignore and do nothing
        }
        ?>
    </ul>
</div>



</div>

    <div class="bkMid_title">
        <h2>Non-membership VS Membership</h2>
        <p>If you haven't joined our membership yet, you're in for a treat. 
        Even without a membership, you can still enjoy a range of benefits that make your interactions with us more rewarding. 
        From discounts on select products to priority access during promotions, 
        our non-membership benefits ensure that you're always getting the best value for your money.</p>
    </div>
</section>

<section class = "bkBottom">
    <div class="bkbottom_cont">
        <h4>FAQs</h4>
        <p class="bkBottomTitle">Introducing The QDC SmilePoints</p>
        <?php foreach ($QDC_SmilePoints as $QDC): ?>
        <div class="divQDC">
            <details>
                <summary><?php echo $QDC['title']; ?></summary>
                <p><?php echo $QDC['content']; ?></p>
            </details>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
    include 'U_Footer.php';
?>
</body>
</html>


