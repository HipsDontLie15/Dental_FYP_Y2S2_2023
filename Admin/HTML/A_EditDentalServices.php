<?php include './A_Functions/db_connection.php'; ?>
<?php include './A_Functions/url.php'; ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Dental Care | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
    <link rel="stylesheet" href="../CSS/A_adminList.css">
</head>

<script src="../JS/textarea_maxLength1000.js"></script>

<body>
    <header>
        <?php include './A_Functions/A_NavBar.php';?>
    </header>
    <div class="border-container">
        <div class="backSearch">
			<a class="arrow" href="A_DentalServicesList.php">
				<div class="al">
					<i class="fas">&#xf060;</i> Go back
				</div>
			</a>
		</div>
        <div class="form_wrapper">
        <?php 
                    if (isset($_GET['editID_ser'])) {
                        $editID_ser = $_GET['editID_ser'];

                        // Fetch data from the database for the specified Treatment
                        $sql = "SELECT * FROM services WHERE id_ser = '".$editID_ser."'";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            // Fetch data
                            $row = mysqli_fetch_array($result);
                    ?>
                    
                    <!-- Treatment Image -->
                    <?php
                        // Fetch the blob image data from the database
                        $imageData = $row["ser_image"];
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
        <form name="form" action="<?php echo $db_editDentalService . '?editID_ser=' . $editID_ser; ?>" method="post" id="serInfo" enctype="multipart/form-data">
            <div class="apppple">
                <h1 class="h1NA">Update Treatments' Details</h1>
				<fieldset>
                <legend>
                    <h3 class="h3NA">Fill in the Details</h3>
                </legend>
                    
                <div class="admin-details">
                    <div class="deA">
                        <img src="data:<?php echo $imageMIMEType; ?>;base64,<?php echo $base64Image; ?>" width="50" height="50" style="border-radius: 13px; align: center;">
                        <label for="image">Change image:
                            <input type="file" name="ser_image" accept=".jpg, .jpeg, .png">
                        </label>
                    </div>
                    <!-- Treatment details -->
                    <div class="deA">
                        <div>Treatment ID: <?php echo $editID_ser ?></div>
                    </div>
                    <div class="deA"><label>Treatment Name: 
                            <input type="hidden" name="id_ser" value="<?php echo $editID_ser ?>" readonly>
							<input type="text" name="ser_name" value="<?php echo $row['ser_name']; ?>" autocomplete="off" required pattern="^[a-zA-Z'- ]*$">
							<p>only accept alphabet with uppercase or lowercase</p>
						</label></div>
                        <div class="deA"><label>Treatment Type: 
                            <select name="ser_type" required>
                                <option value="" <?php if ($row['ser_type'] === "") echo 'selected'; ?>>Please Select</option>
                                <option value="General" <?php if ($row['ser_type'] === "General") echo 'selected'; ?>>General</option>
                                <option value="Specialist" <?php if ($row['ser_type'] === "Specialist") echo 'selected'; ?>>Specialist</option>
                            </select>
						</label></div>
						<div class="deA"><label>Treatment Duration: 
							<select name="ser_duration" required>
								<option value="" selected>Please Select </option>
								<?php
								for ($i = 10; $i <= 60; $i += 10) { 
                                    $selected = ($i == $row['ser_duration']) ? 'selected' : ''; ?>
									<option value="<?php echo $i; ?>" <?php echo $selected; ?> class="TDuration_options"><?php echo "$i minutes"; ?></option>
								<?php
								}
								?>
							</select>
						</label></div>
						<div class="deA"><label for="date">Treatment Pricing:
							<div class="rm">RM <input type="text" name="ser_price" value="<?php echo $row['ser_price']; ?>" autocomplete="off" required pattern="^[0-9.]+$"></div>
							<p>only accept numbers or with decimal point of 2 (example: 900 or 500000.00)</p>						
						</label></div>
                        <?php
                            $ser_description = isset($row['ser_description']) ? $row['ser_description'] : '';
                            $maxLength = 1000;
                            $remaining = $maxLength - strlen($ser_description);
                        ?>
                        <div class="deA"><label>Treatment Description: 
							<textarea onkeyup="countCharacters(this)" rows="4" cols="50" form="serInfo" name="ser_description" title="Max length is 1000 words" maxlength="1000" placeholder="Enter text here... Max Length is 1000 words." autocomplete="off" required><?php echo $ser_description; ?></textarea>
							<p id="charCount">Characters remaining: (<?php echo $remaining; ?> /1000)</p>
						</label></div>
					</div>
				</fieldset>
                <input type="submit" value="edit" name="edit" class="button"/>
                </div>
                    <?php
                        } else {
                            echo "Treatment not found or database error.";
                        }
                    } else {
                        echo "No Treatment ID specified.";
                    }
                    ?>
                    </form>
            </div>
        </div>
    </div>
</body>




</html>
