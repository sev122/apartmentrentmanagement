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
	<link rel="stylesheet" type="text/css" href="css/mini-toggle-switch.css">
	<title><?php echo $firstname . " " . $lastname . "'s Bill";?></title>
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
			<a class="navbar-brand" id="websiteName" href="index.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px">EllApartment</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="admin-dashboard-page.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
			<li><a href="admin-accounts-page.php" id="accounts"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
			<li><a href="bill.php" id="bill"><span class="glyphicon glyphicon-credit-card"></span> Billing</a></li>
			<li><a class="active"href="records-page.php" id="hideRecords"><span class="glyphicon glyphicon-file"></span>Records</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="">Welcome <?php echo $logged_account;?></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</div>
<div class="container">
	<div class="row">
		<legend id="pages"><a class="hyperlinks" href="records-page.php" id="recordslink"> Records</a> <span class="glyphicon glyphicon-chevron-right"></span><a class="hyperlinks" href="admin-unit-bill-page.php?viewBill=<?php echo $id;?>"> <?php echo $firstname . " " . $lastname ;?></a></legend>
		<div class="table-responsive">
			<h3 class="title text-center">TENANT'S BILL</h3>
			<div class="container">
				<ul class="menu panel-menu">
					<li><a href="bill.php" id="addBillBtn"><span class="glyphicon glyphicon-plus"></span> Add Bill</a></li>
					<li><a href="pdf/receipt.php?printBill=<?php echo $id ?>"><span  class="glyphicon glyphicon-print"></span> Print Report</a></li>
				</ul>
			</div>
			<div class="container-fluid col-lg-6">
				<table class="table table-bordered w-auto">
					<thead>
						<tr>
							<th class="text-center bckgrnd-gray" colspan="4"><span class="glyphicon glyphicon-user"></span> ACCOUNT SUMMARY</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Name: </th>
							<td><?php echo $firstname. " " . $lastname; ?></td>
							<th>Unit No:</th>
							<td><?php echo $unit_no; ?></td>
						</tr>
						<tr><td colspan="4" class="bckgrnd-gray"></td></tr>
						<tr>
							<th colspan="2">Electric Bill:</th>
							<td colspan="2"><?php echo "PHP ". number_format($electricTotal, 2); ?></td>
						</tr>
						<tr>
							<th colspan="2">Water Bill:</th>
							<td colspan="2"><?php echo "PHP ". number_format($waterTotal, 2); ?></td>
						</tr>
						<tr>
							<th colspan="2">Rental Bill:</th>
							<td colspan="2"><?php echo "PHP ". number_format($rentalTotal, 2); ?></td>
						</tr>
						<tr><td colspan="4" class="bckgrnd-gray"></td></tr>
						<tr>
							<th colspan="2" class="emphasize"><h4>Total Bill:</h4></th>
							<td colspan="2" class="emphasize"><h4><?php echo "PHP ". number_format($totalBill, 2); ?></h4></td>
						</tr>
						<tr>
							<th colspan="2">Notes:</th>
							<td colspan="2"><?php echo $notes; ?></td>
						</tr>
						<tr>
							<th colspan="2">Due Date:</th>
							<td colspan="2"><?php echo $dueDate; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="container-fluid col-lg-6">
				<table class="table table-bordered w-auto">
					<thead>
						<tr>
							<th class="text-center bckgrnd-gray" colspan="4"><span class="glyphicon glyphicon-flash"></span> ELECTRIC BILL</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="text-center">Total Amount Due</th>
							<th class="text-center">Total kWh</th>
							<th class="text-center">Current kWh</th>
							<th class="text-center">Previous kWh</th>
						</tr>
						<tr>
							<td class="text-center"><?php echo "PHP ". number_format($eTotalAmountDue, 2); ?></td>
							<td class="text-center"><?php echo $totalkwh; ?></td>
							<td class="text-center"><?php echo $unitkwh; ?></td>
							<td class="text-center"><?php echo $prevkwh; ?></td>
						</tr>
						<tr><td colspan="4" class="bckgrnd-gray"></td></tr>
						<tr>
							<th class="text-right" colspan="3">Electric Total Bill</th>
							<td class="text-center"><?php echo "PHP ". number_format($electricTotal, 2); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="container-fluid col-lg-6">
				<table class="table table-bordered w-auto">
					<thead>
						<tr>
							<th class="text-center bckgrnd-gray" colspan="4"><span class="glyphicon glyphicon-tint"></span> WATER BILL</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="text-center">Total Amount Due</th>
							<th class="text-center">Total m3</th>
							<th class="text-center">Current m3</th>
							<th class="text-center">Previous m3</th>
						</tr>
						<tr>
							<td class="text-center"><?php echo "PHP ". number_format($wTotalAmountDue, 2); ?></td>
							<td class="text-center"><?php echo $totalm3; ?></td>
							<td class="text-center"><?php echo $unitm3; ?></td>
							<td class="text-center"><?php echo $prevm3; ?></td>
						</tr>
						<tr><td colspan="4" class="bckgrnd-gray"></td></tr>
						<tr>
							<th class="text-right" colspan="3">Water Total Bill</th>
							<td class="text-center"><?php echo "PHP ". number_format($waterTotal, 2); ?></td>
						</tr>
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