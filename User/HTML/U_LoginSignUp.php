<?php include './Functions/U_url.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/U_loginSign.css">
    <title>Login | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
</head>

<body>
<?php include 'U_NavBar.php'; ?>
<div class="body">
<div class="bContainer right-panel-active">

  <!-- Login -->
  <div class="bContainer__form bContainer--signin">
    <form action=<?php echo $login ?> class="form" id="form2" method="post">
      <h2 class="form__title">Login</h2>
      <label for="S_email">Email :</label>
      <input type="email" name="c_email" placeholder="Email" class="input" required/>
      <label for="S_pwd">Password :</label>
      <input type="password" id="password" name="c_password" placeholder="Password" class="input" required/>
      <label class="lbltPW"><input type="checkbox" onclick="togglePW()" class="togglePW">Show Password</label>
      <button type="submit" class="btn" id="logBTN" name="login">Login</button>
      <div class="adLog">
        Admin login <a href="<?php echo $adminLogin ?>">Click here to <strong>login</strong></a>
      </div>
    </form>
  </div>

  <!-- Sign Up -->
  <div class="bContainer__form bContainer--signup">
    <form action="<?php echo $signup ?>" class="form" id="form1" method="post">
      <h2 class="form__title">Sign Up</h2>
      <label for="S_email" class="S_email">Email :
      <input type="email" name="c_email" id="c_email" placeholder="Enter your email" class="input" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,50}$" required/>
      <span class="form__error" id="emailError">format: xxx@xxx.xxx</span>
      </label>
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
      <label for="phone" class="S_phone">Phone Number :
        <input type="tel" name="c_phone" id="phoneInput" placeholder="0123456789" pattern="^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" autocomplete="off" required>	
        <span class="form__error" id="phoneError">Form of 0101234567 or 601112345678</span>
      </label>
      <label for="S_pwd" class="S_pwd">Password :
      <input type="password" id="pwd" name="c_password" placeholder="Enter your password" class="input" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
      <div id="requirement">
        <span>Password must contain the following:</span>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="symbol" class="invalid">A <b>symbol</b></p>
        <p id="length" class="invalid">A minimum of <b>8 characters</b></p>
      </div>
      </label>
      <div class="S_btns">
        <button type="button" class="cancelbtn" id="cancelBtn">Cancel</button>
        <button type="submit" class="signupbtn" name="signup" id="signUpBtn">Sign Up</button>
    </div>
    </form>
  </div>


  <!-- Overlay -->
  <div class="bContainer__overlay">
    <div class="overlay">
      <div class="overlay__panel overlay--left">
        <div class="o_text">already have an account?</div>
        <button class="btn" id="signIn" onclick="changeTitleToLogin()";>Login</button>
      </div>
      <div class="overlay__panel overlay--right">
        <div class="o_text">Looking to register an account?</div>
        <button class="btn" id="signUp" onclick="changeTitleToSignUp()";>Sign Up</button>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'U_Footer.php'; ?>
<script src="../JS/U_signInPw_validator.js"></script>
<script src="../JS/U_signInEmail_validator.js"></script>
<script src="../JS/U_signInDOB_validator.js"></script>
<script src="../JS/U_signInPhone_validator.js"></script>
<script src="../JS/U_LogSignUpTitle.js"></script>
<script src="../JS/U_LogSignUpSwap.js"></script>
<script src="../JS/U_LogSignUpSize.js"></script>
<script src="../JS/U_togglePw.js"></script>
<script src="../JS/U_genderRB.js"></script>

<!-- <script>
// radio text clickable
function enableRadio(radioId) {
  var radio = document.getElementById(radioId);
  radio.checked = true;
}
</script> -->

</body>
</html>



