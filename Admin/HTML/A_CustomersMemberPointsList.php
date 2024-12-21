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
				<table id="myTable">
				<thead>
					<tr>
						<th colspan="7">Overall Membership Customer Transaction History</th>
					</tr>
					<tr>
						<th>No.</th>
						<th>Email</th>
						<th>ID</th>
						<th>Free Twice Yearly Hygiene</th>
						<th>Free Twice Yearly Examination</th>
						<th>SmilePoints</th>
						<!-- <th>Created at</th> -->
					</tr>
				</thead>
				<form name ="form" action="<?php echo $A_AddCustomers_Points ?>" method="post" >
				<?php 
				
				$find = "SELECT * FROM `customermembership` ORDER BY `cm_id` DESC";
				$search_result = $conn->query($find);
				
				//Fetch Data form database
				if ($search_result->num_rows > 0) {
					while ($row = mysqli_fetch_array($search_result)) {
					?>
						<tr>
							<td align="center"><?php echo $row['cm_id']; ?></td>
							<td align="center"><?php echo $row['c_email']; ?></td>
							<td align="center"><?php echo $row['c_id']; ?></td>
							<td align="center"><?php echo $row['c_hygiene']; ?></td>
							<td align="center"><?php echo $row['c_examination']; ?></td>
							<td align="center"><?php echo $row['c_points']; ?></td>
							<!-- <td align="center"><?php echo $row['created_at']; ?></td> -->
						</tr>
						<?php
					}//end while loop
				}else{
				?>
					<tr>
						<th colspan="7">There's No data found!!!</th>
					</tr>
					<?php
					}//end else statement
				?>
			</table>

		</div>
	</div> 
</body>

</html> 