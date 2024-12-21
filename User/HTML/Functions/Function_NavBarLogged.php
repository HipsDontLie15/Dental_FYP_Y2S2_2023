<?php
  include './Functions/Function_ConnectSQL.php';
  $c_email = $_SESSION['c_email'];

  // Fetch data from the database for the specified doctor
  $sql = "SELECT * FROM customers WHERE c_email = '".$c_email."' ";
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

    }
  
?>

<div class="profile" onclick="myFunction()">
  <button  class="dropbtn" id="userP">
      <img class = "uicon" alt="login icon" src="data:<?php echo $imageMIMEType; ?>;base64,<?php echo $base64Image; ?>" width="50" height="50" style="border-radius: 13px; align: center;">
      <div class="c_name">
        <?php  
          $gender = $row['c_gender'];
          $lastName = $row['c_lastname'];

          if ($gender === 'Male') {
              echo 'Mr. ' . $lastName;
          } else {
              echo 'Mrs. ' . $lastName;
          }
        ?>
      </div>
  </button>
  <div id="myDropdown" class="dropdown-content">
    <a href="U_DashBoard.php" id="db">Dashboard</a>
    <a href="U_ProfilePage.php?editID_customer=<?php echo $row['c_id']; ?>" >Edit Profile</a>
    <a href="./Functions/Function_LogOut.php">Log Out</a>
  </div>
</div>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>