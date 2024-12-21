<?php 
function A_Dentists(){
include "./A_Functions/db_connection.php";

// get total doctors
$doctors = $conn->query("SELECT count(id_doc) as total FROM doctors")->fetch_assoc()['total'];
$echoDoctors = number_format($doctors);

// get total appointment
$doctors_delete = $conn->query("SELECT count(id_doc) as total FROM doctors_delete")->fetch_assoc()['total'];
$echoDoctors_delete= number_format($doctors_delete);

$fetchingData = array(
  array(
    'title' => 'Total Active Doctors',
    'content' => $echoDoctors
  ),
  array(
    'title' => 'Total Deactivated Doctors',
    'content' => $echoDoctors_delete
  )
)

?>
<div class="overviewTitle">
  <h1>Summary Overview of Doctors</h1>
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
    <button type="button" class="card-button" onclick="window.location.href='A_DoctorsList.php'" >Doctor List</button>
    <button type="button" class="card-button" onclick="window.location.href='A_AddDoctors.php'" >Add New Doctor</button>
  </div>
</section>
<?php }

?>