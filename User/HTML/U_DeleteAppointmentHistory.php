<?php 
include './Functions/U_url.php'; 
include './Functions/Function_ConnectSQL.php';    
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Delete Appointment History | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title> 
	<link rel="stylesheet" href="../CSS/U_appointmentDelete.css">
</head>

<body>
<?php
    include "U_NavBar.php";
?>
<?php
$sql = "SELECT * FROM appointment_info WHERE app_email = '".$_SESSION['c_email']."' ";
$result = $conn->query($sql);	//execute query connection
$search_result = mysqli_query($conn, $sql);
?>
<div class="bkTop">
    <div class="backSearch">
        <a class="arrow" href="javascript:history.back()">
            <div class="al">
                <i class="fas">&#xf060;</i> Go back
            </div>
        </a>
    </div>
    <section>
        <div class="bkMidTitle">
            <h2>Are you sure you would like to remove this appointment?</h2>
            <h4>This appoinment will not be retrievable once remove</h4>
        </div>
        <form action="<?php echo $db_deleteAppointmentHistory ?>" method="post" id="appoint_form" class="deleteform">
<?php
if (isset($_GET['editID_app'])) {
    $editID_app = $_GET['editID_app'];

    // Fetch data from the database for the specified Treatment
    $sql = "SELECT * FROM appointment_info WHERE app_id = '".$editID_app."'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch data
        $row = mysqli_fetch_array($result);
        $app_id = $row['app_id'];
        $app_email = $row['app_email'];
        $app_type = $row['app_type'];
        $app_care = $row['app_care'];
        $app_doc = $row['app_doc'];
        $app_loc = $row['app_loc'];
        $app_date = $row['app_date'];
        $app_time = $row['app_time'];
        $app_description = $row['app_description'];
?>
<ul>
    <li><label class="info">Appointment Doctor : <input type="text" name="app_doc" value="<?php echo $app_doc ;?>" readonly></label></li>
    <li><label class="info">Appointment Date : <input type="text" name="app_date" value="<?php echo $app_date ;?>" readonly></label></li>
    <li><label class="info">Appointment Period : <input type="text" name="app_time" value="<?php echo $app_time ;?>" readonly></label></li>
    <li><label class="info">Appointment Location : <input type="text" name="app_loc" value="<?php echo $app_loc ;?>" readonly></label></li>
    <li><label class="info">Dental Care : <input type="text" name="app_care" value="<?php echo $app_care ;?>" readonly></label></li>
    <li><label class="info">Dental Type : <input type="text" name="app_type" value="<?php echo $app_type ;?>" readonly></label></li>
    <?php if ($app_description != '') {?>
    <li><label class="Description">Add-On Description : <textarea id="appoint_form" class="des" name="app_description" value="<?php echo $app_description; ?>" readonly><?php echo $app_description; ?></textarea></label></li>
    <?php } ?>
    <input type="hidden" name="app_id" value="<?php echo $app_id ;?>" readonly>
    <input type="hidden" name="app_email" value="<?php echo $app_email ;?>" readonly>
</ul>
<?php
    }
}
?>
            <label for="" class="delete">If you are certain to remove this appointment?
                <input type="submit" value="Delete" name="Submit">
            </label>
        </form>
    </section>
</div> 

<?php
    include 'U_Footer.php';
?>
</body>

</html> 