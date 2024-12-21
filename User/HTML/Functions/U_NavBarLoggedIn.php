<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/headerLogIn.css">
</head>
<header class="header">
    <div class = "container">
        <div class="header-1">
            <a href="Home.php" class="logo" ><img src="../Images/FCUC_Sports_logo.png" alt="FCUC_Sports_Logo" height="100"></a>
        </div>
        <div class="header-2">
            <nav class="navbar">
                <a href="About.php">About Us</a>
                <a href="Facilities.php">Facilities</a>
                <a href="Booking.php">Booking</a>
                
                <a href="UserPage.php" class = "awd">
                    <img class = "uicon" src="../Images/user.png" alt="login icon">
                    <button type="button" class="button1"><?php  echo $_SESSION['c_name']; ?></button>
                </a>
                <a href="./Functions/Function_LogOut.php">
                    <button type="button" class="button2">Logout</button>
                </a>
            </nav>
        </div>
    </div>
</header>
</html>