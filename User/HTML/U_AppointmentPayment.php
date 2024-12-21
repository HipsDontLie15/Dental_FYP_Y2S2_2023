<?php
    include './Functions/U_url.php';
    include './Functions/Function_ConnectSQL.php';
    
    $membership = array(
        '1' => 'Free twice yearly hygiene visits',
        '2' => 'Free twice yearly full clinical examinations',
        '3' => 'All intra-oral x-rays',
        '4' => '10% Discount on all dental treatments'
    );

?>


<?php 
session_start();
if(isset($_POST['Submit'])){
    
    $editID_customer = $_SESSION['c_id'];

    $app_email=$_SESSION['c_email'];
	$app_doc = $_POST['app_doc'];
	$app_type=$_POST['app_type'];
	$app_care = implode(", ", $_POST['app_care']); // Convert array to comma-separated string
	$app_loc = $_POST['app_loc'];
	$app_date=$_POST['app_date'];
	$app_time=$_POST['app_time'];
	$app_description=$_POST['app_description'];
    
	$book_by = "Customer";
	$status = "Booked";
	$timestamp = date('Y-m-d H:i:s');

    
    $rejectURL = 'U_AppointmentReject.php';
    $availability_query = "SELECT * FROM appointment_info WHERE app_doc = '$app_doc' AND app_date = '$app_date' AND app_time = '$app_time' ";
    $availability_result = mysqli_query($conn, $availability_query);
        
    if(mysqli_num_rows($availability_result) > 0) {
        // booked
        header("location: ".$rejectURL);
        exit;
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_appointmentPayment.css">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" > -->
    <title>Appointment Payment | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>
<body>
<?php
    include "U_NavBar.php";
?>


<section class = "bkMid">
    <form action="<?php echo $Function_AppointmentPayment; ?>" id="appoint_form" class="form" method="post" >
        <section class="formtop">
        
            <section class="detail_sec">
                <div class="paymentDetails">

                <section class="SummaryTop">
                    <div class="paymentDetails_inner">
                        <h2>Appointment Summary : </h2>
                        <div class="bkMid_title">
                            <h4>Your Selections From Our Appointment Form</h4>
                            <ul class="price">
                                <li>Type of Appointment: <?php echo $app_type; ?><input type="hidden" name="app_type" value="<?php echo $app_type; ?>" readonly></li>
                                <li>Type of Service: <?php echo $app_care; ?><input type="hidden" name="app_care" value="<?php echo $app_care; ?>" readonly></li>
                                <li>Doctor: <?php echo $app_doc; ?><input type="hidden" name="app_doc" value="<?php echo $app_doc; ?>" readonly></li>
                                <li>Location: <?php echo $app_loc; ?><input type="hidden" name="app_loc" value="<?php echo $app_loc; ?>" readonly></li>
                                <li>Date: <?php echo $app_date; ?><input type="hidden" name="app_date" value="<?php echo $app_date; ?>" readonly></li>
                                <li>Time: <?php echo $app_time; ?><input type="hidden" name="app_time" value="<?php echo $app_time; ?>" readonly></li>
                            <?php if (isset($_POST['app_description']) != '') {?>
                                <li>Description: <textarea id="appoint_form" name="app_description" value="<?php echo $app_description; ?>" readonly ><?php echo $app_description; ?></textarea> 
                                </li>
                            <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="combineBox">
                    <div class="personalPayment">
                        <div class="urDetails">
                            <h2>Your Personal Details : </h2>
                            <ul>
                                <li for="S_email" class="S_email">Email : <?php echo $row['c_email']; ?>
                                    <input type="hidden" name="c_id" value="<?php echo $editID_customer; ?>" readonly>
                                    <input type="hidden" name="c_email" value="<?php echo $row['c_email']; ?>" readonly>
                                </li>
                                <li for="S_name" class="S_name">First Name : <?php echo $_SESSION['c_firstname']; ?></li>
                                <li for="S_name" class="S_name">Last Name : <?php echo $_SESSION['c_lastname']; ?></li>
                            </ul>
                        </div>
                        <div class="pyDetails">
                            <h2>Payment Details : </h2>
                            <h4>Deposit Fee : RM20</h4>
                        </div>
                    </div>
                


            <?php
                // Fetch data from the database for the specified Customers
                $sqlMem = "SELECT * FROM customermembership WHERE c_email = '$c_email' ORDER BY created_at DESC LIMIT 1;";
                $resultMem = mysqli_query($conn, $sqlMem);

            if ($resultMem && mysqli_num_rows($resultMem) > 0) {
                // Fetch data
                $row = mysqli_fetch_assoc($resultMem);
                $c_hygiene = $row['c_hygiene'];
                $c_examination = $row['c_examination'];
                $c_points = $row['c_points'];
                
            ?>
                    <div class="membershipDetails">
                        <h2>Your QDC Loyalty Program Summary : </h2>
                        <div class="bkMid_title">
                            <h4>Would you like to claim your membership benefits in this transaction?</h4>
                            <ul class="price">
                                
                                <?php if ($c_points < 20) { ?>
                                    <li class="popping">Insufficient points to rebate; A minimum of 20 points is required to use, please use card payment.</li>
                                <?php } else { ?>
                            <li class="valid">
        <label for="usePoints" class="usePoints">Use QDC SmilePoints?
            <label for="usePointsNo"><input type="radio" id="usePointsNo" name="usePoints" value="No" checked>No</label>
            <label for="usePointsYes"><input type="radio" id="usePointsYes" name="usePoints" value="Yes">Yes</label>
        </label>
        <?php } ?>
        <ul class="points_UL" id="pointsUL" style="display: none;">
            <li>Total QDC SmilePoints: <?php echo $c_points; ?></li>
                <li>
                    <label for="claim"> Use your QDC SmilePoints : 
                        <input type="text" name="c_points" id="c_points" value="<?php echo $c_points; ?>" readonly disabled>
                        <p>Due to current limitations, QDC SmilePoints can be used on RM20 (Deposit Fee)</p>
                        <p id="error_message" class="error"></p>
                        <p id="calculation_result"><input type="hidden" name=""></p>
                    </label>
                </li>
            
            <li class="valid"><?php echo $membership['3']; ?>: Apply to membership only</li>
            <li class="valid"><?php echo $membership['4']; ?>: Apply to membership only</li>
            <li class="valid"><?php echo $membership['1']; ?>: Remains <?php echo $c_hygiene; ?> out of 2
            <?php if((($c_hygiene != 0))) {?>
            <ul>
                <li class="checkboxes">
                <label for="hygieneCheckbox">
                    <input type="checkbox" id="hygieneCheckbox" name="c_hygiene_checkbox" value="Yes">
                    Claim Yearly Hygiene Visits ( 1 )
                </label>
                <input type="hidden" name="c_hygiene" value="<?php echo $c_hygiene; ?>">
                <!-- <p id="hygieneResult" class="result"></p> -->
                </li>
            </ul>
            <?php } ?>
            </li>
            <li class="valid"><?php echo $membership['2']; ?>: Remains <?php echo $c_examination; ?> out of 2
            <?php if((($c_examination != 0))) {?>
            <ul>
                <li class="checkboxes">
                <label for="examinationCheckbox">
                    <input type="checkbox" id="examinationCheckbox" name="c_examination_checkbox" value="Yes">
                    Claim Yearly Full Clinical Examinations (1)
                </label>
                <input type="hidden" name="c_examination" value="<?php echo $c_examination; ?>">

                <!-- <p id="examinationResult" class="result"></p> -->
                </li>
            </ul>
            <?php } ?>
            </li>
            
        </ul>
    </li>

                                
                            </ul>
                            <?php
                    if((isset($app_email) == ($resultMem && mysqli_num_rows($resultMem) > 0))) {?>
                    <h5>10% Discount on all dental treatments is not included in the Deposit Fee</h5>
                    <?php } ?>
            <?php } else {
                // No data found
                //echo "No data found for c_email: " . $c_email;
                echo "You are not a QDC Loyalty Program. Sign Up now and obtain various benefits from it. You may even collect SmilePoints to rebate on your next appointment.";
            }
            ?>
                        </div>
                    </div> <!-- end of membership -->
                    </div>
                    </section> <!-- end of SummaryTop -->
                    
                </div>
                
            </section>

            <div class="col-50">
    <h2>Billing :</h2>
    <div class="card">
        <img class="pay_img" src="../Icons/payment_1.png" alt="payment_1.png">
        <p>Accepted Cards : Debit or Credit Card</p>
    </div>
    <label for="cname">Name on Card</label>
<input type="text" id="cname" name="c_cardname" class="card-input" placeholder="John More Doe" required>

<label for="ccnum">Debit or Credit card number</label>
<input type="text" id="ccnum" name="c_cardnum" class="card-input" placeholder="1111-2222-3333-4444" pattern="\d{4}-\d{4}-\d{4}-\d{4}" required>

<label for="expmonth">Card Expiration</label>
<input type="text" id="expmonth" name="c_cardexpire" class="card-input" placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\/\d{2}$" required>

<label for="cvc">Security Code</label>
<input type="text" id="cvc" name="c_cardcode" class="card-input" placeholder="352" pattern="\d{3}" required>

    <div class="S_btns">
        <input type="submit" value="Submit" name="submitPayment" class="btn">
    </div>
</div>

        </section>
    </form>
</section>
<?php }
?>

<?php
    include 'U_Footer.php';
?>

<script>
    // Get the input element
    const cPointsInput = document.getElementById("c_points");
    // Get the error message element
    const errorMessage = document.getElementById("error_message");
    // Get the calculation result element
    const calculationResult = document.getElementById("calculation_result");

    // Original c_points value (replace this with your actual value)
    const originalCPoints = <?php echo $c_points; ?>;

    // Add an event listener to the input field
    cPointsInput.addEventListener("input", function () {
        const inputValue = cPointsInput.value.trim();

        // Clear previous error message
        errorMessage.textContent = "";
        calculationResult.textContent = "";

        // Check if the input value is not a valid number
        if (!/^\d+(\.\d{2})?$/.test(inputValue)) {
            errorMessage.textContent = "Only insert numbers or with 2 decimal points";
        } else {
            // Check if the input value is less than 20
            const numericValue = parseFloat(inputValue);
            if (!isNaN(numericValue) && numericValue < 20) {
                errorMessage.textContent = "Please insert a minimum of 20";
            } else if (numericValue > originalCPoints) {
                errorMessage.textContent = "Incorrect points";
            } else {
                // Calculate and display the difference
                const difference = numericValue - 20;
                calculationResult.textContent = `${numericValue} Points - RM20(deposit fee) = ${difference.toFixed(2)} Points`;
            }
        }
    });
</script>

<script>
    // Get the checkbox element
    const hygieneCheckbox = document.getElementById("hygieneCheckbox");
    const examinationCheckbox = document.getElementById("examinationCheckbox");

    // Get the result element
    const hygieneResult = document.getElementById("hygieneResult");
    const examinationResult = document.getElementById("examinationResult");

    // Initial value of c_hygiene (replace this with your actual value)
    const initialCHygiene = <?php echo $c_hygiene; ?>;
    const initialCExamination = <?php echo $c_examination; ?>;

    // Add an event listener to the checkbox
    hygieneCheckbox.addEventListener("change", function () {
        // Clear previous result
        hygieneResult.textContent = "";

        if (hygieneCheckbox.checked) {
            // Calculate and display the remaining value
            const remainingHygiene = initialCHygiene - 1;
            hygieneResult.textContent = `Remaining is ${remainingHygiene} out of 2`;
        }
    });

    // Add an event listener to the checkbox
    examinationCheckbox.addEventListener("change", function () {
        // Clear previous result
        examinationResult.textContent = "";

        if (examinationCheckbox.checked) {
            // Calculate and display the remaining value
            const remainingExamination = initialCExamination - 1;
            examinationResult.textContent = `Remaining is ${remainingExamination} out of 2`;
        }
    });
</script>

<script>
 document.addEventListener("DOMContentLoaded", function () {
    const usePointsYes = document.getElementById("usePointsYes");
    const col50Inputs = document.querySelectorAll(".col-50 input");
    const cPointsInput = document.getElementById("c_points");

    usePointsYes.addEventListener("change", function () {
        const isUsingPoints = usePointsYes.checked;

        col50Inputs.forEach(input => {
            if (isUsingPoints) {
                input.removeAttribute("required");
            } else {
                input.setAttribute("required", "required");
            }
        });

        // cPointsInput.disabled = !isUsingPoints;
        // if (isUsingPoints) {
        //     cPointsInput.value = ""; // Clear the QDC SmilePoints input value
        // }
    });

    // Set QDC SmilePoints input initially disabled and required
    cPointsInput.disabled = true;
    cPointsInput.setAttribute("required", "required");
});

</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const usePointsYes = document.getElementById("usePointsYes");
    const usePointsNo = document.getElementById("usePointsNo");
    const cardInputs = document.querySelectorAll(".card-input");
    const cPointsInput = document.getElementById("c_points");

    usePointsYes.addEventListener("change", function() {
        const isUsingPoints = usePointsYes.checked;

        cardInputs.forEach(input => {
            input.disabled = isUsingPoints;
            if (isUsingPoints) {
                input.value = ""; // Clear the input value
            }
        });

        cPointsInput.disabled = !isUsingPoints;
    });

    usePointsNo.addEventListener("change", function() {
        const isUsingPoints = usePointsNo.checked;

        cardInputs.forEach(input => {
            input.disabled = !isUsingPoints;
        });

        cPointsInput.disabled = isUsingPoints;
        // if (isUsingPoints) {
        //     cPointsInput.value = ""; // Clear the QDC SmilePoints input value
        // }
    });
});

</script>


<script>
    document.getElementById("usePointsYes").addEventListener("click", function() {
        document.getElementById("pointsUL").style.display = "block";
    });
    
    document.getElementById("usePointsNo").addEventListener("click", function() {
        document.getElementById("pointsUL").style.display = "none";
    });
</script>


<script>
    const e_checkbox = document.getElementById("examinationCheckbox");
    const e_hiddenInput = document.getElementById("examinationHidden");
    const h_checkbox = document.getElementById("hygieneCheckbox");
    const h_hiddenInput = document.getElementById("hygieneHidden");
    
    e_checkbox.addEventListener("change", function() {
        if (e_checkbox.checked) {
            e_hiddenInput.disabled = true;
        } else {
            e_hiddenInput.disabled = false;
        }
    });

    h_checkbox.addEventListener("change", function() {
        if (h_checkbox.checked) {
            h_hiddenInput.disabled = true;
        } else {
            h_hiddenInput.disabled = false;
        }
    });

</script>

</body>
</html>