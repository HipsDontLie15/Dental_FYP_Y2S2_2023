<?php include './A_Functions/url.php';?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin List | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
	<link rel="stylesheet" href="../CSS/A_adminList.css">
</head>

<script src="../JS/SA_searchFunctionAdmin.js"></script>
<script src="../JS/SA_confirmDeleteAdmin.js"></script>
<script src="../JS/SA_statusUpdateAdmin.js"></script>
<body>
<?php include './A_Functions/A_NavBar.php';?>
	
	<section class="border-container">
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
						<th colspan="8">Admin</th>
					</tr>
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Password</th>				
						<th>Name</th>
						<th>Type</th>
						<th>Status</th>
						<th>Update Operation</th>
						<th>Remove Operation</th>
					</tr>
				</thead>
				<?php include $F_searchAdmin; ?>
				<?php include $F_changeAdminStatus; ?>
				<?php
				//Fetch Data form database
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){ ?>
						<?php while($row = mysqli_fetch_array($search_result)):?>
						<tr>
							<td align="center"><?php echo $row['admin_id']; ?></td>
							<!-- <td align="center"><img src="admin_image/<?php echo $row["admin_image"]; ?>" width ="50" height="50" style="border-radius:13px;align:centre;" title="<?php echo $row['admin_image']; ?>"> </td> -->
							<td align="center"><?php echo $row['admin_username']; ?></td>
							<td align="center"><?php echo $row['admin_password']; ?></td>
							<td align="center"><?php echo $row['admin_name']; ?></td>
							<td align="center"><?php echo $row['superAdmin']; ?></td>
							<td align="center"><?php echo $row['status']; ?></td>
							<!-- <td align="center"><?php echo $row['created_at']; ?></td> -->
							
							<td align="center" class="unpadding">
								<select class="selectionpop" onchange="status_update(<?php echo $row['admin_id']; ?>, this.value)">
									<option value="">Update Status</option>
									<option value="active">active</option>
									<option value="deactivate">deactivate</option>
								</select>
							</td>
							<td align="center">
								<?php if (($row['superAdmin'] == 0)  && ($row['status'] == 'deactivate')): ?>
									<b><a href="#" class="link" onclick="confirmDelete(<?php echo $row['admin_id']; ?>, '<?php echo $row['status']; ?>')" alt="delete">Delete</a></b>
								<?php endif; ?>
							</td>

						</tr>
						<?php endwhile;?>
						<?php
					}//end while loop
				}else{
				?>
					<tr>
						<th colspan="8">There's No data found!!!</th>
					</tr>
					<?php
					}//end else statement
				?>
				
			</table>
		</div>
	</section> 
</body>

</html> 