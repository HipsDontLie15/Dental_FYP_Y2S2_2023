<?php include './A_Functions/db_connection.php'; ?>
<?php include './A_Functions/url.php'; ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
    <title>Edit Doctor | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
    <link rel="stylesheet" href="../CSS/A_adminList.css">
</head>

<script src="../JS/textarea_maxLength1000.js"></script>

<body>
    <header>
        <?php include './A_Functions/A_NavBar.php';?>
    </header>
    <div class="border-container">
        <div class="backSearch">
			<a class="arrow" href="A_DoctorsList.php">
				<div class="al">
					<i class="fas">&#xf060;</i> Go back
				</div>
			</a>
		</div>
            
                <div class="admin-details">
                    <?php 
                    if (isset($_GET['editID_doc'])) {
                        $editID_doc = $_GET['editID_doc'];

                        // Fetch data from the database for the specified doctor
                        $sql = "SELECT * FROM doctors WHERE id_doc = '".$editID_doc."'";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            // Fetch data
                            $row = mysqli_fetch_array($result);
                    ?>
                    
                    <!-- Doctor Image -->
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
                    <form name="form" action="<?php echo $db_editDoctor . '?editID_doc=' . $editID_doc; ?>" method="post" id="docInfo" enctype="multipart/form-data">
                    
                    <div class="apple">
                        <h1 class="h1NA">Update Doctors' Details</h1>
                        <legend>
                            <h3 class="h3NA">Fill in the Details</h3>
                        </legend>
                    </div>
        <div class="form_wrapper">
                        <div class="cimgbox">
                        <img src="data:<?php echo $imageMIMEType; ?>;base64,<?php echo $base64Image; ?>" width="50" height="50" style="border-radius: 13px; align: center;">
                        <label for="image" class="cimage">Change image:
                            <input type="file" name="doc_image" accept=".jpg, .jpeg, .png">
                        </label>
                        </div>
                    <!-- Doctor details -->
                    <div class="idNameDate">
                        <div>Doctor ID: <input type="text" name="doc_id" value="<?php echo $editID_doc ?>" readonly></div>
                        <label>Doctor Name:
                        <input type="text" name="doc_name" value="<?php echo $row['doc_name']; ?>" autocomplete="off" required pattern="^[a-zA-Z0-9'.,-`~ ]+$">
                    </label>
                    <label for="date" class="lblDate">Date of employment:
                        <input type="date" name="doc_startWorkDate" min="2017-01-01" value="<?php echo $row['doc_startWorkDate']; ?>" required>
                    </label>
                    </div>
                    <div class="textboxes">
                        <label>Doctor Role:
                            <select name="doc_role" required>
                                <option value="" selected>Please Select</option>
                                <option value="General" <?php if ($row['doc_role'] === 'General') echo 'selected'; ?>>General</option>
                                <option value="Specialist" <?php if ($row['doc_role'] === 'Specialist') echo 'selected'; ?>>Specialist</option>
                            </select>
                        </label>
                        <label>Station:
                            <select name="doc_station" required>
                                <option value="">Select a clinic location</option>
                                <option value="Cheras" <?php if ($row['doc_station'] === 'Cheras') echo 'selected'; ?>>Cheras</option>
                                <option value="Desa Aman Puri" <?php if ($row['doc_station'] === 'Desa Aman Puri') echo 'selected'; ?>>Desa Aman Puri</option>
                                <option value="Kepong" <?php if ($row['doc_station'] === 'Kepong') echo 'selected'; ?>>Kepong</option>
                                <option value="Kepong Baru" <?php if ($row['doc_station'] === 'Kepong Baru') echo 'selected'; ?>>Kepong Baru</option>
                                <option value="Petaling Jaya" <?php if ($row['doc_station'] === 'Petaling Jaya') echo 'selected'; ?>>Petaling Jaya</option>
                                <option value="Rawang" <?php if ($row['doc_station'] === 'Rawang') echo 'selected'; ?>>Rawang</option>
                                <option value="Sungai Buloh" <?php if ($row['doc_station'] === 'Sungai Buloh') echo 'selected'; ?>>Sungai Buloh</option>
                            </select>
                        </label>
                        <?php
                            $doc_description = isset($row['doc_description']) ? $row['doc_description'] : '';
                            $maxLength = 1000;
                            $remaining = $maxLength - strlen($doc_description);
                        ?>
                        <label class="des">Doctor Description:
                            <textarea onkeyup="countCharacters(this)" rows="4" cols="50" form="docInfo" name="doc_description" title="Max length is 1000 words" maxlength="1000" placeholder="Enter text here... Max Length is 1000 words." autocomplete="off" required><?php echo $doc_description; ?></textarea>
                            <p id="charCount">Characters remaining: (<?php echo $remaining; ?> /1000)</p>
                        </label>
                        </div>
        </div>
                        <input type="submit" value="edit" name="edit" class="button"/>
                    </form>
                    <?php
                        } else {
                            echo "Doctor not found or database error.";
                        }
                    } else {
                        echo "No doctor ID specified.";
                    }
                    ?>
                </div>
    </div>
</body>



</html>
