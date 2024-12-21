<?php include './A_Functions/url.php';?>


<script src="../JS/SA_searchFunctionCustomer.js"></script>
<script src="../JS/A_statusUpdateCustomerMembership.js"></script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Membership Customer List | Administration System Qualiteeth Dental Clinic | Sistem Pentadbiran Klinik Pergigian Qualiteeth</title> 
	<link rel="stylesheet" href="../CSS/A_adminList.css">
</head>

<body>
	<header>
		<?php include './A_Functions/A_NavBar.php';?>
	</header>
	<div class="border-container">
		<div class="backSearch">
			<a class="arrow" href="A_Dashboard.php">
				<div class="al">
					<i class="fas">&#xf060;</i> Go back
				</div>
			</a>
			<div class="Mingbaibox">
				<input class="stxt" type="text" name="valueToSearch" id="myInput" onkeyup="searchFunction()" placeholder="Type To Search" />
			</div>
		</div>
		<div class="boxform">
		<legend>
			<h2 class="h3NA">Only Customers who are in the Loyalty Program.</h2>
		</legend>
				<table id="myTable">
				<thead>
					<tr>
						<th colspan="4">Membership Customer</th>
					</tr>
					<tr>
						<th>ID</th>
						<th>Email</th>
						<th>Type</th>
						<th>Payment</th>
					</tr>
				</thead>
				<?php //include './A_Functions/db_connection.php';
				$sql = "SELECT * FROM paymentmembership";
				$result = $conn->query($sql);	//execute query connection
				$search_result = mysqli_query($conn, $sql);
				
				//Fetch Data form database
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){ 
						while($row = mysqli_fetch_array($search_result)): ?>
						<tr>
							<td align="center"><?php echo $row['c_id']; ?></td>
							<td align="center"><?php echo $row['c_email']; ?></td>
							<td align="center"><?php echo $row['c_typeMember']; ?></td>
							<td align="center"><?php echo $row['c_payment']; ?></td>				
						</tr>
						<?php endwhile;?>
						<?php
					}//end while loop
				}else{
				?>
					<tr>
						<th colspan="4">There's No data found!!!</th>
					</tr>
					<?php
					}//end else statement
				?>
			</table>

		</div>
	</div> 
</body>

</html> 