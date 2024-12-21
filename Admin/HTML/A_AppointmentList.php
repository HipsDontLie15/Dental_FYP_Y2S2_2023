<?php include './A_Functions/url.php';?>


<script src="../JS/SA_searchFunctionDoctor.js"></script>
<script src="../JS/A_confirmDeleteAppointment.js"></script>
<script src="../JS/A_statusUpdateAppointment.js"></script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Appointment List | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
	<link rel="stylesheet" href="../CSS/A_adminList.css">
</head>

<body>
	<header>
		<?php include './A_Functions/A_NavBar.php';?>
	</header>
	<div class="border-container">
		<div class="backSearch">
			<a class="arrow" href="A_Dashboard.php">
				<div class="al">
					<i class="fas">&#xf060;</i> Go back
				</div>
			</a>
			<div class="Mingbaibox">
				<input class="stxt" type="text" name="valueToSearch" id="myInput" onkeyup="searchFunction()" placeholder="Type To Search" />
			</div>
		</div>
		<div class="boxform">
				<table id="myTable">
				<thead>
					<tr>
						<th colspan="13">Appointment</th>
					</tr>
					<tr>
						<th>ID</th>
						<!-- <th>Type</th> -->
						<th>Customer Email</th>
						<th>Dental Care</th>
						<th>Appointed Doctor</th>
						<th>Appointed Location</th>
						<th>Date</th>
						<th>Time</th>
						<th>Description</th>
						<th>Status</th>
						<th>Edit Operator</th>
						<th>Status Operator</th>
						<th>Remove Operator</th>
					</tr>
				</thead>
				<?php include $db_searchAppointment; ?>
				<?php include $db_changeAppointmentStatus; ?>
				<?php
				//Fetch Data form database
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){ ?>
						<?php while($row = mysqli_fetch_array($search_result)):
                            ?>
						<tr>
							<td align="center"><?php echo $row['app_id']; ?></td>
							<!-- <td align="center"><?php echo $row['app_type']; ?></td> -->
							<td align="center"><?php echo $row['app_email']; ?></td>
							<td align="center"><details><?php echo $row['app_care']; ?></details></td>
							<td align="center"><?php echo $row['app_doc']; ?></td>
							<td align="center"><?php echo $row['app_loc']; ?></td>
							<td align="center"><?php echo $row['app_date']; ?></td>
							<td align="center"><?php echo $row['app_time']; ?></td>
							<td align="center"><details><?php echo $row['app_description']; ?></details></td>
							<td align="center"><?php echo $row['status']; ?></td>
							<?php if ($row['status'] == 'Booked') { ?>
							<td align="center">
								<b><a href="<?php echo $A_editAppointment . '?editID_app=' . $row['app_id']; ?>">Edit</a></b>
							</td>
							<?php } else {?>
								<td></td>
							<?php }?>
							<td align="center" class="unpadding">
								<select class="selectionpop" onchange="status_update(<?php echo $row['app_id']; ?>, this.value)">
									<option value="">Update Status</option>
									<option value="Booked">Booked</option>
									<option value="Freed">Freed</option>
								</select>
							</td>
							<?php if ($row['status'] == 'Freed') { ?>
                            <td align="center">
                                    <b><a href="#" class="link" onclick="confirmDelete(<?php echo $row['app_id']; ?>, '<?php echo $row['status']; ?>')" alt="delete">Delete</a></b>
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
						<th colspan="13">There's No data found!!!</th>
					</tr>
					<?php
					}//end else statement
				?>
			</table>

		</div>
	</div> 
</body>

</html> 