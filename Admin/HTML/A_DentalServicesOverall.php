<?php 
function A_Dental(){
include "./A_Functions/db_connection.php";

// get total doctors
$services = $conn->query("SELECT count(id_ser) as total FROM services")->fetch_assoc()['total'];
$echoServices = number_format($services);


$fetchingData = array(
  array(
    'title' => 'Total Services',
    'content' => $echoServices
  )
)

?>
<div class="overviewTitle">
  <h1>Summary Overview of Dental Care</h1>
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
    <button type="button" class="card-button" onclick="window.location.href='A_DentalServicesList.php'" >Dental Care List</button>
    <button type="button" class="card-button" onclick="window.location.href='A_AddDentalServices.php'" >Add New Dental Care</button>
  </div>
</section>
<?php }

?>