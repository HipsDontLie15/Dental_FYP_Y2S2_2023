<?php
include 'Function_ConnectSQL.php';
$redirectURL = '../U_AppointmentSuccess.php';

$_SESSION['successType'] = 'membership';

if(isset($_POST['submitPayment'])){

    //Customer payment
    $c_id = $_POST['c_id'];
    $c_email = $_POST['c_email'];
    $c_typeMember = $_POST['c_typeMember'];
    $c_payment = $_POST['c_payment'];
    $c_cardname = $_POST['c_cardname'];
    $c_cardnum = $_POST['c_cardnum'];
    $c_cardexpire = $_POST['c_cardexpire'];
    $c_cardcode = $_POST['c_cardcode'];
    $timestamp = date('Y-m-d H:i:s');

    //Customer membership
    $c_hygiene = 2;
    $c_examination = 2;
    $c_points = 0;
    $status = 'active';

    //test before SQL insert
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $insert_query = "INSERT INTO `paymentmembership`(`c_id`, `c_email`, `c_typeMember`, `c_payment`, `c_cardname`, `c_cardnum`, `c_cardexpire`, `c_cardcode`, `created_at`) 
         VALUES ('$c_id','$c_email','$c_typeMember','$c_payment','$c_cardname','$c_cardnum','$c_cardexpire','$c_cardcode','$timestamp')";
    
    $cmember_query = "INSERT INTO `customermembership`(`c_id`, `c_email`, `c_hygiene`, `c_examination`, `c_points`, `status`, `created_at`) 
    VALUES ('$c_id','$c_email','$c_hygiene','$c_examination','$c_points','$status','$timestamp')";

    //test SQL insert
    // echo "Query: $insert_query<br>";

    // Perform the insert query
    $insert_result = mysqli_query($conn, $insert_query);
    $cmember_result = mysqli_query($conn, $cmember_query);

    if ($insert_result && $cmember_result) {
        header("location: ".$redirectURL);
        exit;
    } else {
        // echo "Error updating Customers's details: " . mysqli_error($conn);
        header("location: ".$redirectURL);
        exit;
    }

    mysqli_close($conn);


}   // end of isset($_POST['submitPayment'])

?>