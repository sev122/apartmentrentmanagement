<?php 
include 'database.php';
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == 'admin') {
		$logged_account = $_SESSION['username'];
	}
	else{
		header("Location: tenant-dashboard-page.php");
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
	<title>Records</title>
</head>
<body>

<div class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" id="websiteName" href="admin-dashboard-page.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px">EllApartment</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="admin-dashboard-page.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
			<li><a href="admin-accounts-page.php"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
			<li><a href="bill.php"><span class="glyphicon glyphicon-credit-card"></span> Billing</a></li>
			<li><a href="records-page.php" class="active"><span class="glyphicon glyphicon-file"></span>Records</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="">Welcome <?php echo $logged_account;?></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</div>
<div class="container-fluid">
	<div class="container">
		<div class="row">
			<?php if (isset($_SESSION['alert_success'])):?>
			<div class="alert alert-success alert-dismissible show" role="alert">
				<strong>SUCCESS! </strong>
				<?php

				echo $_SESSION['alert_success'];
				unset ($_SESSION['alert_success']);
				?>
				<button type="button" data-dismiss="alert" class="close" aria-label="Close">&times;</button>
			</div>
			<?php endif ?>
			<?php if (isset($_SESSION['alert_danger'])):?>
			<div class="alert alert-danger alert-dismissible show" role="alert">
				<strong>FAILED! </strong>
				<?php

				echo $_SESSION['alert_danger'];
				unset ($_SESSION['alert_danger']);
				?>
				<button type="button" data-dismiss="alert" class="close" aria-label="Close">&times;</button>
			</div>
			<?php endif ?>
			<div class="col-lg-12 col-xs-12">
				<ul class="menu panel-menu">
					<li><a href="bill.php"><span class="glyphicon glyphicon-plus"></span> Add Bill</a></li>
					<li><a href="pdf/reports.php"><span  class="glyphicon glyphicon-print"></span> Print Report</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">	
					<form class="navbar-form pull-right col-xs-12" action="records-page.php" method="POST">
						<div class="form-group col-xs-10">
							<input type="text" class="form-control" name="searchValue" placeholder="Search">
						</div>
						<button type="submit" name="search" class="btn btn-dark"><span class="glyphicon glyphicon-search"></span></button>
					</form>
				</ul>
			</div>
			<div class="container col-lg-12 col-xs-12 border-mint" id="table">
				<table class="table table-hove table-font-sm text-center" width="100%">
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
							<th class="text-center">Status</th>
							<th class="text-center"><span class="glyphicon glyphicon-option-horizontal"></span></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$count = 1;
						while ($row=mysqli_fetch_assoc($selectBillsRec)) { ?>
						<tr>
							<td><?php echo $count;?></td>
							<td><a href="account-page.php?tenantBills=<?php echo $row['unit_no']; ?>"><?php echo $row['firstname'] ." ". $row['lastname'];?></a></td>
							<td><?php echo $row['unit_no'];?></td>
							<td><?php echo $row['unitkwh'];?></td>
							<td><?php echo number_format($row['electricTotal'],2);?></td>
							<td><?php echo $row['unitm3'];?></td>
							<td><?php echo number_format($row['waterTotal'],2);?></td>
							<td><?php echo number_format($row['rentalTotal'],2);?></td>
							<td class="text-danger"><?php echo number_format($row['totalBill'],2);?></td>

							<td><?php echo $row['notes'];?></td>
							<td><?php echo $row['dueDate'];?></td>
							<td><?php echo $row['readingDate'];?></td>
							<td>
								<?php echo $row['status']; ?>
							</td>
							<td id="<?php echo $row['id'];?>">
								<a type="button" class="btn btn-sm btn-dark" href="admin-unit-bill-page.php?viewBill=<?php echo $row['id'];?>"><span class="glyphicon glyphicon-eye-open"></span></a>
								<a type="button" class="btn btn-sm btn-mint" href="bill.php?editBill=<?php echo $row['id'];?>"><span class="glyphicon glyphicon-edit"></span></a>
								<button class="btn btn-danger btn-sm modalDelRecBtn"><span class="glyphicon glyphicon-trash"></span></button>
							</td>
						</tr>
					<?php $count++ ;} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="modalDelRec" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="records-page.php" method="POST">
				<div class="modal-header">
					<button role="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h3 class="modal-title" id="exampleModalLabel">Delete Record</h3>
				</div>
				<div class="modal-body">
					<input type="hidden" name="delete_id" id="delete_id">
					<p>Are you sure you want to delete this record?</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button"data-dismiss="modal">No</button>
					<button class="btn btn-mint" type="submit" name="deleteBill">Yes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.modalDelRecBtn').on('click', function(){
			$('#modalDelRec').modal('show');

			$tr = $(this).closest('tr');
			var data = $tr.children("td").map(function(){
				return $(this).attr("id");
			}).get();

			console.log(data);
			$('#delete_id').val(data[0]);
		});
	});
</script>

</body>
</html>