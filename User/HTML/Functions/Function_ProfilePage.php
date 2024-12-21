<script>
	var redirectURL = 'U_Home.php';
</script>

<?php 
function ProfilePage(){
    include './Functions/Function_ConnectSQL.php';
    include "U_url.php";
    // include $Function_UpdateProfilePage;

if (isset($_GET['editID_customer'])) {
    $editID_customer = $_GET['editID_customer'];

    // Fetch data from the database for the specified Customers
    $sql = "SELECT * FROM customers WHERE c_id = '".$editID_customer."' ";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch data
        $row = mysqli_fetch_array($result);

        // Fetch the blob image data from the database
        $imageData = $row["c_image"];
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
<form name="form" action="<?php echo $Function_UpdateProfilePage . '?editID_customer=' . $editID_customer; ?>" method="post" enctype="multipart/form-data">
<section class="uKnow">
<div class="imgbox">
<?php
if (!empty($imageMIMEType) && !empty($base64Image)) {
    echo '<img src="data:' . $imageMIMEType . ';base64,' . $base64Image . '" width="50" height="50" style="border-radius: 13px; text-align: center;">';
}
?>
<label for="image">Change image:
    <input type="file" name="c_image" accept=".jpg, .jpeg, .png">
</label>
</div>
<div class="fullName">
    <label for="S_email" class="S_email">Email : <?php echo $row['c_email']; ?>
        <input type="hidden" name="c_id" value="<?php echo $editID_customer; ?>" readonly>
        <input type="hidden" name="c_email" value="<?php echo $row['c_email']; ?>" readonly>
    </label>
    <label for="S_pwd" class="S_pwd">Password :
        <input type="password" id="pwd" name="c_password" placeholder="Enter your password" class="input" onkeyup='check();' value="<?php echo $row['c_password']; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
        <label class="lbltPW"><input type="checkbox" onclick="togglePW()" class="togglePW">Show Password</label>
        <div id="requirement">
            <span>Password must contain the following:</span>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="symbol" class="invalid">A <b>symbol</b></p>
            <p id="length" class="invalid">A minimum of <b>8 characters</b></p>
        </div>
    </label>
    <label for="S_name" id="lblName">First Name :
        <input type="text" id="inName" name="c_firstname" placeholder="Enter your first name"class="input" maxlength="40" value="<?php echo $row['c_firstname']; ?>" autocomplete="off" required pattern="^[a-zA-Z0-9'.,-`~ ]+$">
    </label>
    <label for="S_name" id="lblName">Last Name :
        <input type="text" id="inName" name="c_lastname" placeholder="Enter your last name" class="input" maxlength="40" value="<?php echo $row['c_lastname']; ?>" autocomplete="off" required pattern="^[a-zA-Z0-9'.,-`~ ]+$">
    </label>
</div>
<div class="radGender_Box">
    <label for="Gender">Gender :</label>
    <div class="radGender" id="radMale" onclick="enableRadio('maleRadio')">
        <input type="radio" id="maleRadio" name="c_gender" value="Male" <?php echo ($row['c_gender'] == 'Male') ? 'checked' : ''; ?>>Male
    </div>
    <div class="radGender" onclick="enableRadio('femaleRadio')">
        <input type="radio" id="femaleRadio" name="c_gender" value="Female" <?php echo ($row['c_gender'] == 'Female') ? 'checked' : ''; ?>>Female
    </div>
</div>
      <label for="date" class="S_dob">Date of Birth :
        <input type="date" id="DOB" name="c_dob" min="1900-01-01" max="2019-12-31" value="<?php echo $row['c_dob']; ?>" required>
      </label>
      <?php 
        // calculate bday using date of birth (take backend)
        $dob = $row['c_dob'];
      # object oriented
        $from = new DateTime($dob);
        $to   = new DateTime('today');
        $bday = $from->diff($to)->y;
      ?>
      
        <p id="ageDisplay">Age: <?php echo $bday?> years old</p>
      </label>
      <label for="phone" class="S_phone">Phone Number :
        <input type="tel" name="c_phone" id="phoneInput" value="<?php echo $row['c_phone']; ?>" placeholder="0123456789" pattern="^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" autocomplete="off" required>	
        <span class="form__error" id="phoneError">Form of 0101234567 or 601112345678</span>
      </label>
      <div class="S_btns">
          <input type="reset" value="Reset">
          <input type="submit" value="Submit" name="edit">
      </div>
</section>
</form>
<script>
        // calculate bday using date of birth (take frontend)
        // Get the input element for date of birth
        const dobInput = document.getElementById('DOB');

        // Get the element to display age
        const ageDisplay = document.getElementById('ageDisplay');

        // Attach an event listener to the date of birth input
        dobInput.addEventListener('change', function() {
            // Get the selected date of birth value
            const dobValue = new Date(this.value);

            // Calculate the current date
            const currentDate = new Date();

            // Calculate the age
            const age = currentDate.getFullYear() - dobValue.getFullYear();

            // Display the age
            ageDisplay.textContent = `Age: ${age} years old`;
        });
    </script>
<?php
        }
    }

}

?>
