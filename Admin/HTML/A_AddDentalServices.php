<?php include './A_Functions/db_connection.php';?>
<?php include './A_Functions/url.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Add Dental Care | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
    <link rel="stylesheet" href="../CSS/A_adminList.css">
</head>

<script src="../JS/textarea_maxLength1000.js"></script>

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
		</div>
		<div class="form_wrapper">
		<form name ="form" action="<?php echo $db_addDentalServices?>" method="post" id="addDocForm" enctype="multipart/form-data">
			<div class="apppple">
			<h1 class="h1NA">Add a Dental Treatment</h1>
				<fieldset>
					<legend>
						<h3 class="h3NA">Fill in the Details</h3>
					</legend>
					<div  class="admin-details">
						<div class="deA"><label for="image">Treatments' image:
							<input type="file" name="ser_image" accept=".jpg, .jpeg, .png" required>
							<p>only accept jpg or jpeg or png</p>
						</label></div>
						<div class="deA"><label>Treatment Name: 
							<input type="text" name="ser_name" autocomplete="off" required pattern="^[a-zA-Z'- ]*$">
							<p>only accept alphabet with uppercase or lowercase</p>
						</label></div>
						<div class="deA"><label>Treatment Type: 
						<select name="ser_type" required>
								<option value="" selected>Please Select</option>
								<option value="General" name="General" >General</option>
								<option value="Specialist" name="Specialist" >Specialist</option>
							</select>
						</label></div>
						<div class="deA"><label>Treatment Duration: 
							<select name="ser_duration" required>
								<option value="" selected>Please Select</option>
								<?php
								for ($i = 10; $i <= 60; $i += 10) { ?>
									<option value= <?php echo "$i" ;?> name= <?php echo "$i" ;?> class="TDuration_options" ><?php echo "$i" ;?> minutes</option>
								<?php
								}
								?>
							</select>
						</label></div>
						<div class="deA"><label for="date">Treatment Pricing:
							<div class="rm">RM <input type="text" name="ser_price" autocomplete="off" required pattern="^[0-9.]+$"></div>
							<p>only accept numbers or with decimal point of 2 (example: 900 or 500000.00)</p>						
						</label></div>
						<div class="deA"><?php $remaining = 1000; ?>
						<label>Treatment Description: 
							<textarea onkeyup="countCharacters(this)" rows="4" cols="50" form="addDocForm" name="ser_description" title="Max length is 1000 words" maxlength="1000" placeholder="Enter text here... Max Length is 1000 words." autocomplete="off" required></textarea>
							<p id="charCount">Characters remaining: (<?php echo $remaining; ?> /1000)</p>
						</label></div>
					</div>
				</fieldset>
				<input type="submit" class="button" name="submit" value="Add Now">
			</div>
		</form>
		</div>
	</div>
</div>


</body>

</html> 