<?php 
function A_Appointment(){
include "./A_Functions/db_connection.php";

// get total appointment_info
$appointment = $conn->query("SELECT count(app_id) as total FROM appointment_info")->fetch_assoc()['total'];
$echoAppointment = number_format($appointment);

// get total appointment
$appointment_delete = $conn->query("SELECT count(app_id) as total FROM appointment_delete")->fetch_assoc()['total'];
$echoAppointment_delete = number_format($appointment_delete);

$fetchingData = array(
  array(
    'title' => 'Total Active Appointments',
    'content' => $echoAppointment
  ),
  array(
    'title' => 'Total Deactivated Appointments',
    'content' => $echoAppointment_delete
  )
)

?>
<div class="overviewTitle">
  <h1>Summary Overview of Appointments</h1>
  <p>Display of Minimal Information Only</p>
</div>
<section class="Overview" id="ov">
  <div class="pikaboo" id="poxpox">
      <?php foreach ($fetchingData as $FD): ?>
      <div class="boxbox" id="box_0">
          <h3 class="title"><?php echo $FD['title']; ?></h3>
          <h1 class="text"><?php echo $FD['content']; ?></h1>
      </div>
      <?php endforeach; ?>
  </div>
  <div class="product-btn">
    <button type="button" class="card-button" onclick="window.location.href='A_AppointmentList.php'" >Appointment List</button>
  </div>
</section>
<?php }

?>