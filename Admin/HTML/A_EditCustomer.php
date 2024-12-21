<?php include './A_Functions/db_connection.php'; ?>
<?php include './A_Functions/url.php'; ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
    <title>Edit Customer | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
    <link rel="stylesheet" href="../CSS/A_adminList.css">
</head>

<script src="../JS/textarea_maxLength1000.js"></script>

<body>
    <header>
        <?php include './A_Functions/A_NavBar.php';?>
    </header>
    <div class="border-container">
        <div class="backSearch">
			<a class="arrow" href="A_CustomersList.php">
				<div class="al">
					<i class="fas">&#xf060;</i> Go back
				</div>
			</a>
		</div>
            <div class="admin-details">
                    <?php 
                    if (isset($_GET['editID_cus'])) {
                        $editID_cus = $_GET['editID_cus'];

                        // Fetch data from the database for the specified doctor
                        $sql = "SELECT * FROM customers WHERE c_id = '".$editID_cus."'";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            // Fetch data
                            $row = mysqli_fetch_array($result);
                    ?>
                    <form name="form" action="<?php echo $db_editCustomer . '?editID_cus=' . $editID_cus; ?>" method="post" id="cusInfo" enctype="multipart/form-data">
                    
                    <div class="apple">
                        <h1 class="h1NA">Update Customers' Details</h1>
                        <h3 class="h3NA">Fill in the Details</h3>
                    </div>
        <div class="form_wrapper">
                    <!-- Customer details -->
                    <label for="S_email" class="S_email">Email :
      <input type="email" name="c_email" class="boldEmail" value="<?php echo $row["c_email"] ?>" readonly/>
      <input type="hidden" name="c_id" id="c_id" value="<?php echo $editID_cus ?>" readonly/>
      </label>
      <div class="fullName">
      <label for="S_name" id="lblName">First Name :
      <input type="text" id="inName" name="c_firstname" value="<?php echo $row["c_firstname"] ?>" placeholder="Enter your first name" class="input" maxlength="40" required/>
      </label>
      <label for="S_name" id="lblName">Last Name :
      <input type="text" id="inName" name="c_lastname" value="<?php echo $row["c_lastname"] ?>" placeholder="Enter your last name" class="input" maxlength="40" required/>
      </label>
      </div>
      </label>
      <div class="radGender_Box">
        <label for="Gender">Gender :</label>
        <div class="radGender" id="radMale" onclick="enableRadio('maleRadio')"><input type="radio" id="maleRadio" name="c_gender" value="Male" <?php if ($row["c_gender"] === "Male") echo "checked"; ?> required>Male</div>
        <div class="radGender" onclick="enableRadio('femaleRadio')"><input type="radio" id="femaleRadio" name="c_gender" value="Female" <?php if ($row["c_gender"] === "Female") echo "checked"; ?> required>Female</div>
      </div>
      <label for="date" class="S_dob">Date of Birth :
        <input type="date" id="DOB" name="c_dob" min="1900-01-01" max="2019-12-31" value="<?php echo $row["c_dob"] ?>" required>
      </label>
      <div class="phoneBox">
        <label for="phone" class="S_phone">Phone Number :
            <input type="tel" name="c_phone" id="phoneInput" value="<?php echo $row["c_phone"] ?>" placeholder="0123456789" pattern="^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" autocomplete="off" required>	
            </label>
        <span class="form__error" id="phoneError">Form of 0101234567 or 601112345678</span>
        </div>
    <div class="pwdBox">
      <label for="S_pwd" class="S_pwd">Password :
      <input type="password" id="pwd" name="c_password" value="<?php echo $row["c_password"] ?>" placeholder="Enter your password" class="input" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
        </label>
        <div id="requirement">
        <span>Password must contain the following:</span>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="symbol" class="invalid">A <b>symbol</b></p>
        <p id="length" class="invalid">A minimum of <b>8 characters</b></p>
        </div>
    </div>
      <div class="S_btns">
        <button type="submit" name="Edit" class="button">Edit</button>
    </div>
				
                    </form>
                    <?php
                        } else {
                            echo "Customer not found or database error.";
                        }
                    } else {
                        echo "No Customer ID specified.";
                    }
                    ?>
                </div>
    </div>
</body>
<script src="../JS/U_genderRB.js"></script>
<script src="../JS/U_signInPw_validator.js"></script>
<script src="../JS/U_signInDOB_validator.js"></script>
<script src="../JS/U_signInPhone_validator.js"></script>



</html>
