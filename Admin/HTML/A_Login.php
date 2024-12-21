<?php include './A_Functions/url.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Login | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
  <link rel="stylesheet" href="../CSS/A_login.css">
  <link rel="icon" href="../../SharedImages/QualiteethRework_logo.png" type = "image/QT">
</head>

<body>
<div class="border-container">
  <div class="form_wrapper">
    <form name="form" action=<?php echo $A_P_login ?> method="post"  enctype="multipart/form-data">
      <div class="form_right">
        <div class="form_right-inner">
          <img class = "logo" src="../../SharedImages/QualiteethRework_Transparent.png" alt="QT logo">
          <h1>Admin Login</h1>
        </div>
        <div class="applepie">
          <label for="adminUsername">Username: 
            <input  placeholder="Your Username"  type="text"  name="admin_username"  id="field_username"  class="input_field" autocomplete="off" required/>
          </label>
          <label for="adminPw">Password: 
            <input placeholder="Password"  type="password"  name="admin_password"  id="field_password"  class="input_field"  required/>
          </label>
        </div>
      <div class="busy">
        <input  type="submit"  value="Login"  id="input_submit"  class="btnSubmit"  name="login"  />
        <div class="message"><?php $error=''; if($error!="") { echo $error; } ?></div>
        <span class="create_account">
          Not from here? <a href="../../User/HTML/U_Home.php">Click <strong>Here</strong> to return.</a>
        </span>

      </div>
      </div>
    </form>
  </div>
</div>
  <!-- Site footer 
  <?php
  //include '../../AWD_Assignment_2023JAN/HTML_PHP/Footer.php';
  ?>
  -->
</body>

</html>