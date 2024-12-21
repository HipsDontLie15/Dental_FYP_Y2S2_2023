<?php include './A_Functions/url.php';?>

<!-- <script src="../JS/urls.js"></script> -->
<script src="../JS/SA_searchFunctionDoctor.js"></script>
<script src="../JS/A_confirmDeleteDoctor.js"></script>
<script src="../JS/A_statusUpdateDoctor.js"></script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Doctor List | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
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
				<!-- <input class="sbtn" type="submit" name="search" value="Search"/> -->
			</div>
		</div>
		<div class="boxform">
				<table id="myTable">
				<thead>
					<tr>
						<th colspan="11">Doctor</th>
					</tr>
					<tr>
						<th>ID</th>
						<th>Image</th>
						<th>Name</th>
						<th>Role</th>
						<th>Description</th>
						<th>Date Of Employment</th>
						<th>Station</th>
						<th>Status</th>
						<th>Edit Operator</th>
						<th>Status Operator</th>
						<th>Remove Operator</th>
					</tr>
				</thead>
				<?php include $db_searchDoctor; ?>
				<?php include $db_changeDoctorStatus; ?>
				<?php
				//Fetch Data form database
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){ ?>
						<?php while($row = mysqli_fetch_array($search_result)):
                            ?>
						<tr>
							<td align="center"><?php echo $row['id_doc']; ?></td>
							<td align="center" class="tdImage">
                            	<?php
                                // Fetch the blob image data from the database
                                $imageData = $row["doc_image"];
                                // Determine the image extension based on the MIME type
                                $imageMIMEType = mime_content_type("data://text/plain;base64," . base64_encode($imageData));
                                $imageExtension = '';
                                if ($imageMIMEType === 'image/jpeg') {
                                    $imageExtension = 'jpg';
                                } elseif ($imageMIMEType === 'image/png') {
                                    $imageExtension = 'png';
                                }
                                // Convert the blob image data into base64 encoding
                                $base64Image = base64_encode($imageData);
                                ?>
                                <img src="data:<?php echo $imageMIMEType; ?>;base64,<?php echo $base64Image; ?>" width="50" height="50" style="border-radius: 13px; align: center;">
							</td>
							<td align="center"><?php echo $row['doc_name']; ?></td>
							<td align="center"><?php echo $row['doc_role']; ?></td>
							<td align="center"><details><?php echo $row['doc_description']; ?></details></td>
							<td align="center"><?php echo $row['doc_startWorkDate']; ?></td>
							<td align="center"><?php echo $row['doc_station']; ?></td>
							<td align="center"><?php echo $row['status']; ?></td>
							<td align="center">
								<b><a href="<?php echo $A_editDoctors . '?editID_doc=' . $row['id_doc']; ?>">Edit</a></b>
							</td>
							<td align="center" class="unpadding">
								<select class="selectionpop" onchange="status_update(<?php echo $row['id_doc']; ?>, this.value)">
									<option value="">Update Status</option>
									<option value="active">active</option>
									<option value="deactivate">deactivate</option>
								</select>
							</td>
                            <td align="center">
								<?php if ($row['status'] == 'deactivate'): ?>
                                    <b><a href="#" class="link" onclick="confirmDelete(<?php echo $row['id_doc']; ?>, '<?php echo $row['status']; ?>')" alt="delete">Delete</a></b>
								<?php endif; ?>
							</td>
						</tr>
						<?php endwhile;?>
						<?php
					}//end while loop
				}else{
				?>
					<tr>
						<th colspan="11">There's No data found!!!</th>
					</tr>
					<?php
					}//end else statement
				?>
			</table>

		</div>
	</div> 
</body>

</html> 