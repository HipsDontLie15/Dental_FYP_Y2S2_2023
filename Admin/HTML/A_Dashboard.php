<?php
include 'A_Overview.php';
include 'A_DentistsOverall.php';
include 'A_DentalServicesOverall.php';
include 'A_AppointmentsOverall.php';
include 'A_CustomersOverall.php';
include 'A_AdminOverall.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../CSS/A_dashboard.css">
  <title>Overall Dashboard | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title>
</head>

<script src="../JS/A_tabmenu.js"></script>


<body>
  <header>
    <?php include './A_Functions/A_NavBar.php';?>
  </header>  

  <div class="wholeContent">
    <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'Overview')" id="defaultOpen">Overview</button>
      <button class="tablinks" onclick="openCity(event, 'Dentists System')">Doctors</button>
      <button class="tablinks" onclick="openCity(event, 'Dental Care')">Dental Care</button>
      <button class="tablinks" onclick="openCity(event, 'Appointment System')">Appointment</button>
      <button class="tablinks" onclick="openCity(event, 'Customers System')">Customers</button>
      <!-- check whether superadmin or not -->
      <?php
      if ($_SESSION['superAdmin'] == 1){ ?>
      <button class="tablinks" onclick="openCity(event, 'System Administrators')">Administrators</button>
      <?php }
      ?>      
    </div>
    
    <!-- Tab content -->
    <div id="Overview" class="tabcontent">
      <?php A_Overview(); ?>
    </div>

    <div id="Dentists System" class="tabcontent">
    <?php A_Dentists(); ?>
    </div>

    <div id="Dental Care" class="tabcontent">    
    <?php A_Dental(); ?>
    </div>

    <div id="Appointment System" class="tabcontent">
    <?php A_Appointment(); ?>
    </div>

    <div id="Customers System" class="tabcontent">
    <?php A_Customers(); ?>
    </div>
    
    <div id="System Administrators" class="tabcontent">
      <?php A_Admins(); ?>
    </div>
  </div>   
</body>
</html> 