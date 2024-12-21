<?php 
include './Functions/U_url.php'; 
include './Functions/Function_ConnectSQL.php';    
?>
<?php //include $db_searchAppointment; ?>

<script src="../JS/U_searchFunctionAppointment.js"></script>
<!-- <script src="../JS/A_confirmDeleteDentalService.js"></script> -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Appointment History | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title> 
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
	<div class="border-container">
		<!-- <div class="al">
			<a class="arrow" href="Admin_ManageAdmin.php">Go back</a>
		</div> -->
		<div class="boxform">
			<div class="backSearch">
				<a class="arrow" href="javascript:history.back()">
					<div class="al">
						<i class="fas">&#xf060;</i> Go back
					</div>
				</a>
				<div class="Mingbaibox">
					<input class="stxt" type="text" name="valueToSearch" id="myInput" onkeyup="searchFunction()" placeholder="Type To Search" />
					<!-- <input class="sbtn" type="submit" name="search" value="Search"/> -->
				</div>
			</div>
			<div class="boxform">
				<table id="myTable">
				<thead>
					<tr>
						<th>Appointment ID</th>
						<th>Appointment Doctor</th>
						<th>Appointment Date</th>
						<th>Appointment Period</th>
						<th>Dental Location</th>
						<th>Dental Care</th>
						<!-- <th>Dental Type</th> -->
						<th>Add-On Description</th>
						<th>Status</th>
						<th>Edit Operator</th>
						<th>Remove Operator</th>
					</tr>
				</thead>
				<?php
				//Fetch Data form database
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){ ?>
						<?php while($row = mysqli_fetch_array($search_result)):
                            ?>
						<tr>
							<td align="center"><?php echo $row['app_id']; ?></td>
							<td align="center"><?php echo $row['app_doc']; ?></td>
							<td align="center"><?php echo $row['app_date']; ?></td>
							<td align="center"><?php echo $row['app_time']; ?></td>
							<td align="center"><?php echo $row['app_loc']; ?></td>
							<td align="center"><?php echo $row['app_care']; ?></td>
							<!-- <td align="center"><?php echo $row['app_type']; ?></td> -->
							<td align="center"><?php echo $row['app_description']; ?></td>
							<td align="center"><?php echo $row['status']; ?></td>
							<?php if($row['status'] == "Booked" ) {?>
							<td align="center">
								<a href="<?php echo $U_EditAppointmentHistory . '?editID_app=' . $row['app_id']; ?>">Edit</a>
							</td>
							<?php } else {?>
								<td></td>
							<?php }?>
							<?php if($row['status'] == "Freed" ) {?>
                            <td align="center">
								<a href="<?php echo $U_DeleteAppointmentHistory . '?editID_app=' . $row['app_id']; ?>" class="link" alt="delete">Delete</a>
							</td>
							<?php } else {?>
								<td></td>
							<?php }?>
						</tr>
						<?php endwhile;?>
						<?php
					}//end while loop
				}else{
				?>
					<tr>
						<th colspan="10">There's No data found!!!</th>
					</tr>
					<?php
					}//end else statement
				?>
			</table>
			</div>
		</div>
	</div> 


<?php
    include 'U_Footer.php';
?>
</body>

</html> 