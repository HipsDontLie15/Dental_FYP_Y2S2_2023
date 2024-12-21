<?php
function payMembership(){
    include './Functions/U_url.php';
    include $Function_SignMmbership;
    $membership = array(
        '1' => 'Free twice yearly hygiene visits',
        '2' => 'Free twice yearly full clinical examinations',
        '3' => 'All intra-oral x-rays',
        '4' => '10% Discount on all dental treatments');
        include './Functions/Function_ConnectSQL.php';
        if (isset($_GET['editID_customer'])) {
    $editID_customer = $_GET['editID_customer'];

    // Fetch data from the database for the specified Customers
    $sql = "SELECT * FROM customers WHERE c_id = '".$editID_customer."' ";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch data
        $row = mysqli_fetch_array($result);

        // Calculate age using date of birth (take from backend)
        $dob = $row['c_dob'];
        $from = new DateTime($dob);
        $to = new DateTime('today');
        $bday = $from->diff($to)->y;

        // Function to determine membership type and payment
        function whichType($bday) {
            if ($bday > 17) {
                $payment = '200';
                $membershipType = "Adult";
            } else {
                $payment = '100';
                $membershipType = "Children";
            }
            $output = $membershipType . " : RM". $payment ." / year";
            return [$payment, $membershipType, $output];
        }

        // Call the function
        [$payment, $membershipType, $output] = whichType($bday);
    ?>
<section class = "bkMid">
    <form action="<?php echo $Function_SignMmbership; ?>" class="form" method="post" >
        <section class="formtop">
            <div class="col-50">
                <h2>Billing : </h2>
                <div class="card">
                    <img  class="pay_img" src="../Icons/payment_1.png" alt="payment_1.png">
                    <p>Accepted Cards : Debit or Credit Card</p>
                    <!-- <i class="fa fa-spin" id="spinner">&#xf110;</i> -->
                </div>
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="c_cardname" placeholder="John More Doe" required>
                <label for="ccnum">Debit or Credit card number</label>
                <input type="text" id="ccnum" name="c_cardnum" placeholder="1111-2222-3333-4444" pattern="\d{4}-\d{4}-\d{4}-\d{4}" required>
                <label for="expmonth">Card Expiration</label>
                <input type="text" id="expmonth" name="c_cardexpire" placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\/\d{2}$" required>
                <label for="cvc">Security Code</label>
                <input type="text" id="cvc" name="c_cardcode" placeholder="352" pattern="\d{3}" required>
                <div class="S_btns">
                    <input type="submit" value="Submit" name="submitPayment" class="btn">
                </div>
            </div>
            <section class="detail_sec">
                <div class="paymentDetails">
                    <div class="paymentDetails_inner">
                        <h2>Payment Summary : </h2>
                        <div class="bkMid_title">
                            <h4>Membership (details)</h4>
                            <ul class="price">
                                <?php foreach($membership as $ms): ?>
                                <li class="valid"><?php echo $ms; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <h2><?php echo $output; ?>
                        <input type="hidden" name="c_payment" value="<?php echo $payment; ?>" readonly>
                        <input type="hidden" name="c_typeMember" value="<?php echo $membershipType; ?>" readonly>
                    </h2>
                </div>
                <div class="urDetails">
                    <h2>Your Personal Details : </h2>
                    <ul>
                        <li for="S_email" class="S_email">Email : <?php echo $row['c_email']; ?>
                            <input type="hidden" name="c_id" value="<?php echo $editID_customer; ?>" readonly>
                            <input type="hidden" name="c_email" value="<?php echo $row['c_email']; ?>" readonly>
                        </li>
                        <li for="phone" class="S_phone">Phone Number : <?php echo $row['c_phone']; ?></li>
                        <li for="date">Date of Birth : <?php echo $row['c_dob']; ?></li>
                        <li for="age">Age: <?php echo $bday?> years old</li>
                    </ul>
                </div>
            </section>
        </section>
    </form>
</section>
<?php }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_signMembership.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <title>Applying Loyalty Program | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>
<body>
<?php
    include "U_NavBar.php";
?>

<?php payMembership(); ?>

<?php
    include 'U_Footer.php';
?>


</body>
</html>