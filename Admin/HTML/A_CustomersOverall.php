<?php 
function A_Customers(){
include "./A_Functions/db_connection.php";

// get total customers
$customers = $conn->query("SELECT count(c_id) as total FROM customers")->fetch_assoc()['total'];
$echoCustomers = number_format($customers);

// get total customers_delete
$customers_delete = $conn->query("SELECT count(c_id) as total FROM customers_delete")->fetch_assoc()['total'];
$echoCustomers_delete = number_format($customers_delete);

// get total paymentmembership
$paidmembership = $conn->query("SELECT count(pm_id) as total FROM paymentmembership")->fetch_assoc()['total'];
$echoPaidmembership= number_format($paidmembership);

// get total customermembership
$customers_member = $conn->query("SELECT count(cm_id) as total FROM customermembership")->fetch_assoc()['total'];
$echoCustomers_member = number_format($customers_member);


$fetchingData = array(
  array(
    'title' => 'Total Active Customers',
    'content' => $echoCustomers
  ),
  array(
    'title' => 'Total Deactivated Customers',
    'content' => $echoCustomers_delete
  ),
  array(
    'title' => 'Total Paid Membership Customers',
    'content' => $echoPaidmembership
  ),
  array(
    'title' => 'Total Active Membership Customers',
    'content' => $echoCustomers_member
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
    <button type="button" class="card-button" onclick="window.location.href='A_CustomersList.php'" >Customers' List</button>
    <button type="button" class="card-button" onclick="window.location.href='A_AddCustomers.php'" >Add New Customers</button>
    <button type="button" class="card-button" onclick="window.location.href='A_CustomersMemberList.php'" >Registered Membership Customers' List</button>
    <button type="button" class="card-button" onclick="window.location.href='A_CustomersMemberPointsList.php'" >Membership Customers' Transaction History List</button>
    <button type="button" class="card-button" onclick="window.location.href='A_AddCustomersMemberPoints.php'" >Add Points to Membership Customers</button>
  </div>
</section>
<?php }

?>