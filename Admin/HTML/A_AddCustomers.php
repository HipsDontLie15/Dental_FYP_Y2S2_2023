<?php include './A_Functions/db_connection.php';?>
<?php include './A_Functions/url.php';?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">    
	<title>Add Customers | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
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
    <div class="admin-details">
		<form name ="form" action="<?php echo $A_P_addCustomer ?>" method="post" id="cusInfo">
			<div class="apple">
        <h1 class="h1NA">Add a New Customer</h1>
        <h3 class="h3NA">Fill in the Details</h3>
      </div>
      <div class="form_wrapper">
        <div class="emailBox">
					<label for="S_email" class="S_email">Email :
      <input type="email" name="c_email" id="c_email" placeholder="Enter your email" class="input" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,50}$" required/>
      </label>
      </div>
      <span class="form__error" id="emailError">format: xxx@xxx.xxx</span>
      <div class="fullName">
      <label for="S_name" id="lblName">First Name :
      <input type="text" id="inName" name="c_firstname" placeholder="Enter your first name" class="input" maxlength="40" required/>
      </label>
      <label for="S_name" id="lblName">Last Name :
      <input type="text" id="inName" name="c_lastname" placeholder="Enter your last name" class="input" maxlength="40" required/>
      </label>
      </div>
      </label>
      <div class="radGender_Box">
        <label for="Gender">Gender :</label>
        <div class="radGender" id="radMale" onclick="enableRadio('maleRadio')"><input type="radio" id="maleRadio" name="c_gender" value="Male" required>Male</div>
        <div class="radGender" onclick="enableRadio('femaleRadio')"><input type="radio" id="femaleRadio" name="c_gender" value="Female" required>Female</div>
      </div>
      <label for="date" class="S_dob">Date of Birth :
        <input type="date" id="DOB" name="c_dob" min="1900-01-01" max="2019-12-31" required>
      </label>
      <div class="phoneBox">
      <label for="phone" class="S_phone">Phone Number :
        <input type="tel" name="c_phone" id="phoneInput" placeholder="0123456789" pattern="^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" autocomplete="off" required>	
      </label>
        <span class="form__error" id="phoneError">Form of 0101234567 or 601112345678</span>
      </div>
    <div class="pwdBox">
      <label for="S_pwd" class="S_pwd">Password :
      <input type="password" id="pwd" name="c_password" placeholder="Enter your password" class="input" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
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
          <button type="submit" class="button" name="signup" id="signUpBtn">Sign Up</button>
        </div>
      </div>
		</form>


		
		</div>
	</div>
</div>
<script src="../JS/U_genderRB.js"></script>
<script src="../JS/U_signInPw_validator.js"></script>
<script src="../JS/U_signInEmail_validator.js"></script>
<script src="../JS/U_signInDOB_validator.js"></script>
<script src="../JS/U_signInPhone_validator.js"></script>

</body>

</html> 