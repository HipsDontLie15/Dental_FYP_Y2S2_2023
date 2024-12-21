<?php
    $conn = mysqli_connect("localhost","root","","fyp_dental");

    if($conn === false){
        die("Error: Could not connect." . mysqli_connect_error());
    }
?>
