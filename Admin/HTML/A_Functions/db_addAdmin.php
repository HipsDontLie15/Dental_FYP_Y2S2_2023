<script>
	var redirectURL = '../SA_AdminList.php';
</script>
<?php
    include 'db_connection.php';
	if(isset($_POST['submit'])){
		$username=$_POST['Admin_username'];
		$password=$_POST['Admin_psw'];
		$name=$_POST['Admin_name'];
		$image="default.png";
		$type=$_POST['superAdmin'];
		date_default_timezone_set('Asia/Kuala_Lumpur');
		$created_at=date('Y-m-d H:i:s');
		$status = "active";
		
		$usn = "SELECT * FROM `admins` WHERE admin_username = '$username'";
		$pwd = "SELECT * FROM `admins` WHERE admin_password = '$password'";
		$sql = "INSERT INTO admins (admin_username, admin_password, admin_name, admin_image, superAdmin, created_at, status) VALUES ('$username', '$password', '$name', '$image', '$type', '$created_at','$status')";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$sel = mysqli_query($conn, $usn);
			$sal = mysqli_query($conn, $pwd);

			if (mysqli_num_rows($sel) > 0) {
				echo "<script>
						alert('Username already exists.');
						window.location.href = redirectURL;
					</script>";
			} else if (mysqli_num_rows($sal) > 0) {
				echo "<script>
						alert('Password already used.');
						window.location.href = redirectURL;
					</script>";
			} elseif ($conn->query($sql) === TRUE) {
				echo "<script>
						alert('Successfully Add Admin');
						window.location.href = redirectURL;
					</script>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}


	}//end insert
?>
