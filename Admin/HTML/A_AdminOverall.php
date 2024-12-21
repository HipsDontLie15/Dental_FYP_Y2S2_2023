<?php 
function A_Admins(){
include "./A_Functions/db_connection.php";

// get total admins
$admins = $conn->query("SELECT count(admin_id) as total FROM admins")->fetch_assoc()['total'];
$echoAdmins = number_format($admins);

// get total admins
$admins_normal = $conn->query("SELECT count(superAdmin) as total FROM admins WHERE superAdmin = 0")->fetch_assoc()['total'];
$echoAdNormal = number_format($admins_normal);

// get total superAdmins
$admins_super = $conn->query("SELECT count(superAdmin) as total FROM admins WHERE superAdmin = 1")->fetch_assoc()['total'];
$echoAdSuper = number_format($admins_super);

// get total admins_delete
$admins_del = $conn->query("SELECT count(admin_id) as total FROM admins_delete")->fetch_assoc()['total'];
$echoAdDel= number_format($admins_del);

// get total admins_delete
$admins_normalDel = $conn->query("SELECT count(superAdmin) as total FROM admins_delete WHERE superAdmin = 0")->fetch_assoc()['total'];
$echoAdNormalDel = number_format($admins_normalDel);

// get total superAdmins_delete
$admins_superDel = $conn->query("SELECT count(superAdmin) as total FROM admins_delete WHERE superAdmin = 1")->fetch_assoc()['total'];
$echoAdSuperDel = number_format($admins_superDel);


$fetchingData = array(
  array(
    'imglink' => '../Images/Icons/admin_1.png',
    'title' => 'Total Active Admins',
    'content' => $echoAdmins
  ),
  array(
    'imglink' => '../Images/Icons/dentist_1.png',
    'title' => 'Active Normal Admins',
    'content' => $echoAdNormal
  ),
  array(
    'imglink' => '../Images/Icons/appointment_1.png',
    'title' => 'Active Super Admins',
    'content' => $echoAdSuper
  ),
  array(
    'imglink' => '../Images/Icons/patient_1.png',
    'title' => 'Total Deactivated Admins',
    'content' => $echoAdDel
  ),
  array(
    'imglink' => '../Images/Icons/patient_1.png',
    'title' => 'Deactivated Normal Admins',
    'content' => $echoAdNormalDel
  ),
  array(
    'imglink' => '../Images/Icons/patient_1.png',
    'title' => 'Deactivated Super Admins',
    'content' => $echoAdSuperDel
  )
)

?>
<div class="overviewTitle">
  <h1>Summary Overview of Administrators</h1>
  <p>Display of Minimal Information Only</p>
</div>
<section class="Overview" id="ov">
    <div class="pikaboo" id="poxpox">
        <div class="boxbox" id="box_0">
            <h3 class="title"><?php echo $fetchingData[0]['title']; ?></h3>
            <h2 class="text"><?php echo $fetchingData[0]['content']; ?></h2>
        </div>
        <div class="boxbox" id="box_0">
            <h3 class="title"><?php echo $fetchingData[3]['title']; ?></h3>
            <h2 class="text"><?php echo $fetchingData[3]['content']; ?></h2>
        </div>
    </div>
    <div class="product-btn">
        <button type="button" class="card-button" onclick="window.location.href='SA_AdminList.php'" >Admins' List</button>
        <button type="button" class="card-button" onclick="window.location.href='SA_AddAdmin.php'" >Add New Admin</button>
    </div>
</section>
<?php }

?>