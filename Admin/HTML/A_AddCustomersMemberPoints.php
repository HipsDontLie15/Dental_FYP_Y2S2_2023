<?php include './A_Functions/url.php';?>


<script src="../JS/SA_searchFunctionCustomer.js"></script>
<script src="../JS/A_statusUpdateCustomerMembership.js"></script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Membership Customer List | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
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
		<legend>
			<h2 class="h3NA">Only Membership Customers Who Has Completed Their Appointment or Visit.</h2>
		</legend>
				<table id="myTable">
				<thead>
					<tr>
						<th colspan="12">Membership Customer</th>
					</tr>
					<tr>
						<th>ID</th>
						<th>Email</th>
						<th>Dental Care</th>
						<th>Appointed Doctor</th>
						<th>Appointed Location</th>
						<th>Appointed Date</th>
						<th>Appointed Time</th>
						<th>Status</th>
						<th>Add Points Operator</th>
					</tr>
				</thead>
				<form name ="form" action="<?php echo $A_AddCustomers_Points ?>" method="post" >
				<?php include $db_searchMemberCustomer; 
				
				if ($appInfoResult->num_rows > 0 && $pmInfoResult->num_rows > 0 && $serInfoResult->num_rows > 0) {
					// Fetch the data from the result sets
					$appInfoRows = $appInfoResult->fetch_all(MYSQLI_ASSOC);
					$pmInfoRows = $pmInfoResult->fetch_all(MYSQLI_ASSOC);
					$serInfoRows = $serInfoResult->fetch_all(MYSQLI_ASSOC);
				
					// Create a lookup array for easier comparison
					$serNames = array_column($serInfoRows, 'ser_name');
				
					// Compare and perform action
					foreach ($appInfoRows as $appRow) {
						$appCareArray = explode(', ', $appRow['app_care']);
						$appCareCount = count($appCareArray); // Count the number of app_care items

						foreach ($pmInfoRows as $pmRow) {
							if ($appRow['app_email'] === $pmRow['c_email']) {
								foreach ($appCareArray as $index => $appCare) { // Use $index for rowspan
									if (in_array($appCare, $serNames)) {?>
                        <tr>
                            <?php if ($index === 0) { // Check for the first iteration within appCareArray ?>
                                <td rowspan="<?php echo $appCareCount; ?>" align="center"><input type="hidden" name="app_id" value="<?php echo $appRow['app_id']; ?>" readonly><?php echo $appRow['app_id']; ?></td>
                                <td rowspan="<?php echo $appCareCount; ?>" align="center"><input type="hidden" name="app_email" value="<?php echo $appRow['app_email']; ?>" readonly><?php echo $appRow['app_email']; ?></td>
								<?php } ?>
								<td align="center"><input type="hidden" name="app_care[]" value="<?php echo $appCare; ?>" readonly><?php echo $appCare; ?></td>
							<?php if ($index === 0) { // Check for the first iteration within appCareArray ?>
                                <td rowspan="<?php echo $appCareCount; ?>" align="center"><input type="hidden" name="app_doc" value="<?php echo $appRow['app_doc']; ?>" readonly><?php echo $appRow['app_doc']; ?></td>
								<td rowspan="<?php echo $appCareCount; ?>" align="center"><input type="hidden" name="app_loc" value="<?php echo $appRow['app_loc']; ?>" readonly><?php echo $appRow['app_loc']; ?></td>
                                <td rowspan="<?php echo $appCareCount; ?>" align="center"><input type="hidden" name="app_date" value="<?php echo $appRow['app_date']; ?>" readonly><?php echo $appRow['app_date']; ?></td>
								<td rowspan="<?php echo $appCareCount; ?>" align="center"><input type="hidden" name="app_time" value="<?php echo $appRow['app_time']; ?>" readonly><?php echo $appRow['app_time']; ?></td>
                                <td rowspan="<?php echo $appCareCount; ?>" align="center"><input type="hidden" name="status" value="<?php echo $appRow['status']; ?>" readonly><?php echo $appRow['status']; ?></td>
								
								<td rowspan="<?php echo $appCareCount; ?>" align="center">
									<b><a href="<?php echo $A_AddCustomers_Points . '?editID_cus=' . $appRow['app_id']; ?>" >Add</a></b>
								</td>
								</form>
							<?php } ?>
						</tr>
						<?php
					}
				}
			}
		}
	}//end while loop
}	else { ?>
		<tr>
			<th colspan="12">There's No data found!!!</th>
		</tr>
		<?php } //end else statement ?>	
			</table>

		</div>
	</div> 
</body>

</html> 