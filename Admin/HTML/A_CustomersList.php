<?php include './A_Functions/url.php';?>


<script src="../JS/SA_searchFunctionCustomer.js"></script>
<script src="../JS/A_confirmDeleteCustomer.js"></script>
<script src="../JS/A_statusUpdateCustomer.js"></script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Customer List | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
	<link rel="stylesheet" href="../CSS/A_adminList.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
						<th colspan="12">Customer</th>
					</tr>
					<tr>
						<th>ID</th>
						<th>Email</th>
						<th>Password</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Gender</th>
						<th>Date of Birth</th>
						<th>Phone Number</th>
						<th>Status</th>
						<th>Edit Operator</th>
						<th>Status Operator</th>
						<th>Remove Operator</th>
					</tr>
				</thead>
				<?php include $db_searchCustomer; ?>	<!-- change -->
				<?php include $db_changeCustomerStatus; ?>	<!-- change -->
				<?php
				//Fetch Data form database
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){ ?>
						<?php while($row = mysqli_fetch_array($search_result)):
                            ?>
						<tr>
							<td align="center"><?php echo $row['c_id']; ?></td>
							<td align="center"><?php echo $row['c_email']; ?></td>
							<td align="center"><?php echo $row['c_password']; ?></td>
							<td align="center"><?php echo $row['c_firstname']; ?></td>
							<td align="center"><?php echo $row['c_lastname']; ?></td>
							<td align="center"><?php echo $row['c_gender']; ?></td>
							<td align="center"><?php echo $row['c_dob']; ?></td>
							<td align="center"><?php echo $row['c_phone']; ?></td>
							<td align="center"><?php echo $row['c_status']; ?></td>
							<td align="center">
								<!-- change -->
								<b><a href="<?php echo $A_EditCustomer . '?editID_cus=' . $row['c_id']; ?>">Edit</a></b>
							</td>
							<td align="center" class="unpadding">
								<select class="selectionpop" onchange="status_update(<?php echo $row['c_id']; ?>, this.value)">
									<option value="">Update Status</option>
									<option value="Active">Active</option>
									<option value="Deactivate">Deactivate</option>
								</select>
							</td>
                            <td align="center">
								<?php if ($row['c_status'] == 'Deactivate'): ?>
                                    <b><a href="#" class="link" onclick="confirmDelete(<?php echo $row['c_id']; ?>, '<?php echo $row['c_status']; ?>')" alt="delete">Delete</a></b>
								<?php endif; ?>
							</td>
						</tr>
						<?php endwhile;?>
						<?php
					}//end while loop
				}else{
				?>
					<tr>
						<th colspan="12">There's No data found!!!</th>
					</tr>
					<?php
					}//end else statement
				?>
			</table>

		</div>
	</div> 
</body>

</html> 