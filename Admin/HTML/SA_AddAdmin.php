<?php include './A_Functions/db_connection.php';?>
<?php include './A_Functions/url.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Add Admin | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
	<link rel="stylesheet" href="../CSS/A_adminList.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>


<body>
<?php include './A_Functions/A_NavBar.php';?>

	<div class="border-container">
		<div class="backSearch">
			<a class="arrow" href="javascript:history.back()">
				<div class="al">
					<i class="fas">&#xf060;</i> Go back
				</div>
			</a>
		</div>
		<div class="form_wrapper">
		<form name ="form" action="<?php echo $SA_P_addAdmin?>" method="post">
			<div class="apppple">
			<h1 class="h1NA">Register a New Admin</h1>
				<fieldset>
					<legend>
						<h3 class="h3NA">Fill in the Details</h3>
					</legend>
					<div  class="admin-details">
						<div class="deA"><label>Admin Name: </label>
							<input type="text" name="Admin_name" required autocomplete="off" pattern="^[a-zA-Z'- ]*$" placeholder="insert name">
							<p>only accept alphabet with uppercase or lowercase</p>
						</div>
						<div class="deA"><label>Admin Type: </label>
							<select name="superAdmin" class="sA" required>
								<option value="" selected>Please Select </option>
								<option value="0">Normal Admin</option>
								<option value="1">Super Admin</option>
							</select>
						</div>
						<div class="deA"><label>Admin Username: </label><input type="text" id="usrname" name="Admin_username" placeholder="insert username" title="Username must not be blank and contain only letters, numbers and underscores." pattern="^(?![_])(?=.*\w)[A-Za-z0-9_\d]{3,20}$" autocomplete="off" required><p>Username must contain only letters, numbers and underscores.</p></div>
						<div class="deA">
							<label>Admin Password: </label>
							<input type="password" id="psw" name="Admin_psw" placeholder="insert password" required title="Password must not be blank and contain only letters, numbers and underscores." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autocomplete="off" required>
							<label class="deB"><input type="checkbox" onclick="togglePW()">Show Password</label>
							<!-- <div class="deB">
								<p id="caps">WARNING! Caps lock is ON.</p>
							</div> -->
						</div>
					</div>
					<div id="message">
						<h3>Password must contain the following:</h3>
						<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
						<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
						<p id="number" class="invalid">A <b>number</b></p>
						<p id="symbol" class="invalid">A <b>symbol</b></p>
						<p id="length" class="invalid">A minimum of <b>8 characters</b></p>
					</div>
				</fieldset>
				<input type="submit" class="button" name="submit" value="Add Now">
			</div>
		</form>
		</div>
	</div>
</div>
<script src="../JS/Pw_validator.js"></script>
<script src="../JS/Pw_toggleVisible.js"></script>
<!-- <script src="../JS/toggleCaps.js"></script> -->

</body>

</html> 