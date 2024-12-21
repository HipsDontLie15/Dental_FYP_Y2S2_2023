<?php
    include "Function_ConnectSQL.php";
    if (!session_id()) {
        session_start();
    }
    if (!isset($_SESSION['c_email'])) {
        include './Functions/Function_NavBarLogOut.php';
    }else{
        include './Functions/Function_NavBarLogged.php';
    }
?>