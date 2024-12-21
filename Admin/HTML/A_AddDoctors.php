<?php include './A_Functions/db_connection.php';?>
<?php include './A_Functions/url.php';?>
<?php
$locationArray = array(
	1 => 'Cheras',
	2 => 'Desa Aman Puri',
	3 => 'Kepong',
	4 => 'Kepong Baru',
	5 => 'Petaling Jaya',
	6 => 'Rawang',
	7 => 'Sungai Buloh'
);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">    
	<title>Add Doctor | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
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
		<form name ="form" action="<?php echo $A_P_addDoctor?>" method="post" id="addDocForm" enctype="multipart/form-data">
			<div class="apppple">
			<h1 class="h1NA">Add a New Doctor</h1>
				<fieldset>
					<legend>
						<h3 class="h3NA">Fill in the Details</h3>
					</legend>
					<div  class="admin-details">
						<div class="deA"><label for="image">Doctors' image:
							<input type="file" name="doc_image" accept=".jpg, .jpeg, .png" required>
							<p>only accept jpg or jpeg or png</p>
						</label></div>
						<div class="deA"><label>Doctor Name: 
							<input type="text" name="doc_name" autocomplete="off" required pattern="^[a-zA-Z'- ]*$">
							<p>only accept alphabet with uppercase or lowercase</p>
						</label></div>
						<div class="deA"><label>Doctor Role: 
							<select name="doc_role" required>
								<option value="" selected>Please Select </option>
								<option value="General">General</option>
								<option value="Specialist">Specialist</option>
							</select>
						</label></div>
						<div class="deA"><label>Station:
                            <select name="doc_station" required>
                                <option value="">Select a clinic location</option>
								<?php foreach ($locationArray as $key => $location) { ?>
									<option value="<?php echo $location; ?>"><?php echo $location; ?></option>
								<?php } ?>
                            </select>
                        </label></div>
						<div class="deA"><label for="date">Commencement date of employment:
							<input type="date" name="doc_startWorkDate" min="2017-01-01" required>
							<p>only from 2017-01-01 to currrent date</p>
						</label></div>
						<div class="deA"><?php $remaining = 1000; ?>
						<label>Doctor Description: 
							<textarea onkeyup="countCharacters(this)" rows="4" cols="50" form="addDocForm" name="doc_description" title="Max length is 1000 words" maxlength="1000" placeholder="Enter text here... Max Length is 1000 words." autocomplete="off" required></textarea>
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