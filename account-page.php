<?php 
include 'database.php';
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'tenant') {
		$logged_account = $_SESSION['username'];
	}
	else{
		header("Location: index.php");
	}
}
else{
	header("Location: index.php");
}
include 'unit-process.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta lang="en">
	<meta name="viewport" content="width=device-width, initial scale=1">
	<link rel="icon" type="text/css" href="img/e-logo.png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/design.css">
	<link rel="stylesheet" type="text/css" href="css/records.css">
	<title><?php echo $firstname . " " . $lastname . "'s Bills";?></title>
	<style type="text/css">
	.bckgrnd-gray{
		background-color: #ddd;
	}
	.emphasize{
		font-size: 28px;
		color: #b00;
	}
	</style>
</head>
<body>

<div class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" id="websiteName" href="admin-dashboard-page.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px">EllApartment</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="admin-dashboard-page.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
			<li><a href="admin-accounts-page.php" id="accounts"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
			<li><a href="bill.php" id="bill"><span class="glyphicon glyphicon-credit-card"></span> Billing</a></li>
			<li><a class="active"href="records-page.php" onclick="hide_content()" id="hideRecords"><span class="glyphicon glyphicon-file"></span>Records</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="">Welcome <?php echo $logged_account;?></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</div>
<div class="container">
	<div class="row">
		<legend id="pages"><a class="hyperlinks" href="records-page.php" id="recordslink"> Records</a> <span class="glyphicon glyphicon-chevron-right"></span><a class="hyperlinks" href="account-page.php?tenantBills=<?php echo $unit_no;?>"> <?php echo $firstname . " " . $lastname ;?></a></legend>
		<div class="table-responsive">
			<h3 class="title text-center">TENANT'S BILL</h3>
			<div class="container">
				<ul class="menu panel-menu">
					<li><a href="bill.php" id="addBillBtn"><span class="glyphicon glyphicon-plus"></span> Add Bill</a></li>
					<!--<li><a href="pdf/reports.php?printBill=<?php #echo $id ?>"><span  class="glyphicon glyphicon-print"></span> Print Report</a></li>-->
				</ul>
			</div>
			<div class="container border-mint table-responsive">
				<table class="table table-hover text-center" width="100%">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">Name</th>
							<th class="text-center">Unit No.</th>
							<th class="text-center">Unit kWh</th>
							<th class="text-center">Electric Bill Total</th>
							<th class="text-center">Unit m3</th>
							<th class="text-center">Water Bill Total</th>
							<th class="text-center">Rental Bill</th>
							<th class="text-center">Total Bill</th>
							<th class="text-center">Notes</th>
							<th class="text-center">Due Date</th>
							<th class="text-center">Reading Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$count = 1;
						while ($row=mysqli_fetch_assoc($selectTentantsBills)) { ?>
						<tr>
							<td><?php echo $count;?></td>
							<td><a href="admin-unit-bill-page.php?viewBill=<?php echo $row['id'];?>"><?php echo $row['firstname'] ." ". $row['lastname'];?></a></td>
							<td><?php echo $row['unit_no'];?></td>
							<td><?php echo $row['unitkwh'];?></td>
							<td><?php echo number_format($row['electricTotal'],2);?></td>
							<td><?php echo $row['unitm3'];?></td>
							<td><?php echo number_format($row['waterTotal'],2);?></td>
							<td><?php echo number_format($row['rentalTotal'],2);?></td>
							<td><?php echo number_format($row['totalBill'],2);?></td>

							<td><?php echo $row['notes'];?></td>
							<td><?php echo $row['dueDate'];?></td>
							<td><?php echo $row['readingDate'];?></td>
							<td><?php echo $row['status'];?></td>
						</tr>
					<?php $count++ ;} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	 window.onload = function hide_content(){
	 	if (<?php echo $_SESSION['role'] == 'tenant'; ?>) {
	 		document.getElementById('hideRecords').style.display = 'none';
			document.getElementById('hideRecords').href = '';
			document.getElementById('accounts').innerHTML = '<span class ="glyphicon glyphicon-user"></span> Profile';
			document.getElementById('accounts').href = 'profile-page.php?viewAccount=<?php echo $_SESSION['user_id'];  ?>';
			document.getElementById('bill').innerHTML = '<span class ="glyphicon glyphicon-credit-card"></span> Bills';
			document.getElementById('bill').href = 'account-page.php?tenantBills=<?php echo $_SESSION['unit_no'];  ?>';
			document.getElementById('recordslink').href = 'account-page.php?tenantBills=<?php echo $_SESSION['unit_no'];  ?>';
			document.getElementById('addBillBtn').style.display = 'none';
	 	}
			
	}
</script>

</body>
</html>