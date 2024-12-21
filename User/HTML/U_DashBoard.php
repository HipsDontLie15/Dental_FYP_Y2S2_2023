<?php 
    include "./Functions/U_url.php";
    include $notLoggedIn;
?>

<?php
  include './Functions/Function_ConnectSQL.php';
  $c_email = $_SESSION['c_email'];

  // Fetch data from the database for the specified doctor
  $sql = "SELECT * FROM customers WHERE c_email = '".$c_email."' ";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
      // Fetch data
      $row = mysqli_fetch_array($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User DashBoard | Qualiteeth Dental Clinic | Klinik Pergigian Qualiteeth</title>
    <link rel="stylesheet" href="../CSS/U_dashBoard.css">
</head>
<body>
<?php
    include "U_NavBar.php";
?>
<div class = "overall-box">
    <section>
        <div class ="text1">
            <h1 class="head1">Welcome back,
                <?php  
                $gender = $_SESSION['c_gender'];
                $firstName = $_SESSION['c_firstname'];
                $lastName = $_SESSION['c_lastname'];

                if ($gender === 'Male') {
                    echo 'Mr. ' . $lastName . ' ' . $firstName;
                } else {
                    echo 'Mrs. ' . $lastName . ' ' . $firstName;
                }
                ?>
            </h1>
            <p>The dashboard consists of your appointment details, dental records, and Qualiteeth Dental Clinic loyalty points - QDC SmilePoints. 
                <br> Please select any of the labelled tabs at your preference to your details.</p>
    </section>
<section class="wholeTab">
<section class="tab">
    <button class="tablinks" onclick="openCity(event, 'appointment')" id="defaultOpen">Appointment Details</button>
    <button class="tablinks" onclick="openCity(event, 'dental')">Dental Records</button>
    <?php 
$activeQuery = "SELECT * FROM customermembership WHERE c_email = '".$_SESSION['c_email']."' AND status = 'active' ORDER BY created_at DESC LIMIT 1; ";
$resultMem = mysqli_query($conn, $activeQuery);

if ($resultMem && mysqli_num_rows($resultMem) > 0) {
    // Customer with active status found
    $row = mysqli_fetch_assoc($resultMem);
    $status = $row['status'];
    $c_email = $row['c_email'];
    
    if ($c_email == $_SESSION['c_email']) {
        // Display the QDC SmilePoints button
        echo '<button class="tablinks" onclick="openCity(event, \'points\')">QDC SmilePoints</button>';
    }
}
?>

</section>

<section>
<div id="appointment" class="tabcontent">
    <div class="titlePart">
        <h2>User Appointment Details</h2>
        <p>Qualiteeth Dental Clinic empowers users to manage appointments effortlessly with an integrated system for editing and viewing appointment history. This user-centered approach grants patients control over their dental care journey.</p>
    </div>
    <ul>
        <!-- <li class="head2">
            <div class="head2-inner">
            <h3 class="text3">Edit Arranged Appointments : </h3>
            <p>Easily modify appointments with our user-friendly feature. Update your visits at Qualiteeth Dental Clinic for a tailored dental care experience.</p>
            </div>
            <div class="userbutton">
                <a href="#"><button type="button" class="button_modify">Modify Now</button></a>
            </div>
        </li> -->
        <li class="head2">
            <div class="head2-inner">
            <h3 class="text3">Appointment History : </h3>
            <p>Access your complete appointment history at Qualiteeth Dental Clinic. Stay informed about your past visits and maintain a comprehensive record of your dental care journey.</p>
            </div>
            <div class="userbutton">
                <a href="U_AppointmentHistory.php"><button type="button" class="button_history">View History</button></a>
            </div>
        </li>
        <!-- <li class="head2">
            <div class="head2-inner">
                <h4 class="head3">Delete Appointment(s) : </h4>
                <p class="text5">No longer need of booking? No worries.</p>
            </div>
            <div class="userbutton">
                <a href="#"><button type="button" class="button_delete_booking">Delete Appointment</button></a>
            </div>
        </li> -->
    </ul> 
</div>

<div id="dental" class="tabcontent">
    <div class="titlePart">
        <h2>Dental Records Details</h2>
        <p>Qualiteeth Dental Clinic empowers users to manage appointments effortlessly with an integrated system for editing and viewing appointment history. This user-centered approach grants patients control over their dental care journey.</p>
    </div>
    <ul>
        <li class="head2">
            <div class="head2-inner">
                <h3 class="text3">Dental Records History : </h3>
                <p>Access your complete appointment history at Qualiteeth Dental Clinic. Stay informed about your past visits and maintain a comprehensive record of your dental care journey.</p>
            </div>
            <div class="userbutton">
                <a href="#"><button type="button" class="button_history">View Records</button></a>
            </div>
        </li>
    </ul> 
</div>

<div id="points" class="tabcontent">
    <div class="titlePart">
        <h2>QDC SmilePoints Details</h2>
        <p>Accumulate rewards with each visit and redeem them on various dental services. Your healthy smile now comes with added benefits.</p>
    </div>
    <ul>
        <li class="head2">
            <div class="head2-inner">
                <h3 class="text3">Your QDC Loyalty Program Plan : </h3>
                <p>Discover your QDC SmilePoints Membership Plan to access dental care rewards, track your points, and enjoy exclusive benefits. Start your journey to a brighter smile today.</p>
            </div>
            <div class="userbutton">
                <a href="U_QDCmembershipPlan.php"><button type="button" class="button_modify">View Plan</button></a>
            </div>
        </li>
        <li class="head2" id="diffhead2">
            <div class="head2-inner" id="maxhead2">
                <h3 class="text3">Your QDC SmilePoints : </h3>
                <p>Discover your QDC SmilePoints Membership Plan to access dental care rewards, track your points, and enjoy exclusive benefits. Start your journey to a brighter smile today.</p>
            </div>
            <div class="head2-inner2">
                <div class="userbutton">
                    <h5>QDC SmilePoints Balance</h5>
                    <a href="U_QDCSmilePointsBalance.php"><button type="button" class="button_history">View Balance</button></a>
                </div>
                <div class="userbutton">
                    <h5>QDC SmilePoints Transaction History</h5>
                    <a href="U_QDCSmilePointsHistory.php"><button type="button" class="button_history">View History</button></a>
                </div>
            </div>
        </li>
        <li class="head2">
            <div class="head2-inner">
                <h3 class="text3">Cancel QDC Loyalty Program Plan : </h3>
                <p>Easily cancel your QDC Loyalty Program Plan whenever you need. Hassle-free cancellation process with no hidden fees. Your dental care journey, your way.</p>
            </div>
            <h4 class="head3"></h4>
            <!-- <div class="text5">Are you dissatisfied with our membership?</div> -->
            <div class="userbutton">
                <a href="#"><button type="button" class="button_delete_booking">Quit Now</button></a>
            </div>
        </li>
    </ul>
</div>
</section>
</section>
            
</div>
<?php
    include 'U_Footer.php';
?>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>


