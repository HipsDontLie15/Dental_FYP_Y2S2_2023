<?php 
function A_Overview(){
include "./A_Functions/db_connection.php";

// get total admins
$admins = $conn->query("SELECT count(admin_id) as total FROM admins")->fetch_assoc()['total'];
$echoAdmins = number_format($admins);

// get total doctors
$doctors = $conn->query("SELECT count(id_doc) as total FROM doctors")->fetch_assoc()['total'];
$echoDoctors = number_format($doctors);

// get total care
$care = $conn->query("SELECT count(id_ser) as total FROM services")->fetch_assoc()['total'];
$echoCare = number_format($care);

// get total appointment
$appointment = $conn->query("SELECT count(app_id) as total FROM appointment_info")->fetch_assoc()['total'];
$echoAppointment= number_format($appointment);

// get total customers
$customers = $conn->query("SELECT count(c_id) as total FROM customers")->fetch_assoc()['total'];
$echoCustomers = number_format($customers);

// get total loyalty program customers
$LPcustomers = $conn->query("SELECT count(cm_id) as total FROM customermembership")->fetch_assoc()['total'];
$echoLPcustomers = number_format($LPcustomers);

$fetchingData = array(
  array(
    'imglink' => '../Images/Icons/admin_1.png',
    'title' => 'Admins',
    'content' => $echoAdmins
  ),
  array(
    'imglink' => '../Images/Icons/dentist_1.png',
    'title' => 'Doctors',
    'content' => $echoDoctors
  ),
  array(
    'imglink' => '../Images/Icons/care_1.png',
    'title' => 'Dental Care',
    'content' => $echoCare
  ),
  array(
    'imglink' => '../../SharedImages/appointment_1.png',
    'title' => 'Appointment',
    'content' => $echoAppointment
  ),
  array(
    'imglink' => '../Images/Icons/patient_1.png',
    'title' => 'Customers',
    'content' => $echoCustomers
  ),
  array(
    'imglink' => '../../SharedImages/patient_3.png',
    'title' => 'Loyalty Program<br> Customers',
    'content' => $echoLPcustomers
  )
)

?>
<div class="overviewTitle">
  <h1>Summary Overview of System</h1>
  <p>Display of Minimal Information Only</p>
</div>
<section class="Overview">
  <?php foreach ($fetchingData as $FD): ?>

  <div class="pikaboo">
    <div class="boxbox">
        <img src="<?php echo $FD['imglink']; ?>" alt="<?php echo $FD['title']; ?>">
        <h3 class="title"><?php echo $FD['title']; ?></h3>
        <h1 class="text">
        <?php echo $FD['content']; ?>
        </h1>
    </div>
  </div>
  <?php endforeach; ?>
</section>
<?php }

?>
