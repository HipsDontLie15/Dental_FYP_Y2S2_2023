<?php 
    include "Function_ConnectSQL.php";
    session_start();
    
    if (!isset($_SESSION['c_email'])) {
        echo "<script>alert('Please log in first!'); window.location='U_LoginSignUp.php';</script>";
    exit;
    }
    error_reporting(E_ALL & ~E_NOTICE);

?>