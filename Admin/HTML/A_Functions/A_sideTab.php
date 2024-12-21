<?php include 'dashboard_Overview.php' ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FCUC Admin Dashboard</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../CSS/A_sideDB.css">
  <!-- <link rel="icon" href="../../Images/FCUC_Sports_Icon.png" type = "image/FcucSportIcon"> -->
</head>

<script src="../JS/A_tabmenu.js"></script>


<body>
  <div>
    <div class="stab">
      <button class="tablinks" onclick="openCity(event, 'Overview')" id="defaultOpen">Overview</button>
      <button class="tablinks" onclick="openCity(event, 'Staff System')">Staff System</button>
      <button class="tablinks" onclick="openCity(event, 'Appointment System')">Appointment System</button>
      <button class="tablinks" onclick="openCity(event, 'Patients System')">Patients System</button>
      <!-- check whether superadmin or not -->
      <?php 
        $sqli = "SELECT * FROM admins where superAdmin = 1 and admin_username = '".$_SESSION['username']."'";
        $resultsqli = $conn->query($sqli);//execute query connection
        //Fetch Data form database
        if($resultsqli->num_rows > 0){
          while($rowsqli = $resultsqli->fetch_assoc()){
            if ($rowsqli['superAdmin'] == 1): ?>
            <button class="tablinks" onclick="openCity(event, 'System Administrators')">System Administrators</button>
          <?php endif; ?>
        <?php }
        }
      ?>
      
    </div>

    <!-- Overview content -->
    <table id="myTable">
    <thead>
        <tr>
            <th>Total Admins</th>
            <th>Total Doctors</th>
            <th>Total Treatments</th>
            <th>Total Appointments</th>
            <th>Total Users</th>
            <th>Total Blacklisted</th>
        </tr>
    </thead>
        <?php generateOverview(); ?>
    </table>
  </div>   
</body>
</html> 