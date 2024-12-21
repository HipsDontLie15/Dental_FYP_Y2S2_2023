<?php include './A_Functions/db_connection.php';?>
<?php include './A_Functions/url.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Add Points to Customers | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
    <link rel="stylesheet" href="../CSS/A_adminList.css">
</head>

<script src="../JS/textarea_maxLength1000.js"></script>

<body>
<header>
	<?php include './A_Functions/A_NavBar.php';?>
</header>
	<div class="border-container">
		<div class="backSearch">
			<a class="arrow" href="A_CustomersMemberList.php">
				<div class="al">
					<i class="fas">&#xf060;</i> Go back
				</div>
			</a>
		</div>
		<div class="form_wrapper">
<form name ="form" action="./A_Functions/db_addMemberPoints.php" method="post" id="pointForm" >
			<div class="apppple">
			<h1 class="h1NA">Add Points to Membership Customers</h1>
				<fieldset>

<?php
if(isset($_GET['editID_cus'])){
$editID_cus = $_GET['editID_cus'];

$sql = "SELECT app_care, app_email, app_id, status FROM appointment_info WHERE app_id = '".$editID_cus."'";
$result = mysqli_query($conn, $sql);


if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
	$app_care_list = explode(', ', $row['app_care']); // Assuming app_care is stored as a comma-separated list
	$app_id = $editID_cus;
	$app_email = $row['app_email'];
	$status = $row['status'];

    // Step 2: Compare app_care data with ser_name and retrieve ser_price
    $checkMember = "SELECT ser_name, ser_price FROM services";
    $checkMember_result = mysqli_query($conn, $checkMember);
	
    $matching_services = array();
	
    if ($checkMember_result && mysqli_num_rows($checkMember_result) > 0) {
		while ($service = mysqli_fetch_assoc($checkMember_result)) {
			if (in_array($service['ser_name'], $app_care_list)) {
				$matching_services[$service['ser_name']] = $service['ser_price'];
            }
        }
    }
	?>
<legend>
	<h3 class="h3NA">Only Membership Customers Who Has Completed Their Appointment or Visit.</h3>
	<h5 class="h3NA">Fill in the Details : </h5>
	<p>Appointment ID : <b><input type="hidden" name="app_id" value="<?php echo $app_id; ?>" readonly><?php echo $app_id; ?></b></p>
	<p>Membership Customer Email : <b><input type="hidden" name="app_email" value="<?php echo $app_email; ?>" readonly><?php echo $app_email; ?></b></p>
</legend>
<table id="myTable">
    <thead>
        <tr>
            <th>Dental Care</th>
            <th>Dental Care Prices</th>
            <th>Dental Care Prices with 10% Discount</th>
            <th>Conversion SmilePoints</th>
        </tr>
    </thead>
    <tbody>
            <?php 
            $total_price = 0;
            $total_divided_price = 0;
            $total_dis = 0;
            $total_dis_price = 0;
            $dis_point = 0;
            $total_dis_point = 0;
            foreach ($matching_services as $ser_name => $ser_price) {
                // normal prices
                $total_price += $ser_price; // add each single normal price in to total
                $ser_divided = $ser_price / 100; // Divide by 100 
                $total_divided_price += $ser_divided; // Add to the total

                // after 10% discount
                $dis_multiply = $ser_price * 0.9; // multiply by 0.9 
                $total_dis += $dis_multiply; // Add to the total
                $total_dis_price = $total_dis * 0.9; // Add to the total

                // points
                $dis_point = $dis_multiply / 100;
                $total_dis_point += $dis_point;
            ?>
        <tr>
            <td align="center" class="bigtext"><input type="hidden" name="ser_name[]" value="<?php echo $ser_name; ?>" readonly><?php echo $ser_name; ?></td>
            <td align="center" class="bigtext">RM<input type="hidden" name="ser_price[]" value="<?php echo $ser_price; ?>" readonly><?php echo $ser_price; ?></td>
            <td align="center" class="bigtext">RM<input type="hidden" name="dis_multiply[]" value="<?php echo $dis_multiply; ?>" readonly><?php echo $dis_multiply; ?></td>
            <td align="center" class="bigtext"><input type="hidden" name="dis_point[]" value="<?php echo $dis_point; ?>" readonly><?php echo $dis_point; ?></td>
        </tr>
		<?php } ?>
    </tbody>
    <thead>
        <tr>
			<th></th>
			<th>Dental Care Prices</th>
			<th>Dental Care Prices with 10% Discount</th>
            <th>SmilePoints Points</th>
        </tr>
    </thead>
    <tbody>
		<tr>
			<th>Total Sum of </th>
            <td align="center" class="bigtext" id="totalPrices"><b>RM<input type="hidden" name="total_price" value="<?php echo $total_price; ?>" readonly><?php echo $total_price; ?>.00</b></td>
            <td align="center" class="bigtext" id="totalPrices"><b>RM<input type="hidden" name="total_dis" value="<?php echo $total_dis; ?>" readonly><?php echo $total_dis; ?>.00</b></td>
            <td align="center" class="bigtext" id="totalPrices"><input type="hidden" name="total_dis_point" value="<?php echo $total_dis_point; ?>" readonly><b><?php echo $total_dis_point; ?> points</b></td>
        </tr>
    </tbody>
</table>
<?php }
	}
?>
<p class="smallNote">Note: The SmilePoint convertion rate is each Dental Care divide by 100.</p>
<?php
$checkMember_result = null; // Initialize the variable to avoid the undefined warning

if(isset($_GET['editID_cus'])){
    $editID_cus = $_GET['editID_cus'];

    $sql = "SELECT app_email, app_id, status FROM appointment_info WHERE app_id = '".$editID_cus."'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $app_id = $editID_cus;
        $app_email = $row['app_email'];
        $status = $row['status'];

        // Step 2: Compare app_care data with ser_name and retrieve ser_price
        $checkMember = "SELECT * FROM `customermembership` WHERE c_email = '$app_email' ORDER BY created_at DESC LIMIT 1;";
        $checkMember_result = mysqli_query($conn, $checkMember);

        $c_points = null; // Initialize c_points variable

        if ($checkMember_result && mysqli_num_rows($checkMember_result) > 0) {
            $membership_data = mysqli_fetch_assoc($checkMember_result);
            $c_id = $membership_data['c_id'];
            $c_hygiene = $membership_data['c_hygiene'];
            $c_examination = $membership_data['c_examination'];
            $status = $membership_data['status'];
            $c_points = $membership_data['c_points'];
            $total_Points = $c_points + $total_dis_point;
        }
    }
}
?>

<table id="myTable">
    <thead>
        <tr>
            <th colspan="3">Before and After Adding Points</th>
        </tr>
        <tr>
            <th>Total Accumulated Points (Before)</th>
            <th>Addition of Points (Current)</th>
            <th>Total Sum of Points (After)</th>
        </tr>
    </thead>
        <tr>
            <td align="center" class="bigtext" id="totalPrices" ><b><?php echo $c_points; ?></b> points</td>
            <td align="center" class="bigtext" id="totalPrices" ><b><?php echo $total_dis_point; ?></b> points</td>
            <td align="center" class="bigtext" id="totalPrices" ><input type="hidden" name="total_Points" value="<?php echo $total_Points; ?>" readonly><b><?php echo $total_Points; ?></b> points</td>
        </tr>
</table>
    <input type="hidden" name="c_id" value="<?php echo $c_id; ?>" readonly>
    <input type="hidden" name="c_hygiene" value="<?php echo $c_hygiene; ?>" readonly>
    <input type="hidden" name="c_examination" value="<?php echo $c_examination; ?>" readonly>
    <input type="hidden" name="status" value="<?php echo $status; ?>" readonly>
	<input type="submit" value="Confirm" name="submit" class="button" id="btnSub"/>
</form>

	</fieldset>
</div>
</div>

</body>

</html> 